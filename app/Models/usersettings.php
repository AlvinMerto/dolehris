<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersettings extends Model
{
    use HasFactory;

    protected $table        = "usersettings";
    protected $primaryKey   = "usersettingspk";
    protected $fillable     = [
        "userid","thenav","created_at","updated_at"
    ];

}
