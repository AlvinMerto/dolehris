<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leavecards extends Model
{
    use HasFactory;

    protected $table        = "leavecards";
    protected $primaryKey   = "leavecardpk";
    protected $fillable     = [
        "particulartype","particularid","operand",
        "particulars_days","particulars_hrs","particulars_mins",
        "leave_earned","leave_withpay","leave_balance",
        "leave_wopay","leavecardtype","status","personnelid","created_at","updated_at"
    ];

}
