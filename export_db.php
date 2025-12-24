<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Proyecto;
use App\Models\BOE;
use App\Models\Enigma;
use App\Models\Protocolo;
use App\Models\Minecraft;
use App\Models\Minijuego;
use App\Models\MW3;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\StoryView; // Good for aggregate analytics
use App\Models\Notificacion;
use App\Models\Calendar;
use App\Models\Image;
use App\Models\Stream;
use App\Models\Timeline;

$data = [];

// 1. Users
try {
    $users = User::all();
    foreach ($users as $u) {
        // Create normalized name for better search (Rubén -> Ruben)
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $u->name);
        $data[] = [
            "prompt" => "Información sobre el usuario: {$u->name} / {$normalized} (Email: {$u->email})",
            "completion" => "Datos completos del usuario: " . json_encode($u->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Users exported: " . count($users) . "\n";
} catch (\Exception $e) {
    echo "Error users: " . $e->getMessage() . "\n";
}

// 2. Proyectos
try {
    $proyectos = Proyecto::all();
    foreach ($proyectos as $p) {
        $data[] = [
            "prompt" => "Detalles del proyecto: {$p->titulo}",
            "completion" => "Datos del proyecto: " . json_encode($p->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Proyectos exported: " . count($proyectos) . "\n";
} catch (\Exception $e) {
    echo "Error proyectos: " . $e->getMessage() . "\n";
}

// 3. BOE (Boletín Oficial)
try {
    $boes = BOE::all();
    foreach ($boes as $b) {
        $data[] = [
            "prompt" => "Contenido del BOE: {$b->titulo}",
            "completion" => "Datos del BOE: " . json_encode($b->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "BOEs exported: " . count($boes) . "\n";
} catch (\Exception $e) {
    echo "Error BOE: " . $e->getMessage() . "\n";
}

// 4. Enigmas
try {
    $enigmas = Enigma::all();
    foreach ($enigmas as $e) {
        $data[] = [
            "prompt" => "Solución o detalles del enigma: {$e->titulo}",
            "completion" => "Datos del Enigma: " . json_encode($e->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Enigmas exported: " . count($enigmas) . "\n";
} catch (\Exception $e) {
    echo "Error Enigmas: " . $e->getMessage() . "\n";
}

// 5. Minijuegos (New)
try {
    $minijuegos = Minijuego::all();
    foreach ($minijuegos as $m) {
        $data[] = [
            "prompt" => "Información del minijuego: {$m->titulo}",
            "completion" => "Datos del minijuego: " . json_encode($m->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Minijuegos exported: " . count($minijuegos) . "\n";
} catch (\Exception $e) {
    echo "Error Minijuegos: " . $e->getMessage() . "\n";
}

// 6. Minecraft (New)
try {
    $mc = Minecraft::all();
    foreach ($mc as $m) {
        $title = isset($m->titulo) ? $m->titulo : 'General';
        $data[] = [
            "prompt" => "Datos de Minecraft: {$title}",
            "completion" => "Datos de Minecraft: " . json_encode($m->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Minecraft exported: " . count($mc) . "\n";
} catch (\Exception $e) {
    echo "Error Minecraft: " . $e->getMessage() . "\n";
}

// 7. MW3 (New)
try {
    $mw3 = MW3::all();
    foreach ($mw3 as $m) {
        $title = isset($m->titulo) ? $m->titulo : 'General';
        $data[] = [
            "prompt" => "Datos de MW3: {$title}",
            "completion" => "Datos de MW3: " . json_encode($m->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "MW3 exported: " . count($mw3) . "\n";
} catch (\Exception $e) {
    echo "Error MW3: " . $e->getMessage() . "\n";
}

// 8. Stories & Comments
try {
    $stories = Story::with(['comments', 'user'])->get();
    foreach ($stories as $s) {
        $username = $s->user ? $s->user->name : $s->user_name;
        $data[] = [
            "prompt" => "Historia/Story de {$username} (ID: {$s->id})",
            "completion" => "Detalles Story: " . json_encode($s->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Stories exported: " . count($stories) . "\n";
} catch (\Exception $e) {
    echo "Error Stories: " . $e->getMessage() . "\n";
}

// 9. Calendar / Cumpleaños / Eventos
try {
    $events = Calendar::all();
    foreach ($events as $ev) {
        $data[] = [
            "prompt" => "Evento calendario: {$ev->titulo} (Fecha: {$ev->fecha})",
            "completion" => "Datos Evento: " . json_encode($ev->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Calendar exported: " . count($events) . "\n";
} catch (\Exception $e) {
    echo "Error Calendar: " . $e->getMessage() . "\n";
}

// 10. Notifications
try {
    $nots = Notificacion::all();
    foreach ($nots as $n) {
        $data[] = [
            "prompt" => "Notificación sistema ID {$n->id}",
            "completion" => json_encode($n->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Notifications exported: " . count($nots) . "\n";
} catch (\Exception $e) {
    echo "Error Notifications: " . $e->getMessage() . "\n";
}

// 11. Protocolos
try {
    $protos = Protocolo::all();
    foreach ($protos as $p) {
        $data[] = [
            "prompt" => "Protocolo existente: {$p->titulo}",
            "completion" => json_encode($p->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Protocols exported: " . count($protos) . "\n";
} catch (\Exception $e) {
    echo "Error Protocols: " . $e->getMessage() . "\n";
}

// 12. Images / Gallery
try {
    $imgs = Image::all();
    foreach ($imgs as $img) {
        $data[] = [
            "prompt" => "Imagen de galería: {$img->titulo} (Usuario: {$img->id_user})",
            "completion" => json_encode($img->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Images exported: " . count($imgs) . "\n";
} catch (\Exception $e) {
    echo "Error Images: " . $e->getMessage() . "\n";
}

// 13. Stream
try {
    $streams = Stream::all();
    foreach ($streams as $st) {
        $data[] = [
            "prompt" => "Stream/Directo datos: {$st->titulo}",
            "completion" => json_encode($st->toArray(), JSON_UNESCAPED_UNICODE)
        ];
    }
    echo "Streams exported: " . count($streams) . "\n";
} catch (\Exception $e) {
    echo "Error Streams: " . $e->getMessage() . "\n";
}


// 14. Timeline (Hardcoded Source of Truth)
$timelineIds = [
    ["year" => "2012", "title" => "Los Inicios", "desc" => "Dos grupos separados. Preparación del inicio de The Trollers."],
    ["year" => "2013", "title" => "El Pacto", "desc" => "Firma del pacto el 28 de Noviembre de 2013 entre Jose Javier Pastor y Carlos Robles. Primeros corporantes: Antonio Vicedo, David Bernabeu, Eduardo Payá, Jose Alberto Oltra, Daniel Martos."],
    ["year" => "2014", "title" => "Nuevo Horizonte", "desc" => "Inicio de la era dorada. Costumbres: Pirotecnia, Telepizza. Incorporaciones: Carlos Micó, Héctor Martinez, Manuel Rocamora, Iván Micluti, Daniel Castalla."],
    ["year" => "2015", "title" => "El Año de Oro", "desc" => "Máximo de 14 integrantes. Presupuesto récord en LoL y Telepizza. Fin de la era dorada con la explosión de Tomás Picó. Abandonos: Jose Alberto Oltra, David Bernabeu."],
    ["year" => "2016", "title" => "La Caída", "desc" => "Llegada de 'bichitos' (mujeres). Creación de 'El Palace'. Abandonos: Stivo Martinez, Héctor Martinez, Gabriel Alfonzo."],
    ["year" => "2017", "title" => "Los Pilares", "desc" => "Consolidación y tolerancia. Reincorporación: David Bernabeu."],
    ["year" => "2018", "title" => "La Fusión", "desc" => "Renacimiento Troller. Incorporaciones: Ramón García, Roberto Bernabeu, Rubén Agulló. Reincorporación clave: Jose Alberto Oltra, Stivo Martinez, Gabriel Alfonzo. Delegación San Juan: Pedro Pérez."],
    ["year" => "2019", "title" => "Michigan", "desc" => "Estabilidad y Ministerios. Incorporación: Martin Olivares."],
    ["year" => "2020", "title" => "COVID / Morfeo", "desc" => "Protocolo Morfeo ante defunciones. Éxodo a la metrópolis."],
    ["year" => "2021", "title" => "Año Neutro", "desc" => "Mayoría de edad de Martín."],
    ["year" => "2022", "title" => "Gala I", "desc" => "1era Gala Troller. Entrada de Eze Díaz."],
    ["year" => "2023", "title" => "Euroavis / Grupo Mixto", "desc" => "Creación del Grupo Mixto con María García, Alejandro Moltó, Alejandro Gisbert. Abandono del ministro de Economía."],
    ["year" => "2024", "title" => "Actualidad", "desc" => "Reintegraciones: David Bernabéu e Iván Gabriel Micluti."]
];

try {
    foreach ($timelineIds as $t) {
        $data[] = [
            "prompt" => "Historia Trollers Año {$t['year']}: {$t['title']}",
            "completion" => "En {$t['year']} ocurrió '{$t['title']}': {$t['desc']}"
        ];
    }
    echo "Timeline (Hardcoded) exported: " . count($timelineIds) . "\n";
} catch (\Exception $e) {
    echo "Error Timeline: " . $e->getMessage() . "\n";
}

// 5. Save to JSON
$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents(public_path('archivos/gpt/db_knowledge.json'), $json);

echo "Successfully exported " . count($data) . " items to public/archivos/gpt/db_knowledge.json\n";
