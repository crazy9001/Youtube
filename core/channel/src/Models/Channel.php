<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:49 AM
 */

namespace Youtube\Channel\Models;

use Eloquent;

class Channel extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'channels';

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
    protected $fillable = ['id_channel', 'name', 'images', 'description', 'last_update', 'count_video', 'note'];
}