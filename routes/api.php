<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

Route::get('/warera-prices', function () {
$db = new SQLite3('/home/carlos/warera/warera_prices.db');
    // Fecha desde hace 7 días, a las 00:00
    $from = Carbon::now()->subDays(30)->startOfDay()->toDateTimeString();

    $stmt = $db->prepare("SELECT * FROM prices WHERE timestamp >= :from ORDER BY timestamp ASC");
    $stmt->bindValue(':from', $from, SQLITE3_TEXT);

    $results = $stmt->execute();

    $rows = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $rows[] = $row;
    }

    return response()->json($rows);
});
