<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 7:02 PM
 */

namespace Youtube\Videos\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Youtube\Videos\Models\Video;

class DbVideosRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Video::class;
    }
}