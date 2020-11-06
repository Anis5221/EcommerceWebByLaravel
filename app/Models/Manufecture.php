<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufecture_id',
        'manufecture_name',
        'manufecture_description',
        'manpublication_status'
    ];
}
