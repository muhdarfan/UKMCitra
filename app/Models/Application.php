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
    protected $primarykey = 'application_id';

    protected $fillable = [
        
        
    ];

    public function getRouteKeyName()
{
    return 'application_id';
}

    public function user()
    {
        return $this->belongsTo(User::class,'matric_no');
    }

    public function citra()
    {
        return $this->belongsTo(Citra::class,'courseCode');
    }
}
