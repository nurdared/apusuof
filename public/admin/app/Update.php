<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Update
 *
 * @package App
 * @property string $update_title
 * @property text $update_body
 * @property string $update_image
 * @property string $user
 * @property string $club
*/
class Update extends Model
{
    use SoftDeletes;

    protected $fillable = ['update_title', 'update_body', 'update_image', 'user_id', 'club_id'];
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
     * Set to null if empty
     * @param $input
     */
    public function setClubIdAttribute($input)
    {
        $this->attributes['club_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id')->withTrashed();
    }
    
}
