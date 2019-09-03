<?php
    if(isset($_POST["edit"])){
        
        $Archive = json_decode($_POST["edit"]);
        $json = file_get_contents('todo.json');
        $jsonDecoded = json_decode($json, true);

    foreach($Archive as $element){
        //sanitization id
        $oldId = $element->id;
        $valId = trim(filter_var($oldId, FILTER_VALIDATE_INT));
        $index = $valId;
        //sanitization check
        $oldCheck = $element->check;
        $valCheck = trim(filter_var($oldCheck, FILTER_VALIDATE_BOOLEAN));
        $element->check = $valCheck;
        //sanitization archive
        $oldArchive = $element->archive;
        $valArchive = trim(filter_var($oldArchive, FILTER_VALIDATE_BOOLEAN));
        $element->archive = $valArchive;

        $jsonDecoded['items'][$index-1]['archive']=true;
    }
       $newArchive = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
       file_put_contents('todo.json', $newArchive);
    }
?>