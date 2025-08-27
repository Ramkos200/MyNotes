<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model

{

    use SoftDeletes;
    //public $guarded = [];
    protected $fillable = [
        'title',
        'text',
        'user_id',
        'uuid',
        'notebook_id'
    ];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notebook()
    {
        return $this->belongsTo(NoteBook::class);
    }
}
