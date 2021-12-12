<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Feedback
 *
 * @mixin Eloquent
 */
class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'matric_no',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'matric_no');
    }
}
