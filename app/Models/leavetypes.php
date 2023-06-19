<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leavetypes extends Model
{
    use HasFactory;

    protected $table      = "leavetypes";
    protected $primaryKey = "leavetypepk";
    protected $fillable   = ["theleave","groupid","navigation","created_at","updated_at"];

}
