<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 4:39 PM
 */

namespace Youtube\Groups\Models;

use Eloquent;

class Tag extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

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
    protected $fillable = ['name', 'slug', 'user_id', 'description', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Toinn
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_tag');
    }

}