<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Invitation
 *
 * @package App
 * @property string $event
 * @property string $email
 * @property string $sent_at
 * @property string $accepted_at
 * @property string $rejected_at
*/
class Invitation extends Model
{
    protected $fillable = ['email', 'sent_at', 'accepted_at', 'rejected_at', 'event_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEventIdAttribute($input)
    {
        $this->attributes['event_id'] = $input ? $input : null;
    }

    
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withTrashed();
    }
    
}
