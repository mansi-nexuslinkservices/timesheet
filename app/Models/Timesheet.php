<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use App\Models\User;
use App\Models\UserTimesheet;

class Timesheet extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'timesheets';
    
    protected $guarded = [];

    public function user_timesheet() {
        return $this->belongsToMany(Project::class, 'user_timesheets', 'timesheet_id', 'project_id')->withTimestamps();
    }

    public function project() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function employee() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
