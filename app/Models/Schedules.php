<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $primaryKey = "schedid";
    protected $table      = "schedules";
    protected $fillable   = [
        "thetime","timeexact","areaid","status","created_at","updated_at"
    ];
}
