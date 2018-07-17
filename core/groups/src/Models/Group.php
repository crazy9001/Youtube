<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 4:37 PM
 */

namespace Youtube\Groups\Models;

use Eloquent;
use Nestable\NestableTrait;

class Group extends Eloquent

{
    use NestableTrait;

    protected $parent = 'parent_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

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
    protected $fillable = ['name', 'slug', 'user_id', 'parent_id','note', 'icon', 'tags'];

    public function parent()
    {
        return $this->belongsTo('Youtube\Groups\Models\Group', 'id', 'parent_id'); // I believe you can use also hasOne().
    }
    public function childs() {
        return $this->hasMany('Youtube\Groups\Models\Group','parent_id','id') ;
    }
}