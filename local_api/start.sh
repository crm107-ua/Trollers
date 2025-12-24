#!/bin/bash
source venv/bin/activate
uvicorn local_api.server:app --reload --port 8001
