<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Citra;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';
    protected $primaryKey = 'application_id';

    protected $fillable = [
        'session',
        'matric_no',
        'courseCode',
        'reason',
        'status',
        'semester'
    ];

    public function getRouteKeyName()
    {
        return 'application_id';
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'matric_no')->with('studentInfo');
    }

    public function course()
    {
        return $this->belongsTo(Citra::class, 'courseCode');
    }

    public function scopeByStatus($query, $status) {
        return isset($status) ? $query->where('status', '=', $status) : null;
    }
}
