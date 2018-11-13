<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 */
class Category extends Model
{
    // Mass assigned
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by', 'image'];

    // Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    /**
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeLastCategories($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }


    public function articles()
    {
        return $this->hasMany('App\Article', 'category_id', 'id');
    }
}
