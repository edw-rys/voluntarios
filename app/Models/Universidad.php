<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use HasFactory;
    protected $table = 'tbwbUniversidad'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "Siglas",
        "Nombre",
        "Pais",
        "Tipo",
        "Convenio",
        "status",
    ];    
}


