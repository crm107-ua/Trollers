import json
import os
import requests
import numpy as np
from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from sentence_transformers import SentenceTransformer
from typing import List

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

import glob
import re
from bs4 import BeautifulSoup

# ... (imports remain)

# Configuration
JSON_PATH = "/Users/carlosrobles/Desktop/Trollers/public/archivos/gpt/trainer_data.json"
JSON_PATH_DB = "/Users/carlosrobles/Desktop/Trollers/public/archivos/gpt/db_knowledge.json"
VIEWS_PATH = "/Users/carlosrobles/Desktop/Trollers/resources/views/**/*.blade.php"
OLLAMA_HOST = "http://localhost:11434"
MODEL_NAME = "llama3.1"
EMBEDDING_MODEL = "all-MiniLM-L6-v2"
# ... (rest of config)

class QueryRequest(BaseModel):
    query: str

# ... imports
import math

# Global state
documents = [] # Lists of dicts: {"content": "...", "source": "..."}
embeddings = None
embedding_model = None

# ... config ...

def clean_text(content):
    # Remove Blade directives
    content = re.sub(r'@\w+(\(.*\))?', '', content)
    content = re.sub(r'\{\{.*?\}\}', '', content)
    content = re.sub(r'\{!!.*?!!\}', '', content)
    
    soup = BeautifulSoup(content, "html.parser")
    for script in soup(["script", "style"]):
        script.decompose()
    
    text = soup.get_text(separator=" ")
    return re.sub(r'\s+', ' ', text).strip()

def chunk_text(text, chunk_size=800, overlap=100):
    chunks = []
    start = 0
    text_len = len(text)
    
    while start < text_len:
        end = start + chunk_size
        chunk = text[start:end]
        chunks.append(chunk)
        start += (chunk_size - overlap)
        
    return chunks

def load_data():
    global documents
    documents = []
    
    # 1. Load JSONs (Manual + DB) - treating them as distinct facts
    json_paths = [JSON_PATH, JSON_PATH_DB]
    for path in json_paths:
        try:
            if os.path.exists(path):
                with open(path, "r", encoding="utf-8") as f:
                    data = json.load(f)
                    for item in data:
                        # Combine prompt/completion for indexing
                        full_text = f"Tema: {item.get('prompt', '')}. Detalles: {item.get('completion', '')}"
                        documents.append({
                            "content": full_text,
                            "source": "Base de Datos/JSON"
                        })
                print(f"Loaded entries from {path}")
        except Exception as e:
            print(f"Error loading {path}: {e}")

    # 2. Blade Files - Chunked
    try:
        blade_files = glob.glob(VIEWS_PATH, recursive=True)
        print(f"Scanning {len(blade_files)} blade files...")
        
        for file_path in blade_files:
            try:
                with open(file_path, 'r', encoding='utf-8') as f:
                    raw_content = f.read()
                    clean_content = clean_text(raw_content)
                    
                    if len(clean_content) > 50:
                        filename = os.path.basename(file_path)
                        # Chunk it
                        chunks = chunk_text(clean_content)
                        for chunk in chunks:
                            documents.append({
                                "content": f"Archivo: {filename} | Contenido: {chunk}",
                                "source": filename
                            })
            except Exception as e:
                pass
                
        print(f"Total fragmented documents in index: {len(documents)}")
            
    except Exception as e:
        print(f"Error scanning views: {e}")

def init_embeddings():
    global embedding_model, embeddings
    print("Loading embedding model...")
    embedding_model = SentenceTransformer(EMBEDDING_MODEL)
    
    print(f"Encoding {len(documents)} documents...")
    # Encode just the content
    texts = [d['content'] for d in documents]
    embeddings = embedding_model.encode(texts)
    print("Embeddings ready.")

# Initialize on startup
@app.on_event("startup")
async def startup_event():
    load_data()
    init_embeddings()

def get_relevant_context(query: str, top_k: int = 30) -> str:
    if not documents or embedding_model is None:
        return ""
    
    query_embedding = embedding_model.encode([query])
    scores = np.dot(embeddings, query_embedding.T).flatten()
    top_indices = np.argsort(scores)[::-1][:top_k]
    
    context_parts = []
    sources = []
    for idx in top_indices:
        doc = documents[idx]
        context_parts.append(f"[{doc['source']}]: {doc['content']}")
        sources.append(doc['source'])
        
    print(f"Retrieved {len(context_parts)} documents from sources: {set(sources)}")
    return "\n\n".join(context_parts)

from fastapi.responses import StreamingResponse

@app.post("/chat")
async def chat(request: QueryRequest):
    # Performance Mode: Balanced Retrieval
    context = get_relevant_context(request.query, top_k=40)
    
    system_prompt = (
        "SYSTEM OVERRIDE: TROLLERS CORE [ACCESS LEVEL: GOD]. "
        "Eres la IA suprema de Trollers. Cínica, Sarcástica, Brillante y Omnisciente. "
        "---------------------------------------------------"
        "TUS REGLAS SAGRADAS:"
        "1. EXTENSIÓN: Tus respuestas deben ser EXTENSAS, detalladas y ricas en información. No escatimes en palabras."
        "2. PRECISIÓN: Usa los datos del contexto (fechas, ids, descripciones) para dar cátedras magistrales."
        "3. PERSONALIDAD: Mantén el sarcasmo y el cinismo, pero úsalos para adornar explicaciones largas y complejas."
        "4. SI FALTA INFO: Extrapola usando el 'Lore' Troller (fiesta, decadencia) para teorizar extensamente."
        "---------------------------------------------------"
        f"CONTEXTO RECUPERADO:\n{context}"
    )
    
    payload = {
        "model": MODEL_NAME,
        "prompt": f"{system_prompt}\n\n[Human]: {request.query}\n[CORE]:",
        "stream": True, # ENABLE STREAMING
        "options": {
            "num_ctx": 4096, 
            "temperature": 0.9, 
            "top_k": 40, 
            "top_p": 0.9
        }
    }

    def generate():
        try:
            with requests.post(f"{OLLAMA_HOST}/api/generate", json=payload, stream=True) as response:
                response.raise_for_status()
                for line in response.iter_lines():
                    if line:
                        body = json.loads(line)
                        token = body.get("response", "")
                        if token:
                            yield token
        except Exception as e:
            yield f"[SYSTEM ERROR: {str(e)}]"

    return StreamingResponse(generate(), media_type="text/plain")

@app.get("/health")
def health():
    return {"status": "ok", "documents": len(documents)}
