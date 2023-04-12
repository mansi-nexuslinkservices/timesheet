<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Designation extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'designations';
    
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(User::class,'id','designation_id');
    }
}
