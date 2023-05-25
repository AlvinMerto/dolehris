<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monetization extends Model
{
    use HasFactory;
    protected $table        = "";
    protected $primaryKey   = "monetizationpk";
    protected $fillable     = [
        "leaveapplicationid","ismonetize","isterminalleave","created_at","updated_at"
    ];

}
