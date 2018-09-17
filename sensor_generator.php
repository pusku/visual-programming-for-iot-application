<?php
$setup = "";
$loop = "";
$variables = "";
$myfile = fopen("SoilMoistureSensor/SoilMoistureSensor.ino", "r+") or die("Unable to open file!");

$data = fread($myfile,filesize("SoilMoistureSensor/SoilMoistureSensor.ino"));

//$arr = explode('{' , rtrim($data, '}')); 

//$arr = str_split($data,"\n");

$arr = explode("\n", $data);

//print_r($arr);

for($x = 0; $x < sizeof($arr); $x++){
    // echo "x\n".$a."\n </br> x";
    if(strpos($arr[$x],"setup")){
        for($i = $x+1 ; $i < sizeof($arr); $i++){
            if($arr[$i]=="}"){
                break;
            }
            $setup = $setup . $arr[$i];
         
        }
        break;
    }
}
echo "\n*setup code*\n".$setup;

for($x = 0; $x < sizeof($arr); $x++){
    // echo "x\n".$a."\n </br> x";
    if(strpos($arr[$x],"loop")){
        for($i = $x+1 ; $i < sizeof($arr); $i++){
            if($arr[$i]=="}"){
                break;
            }
            $loop = $loop . $arr[$i];
        }
        break;
    }
}

echo "</br>\n*loop code*\n".$loop;

for($x = 0; $x < sizeof($arr); $x++){
    // echo "x\n".$a."\n </br> x";
    //echo $arr[$x];
    if(substr($arr[$x],0,3)== "int" || strpos($arr[$x],"String") || strpos($arr[$x],"float")){
        $variables = $variables.$arr[$x];
    }
}

echo "</br>\n*variables code*\n".$variables;

$code = '
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <ESP8266WiFi.h>

 
const char* ssid = "Research_LAB";
const char* password =  "diulab505";
const char* mqttServer = "m10.cloudmqtt.com";
const int mqttPort = 13964 ;
const char* mqttUser = "hvgihpll";
const char* mqttPassword = "CTMRYdz5vSx4";  


WiFiClient espClient;
PubSubClient client(espClient);

char topicValue[10];
char mac [15];
int value;
'.$variables.'
void setup() {'.$setup.'
    WiFi.begin(ssid, password);
   
    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.println("Connecting to WiFi..");
    }
    Serial.println("Connected to the WiFi network");
   
    client.setServer(mqttServer, mqttPort);
    client.setCallback(callback);
   
    while (!client.connected()) {
      Serial.println("Connecting to MQTT...");
   
      if (client.connect("ESP8266Client", mqttUser, mqttPassword )) {
   
        Serial.println("connected");  
   
      } else {
   
        Serial.print("failed with state ");
        Serial.print(client.state());
        delay(2000);
   
      }
    }
   
    
    //client.subscribe("/WTC");
   
  }
  void reconnect(){
      while (!client.connected()) {
      Serial.println("Connecting to MQTT...");
   
      if (client.connect("ESP8266Client", mqttUser, mqttPassword )) {
   
        Serial.println("connected");  
   
      } else {
   
        Serial.print("failed with state ");
        Serial.print(client.state());
        delay(2000);
   
      }
    }
  }
   
  void callback(char* topic, byte* payload, unsigned int length) {
   
    Serial.print("Message arrived in topic: ");
    Serial.println(topic);
   
    Serial.print("Message:");
    for (int i = 0; i < length; i++) {
      Serial.print((char)payload[i]);
    }
   
    Serial.println();
    Serial.println("-----------------------");
   
  }
   
  void loop() {'.$loop.'
    String payload = "";
    payload += value;
    payload.toCharArray(topicValue,10);
    MAC.toCharArray(mac,15);
 
    if (!client.connected()) {
   reconnect();
  }
   client.loop();
   client.publish(mac, topicValue);
 delay(2000);
 }
 ';

//open or create if dosent exist 
$myfile = fopen("xxx.ino", "w") or die("Unable to open file!");
//write codein to the file
fwrite($myfile, $code);
//close the file
fclose($myfile);

?>