<?php
// Since I can't run spark or easily use the CI4 environment via CLI due to DB issues,
// I'll try to find an existing user ID and attempt a dry-run insert if this was a web request.
// But wait, I can just check the table's definition if the script works.

$db = \Config\Database::connect();
try {
    $fields = $db->getFieldNames('shifts');
    echo "Shifts table fields: " . implode(', ', $fields) . "\n";
    
    $query = $db->query("DESCRIBE shifts");
    foreach ($query->getResult() as $row) {
        echo "Field: {$row->Field}, Type: {$row->Type}, Null: {$row->Null}, Key: {$row->Key}\n";
    }
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
