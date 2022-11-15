<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo','autor', 'resumen', 'url','anio','idioma','publico',
        'departamento_id',
        'user_id',
        'categoria_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
