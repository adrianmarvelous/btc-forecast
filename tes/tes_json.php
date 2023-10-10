<?php
// Read the existing JSON file
$file_name = 'pretty_json.json'; // Adjust the filename
$jsonString = file_get_contents($file_name);

// Decode the JSON string into a PHP associative array
$data = json_decode($jsonString, true);

if ($data === null) {
    die('JSON decoding error');
}

if(!$data['id']){
    $data['id'] = 1;
}

// Add another "item"
$newItem = [
    'id' => $data['id']++,
    'jam' => date('H'),
    'menit' => date('i'),
    'detik' => date('s') 
];

// Append the new "item" to the existing "item" array
$data['item'][] = $newItem;

// Encode the updated data as JSON with pretty indentation
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// Check for errors during encoding
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON encoding error: ' . json_last_error_msg());
}

// Save the updated JSON data back to the file
file_put_contents($file_name, $jsonData);

// Output the updated JSON data as an HTTP response (optional)
header('Content-Type: application/json');
echo $jsonData;
?>
