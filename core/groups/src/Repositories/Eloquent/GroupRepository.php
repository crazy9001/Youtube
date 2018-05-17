<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 4:46 PM
 */

namespace Youtube\Groups\Repositories\Eloquent;

use Youtube\Groups\Models\Group;
use Prettus\Repository\Eloquent\BaseRepository;

class GroupRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Group::class;
    }

}