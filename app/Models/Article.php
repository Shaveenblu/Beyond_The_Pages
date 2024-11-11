<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;


class Article extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'description', 'status'];

    // Primary key added
    protected $primaryKey = 'article_id';
    protected $searchableFields = ['*'];

    use HasFactory;

    public function tags() {
        return $this->belongsToMany(Tag::class,'article_tag', 'article_id', 'tag_id');
    }

    protected $guarded = [];


}
