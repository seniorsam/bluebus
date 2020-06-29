## Bluebus For Bus Tickets Booking Service

Bluebus is a web application presenting ticket booking services for buses.

## Some points Explanation

- I created all the functionalities as APIS, so you can use it from web or mobile application
- I treated all the trip crossovers as sub trips
For example if we have a trip such as (Cairo > Giza > Asyut)
I treat this as sub trips such as a trip from (Cairo > Giza) and from (Giza > Asyut)
and booking a parent trip booking would affect its sub trips.
this helped me to track each trip possible scenarios for example
“if the user want to book a seat from Cairo > Giza which is sub trip, but at the same time all tickets from Cairo > Asyut Are Booked which is a parent 
trip”
in other word all the sub trips bookings are affected by the parent trip bookings and vice versa
- i made the booking process seperated to 4 parts in order to increase performance by distributing the process required on these 4 steps.

## Database Tables

- stations (hold the stations names and id)
- Seats (hold the seat name and trip id)
- trips (hold the bus name and trip id)
- lines (hold the trip lines) for example trip number 1 have (Cairo > Giza), (Giza > Asyut), (Cairo > Asyut)
- line_parts (hold the trip line crossovers (lines)) each line might hold sub lines for example (Cairo > Asyut) have (Cairo > Giza), (Giza > Asyut) lines. 
- bookings (hold current lines bookings)

## How to use
- clone the project
- run "composer install" to install packages
- run "php artisan migrate:refresh --seed" inside project folder


