<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class air_qualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(database_path() . "/csv/air_quality.csv", 'r');

        // Ignora l'intestazione del file CSV
        fgetcsv($csvFile);

        // Array per contenere i dati
        $dataToSeed = [];

        while (($data = fgetcsv($csvFile, 1000, ',')) !== false) {
            $dataToSeed[] = [
                'data_di_misurazione' => $data[0],
                'id_station' => $data[1],
                'denominazione' => $data[2],
                'comune' => $data[3],
                'provincia' => $data[4],
                'latitudine' => $data[5],
                'longitudine' => $data[6],
                'tipologia_di_area' => $data[7],
                'tipologia_stazione' => $data[8],
                'interesse_rete' => $data[9],
                'inquinante_misurato' => $data[10],
                'valore_inquinante_misurato' => $data[11],
                'limite' => $data[12],
                'unita_di_misura' => $data[13],
                'superamenti' => $data[14],
                'indice_qualita' => $data[15],
                'classe_qualità' => $data[16]

            ];
        }


        fclose($csvFile);


        DB::table('air_quality')->insert($dataToSeed);
    }
}
