<?php
    if(isset($_POST["edit"])){
        $Archive = json_decode($_POST["edit"]);
        $json = file_get_contents('todo.json');
        $jsonDecoded = json_decode($json, true);
    
    foreach($Archive as $element){
        $index = array_search($element['id'], array_column($jsonDecoded['items'], 'id'), false);//? On utilisera "array_column" pour qu'il sélectionne bien la clé 'id' de 'items'
        $archived=$jsondecoded['items'][$index]['archive'];
        $jsondecoded['items'][$index]['archive'] = $archived ? false : true;
        
    }
    
        $newArchive = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
        file_put_contents('todo.json', $newArchive);

        echo 'done';
    }
?>