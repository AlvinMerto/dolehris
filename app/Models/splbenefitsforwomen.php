<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class splbenefitsforwomen extends Model
{
    use HasFactory;

    protected $table        = "splbenefitsforwomens";
    protected $primaryKey   = "splbenefitsforwomenpk";
    protected $fillable     = [
        "leaveapplicationid","thebenefit","created_at","updated_at"
    ];
}
