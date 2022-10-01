<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'judul',
        'star_at',
        'end_at'
    ];

    public function Activity()
    {
        return $this->hasMany(Activity::class, 'note_id');
    }
}
