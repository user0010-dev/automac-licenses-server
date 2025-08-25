<?php
// Verifica licenza semplice per raw.githubusercontent.com
$license_key = $_GET['key'] ?? '';

// URL del file licenses.json
$json_url = 'https://raw.githubusercontent.com/user0010-dev/automac-licenses-server/main/licenses.json';
$json_data = file_get_contents($json_url);
$licenses = json_decode($json_data, true);

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
