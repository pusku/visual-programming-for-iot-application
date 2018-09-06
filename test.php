<?php
$str = file_get_contents('https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');
$json = json_decode($str, true);
$status = $json['weather'][0]['description'];
echo $status;