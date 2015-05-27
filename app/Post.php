<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'body', 'date'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
