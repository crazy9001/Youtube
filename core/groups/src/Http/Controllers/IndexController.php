<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 12:01 PM
 */

namespace Youtube\Groups\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Youtube\Groups\Repositories\Eloquent\GroupRepository;
use Assets;
use Sentinel;
use Input;
use Validator;

class IndexController extends Controller
{
    protected $groupRepository;


    public function __construct( GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        Assets::removeJavascript(['eakroko']);
        Assets::addJavascript(['ck-editor']);
        $search = Input::get('search');
        $filters = array(
            'search' => trim($search),
        );
        $sortInfo = array();
        if (Input::has('sort') && Input::has('dir')) {
            $sortInfo['column'] = Input::get('sort');
            $sortInfo['order'] = Input::get('dir');
        }
        $groups = $this->groupRepository->getGroups($filters)->get();
        $html = $this->groupView($groups, '');
        $groups_parent = $this->groupRepository->pluck('name', 'id')->toArray();
        $groups_parent[0] = 'Nhóm cha';
        return view('groups::index.index', compact('html', 'groups_parent'));
    }

    public function groupView($data, $string)
    {

        $html = '';

        foreach($data as $value)
        {
            $tags = $value->tags && !empty($value->tags) ? $value->tags : '';
            $display = $value->display && $value->display == 1 ? '<span class="label label-info">Hiển thị</span>' : '<span class="label label-default">Ẩn</span>';
            $html .= '<tr role="row" class="odd" id="group-1">
                        <td style="width: 10px">'. $value->id .'</td>
                        <td class="group-name">
                            '. $string . ' ' . $value->name .'
                        </td>
                        <td>'. $tags .'</td>
                        <td>'. $value->note .'</td>
                        <td>'. $display .'</td>
                        <td>1000</td>
                        <td>
                            <input type="checkbox" data-skin="square" data-color="blue" name="groupsSelect[]" value="">
                        </td>
                    </tr>';
            if(isset($value->children) && !empty($value->children)) {
                $html .= $this->groupView($value->children, $string . '━');
            }
        }

        return $html;
    }

    public function create()
    {
        Assets::addStylesheets(['tagsinput']);
        Assets::addJavascript(['tagsinput']);
        $groups = $this->groupRepository->pluck('name', 'id')->toArray();
        $groups[0] = 'Nhóm cha';
        $groups = array_sort_recursive($groups);
        return view('groups::index.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name'  =>  'required',
            'parent_id' =>  'required',
            'tags' => 'required',
        ],[
            'name.required' => 'Vui lòng nhập tên nhóm',
            'parent_id.required' => 'Vui lòng chọn nhóm cha',
            'tags.required'    =>  'Vui lòng nhập tags'
        ]);
        if($validator->fails()){
            return $this->sendError('Error.', $validator->errors()->first(), 422);
        }
        // data group
        $data = [
            'name'  => $request->name,
            'slug'  =>  str_slug($request->name),
            'user_id' => Sentinel::getUser()->id,
            'parent_id' => $request->parent_id,
            'note'  =>  $request->note,
            'tags'  =>  $request->tags,
        ];
        try{
            $savegroup = $this->groupRepository->updateOrCreate($data);
            return $this->sendResponse($savegroup->toArray(), 'Successfully');
        }catch (\Exception $e) {
            return $this->sendError('Error.', $e->getMessage());
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}