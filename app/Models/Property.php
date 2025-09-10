<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $casts = [
        'images' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
