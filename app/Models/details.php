<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class details extends Model
{
    use HasFactory;

    protected $table        = "details";
    protected $primaryKey   = "detailspk";
    protected $fillable     = [
        "groupid","thefield","thevalue","created_at","updated_at"
    ];
    
}
