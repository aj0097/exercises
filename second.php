<?php

$dir = 'sqlite:db.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");
$query =  "SELECT count(*) as numberOfPeople,w.name, avg((r.capital_gain-r.capital_loss)) as avg from records r left join workclasses w on r.workclass_id=w.id group by w.name;";
$result= $dbh->query($query) or die;

foreach($result as $row){
    //$line["id"]=$row["id"];
    //$line["age"]=$row["age"];
    $line["numberOfPeople"]=$row["numberOfPeople"];
    $line["name"]=$row["name"];
    $line["avg"]=$row["avg"];
    $data[]=$line;
}
echo json_encode($data);
$dbh = null;
?>