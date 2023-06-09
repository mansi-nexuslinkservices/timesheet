<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\RateCard;

class ProjectType extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'project_types';
    
    protected $guarded = [];

    public function ratecard(){
        return $this->belongsTo(RateCard::class,'id','project_type_id');
    }
}
