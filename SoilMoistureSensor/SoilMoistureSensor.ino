const String MAC = "/S07USWTC23";   
const String MAC = "/S07USWTC23";   
int sensorValue = A0;
int value;
void setup() {

    Serial.begin(115200);

}

void loop() {

     value = analogRead(sensorValue);

}
