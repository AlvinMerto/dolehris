<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacationlocation extends Model
{
    use HasFactory;

    protected $table      = "vacationlocations";
    protected $primaryKey = "vacationlocpk";
    protected $fillable   = [
        "thevalue","created_at","updated_at"
    ];
}
