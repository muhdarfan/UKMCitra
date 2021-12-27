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

    public function registeredStudent() {
        return $this->application()->where('status', 'approved')->count();
    }

    public function availableSlot() {
        return intval($this->courseAvailability - $this->registeredStudent());
    }

    public function isAvailable() {
        return $this->courseAvailability > $this->application()->where('status', 'approved')->count();
    }

    public function scopeSearch($query, $search, $category) {
        if (isset($category)) {
            $query->where('courseCategory', '=', $category);
        }

        if (!isset($search))
            return;

        return $query->where(function ($q) use ($search) {
            $q->orWhere('courseCode', 'LIKE', "%{$search}%");
            $q->orWhere('courseCredit', 'LIKE', "%{$search}%");
            $q->orWhere('courseName', 'LIKE', "%{$search}%");
        });
    }
}


