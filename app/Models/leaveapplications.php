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
                "leavetypeid","thedateinquestion",
                "numberofdays","personnelid","commutationid",
                "created_at","updated_at"
            ];

}
