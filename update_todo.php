<?php

require 'databaseConnection.php';

$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);

parse_str($url_components['query'], $params);
$id = $params['id'];

$validatedID = mysqli_real_escape_string($con, $id);
$query = "SELECT * FROM todolist WHERE id=$validatedID ";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run)){
    $todo = mysqli_fetch_array($query_run);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        
    </body>
    </html>
        <div class="container">
            <h5 class="text-center mt-4">Please amend the todo</h5>
            <form action="code.php" method="POST" class="text-center p-4">
                <input type="text" value="<?=$todo[1]?>" name="updatetodo">
                <input type="hidden" value="<?=$todo[0]?>" name="updateid">
                <button type="submit" name="update2"><i class="material-icons icon-dark">check_circle</i></button>
            </form>
        </div>
    <?php
};
  ?>  
