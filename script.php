<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code execution</title>
</head>
<body>
<?php

$start = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>';

$end = '    
</body>
</html>';

$code = $_POST['code'];
echo $code;

$function = 'function parseJson(){
    $str = file_get_contents("https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22");
    $json = json_decode($str, true);
    $status = $json["weather"][0]["description"];
    return $status;}';

$myfile = fopen("generatedCode.php", "w") or die("Unable to open file!");
$code = $start."<?php \n ".$function."\n".$code."\n ?>".$end;
fwrite($myfile, $code);
fclose($myfile);

///////////////////////////
// Testing area 
 
//echo $code;
//eval($code);

// //Url 
// $url="https://randomuser.me/api/";
// $json = file_get_contents($url);
// $data = json_decode($json, TRUE);
// $location = $data["results"][0]["location"]["city"];
// $state = $data["results"][0]["location"]["state"];
// $location = str_replace(' ', '', $location);

// echo "<h1>Location : ".$location." State : ".$state."</h1>";

// $weather_url="https://samples.openweathermap.org/data/2.5/weather?appid=b6907d289e10d714a6e88b30761fae22&q=".$location;
// $weather_json = file_get_contents($weather_url);
// $weather_data = json_decode($weather_json, TRUE);
// $weather = $weather_data["weather"][0]["description"];

// echo "<h1>Weather : ".$weather."</h1>";


?>
</body>
</html>
