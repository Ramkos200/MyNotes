<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteBook extends Model
{
    protected $guarded = [];
    protected $table = 'notebooks';
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
