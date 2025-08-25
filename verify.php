<?php
header('Content-Type: text/plain');

$license_key = $_GET['key'] ?? '';

// Leggi il file licenses.json
$data = file_get_contents('licenses.json');
$licenses = json_decode($data, true);

if (isset($licenses['licenses'][$license_key])) {
    $license = $licenses['licenses'][$license_key];
    if ($license['status'] === 'active') {
        echo "VALID";
    } else {
        echo "INACTIVE";
    }
} else {
    echo "NOT_FOUND";
}
?>
