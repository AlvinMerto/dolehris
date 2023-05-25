<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisions extends Model
{
    use HasFactory;

    protected $table      = "divisions";
    protected $primaryKey = "divisionpk";
    protected $fillable   = [
        "thedivision","status","created_at","updated_at"
    ];
}
