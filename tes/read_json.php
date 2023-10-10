<?php
    
    // Read the existing JSON file
    $file_name = 'pretty_json.json'; // Adjust the filename
    $jsonString = file_get_contents($file_name);

    // Decode the JSON string into a PHP associative array
    $data = json_decode($jsonString, true);

    if ($data === null) {
        die('JSON decoding error');
    }

    // Loop through the "item" array
    foreach ($data['item'] as $item) {
        // Loop through each column in the inner array
        foreach ($item as $key => $value) {
            echo "$key: $value<br>";
        }
        echo "<br>";
    }

    // Access the "id" outside the loop
    echo "id: " . $data['id'];

?>