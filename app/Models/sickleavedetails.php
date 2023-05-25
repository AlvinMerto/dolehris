<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sickleavedetails extends Model
{
    use HasFactory;

    protected $table      = "sickleavedetails";
    protected $primaryKey = "sickleavedetailspk";
    protected $fillable   = [
        "leaveapplicationid","inhospital",
        "outpatient","specific",
        "created_at","updated_at"
    ];

}
