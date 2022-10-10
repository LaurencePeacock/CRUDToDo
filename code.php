<?php

require 'databaseConnection.php';

if (isset($_POST['todo'])) {
 
    $todo = mysqli_real_escape_string($con, $_POST['todo']);
    $sql = "INSERT INTO todolist (todo) VALUES ('$todo')";

    if (!$con->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $con->error;
        }
    $con->close();

    header( "Location: {$_SERVER['PHP_SELF']}", true, 303 );
    exit();
 }

 if(isset($_POST['complete_task'])){
    $id = mysqli_real_escape_string($con, $_POST['complete_task']);

    $sql = "DELETE FROM todolist WHERE id='$id' ";

    if (!$con->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
      $con->close();
 
    
    header( "Location: {$_SERVER['PHP_SELF']}", true, 303 );
    exit();
 }

 if(isset($_POST['updatetodo'])){
   
    $updated_Todo = mysqli_real_escape_string($con, $_POST['updatetodo']);
    $id = mysqli_real_escape_string($con, $_POST['updateid']);

    $sql = "UPDATE todolist SET todo='$updated_Todo' WHERE id='$id' ";
    $query_run = mysqli_query($con, $sql);
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>
    
    <div class="container">
        <table class="table table-hover table-bordered table-striped table-dark  m-3 rounded">
                                <?php 
                                require 'databaseConnection.php';
                                    $query = "SELECT * FROM todolist";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        ?>
                                         <thead>
                                                 <tr>
                                                    <th class="text-center">To do</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Done</th>
                                                 </tr>
                                            </thead>
                                        <?php
                                        foreach($query_run as $todo)
                                        {
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td class="text-center"><?= $todo['todo']; ?></td>
                                                <td class="text-center">
                                                    <a href="update_todo.php?id=<?= $todo['id'];?>">
                                                        <i class="material-icons">edit</i></td>
                                                    </a>
                                                <td class="text-center">
                                                    <form action="code.php" method="POST">
                                                    <button  type="submit" name="complete_task" value="<?=$todo['id'];?>>"><i class="material-icons">check_circle</i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="container mt-5 "></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card text-center p-3">
                                        <?php
                                            echo "<h5>Please add a to do item </h5>";
                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $con->close();
                                ?>
                                
                            </tbody>
            </table>
        </div>

    <!-- <div class="container-sm mt-5">
        <div class="row">
            <div class="col-md-12"> -->
                <div class="container">
                    <form action="code.php" method="POST" class="text-center p-4" >
                        <label >Todo</label>
                        <input type="text" name="todo"  >
                        <button type="submit" name="form" class="btn btn-primary" >add</button>
                    </form>
                </div>
            <!-- </div>
        </div>
    </div> -->

    
</body>
</html>