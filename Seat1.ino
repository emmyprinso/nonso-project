//SKETCH FOR SEAT 1

#include <ESP8266WiFi.h> 
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Ticker.h>

Ticker indicator;
String lastUID = "";
int lastPressure = 0;
String URLi = "";
String httpResponse;

//LED blink function @Ardunino Ticker library basic example//
void flip(){
  int previous = digitalRead(00);//power LED connected to GPIO 00
    digitalWrite(00, !previous);  
  }

//VARIABLE DECLARATIONS 
//#define SS_PIN 4 connection on rfid reader gpio4
#define RST_PIN 5 //D1 rfid reader
//define GW
const char* ssid = "orange1292";//ROUTER SSID
const char* password = "n525zrf7";       //password
HTTPClient http;  //Declaration of an instance of the HTTPClient 

//connection setup
void setup() 
{
  Serial.begin(115200);   // Initiate a serial communication at 115200 baud rate
  SPI.begin();      // Initiate  SPI communication


  pinMode(00, OUTPUT);             

 WiFi.begin(ssid, password);              
 Serial.println();
 Serial.print("Connecting..");            


 // /*
   while (WiFi.status() != WL_CONNECTED) {  //check if the router is really connected
    delay(1000);
    Serial.print(".");
  }// */

indicator.attach(0.5, flip);  
} 
//end of setup

//loop function
void loop() 
{
      String receiverUID = RFIDFetch(4);
      int pressureRe = analogRead(A0);
      lastUID = receiverUID;

    while(pressureRe > 30){
        if(receiverUID == "")receiverUID = RFIDFetch(4);
        if(receiverUID != "")lastUID = receiverUID;
        indicator.detach();
        digitalWrite(00, LOW);
        pressureRe = analogRead(A0);
        URLi = "http://192.168.1.7/mdxlib/listener.php?seatnum=1";
        URLi += "&UID=";
        //URLi += lastUID;
        String spacer = lastUID;
        String spaceChar = " ";
        String webSpace = "%20";
        spacer.replace(spaceChar, webSpace);
        URLi += spacer;
        URLi += "&pressure=YES";
 //print the post request sent to serial monitor
        Serial.println(URLi);
          
          do{
          httpResponse = httpReq(URLi);
          Serial.println(httpResponse);
          delay(500);
          }while(httpResponse.indexOf("<br>firstname") < 4);
        //Serial.println(httpReq(URLi));
        receiverUID = RFIDFetch(4);
        while((lastUID == receiverUID || receiverUID == "") && pressureRe > 30){
          receiverUID = RFIDFetch(4);
          pressureRe = analogRead(A0);
      
          if(receiverUID != "" && receiverUID != lastUID){
            lastUID = receiverUID;
            break;
            }
            delay(2);
          }
      }
//loop send Get request to local host machine
        URLi = "http://192.168.1.7/mdxlib/listener.php?seatnum=1";
        URLi += "&UID=&pressure=NO";
        Serial.println(URLi);
        do{
          httpResponse = httpReq(URLi);
          Serial.println(httpResponse);
          delay(500);
          }while(httpResponse.indexOf("<br>firstname") < 4);
        //Serial.println(httpReq(URLi));

indicator.attach(0.5, flip);  //LED blink while ..

while(analogRead(A0) < 30) delay(2);
      
       //String URLi = "http://192.168.1.7/mdxlib/listener.php?seatnum=" + String(i+1) + "&UID=" + receiverUID + "&pressure=" + pressureResult;
      //Serial.println(URLi);
      //Serial.println(httpReq(URLi));
 
} 

///////////////////////////////////////////////////////////////////
//////////////////////FETCH VALUES FROM THE RFID CARD @https://randomnerdtutorials.com/security-access-using-mfrc522-rfid-reader-with-arduino//////////////////
String RFIDFetch(int SS_PIN){   //supply the chip select pin as parameter

  MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.
   mfrc522.PCD_Init();   // Initiate MFRC522
   // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return "";
  }
  // Select one of the cards
  if (!mfrc522.PICC_ReadCardSerial()) 
  {
    return "";
  }
  //Show UID on serial monitor
  //Serial.println();
  //Serial.print(" UID tag :");
  String myUID= "";
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     myUID.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     myUID.concat(String(mfrc522.uid.uidByte[i], HEX));
  
  }
  myUID.toUpperCase();
  return myUID.substring(1);
  }




  ///////////////////THE HTTP REQUEST @ https://techtutorialsx.com/2016/07/17/esp8266-http-get-requests/ /////////////////////////////
  String httpReq(String targetURL){
      String response = "";
      http.begin(targetURL); 
      int httpCode = http.GET(); 
    //while(httpCode < 0);
    if (httpCode > 0) { //Check the returning code
      response = http.getString();   //Get response
     }
    http.end();         //end the http connecton
    return response;    //returns the response to the caller
    }                   //end of request function
