<?php
    if(isset($_POST["edit"])){
        
        $Archive = json_decode($_POST["edit"]);
        $json = file_get_contents('todo.json');
        $jsonDecoded = json_decode($json, true);

        var_dump($Archive);
        echo '<br>';

    foreach($Archive as $element){
        $index = $element->id;
        $jsonDecoded['items'][$index-1]['archive']=true;
    }
       $newArchive = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
       file_put_contents('todo.json', $newArchive);
    }
?>