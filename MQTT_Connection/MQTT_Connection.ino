// MQTT Code 

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


void setup() {
 

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
 
void loop() {
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
