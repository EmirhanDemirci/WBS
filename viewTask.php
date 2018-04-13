<?php
/**
 * Created by PhpStorm.
 * User: Rajestic
 * Date: 27-3-2018
 * Time: 13:30
 */
require ('database.php');



?>

<html>
<head>
    <title>Bootstrap Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h1>Dit zijn de taken van: <b id="project_id"><?=$taken[$_GET['project_id']]['projectnaam']?></b></h1>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Taak ID</th>
                <th scope="col">Taak Name</th>
                <th scope="col">Plan</th>
                <th scope="col">Do</th>
                <th scope="col">Klok</th>
                <th scope="col">Delete Task</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $taak){ ?>
                        <tr id="row<?=$taak['id']?>">
                            <td><?=$taak['id']?></td>
                            <td><?=$taak['taken']?></td>
                            <td class="plan<?=$taak['id']?>"><?=$taak['plan']?></td>
                            <td style="
                            color: <?=( ( strtotime($taak['plan']) > strtotime($klok[$taak['id']]['totaalGeklokt']) ) ? 'green' : 'red') ?>" data-dezeSessie=""                                             class="alleDo do<?=$taak['id']?>"><?=(empty($klok[$taak['id']]['totaalGeklokt']) ? "00:00:00" : $klok[$taak['id']]['totaalGeklokt'])?></td>
                            <td><i data-status="uitgeklokt" data-value="<?=$taak['id']?>" class="material-icons timerIcon">timer_off</i></td>
                            <td><label data-taak_id="<?=$taak['id']?>"  class="btn btn-danger deleteTask">Delete Task</label></td>
                            <?php echo '<pre>'; print_r ($total[$taak['id']]['totaalGeklokt']  ); echo '</pre>';


?>
                        </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
<script type="text/javascript" src="main.js"></script>

</html>