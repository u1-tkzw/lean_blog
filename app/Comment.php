<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	/**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['post_id', 'name', 'body', 'date'];

}
