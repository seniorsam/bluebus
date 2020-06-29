## Bluebus For Bus Tickets Booking Service

Bluebus is a web application presenting ticket booking services for buses.

## Some points Explanation

- I created all the functionalities as APIS, so you can use it from web or mobile application
- I treated all the trip crossovers as sub trips
For example if we have a trip such as (Cairo > Giza > Asyut)
I treat this as parent trips and sub trips such as:
a parent trip from (Cairo > Asyut) inlude sub trips such as (Cairo > Giza) and from (Giza > Asyut) and so on for all possible lines in this trip, booking a parent trip booking would affect its sub trips and vice versa
this helped me to track each trip possible scenarios for example
“if the user want to book a seat from Cairo > Giza which is sub trip, but at the same time all tickets from Cairo > Asyut Are Booked which is a parent 
trip”
- i made the booking process seperated to 4 parts in order to increase performance by distributing the process required on these 4 steps.

## Database Tables

- stations (hold the stations names and id)
- Seats (hold the seat name and trip id)
- trips (hold the bus name and trip id)
- lines (hold the trip lines) for example trip number 1 have (Cairo > Giza), (Giza > Asyut), (Cairo > Asyut) lines
- line_parts (hold the trip lines crossovers (lines)) each trip line might hold sub trip lines, for example (Cairo > Asyut) have (Cairo > Giza), (Giza > Asyut) lines. 
- bookings (hold current trip lines bookings)

## How to use
- clone the project
- run "composer install" to install packages
- run "php artisan migrate:refresh --seed" inside project folder


