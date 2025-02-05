<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];
    public function ads()
{
    return $this->belongsToMany(Ads::class, 'ads_tag');
}
}
