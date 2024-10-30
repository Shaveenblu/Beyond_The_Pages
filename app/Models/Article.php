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

    use HasFactory;

    public function tags() {
        return $this->belongsToMany(Article_Tags::class, 'article_tag');
    }

    public function tag() {
        return $this->belongsTo(Tag::class,'status', 'tag_id');
    }

    protected $guarded = [];


}
