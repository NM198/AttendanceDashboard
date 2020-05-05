# AttendanceDashboard
Employee attendance and information Dashboard

This project is aiming at finding an efficient solution of automating the process of logging attendance within a traditional office environment.  A raspberry pi model 3B is used as a hardware platform along with an RC522 RFID reader, used to gather the employee’s data.  The key aim of this project is to find a way to automate the process of attendance tracking of daily attendance log-in, log-out times of employees. Another notable feature of this project includes a web interface granting access to company information, workflow resources and attendance statistics to all employees from top level management to all other employees as to enable employee management and productivity.  The design of the system is effective, portable and inexpensive making it a good fit for commercial and academic purposes.


Instructions Section:

  Instructions for new user setup(
  1. Register a new user using nfc, run save_user.py and then place nfc to reader. Follow the steps on display or script. 
  2. Log attendance,run record_attendance.py and then place nfc to reader.)


Instructions to view attendance(
  1. install all requirements mentioned below on local machine.
  2. make a new directory to keep scripts within default NGINX folder --- sudo mkdir /var/www/html/Dashboard
  3. Save repository within Dashboard file -- sudo git clone (this repository) /var/www/html/Dashboard 
  4. Find local ip address to be displayed Run --  hostname -I
  5. Visit IP address.
  6. DONE!) 

Requirements Section:
  1.PHP
  2.NGINX
  3.MySQL
  4.JavaScript
  5.Python

  Requierements - Hardware:
  Here we have the hardware requirements that we need to build the full system
  1. Raspberry pi 
  2. SD card
  3. Breadboard
  4. Breadboard wire
  5. potentiometer
  6. NFC READER(RC522) 
  7 LCD display 

  Requirements - Libraries: 
  1.Rpi.GPIO
  2.SimpleMFRC522
  3.Mysql.connector
  4.Adafruit_CharLCD
  5.Bootstrap




