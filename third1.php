<?php
$limit = "";
$count="";
if (isset($_GET["offset"])) {
    $limit = "limit " . $_GET["offset"] . "";
}
if (isset($_GET["count"])) {
    $count="count(".$_GET["count"]."),";
}

$dir = 'sqlite:db.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");
$query =  "select r.*, c.name as country, w.name as workclass, e.name as education_level, m.name as marital_status, o.name as occupation, re.name as relationship, ra.name as race, s.name as sex
from records r 
left join countries c on r.country_id=c.id 
left join workclasses w on r.workclass_id=w.id 
left join education_levels e on r.education_level_id=e.id
left join marital_statuses m on r.marital_status_id=m.id
left join occupations o on r.occupation_id=o.id
left join relationships re on r.relationship_id=re.id
left join races ra on r.race_id=ra.id
left join sexes s on r.sex_id=s.id
" . $limit . "
;";
$result = $dbh->query($query);

foreach ($result as $row) {
    $line["id"] = $row["id"];
    $line["age"] = $row["age"];
    $line["workclass_id"] = $row["workclass_id"];
    $line["education_level_id"] = $row["education_level_id"];
    $line["education_num"] = $row["education_num"];
    $line["marital_status_id"] = $row["marital_status_id"];
    $line["occupation_id"] = $row["occupation_id"];
    $line["relationship_id"] = $row["relationship_id"];
    $line["race_id"] = $row["race_id"];
    $line["sex_id"] = $row["sex_id"];
    $line["capital_gain"] = $row["capital_gain"];
    $line["capital_loss"] = $row["capital_loss"];
    $line["hours_week"] = $row["hours_week"];
    $line["country_id"] = $row["country_id"];
    $line["over_50k"] = $row["over_50k"];
    $line["country"] = $row["country"];
    $line["workclass"] = $row["workclass"];
    $line["education_level"] = $row["education_level"];
    $line["marital_status"] = $row["marital_status"];
    $line["occupation"] = $row["occupation"];
    $line["relationship"] = $row["relationship"];
    $line["race"] = $row["race"];
    $line["sex"] = $row["sex"];

    $data[] = $line;
}

echo json_encode($data);



$dbh = null;
