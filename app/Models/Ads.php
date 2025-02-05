<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Ads extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];
    protected $guarded = ['id'];
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ad_tags', 'ad_id', 'tag_id');
    }
}
