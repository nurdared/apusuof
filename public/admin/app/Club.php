<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Club
 *
 * @package App
 * @property string $club_name
 * @property text $club_description
 * @property text $club_timetable
 * @property string $club_logo
 * @property string $user
 * @property string $category
*/
class Club extends Model
{
    use SoftDeletes;

    protected $fillable = ['club_name', 'club_description', 'club_timetable', 'club_logo', 'user_id', 'category_id'];
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
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
}
