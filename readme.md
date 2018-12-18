# Project 4
+ By: Pat Ausman
+ Production URL: <http://p4.pmadwa2018.me>

## Introduction
* This application is a reservation system for Camp Eagle Island (known as EIC) Visitors Day which occurs every summer. The camp is located on an island in Upper Saranac Lake.  
+ Arrival and departure for the event is done by a boat trip from and to the mainland dock located in Gilpin Bay.  Each boat trip has a limited capacity so this system attempts to manage more that just signing up for the event but to manage the capacity of each boat trip. 
* A registered user can have multiple reservations if needed.

* The current website for EIC may be found at www.eagleisland.org 
* The history of EIC may be found at https://en.wikipedia.org/wiki/Camp_Eagle_Island.



## Database

Primary tables:
visitors
schedules
  
Pivot table(s):
visitor_schedule`


## CRUD
+ This system uses auth. visit <http://p4.pmadwa2018.me> to login in (with pre-seeded accounts) or register for your account


__Create__
  + Visit <http://p4.pmadwa2018.me/visitors/create>
  + Fill out form
  + Use the schedule to assist in picking out a schedule for a group of your size
  + Click *Save Changes* button
  + Return to the list of your reservations and observe confirmation message
  
__Read__
  + Visit <http://p4.pmadwa2018.me/visitors> see a list of your reservations
  
__Update__
  + Visit <http://p4.pmadwa2018.me/visitors>; 
  + Select *View Details* button under one of the reservations
  + Select *Edit* button to bring up the edit form
  + Make some edit to form
  + Use the schedule to assist in picking out a schedule for a group of your size
  + Click *Save changes* button
  + Return view the changed data and observe confirmation message 
  
__Delete__
  + Visit <http://p4.pmadwa2018.me/visitors>; 
  + Select *View Details* button under one of the reservations
  + Select *Delete* button
  + Confirm deletion by selecting the *Yes, delete it* button.
  + Return to the list of your reservations and observe confirmation message

## Outside resources
+ lynsarmy\CsvSeeder\CsvSeeder :  seed from a csv file type
+ https://stackoverflow.com/questions/40038521/change-the-date-format-in-laravel-view-page : date formating
+ codepen.io : css help
+ https://github.com/fzaninotto/Faker : help with Faker for seeding

## Code style divergences
none



