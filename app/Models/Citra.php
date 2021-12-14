<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citra extends Model
{
    use HasFactory;

    protected $table = 'citras';
    protected $primaryKey = 'courseCode';
    protected $keyType = 'string';

    protected $fillable = [
        'courseCode',
        'courseName',
        'courseCredit',
        'courseCategory',
        'courseAvailability',
        'descriptions'
    ];

    public function getRouteKeyName()
    {
        return 'courseCode';
    }

    public function lecturers()
    {
        return $this->belongsToMany(User::class, 'citras_lecturer', 'courseCode', 'matric_no');
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'courseCode');
    }
}


