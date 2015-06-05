<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	/**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'filename'];

}
