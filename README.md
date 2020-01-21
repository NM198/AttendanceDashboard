# AttendanceDashboard
Employee attendance and information Dashboard


Instructions - Backend:

Instructions for new user setup and save nfc tag. 

0. Check the nfc reader, In the terminal -- python3 /var/www/html/Dashboard/Backend/readone.py and then place nfc to reader. 

1. Register a new user using nfc, In the terminal -- python3 /var/www/html/Dashboard/Backend/save_user.py and then place nfc to reader. Follow the steps on the display. 

2. Log attendance,  In the terminal -- python3 /var/www/html/Dashboard/Backend/check_attendance.py and then place nfc to reader.



Instructions - frontend:

Instructions to view attendance

1. install all requirements mentioned below on local machine.

2. make a new directory to keep scripts within default NGINX folder --- sudo mkdir /var/www/html/Dashboard

3. Save repository within Dashboard file -- sudo git clone (this repository) /var/www/html/Dashboard 

4. Find local ip address to be displayed Run --  hostname -I

5. Visit IP address.

6. DONE! 




Requirements - packages: 

Here we have the packages that need to be installed on your machine to run the app

1. mysql 
2. php 
3. python3
4. NGINX 
5. medoo framework


Requieremnts - Hardware:

Here we have the hardware requirements that we need to build the full system

1. Raspberry pi 
2. SD card
3. Breadboard
4. Breadboard wire
5. potentiometer
6. NFC READER(RC522) 
7 LCD display 
