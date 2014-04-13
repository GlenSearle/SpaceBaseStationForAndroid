/*
Some Arduino boards may need the analog pins set to input.
*/

#include <Servo.h>
  Servo servo0;
  Servo servo1;
  Servo servo2;
  Servo servo3;

int miliseconds=50;



void setup()
{
  servo0.attach(4);
  servo1.attach(5);
  servo2.attach(6);
  servo3.attach(7);

  Serial.begin(115200);

}

void loop()
{
      while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
      }
      //delay(miliseconds);

  while ( Serial.available() < 1 ) { delay(miliseconds); }
     char ch = Serial.read();

  switch (ch) {

    case 'G':
      GoServo();
      break;

    case 'M':
      char ch = Serial.read();
      switch (ch) {
        case '0':
          Serial.println( analogRead(0));
          break;
        case '1':
          Serial.println( analogRead(1));
          break;
        case '2':
          Serial.println( analogRead(2));
          break;
        case '3':
          Serial.println( analogRead(3));
          break;
        case '4':
          Serial.println( analogRead(4));
          break;
        case '5':
          Serial.println( analogRead(5));
          break;
        case '6':
          Serial.println( analogRead(6));
          break;
        case '7':
          Serial.println( analogRead(7));
          break;
      }

    break;

  }
}



void GoServo(){
      Serial.print("motor ");
      int motor=Serial.parseInt();
      Serial.print(motor);
      Serial.print(" ");
      float angle=Serial.parseInt();


switch (motor) {

     case 0:
     Serial.print("   was ");
     Serial.print(servo0.read());
     servo0.write(angle);
     Serial.print("   now ");
     Serial.println(servo0.read());
     break;

      case 1:
      Serial.print("   was ");
      Serial.print(servo1.read());
     servo1.write(angle);
     Serial.print("   now ");
     Serial.println(servo1.read());
      break;

    case 2:
      Serial.print("   was ");
      Serial.println(servo2.read());
      servo2.write(angle);
      Serial.print("   now ");
      Serial.println(servo2.read());
      break;

    case 3:
     Serial.print("   was ");
     Serial.print(servo3.read());
     servo3.write(angle);
     Serial.print("   now ");
    Serial.println(servo3.read());
      break;
  }

      return;
}
