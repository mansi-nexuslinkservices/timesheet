<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserType;
use App\Models\ProjectType;
use App\Models\Designation;
use App\Models\Project;
use App\Models\Timesheet;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'employee_code',
        'specialty',
        'skills',
        'gender',
        'birth_date',
        'phone',
        'profile',
        'username',
        'user_type_id',
        'designation_id',
        'joining_date',
        'project_id',
        'team_leader_id',
        'status',
        'super_admin',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee_type() {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function project(){
        return $this->hasOne(Project::class,'id','project_id');
    }

    public function designation(){
        return $this->hasOne(Designation::class,'id','designation_id');
    }

    public function timesheet(){
        return $this->belongsTo(Timesheet::class,'id','user_id');
    }

    /*public function users() {
        return $this->belongsToMany(User::class)->withPivot('recipent_id', 'user_id', 'project_id');
    }*/
}
