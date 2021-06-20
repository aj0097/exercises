<?php

$dir = 'sqlite:db.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");
$query =  "SELECT count(*) from records where over_50k=TRUE and age<30;";
$result= $dbh->query($query) or die;

foreach($result as $row){
    //$line["id"]=$row["id"];
    //$line["age"]=$row["age"];
    $data[]=$row;
}
echo json_encode($data);
$dbh = null; //This is how you close a PDO connection
?>