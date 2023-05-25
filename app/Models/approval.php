<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approval extends Model
{
    use HasFactory;

    protected $table        = "approvals";
    protected $primaryKey   = "approvalid";
    protected $fillable     = [
        "fkidfromtbl","fromprimaryfield","fromtable",
        "approvalcode","tobeapprovedby","isapproved",
        "reasonfordisapproval","created_at","updated_at"
    ];

}
