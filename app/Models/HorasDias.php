<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorasDias extends Model
{
    use HasFactory;
    protected $table = 'tbwbHorasDias'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'hora_inicio',
	    'hora_fin',
	    'detalle',
        'status',
    ];    
}

