<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirQuality extends Model
{
    use HasFactory;
    protected $table = 'air_quality';
    protected $fillable = [
        'data_di_misurazione',
        'id_station',
        'denominazione',
        'comune',
        'provincia',
        'latitudine',
        'longitudine',
        'tipologia_di_area',
        'tipologia_stazione',
        'interesse_rete',
        'inquinante_misurato',
        'valore_inquinante_misurato',
        'limite',
        'unita_di_misura',
        'superamenti',
        'indice_qualita',
        'classe_qualità',
    ];
    public $timestamps = false;
}
