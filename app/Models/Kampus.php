<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kampus extends Model
{
    use HasFactory;
    protected $table = "kampus";

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan');
    }
}
