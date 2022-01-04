<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $fillable = [
        'author_id',
        'message',
        'featured'
    ];

    protected static function booted()
    {
        static::saving(function ($announcement) {
            if ($announcement->featured === '1' && $announcement->getOriginal('featured') !== '1')
                Announcement::query()->update(['featured' => '0']);
        });
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'matric_no');
    }
}
