<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserType extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'user_types';
    
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(User::class, 'id', 'user_type_id');
    }
}
