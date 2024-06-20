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
                'id'=>$data[0],
                'data_di_misurazione' => $data[1],
                'id_station' => $data[2],
                'denominazione' => $data[3],
                'comune' => $data[4],
                'provincia' => $data[5],
                'latitudine' =>(double) $data[6],
                'longitudine' => (double)$data[7],
                'tipologia_di_area' => $data[8],
                'tipologia_stazione' => $data[9],
                'rete'=>$data[10],
                'interesse_rete' => $data[11],
                'inquinante_misurato' => $data[12],
                'valore_inquinante_misurato' => $data[13],
                'limite' => $data[14],
                'unita_di_misura' => $data[15],
                'superamenti' => $data[16],
                'indice_qualita' => $data[17],
                'classe_qualità' => $data[18]

            ];
        }


        fclose($csvFile);


        DB::table('air_quality')->insert($dataToSeed);
    }
}