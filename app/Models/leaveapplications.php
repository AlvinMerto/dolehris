<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveapplications extends Model
{
    use HasFactory;

    protected $table      = "leaveapplications";
    protected $primaryKey = "leaveapplicationpk";
    protected $fillable   = [
                "leavetypeid","numberofdays",
                "personnelid","commutationid",
                "monetizationid","created_at","updated_at"
            ];

}
