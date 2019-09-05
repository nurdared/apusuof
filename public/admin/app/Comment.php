<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App
 * @property string $user
 * @property text $body
 * @property integer $commentable_id
 * @property string $commentable_type
*/
class Comment extends Model
{
    protected $fillable = ['body', 'commentable_id', 'commentable_type', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCommentableIdAttribute($input)
    {
        $this->attributes['commentable_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
