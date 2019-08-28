<?php 
if(isset($_POST["data"])){
    $newTask = json_decode($_POST["data"]);

    $json = file_get_contents('todo.json');
    $jsonDecoded = json_decode($json, true);
    $jsonDecoded['increment']++;

    $newTask->id = $jsonDecoded['increment'];

    array_push($jsonDecoded['items'], $newTask);

    $newJson = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
    file_put_contents('todo.json', $newJson);
    //fin du traitement du JSON

    //changer le state de la requête AJAX
    $dataSend = json_encode($newTask);
    echo $dataSend;
}
?>