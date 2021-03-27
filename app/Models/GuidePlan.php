<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidePlan extends Model
{
    use HasFactory;
    protected $table = 'guide_plan';
    
    protected $guarded = [
        'id'
    ];
}
