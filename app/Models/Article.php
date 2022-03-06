<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'image'
    ];

    /**
     * The article that belong to the tag.
     */
    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
}
