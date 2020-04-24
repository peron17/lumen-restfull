<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}