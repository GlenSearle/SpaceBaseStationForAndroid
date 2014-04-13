/*
  Blink
  Turns on an LED on for one second, then off for one second, repeatedly.
 
  This example code is in the public domain.
 */
 
// Pin 13 has an LED connected on most Arduino boards.
// give it a name:
int led = 13;

// the setup routine runs once when you press reset:
void setup() {                
  // initialize the digital pin as an output.
  pinMode(led, OUTPUT);     
  Serial.begin(115200); 
}

// the loop routine runs over and over again forever:
void loop() {
 
  byte theChar;
  theChar = Serial.read()-'0'; 
 
  int l;
  if (theChar<10) {
    for (l=0; l<theChar; l++) {
      digitalWrite(led, HIGH);   // turn the LED on (HIGH is the voltage level)
      delay(20);               // wait for a second
      digitalWrite(led, LOW);    // turn the LED off by making the voltage LOW
      delay(300);               // wait for a second
    }
  }
    delay(500);               // wait for a second
}
