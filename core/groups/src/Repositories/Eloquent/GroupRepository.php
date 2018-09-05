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

    public function getGroups($filters = array())
    {
        $query = $this->model->with('parent')
                ->with('children')
                ->with('videos')
                ->where('parent_id', 0)
                ->where(function ($where) use ($filters){
                    if (isset($filters['search']) && !empty($filters['search'])) {
                        $where->where('name', 'like', '%' . ($filters['search']) . '%');
                    }
                });
        return $query;
    }

}