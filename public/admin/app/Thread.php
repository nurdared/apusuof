<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Thread
 *
 * @package App
 * @property string $subject
 * @property text $thread
 * @property string $type
 * @property integer $solution
 * @property string $user
*/
class Thread extends Model
{
    use SoftDeletes;

    protected $fillable = ['subject', 'thread', 'type', 'solution', 'user_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSolutionAttribute($input)
    {
        $this->attributes['solution'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
