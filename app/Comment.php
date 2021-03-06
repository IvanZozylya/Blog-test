<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation with Article model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relations with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}