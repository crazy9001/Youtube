<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 11:03 AM
 */

namespace Youtube\Channel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Youtube;
use Assets;
use Youtube\Channel\Repositories\Eloquent\DbChannelRepository;

class IndexController extends Controller
{
    protected $channelRepository;

    public function __construct(DbChannelRepository $channelRepository )
    {
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        Assets::addStylesheets(['editable']);
        Assets::addJavascript(['editable']);
        return view('channel::index.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idChannel' => 'required'
        ],[
            'idChannel.required' =>  'Chưa nhập ID Channel'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error', $validator->errors()->first());
        }

        $infoChannel = Youtube::getChannelById($request->idChannel);

        if($infoChannel){

            $findChannel = $this->channelRepository->findWhere(['id_channel' => $infoChannel->id])->first();

            if($findChannel){
                return $this->sendError('Error.', 'Kênh này đã được thêm, hãy thêm kênh khác');
            }
            $data['id_channel'] = $infoChannel->id;
            $data['name'] = $infoChannel->snippet->title;
            $data['images'] = $infoChannel->snippet->thumbnails->medium->url;
            $data['description'] = $infoChannel->snippet->description;
            $channel = $this->channelRepository->updateOrCreate($data);
            return $this->sendResponse($channel, 'Thêm mới thành công');
        }

        return $this->sendError('Error.', 'Kênh không tồn tại');

    }


    public function getListChannel()
    {
        $data =  $this->channelRepository->all();
        return $this->sendResponse($data, 'Success');
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