<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategorie_id',
        'subcategorie_name',
        'subcategorie_description',
        'maincategorie_id',
        'subpublication_status'
    ];
}
