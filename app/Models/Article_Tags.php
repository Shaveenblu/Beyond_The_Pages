<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_Tags extends Model
{
    public $table = 'article_tag';
    protected $primaryKey = ['article_id', 'tag_id'];
    use HasFactory;

    protected $guarded = [];
}
