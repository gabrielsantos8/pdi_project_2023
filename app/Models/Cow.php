<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'nascimento', 'dataprimeiracria', 'ultimacria', 'litrosleite', 'cow_situation_id'];
}
