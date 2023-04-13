<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProjectType;

class RateCard extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'rate_cards';
    
    protected $guarded = [];

    public function project_type() {
        return $this->hasOne(ProjectType::class, 'id', 'project_type_id');
    }
}
