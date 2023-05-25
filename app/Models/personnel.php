<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    use HasFactory;

    protected $table        = "personnels";
    protected $primaryKey   = "perid";
    protected $fillable     = ["biometricid","user_id","employeeid"
                                ,"employeeid","fname","mname"
                                ,"lname","gender","employment_type_id"
                                ,"email","office_id","division_id"
                                ,"area_office_id","position_id","status"
                                ,"created_at","updated_at"];
}
