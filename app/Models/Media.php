<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'mime_type',
        'size',
        'alt_text',
        'disk',
    ];

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}
