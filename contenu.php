<?php  

$json = file_get_contents('todo.json');
$data = json_decode($json, true);

/*
foreach ($data['items'] as $result){
    if($result['archive']){
        $archives .= "<li id=".$result['id']." checked=".($result['check'] ? 'checked' : 'unchecked')." archived=".($result['archive'] ? "yes" : "no" ).">".$result['text']."</li>";
    }else{
        $tasks .= "<li id=".$result['id']." onClick='checkStart(this)' checked=".($result['check'] ? 'checked' : 'unchecked')." archived=".($result['archive'] ? "yes" : "no" ).">".$result['text']."</li>";
    }    
};
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Todo</title>
</head>
<body>
        <table>
        <tr><td><h1>To do list</h1></td></tr>
        <tr><td><p>A faire</p></td></tr>
        <tr>
            <td>
            <ul id="columns" class="dropper">
                <?php 
                foreach ($data['items'] as $result){
                    if($result['archive']==false){

                        echo '<li id="'.$result['id'].'" class="column" onClick="checkStart(this)" draggable="true" checked="'.$result['check'].'" archived="'.$result['archive'].'">'.$result['text'].'</li>';
                    }   
                };
                echo $tasks; 
                ?>
            </ul>
            </td>
        </tr>
        <tr>
            <td><button id="addArchive">Archiver</button></td>
        </tr>
        <tr><td><p>Archive</p></td></tr>
        <tr>
            <td>
            <ul id="archive" class="dropper">
            <?php 
            foreach ($data['items'] as $result){
                if($result['archive']){
                    $archives .= '<li id="'.$result['id'].'" checked="'.($result['check'] ? 'true' : 'false').'" archived="'.($result['archive'] ? "yes" : "no" ).'">'.$result['text'].'</li>';
                }   
            };
                echo $archives; 
            ?>
            </ul>
            </td>
        </tr>

        </table>
        <form method="post">
            <table>
                <tr><td><h3>Ajouter une tâche</h3></td></tr>
                <tr><td>La tâche à effectuer</td></tr>
                <tr>
                    <td><input type="text" id="activity" />
                        <button id="addTask" name="add">Ajouter</button>
                        <div id="demo"></div>
                    </td>
                </tr>
            </table>
        </form>
        <p id="response"></p>
    <script src="main.js"></script>
    <script src="main2.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<!--$newstr = filter_var($activity, FILTER_SANITIZE_STRING);