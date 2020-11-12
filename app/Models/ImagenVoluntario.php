<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenVoluntario extends Model
{
    use HasFactory;

    protected $connection = 'db_imagen_vol';
    protected $table = 'tb_imagen_voluntario'; 

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'voluntario_id',
		'imagen',
		'created_by',
		'created_at',
		'updated_by',
		'updated_at',
		'status',
    ];

}
