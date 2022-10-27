<?php
$data = array();
$data['IDAgence'] = $_POST['agence'];
$data['IDUser'] = 1;
$data['dateT'] = $_POST['date'];
$data['timeT'] = "00:00:00";
$data['service'] = 1;   
$data = json_encode($data);

$url = "http://localhost/eticket/public/index.php/addTicket/" . $data;
print_r($url);
$ch = curl_init($url);
$result = curl_exec($ch);
curl_close($ch);
?>