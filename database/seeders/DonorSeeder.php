<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donor;
use Faker\Factory as Faker;
use Carbon\Carbon;
class DonorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Donor::create([
                'name'             => $faker->name,
                'gothra'           => $faker->word,
                'donor_name'       => $faker->name,
                'occasion'         => $faker->randomElement(['Pooja', 'Annadanam', 'Abhishekam', 'Birthday', 'Anniversary']),
                'donation_amount'  => $faker->numberBetween(500, 5000),
                'donation_date'    => Carbon::now()->startOfMonth()->addDays(rand(0, now()->daysInMonth - 1)),
                'contact_details'  => $faker->address,
                'contact_number'   => $faker->phoneNumber,
                'email'            => $faker->safeEmail,
                'note'             => $faker->sentence,
            ]);
        }
    }
}
