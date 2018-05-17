<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/17/2018
 * Time: 7:26 PM
 */

namespace Youtube\Groups\Repositories\Eloquent;

use Youtube\Groups\Models\Tag;
use Prettus\Repository\Eloquent\BaseRepository;

class TagRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Tag::class;
    }
}