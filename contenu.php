<?php  
    extract($_POST);
    $activity;
    $newstr = filter_var($activity, FILTER_SANITIZE_STRING);

        //Load the file
    $contents = file_get_contents('todo.json');
    
    //Decode the JSON data into a PHP array.
    $contentsDecoded = json_decode($contents, true);
    
    //Modify the counter variable.
    $contentsDecoded.=$newstr;
    
    //Encode the array back into a JSON string.
    $json = json_encode($contentsDecoded);
    
    //Save the file.
    file_put_contents('todo.json', $json);
   
    $contentss = file_get_contents('todo.json');
    var_dump(json_decode($contentss));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contenu</title>
</head>
<body>
    <hr/>
        <form method="post">
            <table>
                <tr><td><h3>Ajouter une tâche</h3></td></tr>
                <tr><td>La tâche à effectuer</td></tr>
                <tr>
                    <td><input type="text" name="activity" />
                        <input type="submit" name="submit_description" value="Ajouter"/>
                    </td>
                </tr>
            </table>
        </form>
    <hr/>
</body>
</html>

<!--
    $activity2 = json_encode($activity);

    $json = 'todo.json';
    // Ouvre un fichier pour lire un contenu existant
    $current = file_get_contents($json);
    // Ajoute une personne
    $current .= $activity2;
    // Écrit le résultat dans le fichier
    file_put_contents($json, $current);
    -->