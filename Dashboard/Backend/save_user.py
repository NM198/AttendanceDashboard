#!/usr/bin/env python
import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector
import Adafruit_CharLCD as LCD
import sys


db = mysql.connector.connect(
  host="localhost",
  user="attendanceadmin",
  passwd="attendance2020",
  database="attendancesystem"
)
cursor = db.cursor()
reader = SimpleMFRC522()
lcd = LCD.Adafruit_CharLCD(4, 24, 23, 17, 18, 22, 16, 2, 4);
valid_departments = ["Accounting", "Operations", "Transport", "Warehouse", "Sales", "accounting", "operations", "transport", "warehouse", "sales"]
try:
  while True:
    lcd.clear()
    lcd.message('Place Card to\nregister or edit')
    id, text = reader.read()
    cursor.execute("SELECT id FROM users WHERE rfid_uid="+str(id))
    cursor.fetchone()
    #check if existing user
    if cursor.rowcount >= 1:
      lcd.clear()
      lcd.message("Overwrite\nexisting user?")
      overwrite = input("Overwite (Y/N)? ")
      if overwrite[0] == 'Y' or overwrite[0] == 'y':
        lcd.clear()
        lcd.message("Overwriting user.")
        time.sleep(1)
        sql_insert = "UPDATE users SET name = %s, username = %s, department=%s WHERE rfid_uid=%s"
      else:
        continue;
    else:
      sql_insert = "INSERT INTO users (name, username, department, rfid_uid) VALUES (%s, %s, %s, %s)"
    lcd.clear()
    lcd.message('Enter Full name')
    print('Enter Full name')
    new_name = input("Name: ")
    lcd.message('Enter new username')
    print('Enter new username')
    new_username = input("Username: ") 
    lcd.message('Enter your department')
    print('Enter your department in the following format: Accounting, Operations, Sales, Transport, Warehouse')
    new_department = input("Department: ")
     #Reject user if input left empty:
    if new_name == '':
      print('Invalid! name field empty.')
      lcd.message('Invalid! name field empty.')
      sys.exit() #exit script if invalid
    #if input is not in alphabet, reject it:  
    if not(new_name.isalpha()):
      print('Invalid! name must be a string')
      lcd.message('Invalid! name must be a string')
      sys.exit()
    #Reject user if input left empty:  
    if new_username == '':
      print('Invalid! username field empty.')
      lcd.message('Invalid! username field empty.')
      sys.exit() 
    #Reject user if input left empty:
    if new_department == '':
      print('Invalid! department field empty.')
      lcd.message('Invalid! department field empty.')
      sys.exit() 
    #if department is not string, reject:  
    if not(new_department.isalpha()):
      print('Invalid! department must be a string')
      lcd.message('Invalid! department must be a string')
      sys.exit()
    #Check if department is in valid_departments list:
    if not(new_department in valid_departments):
      print('invalid! department does not exist')
      lcd.message('invalid! department does not exist')
      sys.exit()
    else:
      print("Success! Employee Registered")  
      cursor.execute(sql_insert,(new_name, new_username, new_department, id))
    db.commit()
    lcd.clear()
    lcd.message("User " + new_name + "\nSaved")
    time.sleep(2)
        
finally:
  GPIO.cleanup()

