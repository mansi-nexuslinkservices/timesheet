<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Timesheet;
use App\Models\User;
use App\Models\ProjectUser;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'projects';
    
    protected $guarded = [];

    public function timesheet() {
        return $this->belongsTo(Timesheet::class, 'id', 'project_id');
    }
    public function employee(){
        return $this->belongsTo(User::class,'id','project_id');
    }

    public function project_user() {
        return $this->hasOne(ProjectUser::class, 'project_id', 'user_id');
    }

    public function employeeTimesheet()
    {   
        return $this->hasMany(Timesheet::class,'user_timesheets')->withTimestamps();
    }
    /*public function employee()
    {   
        return $this->hasMany(User::class,'user_projects');
    }*/
}
