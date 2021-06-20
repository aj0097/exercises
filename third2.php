<?php 
$aggregationType = "";
$aggregationValue="";
if (isset($_GET["aggregationType"]) && isset($_GET["aggregationValue"])) {
    $aggregationType = $_GET["aggregationType"];
    $aggregationValue = $_GET["aggregationValue"];
    
    $dir = 'sqlite:db.sqlite';
    $dbh  = new PDO($dir) or die("cannot open the database");
    $query =  "select sum(capital_gain) as capital_gain_sum,avg(capital_gain) as capital_gain_avg, sum(capital_loss) as capital_loss_sum, 
    avg(capital_loss) as capital_loss_avg,sum(case when over_50k=true then 1 else 0 end) as over_50k_count , sum(case when over_50k=false then 1 else 0 end) as under_50k_count 
    from records where $aggregationType=$aggregationValue;";

    $result= $dbh->query($query) or die;
    $row=$result->fetch();

    $data["aggregationType"]= $aggregationType;
    $data["aggregationValue"]= $aggregationValue;
    $data["capital_gain_sum"]=$row["capital_gain_sum"];
    $data["capital_gain_avg"]=$row["capital_gain_avg"];
    $data["capital_loss_sum"]=$row["capital_loss_sum"];
    $data["capital_loss_avg"]=$row["capital_loss_avg"];
    $data["over_50k_count"]=$row["over_50k_count"];
    $data["under_50k_count"]=$row["under_50k_count"];
    echo json_encode($data);

}
else{
    echo "Please insert aggregationType and aggregationValue ";
    die;
    }


?>