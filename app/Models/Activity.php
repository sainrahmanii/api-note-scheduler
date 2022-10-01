<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'activity',
        'note_id'
    ];

    public function Notes()
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
}