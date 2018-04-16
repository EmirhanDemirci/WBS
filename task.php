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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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


<input class="col-md-3 col-md-offset-4 form-control" data-project_id="<?=$_GET['project_id']?>" id="taskname" type="text"  placeholder="Task Name" /> <br/>
<input class="col-md-3 col-md-offset-4 form-control" data-project_id="<?=$_GET['project_id']?>" id="predecessor" type="text"  placeholder="Predecessor" /> <br/>
<input class="col-md-3 col-md-offset-4 form-control" data-project_id="<?=$_GET['project_id']?>" id="developer" type="text"  placeholder="Developer" /> <br/>
<select class="col-md-3 col-md-offset-4 form-control" id="moscow">
    <option value="must">Must</option>
    <option value="should">Should</option>
    <option value="could">Could</option>
    <option value="wont">Wont</option>
</select> <br/>
<input class="col-md-3 col-md-offset-4 form-control" data-project_id="<?=$_GET['project_id']?>" id="plan" type="text" placeholder="Plan" required /> <br/>
<input class="col-md-3 col-md-offset-4 form-control" data-project_id="<?=$_GET['project_id']?>" id="check" type="text" placeholder="Check"></input> <br/>
<input class="col-md-3 col-md-offset-4 form-control"  data-project_id="<?=$_GET['project_id']?>" id="act" type="text" placeholder="Act"></input>

<label  id="submit2" class="col-md-2 col-md-offset-4 btn btn-primary btn-info" >Submit</label>
</body>
<script type="text/javascript" src="main.js"></script>
</html>