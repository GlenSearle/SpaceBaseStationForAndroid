#include <Servo.h> 
 Servo hip;
 Servo knee;
 Servo ankle;
 
 
void setup() 
{ 
  Serial.begin(115200);
  hip.attach(3);
  knee.attach(4);
  ankle.attach(5);
  
} 
 
 
void loop() { 
  switch (random(3)) {
    case 0:
    hip.write((random(170)+5));
    break;
    case 1:
    knee.write((random(170)+5));
    break;
    case 2:
    ankle.write((random(170)+5));
    break;
}
delay(random(500+random(100)*10));
} 
