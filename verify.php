<?php
header('Content-Type: text/plain');

$license_key = $_GET['key'] ?? '';
$mac_address = $_GET['mac'] ?? '';

// Leggi il file licenses.json
$data = file_get_contents('licenses.json');
$licenses = json_decode($data, true);

if (isset($licenses['customers'][$license_key])) {
    $license = $licenses['customers'][$license_key];
    
    if ($license['status'] === 'active') {
        if (empty($license['mac_address'])) {
            // Prima attivazione - aggiorna il file
            $licenses['customers'][$license_key]['mac_address'] = $mac_address;
            file_put_contents('licenses.json', json_encode($licenses, JSON_PRETTY_PRINT));
            echo "ACTIVATED:".$mac_address;
        }
        elseif ($license['mac_address'] === $mac_address) {
            echo "VALID";
        } else {
            echo "INVALID_MAC";
        }
    } else {
        echo "INACTIVE";
    }
} else {
    echo "NOT_FOUND";
}
?>
