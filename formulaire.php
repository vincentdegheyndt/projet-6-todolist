<?php 
if(isset($_POST["data"])){
    $newTask = json_decode($_POST["data"]);
    $json = file_get_contents('todo.json');
    $jsonDecoded = json_decode($json, true);
    //sanitization du text
    $oldText = $newTask->text;
    $valText = trim(filter_var($oldText, FILTER_SANITIZE_STRING));
    $newTask->text = $valText;

    if (empty($newTask->text)){
        $vide = "0";
        echo $vide;
    }else{
    $jsonDecoded['increment']++;

    $newTask->id = $jsonDecoded['increment'];
    // push
    array_push($jsonDecoded['items'], $newTask);

    $newJson = json_encode($jsonDecoded, JSON_PRETTY_PRINT);
    file_put_contents('todo.json', $newJson);
    //fin du traitement du JSON

    //changer le state de la requête AJAX
    $dataSend = json_encode($newTask);
    echo $dataSend;
    }

}



/*if(isset($_POST["data"])){
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
}*/
?>
