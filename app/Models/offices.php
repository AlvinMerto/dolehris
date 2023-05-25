<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offices extends Model
{
    use HasFactory;

    protected $table      = "offices";
    protected $primaryKey = "officepk";
    protected $fillable   = [
        "theoffice","status","created_at","updated_at"
    ];
}
