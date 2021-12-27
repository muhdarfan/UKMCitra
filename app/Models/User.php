<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Application;
use App\Models\StudentInformation;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'matric_no';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'matric_no',
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function hasRole($role)
    {
        if ($this->role === $role)
            return true;

        return false;
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'matric_no');
    }

    public function studentInfo()
    {
        return $this->hasOne(StudentInformation::class, 'matric_no');
    }

    public function citras()
    {
        return $this->belongsToMany(Citra::class, 'citras_lecturer', 'matric_no', 'courseCode');
    }

    public function scopeSearch($query, $search, $role)
    {
        if (isset($role))
            $query->where('role', '=', 'student');

        if (!isset($search))
            return;

        return $query->where(function ($q) use ($search) {
            $q->orWhere('matric_no', 'LIKE', "%$search%");
            $q->orWhere('name', 'LIKE', "%$search%");
            $q->orWhere('role', 'LIKE', "%$search%");
        });
    }
}
