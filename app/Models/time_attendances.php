<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_attendances extends Model
{
    use HasFactory;

    protected $table      = "time_attendances";
    protected $primarykey = "taaid";
    protected $fillable   = [
        "biometricid","theattendance","cstatus","timeactual","status","created_at","updated_at"
    ];
}
