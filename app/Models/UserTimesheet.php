<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Timesheet;

class UserTimesheet extends Model
{
    use HasFactory;

    public $table = 'user_timesheets';
    
    protected $guarded = [];

    public function timesheet(){
        return $this->belongsToMany(Timesheet::class, 'user_timesheets','timesheet_id');
    }
}
