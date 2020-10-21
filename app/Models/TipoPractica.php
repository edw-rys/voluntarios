<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPractica extends Model
{
    use HasFactory;
    protected $table = 'tbwbTipoPractica'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "codigo",
        "descripcion",
        "abreviatura",
        "status",
    ];    
}

