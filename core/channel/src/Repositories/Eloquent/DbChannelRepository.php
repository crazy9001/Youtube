<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:48 AM
 */

namespace Youtube\Channel\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Youtube\Channel\Models\Channel;


class DbChannelRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Channel::class;
    }
}