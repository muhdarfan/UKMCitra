<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'matric_no';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class,'matric_no');
    }

    public function year() {
        return (env('APP_CURRENT_SESSION') - $this->session_enter) / 10001;
    }
}
