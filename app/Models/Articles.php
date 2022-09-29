<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'content',
        'user_id',
        'category_id',
    ];

    /**
     * Get the user for the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories for the article.
     */
    public function categories()
    {
        return $this->hasOne(Categories::class);
    }
}
