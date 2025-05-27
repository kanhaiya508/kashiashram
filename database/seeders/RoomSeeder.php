<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => '101 kedhar', 'donation' => 1600, 'no_of_beds' => 2, 'room_type' => 'AC'],
            ['name' => '102', 'donation' => 1600, 'no_of_beds' => 2, 'room_type' => 'AC'],
            ['name' => '103', 'donation' => 1000, 'no_of_beds' => 2, 'room_type' => 'NON-AC'],
            ['name' => '104 kedhar common', 'donation' => 1600, 'no_of_beds' => 4, 'room_type' => 'NON-AC'],
            ['name' => '105 common', 'donation' => 1500, 'no_of_beds' => 5, 'room_type' => 'NON-AC'],
            ['name' => '106 common', 'donation' => 800, 'no_of_beds' => 2, 'room_type' => 'NON-AC'],
            ['name' => '201', 'donation' => 1600, 'no_of_beds' => 2, 'room_type' => 'AC'],
            ['name' => '202', 'donation' => 1600, 'no_of_beds' => 2, 'room_type' => 'AC'],
            ['name' => '203', 'donation' => 1600, 'no_of_beds' => 2, 'room_type' => 'AC'],
            ['name' => '204', 'donation' => 1000, 'no_of_beds' => 2, 'room_type' => 'NON-AC'],
            ['name' => '301', 'donation' => 2500, 'no_of_beds' => 5, 'room_type' => 'AC'],
            ['name' => '302', 'donation' => 2000, 'no_of_beds' => 4, 'room_type' => 'AC'],
            ['name' => '303', 'donation' => 2000, 'no_of_beds' => 4, 'room_type' => 'AC'],
            ['name' => '304', 'donation' => 1500, 'no_of_beds' => 3, 'room_type' => 'AC'],
            ['name' => '305', 'donation' => 1000, 'no_of_beds' => 2, 'room_type' => 'NON-AC'],
        ];

        foreach ($rooms as $room) {
            Room::create([
                'ashram_id' => 4, // 👈 Change as per actual ashram_id
                'name' => $room['name'],
                'donation' => $room['donation'],
                'no_of_beds' => $room['no_of_beds'],
                'room_type' => $room['room_type'],
                'active' => true,
            ]);
        }
    }
}
