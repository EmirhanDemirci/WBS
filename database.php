<?php
/**
 * Created by PhpStorm.
 * User: Rajestic
 * Date: 27-3-2018
 * Time: 13:35
 */

$servername = "localhost";
$username = "root";
$password = "";
$database = "wbs";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// hafiz heeft ons hiermee geholpen
function schoonmaakAssistent($value){
    $data = htmlentities($value, ENT_QUOTES); // "A 'quote' is <b>bold</b>" Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;
    return $data;
}

if (isset($_POST['ajax']) && $_POST['status'] == "verstuurProject"){
    $conn->query("INSERT INTO projecten VALUES (NULL , '{$_POST['firstname']}')");
}
if (isset($_POST['ajax']) && isset($_POST['project_id']) &&$_POST['status'] == "verstuurTask"){
    $conn->query("INSERT INTO taken VALUES (NULL , '{$_POST['taskname']}' , {$_POST['project_id']}, {$_POST['predecessor']}, NULL, NULL, '{$_POST['plan']}', NULL, NULL ) ");
}


if (isset($_GET['project_id'])){
    if (is_numeric($_GET['project_id'])){
        $filteredProject_id = schoonmaakAssistent($_GET['project_id']);
    }
    else
    {
        die("Die project id is geen nummer maar een dick");
    }
}

    if ($resource = mysqli_query($conn," SELECT 
                                                taken.*,
                                                COUNT(taken.project_id) AS `aantalTaken`,
                                                projecten.project_name AS `projectnaam`                                                    
                                                FROM taken
                                                LEFT JOIN projecten
                                                ON projecten.project_id = taken.project_id
                                                GROUP BY taken.project_id 
                                                           "))
    {
        while($result = mysqli_fetch_assoc($resource))
        {
            $taken[$result['project_id']] = $result;
        }
    }
    else
    {
        echo "There is a problem:"; // Message says that there is a problem.
        die(mysqli_error($conn)); // Shows the $connect variable.
    }

if (isset($_GET['project_id'])){
    if ($resource = mysqli_query($conn," SELECT * FROM taken WHERE project_id = {$_GET['project_id']} "))
    {
        while($result = mysqli_fetch_assoc($resource))
        {
            $tasks[$result['id']] = $result;
        }
    }
    else
    {
        echo "There is a problem:"; // Message says that there is a problem.
        die(mysqli_error($conn)); // Shows the $connect variable.
    }
}




if (isset($_POST['ajax']) && $_POST['status'] == "verwijderProject"){

    if ($taken[$_POST['project_id']]['aantalTaken'] > 0) {
        $conn->query(" DELETE projecten.*, taken.* FROM projecten, taken WHERE projecten.project_id = taken.project_id AND projecten.project_id = {$_POST['project_id']} ");
    } // einde ($projecten[$_POST['id']]['aantalOpdrachten'] > 0)
    else
    {
        $conn->query(" DELETE FROM projecten WHERE project_id = {$_POST['project_id']} ");
    }

}

if (isset($_POST['ajax']) && $_POST['status'] == "verwijderTask"){

        $conn->query(" DELETE FROM taken WHERE id = {$_POST['taak_id']} ");


}

    if ($resource = mysqli_query($conn," SELECT  * FROM projecten "))
    {
        while($result = mysqli_fetch_assoc($resource))
        {
            $projecten[$result['project_id']] = $result;
        }
    }
    else
    {
        echo "There is a problem:"; // Message says that there is a problem.
        die(mysqli_error($conn)); // Shows the $connect variable.
    }



if (isset($_GET['project_id']) && empty($tasks) && $_SERVER['SCRIPT_NAME'] !== "/wbs/task.php" ){
   die("Er zijn geen taken gevonden" );
}



if (isset($_POST['ajax']) && $_POST['status'] == "klokken"){
        $conn->query(" INSERT INTO klok VALUES (NULL, '{$_POST['tijd']}', {$_POST['taak_id']}) ");
}


if ($resource = mysqli_query($conn,"      SELECT 
                                                 taken.id as `taak_id`, 
                                                  SEC_TO_TIME( ROUND( SUM( TIME_TO_SEC(klok.tijd)) ) ) as `totaalGeklokt`
                                                 FROM taken
                                                 INNER JOIN klok
                                                 ON taken.id = klok.taak_id
                                                 GROUP BY taken.id 
                                                 "))
{
    while($result = mysqli_fetch_assoc($resource))
    {
        $klok[$result['taak_id']] = $result;
    }
}
else
{
    echo "There is a problem:"; // Message says that there is a problem.
    die(mysqli_error($conn)); // Shows the $connect variable.
}


if ($resource2 = mysqli_query($conn,"      SELECT 
                                                 taken.id as `taak_id`, 
                                                  ( ROUND( SUM( TIME_TO_SEC(klok.tijd)) ) ) as `totaalGeklokt`
                                                 FROM taken 
                                                 INNER JOIN klok
                                                 ON taken.id = klok.taak_id
                                                 GROUP BY taken.id 
                                                 "))
{
    while($result = mysqli_fetch_assoc($resource2))
    {
        $total[$result['taak_id']] = $result;
    }
}
else
{
    echo "There is a problem:"; // Message says that there is a problem.
    die(mysqli_error($conn)); // Shows the $connect variable.
}

if (isset($_POST['ajax']) && $_POST['status'] == "showKlok"){
    $id = $_POST['opdracht_id'];
    echo $klok[$id]['totaalGeklokt'];
}

