<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
        protected $fillable = [
            "news_title",
            "news_author",
            "news_body",
            "category_id",
            "created_at"
        ];
        public $timestamps = "false";

}
