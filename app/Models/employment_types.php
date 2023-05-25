<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employment_types extends Model
{
    use HasFactory;

    protected $table      = "employment_types";
    protected $primaryKey = "employmenttypepk";
    protected $fillable   = [
        "theemploymenttype","status","created_at","updated_at"
    ];
}
