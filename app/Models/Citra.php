<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citra extends Model
{
    use HasFactory;

    protected $table = 'citras';
    protected $primarykey = 'courseCode';
    protected $keyType='string';

    protected $fillable = [
        'courseCode',
        'courseName',
        'courseCredit',
        'courseCategory',
        'descriptions'
    ];

    public function getRouteKeyName()
{
    return 'courseCode';
}
    

}


