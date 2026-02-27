<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoComida extends Model
{
    use HasFactory;

    protected $table = 'tb_tipo_comidas';
    protected $primaryKey = 'id_tipo_comida';

    protected $fillable = [
        'nombre_categoria'
    ];

    public function getRouteKeyName()
    {
        return 'id_tipo_comida';
    }
}