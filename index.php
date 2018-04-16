<html>
<?php
require ('database.php');
/**
 * Created by PhpStorm.
 * User: Rajestic
 * Date: 27-3-2018
 * Time: 13:35
 */

?>
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">



</head>
        <body>
        <div class="jumbotron">
            <div class="container">
                <h1>WBS monitor</h1>
            </div>
        </div>


    <table class="table">
        <form action="project.php">
            <button type="submit" name="sturen" class="btn btn-success">Add Project</button>
        </form>


        <thead>
        <tr>
            <th scope="col">Project ID</th>
            <th scope="col">Project Name</th>
            <th scope="col">Estimated time (minutes)</th>
            <th scope="col">Actual time(minutes)</th>
            <th scope="col">view</th>
            <th scope="col">Add task</th>
            <th scope="col">Delete project</th>
        </tr>


        </thead>

        <body>
        <?php
        if (empty($projecten)){
            echo '<script> alert( "Er zijn geen project gevonden" ); </script>';
        }
        else
        {
        foreach ($projecten as $project){
        ?>

        <tr id="row<?=$project['project_id']?>">
            <td><?=$project['project_id']?></td>
            <td><?=$project['project_name']?></td>
            <td><label>Tijd</label></td>
            <td><label>Actual Time</label></td>
            <td><a href="viewTask.php?project_id=<?=$project['project_id']?>"><label class="btn btn-success">View Project</label></a></td>
            <td><a href="task.php?project_id=<?=$project['project_id']?>"><label class="btn btn-success">Add Task</label></a></td>
            <td><label data-project_id="<?=$project['project_id']?>"  class="btn btn-danger deleteProject">Delete Project</label></td>
        </tr>
        <?php       } // einde foreach ($taken as $taak)
        }
        ?>



        </body>
    </table>

        <script type="text/javascript" src="main.js"></script>
    </body>