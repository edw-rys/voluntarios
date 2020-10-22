<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'tbwbCiudad'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "Nombre",
        "Pais",
        "status",
    ];    

    public function pais() : BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais', 'id');
    }
}



