<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Teams
        $teams = [];
        for ($i = 1; $i <= 10; $i++) {
            $teams[] = [
                'name' => "Team $i",
                'principal' => "Principal $i",
                'base' => "Base $i",
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('teams')->insert($teams);

        // 2. Drivers
        $drivers = [];
        for ($i = 1; $i <= 20; $i++) {
            $drivers[] = [
                'team_id' => ceil($i / 2),
                'first_name' => "Driver",
                'last_name' => "$i",
                'nationality' => "Nationality " . rand(1, 10),
                'number' => rand(1, 99),
                'dob' => Carbon::now()->subYears(rand(20, 35)),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('drivers')->insert($drivers);

        // 3. Circuits
        $circuits = [];
        for ($i = 1; $i <= 25; $i++) {
            $circuits[] = [
                'name' => "Circuit $i",
                'location' => "Location $i",
                'country' => "Country $i",
                'length_km' => rand(3000, 7000) / 1000,
                'turns' => rand(10, 25),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('circuits')->insert($circuits);

        // 4. Sponsors & Pivot
        $sponsors = [];
        for ($i = 1; $i <= 50; $i++) {
            $sponsors[] = [
                'name' => "Sponsor $i",
                'industry' => "Industry " . rand(1, 5),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('sponsors')->insert($sponsors);

        $sponsorTeam = [];
        for ($i = 1; $i <= 100; $i++) {
            $sponsorTeam[] = [
                'sponsor_id' => rand(1, 50),
                'team_id' => rand(1, 10),
            ];
        }
        // ignore duplicates
        DB::table('sponsor_team')->insertOrIgnore($sponsorTeam);

        // 5. Cars
        $cars = [];
        for ($i = 1; $i <= 100; $i++) {
            $cars[] = [
                'team_id' => rand(1, 10),
                'chassis' => "Chassis $i",
                'power_unit' => "PU " . rand(1, 4),
                'year' => rand(2010, 2024),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('cars')->insert($cars);

        // 6. Races (500 races)
        $races = [];
        for ($i = 1; $i <= 500; $i++) {
            $races[] = [
                'circuit_id' => rand(1, 25),
                'season' => rand(2000, 2024),
                'name' => "Grand Prix $i",
                'date' => Carbon::now()->subDays(rand(1, 5000)),
                'laps' => rand(50, 70),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        foreach (array_chunk($races, 100) as $chunk) {
            DB::table('races')->insert($chunk);
        }

        // 7. Results, PitStops, Qualifyings (500 races * 20 drivers = 10,000 each)
        // To be safe on memory, chunk inserts
        for ($raceId = 1; $raceId <= 500; $raceId++) {
            $results = [];
            $pitStops = [];
            $qualifyings = [];

            for ($driverId = 1; $driverId <= 20; $driverId++) {
                $results[] = [
                    'race_id' => $raceId,
                    'driver_id' => $driverId,
                    'grid' => rand(1, 20),
                    'position' => rand(1, 20),
                    'points' => rand(0, 25),
                    'fastest_lap' => "1:" . rand(10, 40) . "." . rand(100, 999),
                    'time_ms' => rand(5000000, 6000000),
                    'status' => 'Finished',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $pitStops[] = [
                    'race_id' => $raceId,
                    'driver_id' => $driverId,
                    'lap' => rand(10, 50),
                    'duration_ms' => rand(20000, 30000), // 20s-30s
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $qualifyings[] = [
                    'race_id' => $raceId,
                    'driver_id' => $driverId,
                    'position' => rand(1, 20),
                    'q1_time' => "1:" . rand(10, 40) . "." . rand(100, 999),
                    'q2_time' => "1:" . rand(10, 40) . "." . rand(100, 999),
                    'q3_time' => "1:" . rand(10, 40) . "." . rand(100, 999),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('results')->insert($results);
            DB::table('pit_stops')->insert($pitStops);
            DB::table('qualifyings')->insert($qualifyings);
        }
    }
}
