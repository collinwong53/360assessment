<?php
include('mysql_connect.php');
$query = 
    "SELECT 
        date,
        time,
        hitemp,
        lowtemp,
        windspeed,
        heatindex 
    FROM 
        weather
    WHERE 
        heatindex<91 AND windspeed>0";
if(!($stmt=$conn->prepare($query))){
    echo 'query failed';
    exit();
}
$stmt->execute();
$results = $stmt->get_result();
if($results->num_rows>0){
    while($row = $results->fetch_assoc()){
        $output['data'][] = $row;
    }
}else{
    $output['messages'][] = 'nothing to read';
}
$output['success'] = true;

foreach($output['data'] as $value){
    $display = nl2br(
    "date: {$value['date']} \n
    time : {$value['time']} \n
    high temp: {$value['hitemp']} \n
    low temp: {$value['lowtemp']} \n
    windspeed: {$value['windspeed']} \n
    heat index : {$value['heatindex']} \n\n");
    echo $display;
}
exit();
?>