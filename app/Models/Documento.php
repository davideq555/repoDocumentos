<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo','autor', 'formato', 
        'resumen', 'url','fecha',
        'idioma','publico',
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
    //funcion para crear un enlace pdf_url
    public function getPdfUrlAttribute(): string
    {
        return Storage::disk()->url($this->url);
    }
}
