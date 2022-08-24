#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

LiquidCrystal_I2C lcd(0x27, 16, 2); // don't know what address to put instead of 0x27 as the scanner don't work

//Inialisasi nilai pin awal
const int sensorPin   = A0;
const int LedHijau    = 15;
const int LedKuning   = 13;
const int LedMerah    = 12;

//config wifi
const char* ssid      = "*"; //nama wifi/hostpot
const char* password  = "00000000"; //password wifi
const char* host      = "192.168.34.198"; //IP PC
const int httpPort    = 80; //Port dari servernya

//inialisasi nilai batas bawah dan atas
const int BatasBawah  = 50;
const int BatasAtas   = 250;

float tinggiAir = 0; 
float nilaiakhir = 0; 
float sensorVoltage = 0;

int nilaiMax = 1023; 
float panjangSensor = 4.0;

void setup() {

  //munculkan status koneksi di serial monitor
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  int i=0;
  while(WiFi.status() != WL_CONNECTED){ 
    Serial.print(".");
    delay(1000);     
  } 
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println();

  
  //perkenalkan sebagai nilai output
  pinMode(LedMerah, OUTPUT);
  pinMode(LedHijau, OUTPUT) ;
  pinMode(LedKuning, OUTPUT) ;
  //perkenalkan sebagai nilai input
  pinMode(sensorPin, INPUT);
  //Matikan semua LED
  digitalWrite(LedHijau, LOW);
  digitalWrite(LedKuning, LOW);
  digitalWrite(LedMerah, LOW);
  
  //Menghidupkan Serial monitor Pada 115200 Baud
  Serial.begin(115200);
  
  //Menghidupkan LCD
  lcd.begin();
  lcd.backlight();
  //Tampilan awal LCD
  lcd.setCursor(0, 0);
  lcd.print("   Pendeteksi");
  lcd.setCursor(0, 1);
  lcd.print(" Ketinggian Air");
}

void loop() {
   nilaiakhir = 0;
  //dapatkan ketinggian air dari sensor
  int analogValue = analogRead(sensorPin);
  tinggiAir = analogValue*panjangSensor/nilaiMax;
  //  Serial.println(tinggiAir);

  //menampilkan ketinggian air pada serial monitor
  Serial.print('Ketinggian Air : ');
  Serial.println(tinggiAir);
  
  //jka nilai ketinggian air dibawah batas bawah, maka hidupkan lampu hijau dan lampu yg lain mati
  if (analogValue < BatasBawah) {
    digitalWrite(LedHijau, HIGH);
    digitalWrite(LedMerah, LOW);
    digitalWrite(LedKuning, LOW);
  }
  
  //jka nilai ketinggian air diatas batas bawah, maka hidupkan lampu merah dan buzzer dan lampu yg lain mati
  if (analogValue > BatasAtas) {
   nilaiakhir = tinggiAir;   digitalWrite(LedKuning, LOW);
   digitalWrite(LedMerah, HIGH);
   digitalWrite(LedHijau, LOW);
   digitalWrite(LedKuning, LOW);

  }

  WiFiClient client;
 
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
  }
 
  // We now create a URI for the request
  String url = "/iot/insert.php?";
  url += "tinggi=";
  url += nilaiakhir;
 
  Serial.print("Requesting URL: ");
  Serial.println(url);
 
  // This will send the request to the server
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  if(client.available()== 0){
    Serial.println("Data Berhasil Disimpan");
  }else{
    Serial.println("Data Gagal Disimpan");
  }
 
  Serial.println();
  Serial.println("closing connection");

  delay(1000); //1 detik

}
