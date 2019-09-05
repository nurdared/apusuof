<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Invitation;
use App\Volunteer;

/**
 * Class Event
 *
 * @package App
 * @property string $name
 * @property string $event_date
 * @property text $description
 * @property string $location
 * @property string $poster
 * @property text $information
 * @property integer $quantity
*/
class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'event_date', 'description', 'location', 'poster', 'information', 'quantity'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEventDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['event_date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['event_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEventDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function getSentAttribute()
    {
        return $this->invitations()->whereNotNull('sent_at')->count();
    }

    public function getAcceptedAttribute()
    {
        return $this->invitations()->whereNotNull('accepted_at')->count();
    }
    
    public function getRejectedAttribute()
    {
        return $this->invitations()->whereNotNull('rejected_at')->count();
    }

    public function setQuantityAttribute($input)
    {
        $this->attributes['quantity'] = $input ? $input : null;
    }

    public function getQuantityAttribute()
    {
        return $this->volunteers()->whereNotNull('approved_at')->count();
    }
    
}
