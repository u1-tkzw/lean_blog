<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	/**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'blog_title', 'comment', 'sex', 'birthday'];

}
