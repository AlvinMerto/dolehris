<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class positions extends Model
{
    use HasFactory;

    protected $table        = "positions";
    protected $primaryKey   = "positionpk";
    protected $fillable     = [
        "theposition","status","created_at","updated_at"
    ];
}
