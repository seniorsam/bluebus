<?php

use Illuminate\Database\Seeder;

class seedBluebusApp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // trips
        \DB::table('trips')->insert([
            [   
                'bus_name' => 'blue Jumbo'
            ],
            [   
                'bus_name' => 'blue Rocket'
            ]
        ]);
        
        // seats
        foreach(range(1,2) as $tripId){
            foreach(range(1,12) as $seatNum){
                \DB::table('seats')->insert([
                    'number' => 's'.$seatNum.$tripId,
                    'trip_id' => $tripId
                ]);
            }
        }

        $stations = [
            ['name' => 'Cairo'], 
            ['name' => 'AlFayyum'], 
            ['name' => 'AlMinya'], 
            ['name' => 'Asyut'], 
            ['name' => 'Suhag'], 
            ['name' => 'Qena'], 
            ['name' => 'Luxor'], 
            ['name' => 'Aswan']
        ];
        
        // stations
        \DB::table('stations')->insert($stations);
        
        // // lines
        $lines = [
            [
                'from_id' => 1,
                'to_id' => 2,
                'trip_id' => 1,
            ],
            [
                'from_id' => 2,
                'to_id' => 3,
                'trip_id' => 1
            ],
            [
                'from_id' => 3,
                'to_id' => 4,
                'trip_id' => 1
            ],
            [
                'from_id' => 1,
                'to_id' => 3,
                'trip_id' => 1
            ],
            [
                'from_id' => 2,
                'to_id' => 4,
                'trip_id' => 1
            ],
            [
                'from_id' => 1,
                'to_id' => 4,
                'trip_id' => 1
            ],
            [
                'from_id' => 5,
                'to_id' => 6,
                'trip_id' => 2
            ],
            [
                'from_id' => 6,
                'to_id' => 7,
                'trip_id' => 2
            ],
            [
                'from_id' => 7,
                'to_id' => 8,
                'trip_id' => 2
            ],
            [
                'from_id' => 5,
                'to_id' => 7,
                'trip_id' => 2
            ],
            [
                'from_id' => 6,
                'to_id' => 8,
                'trip_id' => 2
            ],
            [
                'from_id' => 5,
                'to_id' => 8,
                'trip_id' => 2
            ]
        ];

        // trip lines
        \DB::table('lines')->insert($lines);       
        
        $line_parts = [
            [
                'line_id' => 1,
                'child_line_id' => 1
            ],
            [
                'line_id' => 2,
                'child_line_id' => 2
            ],
            [
                'line_id' => 3,
                'child_line_id' => 3
            ],
            [
                'line_id' => 4,
                'child_line_id' => 1
            ],
            [
                'line_id' => 4,
                'child_line_id' => 2
            ],
            [
                'line_id' => 5,
                'child_line_id' => 3
            ],
            [
                'line_id' => 5,
                'child_line_id' => 4
            ],
            [
                'line_id' => 6,
                'child_line_id' => 1
            ],
            [
                'line_id' => 6,
                'child_line_id' => 2
            ],
            [
                'line_id' => 6,
                'child_line_id' => 3
            ],
            [
                'line_id' => 7,
                'child_line_id' => 8
            ],
            [
                'line_id' => 8,
                'child_line_id' => 8
            ],
            [
                'line_id' => 9,
                'child_line_id' => 9
            ],
            [
                'line_id' => 10,
                'child_line_id' => 7
            ],
            [
                'line_id' => 10,
                'child_line_id' => 8
            ],
            [
                'line_id' => 11,
                'child_line_id' => 8
            ],
            [
                'line_id' => 11,
                'child_line_id' => 9
            ],
            [
                'line_id' => 12,
                'child_line_id' => 7
            ],
            [
                'line_id' => 12,
                'child_line_id' => 8
            ],
            [
                'line_id' => 12,
                'child_line_id' => 9
            ]
        ];

        \DB::table('line_parts')->insert($line_parts);

    }
}
