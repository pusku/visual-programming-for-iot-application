<?php
//
// function parseJson(){
//     $str = file_get_contents('https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');
//     $json = json_decode($str, true);
//     $status = $json['weather'][0]['description'];
//     //echo $status;
//     return $status;
// }

//The URL that we want to send a PUT request to.

function action_motor(){
    $url = 'http://localhost:8080/restapp/public/index.php/api/action/update/1';
    
    $fields=array (
        "id"=>"1",
        "atag"=>"/ac0wtc23",
        "action"=>"1",
        "time"=>"2018-09-09 14:08:27"
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($fields));

    $response = curl_exec($ch);

    echo $response;
}

// function get_lowersensor(){
//     $url = 'http://localhost:8080/restapp/public/index.php/api/lowerlastvalue';
//     $str = file_get_contents($url);
//     $json = json_decode($str, true);
//     $status = $json[0]['data'];
//     echo $status;

// }

action_motor();
