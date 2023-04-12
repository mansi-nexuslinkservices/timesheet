<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
    
    public $table = 'project_users';
    
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Project::class,'project_id','user_id');
    }
}
