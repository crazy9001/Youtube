<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 7:03 PM
 */
namespace Youtube\Videos\Models;

use Eloquent;
use Youtube\Channel\Models\Channel;

class Video extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['video_id', 'title', 'description', 'thumbnails', 'published_at', 'tags', 'category_id', 'embed_html', 'group_id', 'channelId', 'views'];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channelId', 'id_channel')->select(['id_channel']);
    }

}