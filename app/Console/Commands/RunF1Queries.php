<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Driver;
use App\Models\Team;
use App\Models\Race;
use App\Models\Circuit;

class RunF1Queries extends Command
{
    protected $signature = 'f1:queries';
    protected $description = 'Demonstrate 5 Eloquent queries for the F1 Lab';

    public function handle()
    {
        $this->info("Running F1 Eloquent Queries...\n");

        // Query 1: Filtrar y ordenar
        $this->info("1. Drivers of 'Nationality 1' ordered by number DESC:");
        $drivers = Driver::where('nationality', 'Nationality 1')
            ->orderBy('number', 'desc')
            ->take(5)
            ->get();
        foreach ($drivers as $d) {
            $this->line("- {$d->first_name} {$d->last_name} (#{$d->number})");
        }
        $this->line("");

        // Query 2: Uso de relación HasMany a través de whereHas
        $this->info("2. Teams that have Cars from year >= 2020:");
        $teams = Team::whereHas('cars', function ($query) {
            $query->where('year', '>=', 2020);
        })->take(5)->get();
        foreach ($teams as $t) {
            $this->line("- {$t->name}");
        }
        $this->line("");

        // Query 3: Eager Loading para evitar N+1 (Requerimiento #5)
        $this->info("3. Drivers with their Team (Eager Loading N+1 fix):");
        /*
         * JUSTIFICACIÓN DE EAGER LOADING (Requerimiento #5):
         * Aquí usamos `with('team')` para cargar de antemano la relación de Team.
         * Si no lo hiciéramos, al iterar sobre los pilotos e imprimir `$d->team->name`, 
         * Eloquent ejecutaría una consulta SQL extra por cada piloto (Problema N+1).
         * Al usar `with()`, obtenemos todos los pilotos y sus equipos en solo 2 consultas.
         */
        $eagerLoadedDrivers = Driver::with('team')->take(5)->get();
        foreach ($eagerLoadedDrivers as $d) {
            $this->line("- {$d->first_name} {$d->last_name} drives for {$d->team->name}");
        }
        $this->line("");

        // Query 4: Relación BelongsTo y ordenamiento
        $this->info("4. Races at Circuit 1, ordered by date DESC:");
        $races = Race::where('circuit_id', 1)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
        foreach ($races as $r) {
            $this->line("- {$r->name} ({$r->date})");
        }
        $this->line("");

        // Query 5: Relación Many-to-Many
        $this->info("5. Sponsors of Team 1:");
        $team = Team::find(1);
        if ($team) {
            $sponsors = $team->sponsors()->take(5)->get();
            foreach ($sponsors as $s) {
                $this->line("- {$s->name} ({$s->industry})");
            }
        }
        $this->line("");

        $this->info("Done.");
    }
}
