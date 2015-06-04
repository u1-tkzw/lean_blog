<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'body', 'date'];

    /**
     * comments
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
/*    
    public function commentsCount()
    {
        return $this->hasMany(Comment::class)->count();
    }
 */
}
