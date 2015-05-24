<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'date'];

}
