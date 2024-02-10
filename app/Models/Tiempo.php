<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'tiempos';

    protected $fillable = ['actividad_id','fecha','horas'];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
}
