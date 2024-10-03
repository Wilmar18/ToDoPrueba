<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Definimos los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'title',
        'description',
        'tags',
        'due_date',
        'user_id',
    ];

    // Relación de nota con usuario: una nota pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}