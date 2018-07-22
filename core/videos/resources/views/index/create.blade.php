@extends('bases::layouts.master')

@section('content')

    <div id="update-video-screen">

        <div class="page-header"></div>
        <div class="breadcrumbs">
            <h2>Update video <a class="label opac5" href="#addVideo" onclick="location.href='#addVideo';" data-toggle="modal">+ add new</a></h2>
        </div>

        <div class="row">

            {!! Form::open(array('route' => 'video.update', 'method'=>'post','class'=>'form-inline')) !!}
            {!! Form::hidden('id', isset($video->id) && !empty($video->id) ? $video->id : '' ,array('id' => 'id_video')) !!}
            {!! Form::hidden('unique_id', isset($video->id) && !empty($video->video_id) ? $video->video_id : '' ,array('id' => 'unique_id')) !!}
            <div id="post-page">

                <div class="col-sm-9">
                    <div class="widget border-radius4 shadow-div">
                        <h4>Title &amp; Description</h4>
                        <div class="control-group">
                            {!! Form::text('video_title', isset($video->id) && !empty($video->title) ? $video->title : '' ,array('id' => 'video_title','placeholder'=>'Enter keyword', 'autocomplete' => 'off')) !!}
                            {!! Form::textarea('description', isset($video->id) && !empty($video->description) ? $video->description : '',['id'=>'description']) !!}
                        </div>
                    </div>
                    <div class="widget border-radius4 shadow-div">
                        <h4>Embed Code</h4>
                        <div class="control-group">
                            {!! Form::textarea('embed_code', isset($video->id) && !empty($video->embed_html) ? $video->embed_html : '',['id'=>'embed_code', 'class'=>'textarea-embed', 'cols' => '', 'rows' => '']) !!}
                        </div>
                    </div>
                    <div class="widget border-radius4 shadow-div">
                        <h4>Ghi chú</h4>
                        <div class="control-group">
                            {!! Form::textarea('note', isset($video->id) && !empty($video->note) ? $video->note : '',['id'=>'note', 'class'=>'textarea-embed', 'cols' => '', 'rows' => '']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">

                    <div class="widget border-radius4 shadow-div">
                        <h4>Preview</h4>
                        <div class="control-group">
                           {!! isset($video->id) && !empty($video->embed_html) ? $video->embed_html : '' !!}
                        </div>
                    </div>

                    <div class="widget border-radius4 shadow-div">
                        <h4>Video Details</h4>
                        <div class="control-group">
                            <label class="control-label" for="">
                                {!! isset($inforVideo->contentDetails->duration) ? 'Duration: <span id="value-yt_length"><strong>' . Helper::convertDurationTime($inforVideo->contentDetails->duration) . '</strong></span>' : '' !!}
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">
                                Embedding: <span id="value-embedding"><strong>{{ isset($inforVideo->status->embeddable) && $inforVideo->status->embeddable == true ? 'allowed ' : 'not allowed' }}</strong></span>
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="">
                                {!! isset($inforVideo->snippet->publishedAt) ? 'Publish date: <span id="value-publish"><strong>' . date('Y-m-d H:i:s', strtotime($inforVideo->snippet->publishedAt)) . '</strong></span>' : '' !!}
                            </label>
                        </div>
                    </div>

                    <div class="widget border-radius4 shadow-div upload-file-dropzone" id="subtitle-dropzone">
                        <h4>Nhóm Video</h4>
                        <div>
                            {!! $groupsNested !!}
                        </div>
                    </div>

                    <div class="widget border-radius4 shadow-div">
                        <h4>Hiển thị trang chủ</h4>
                        <div class="control-group">
                            <div class="controls">
                                <div class="tagsinput" style="width: 100%;">
                                    {!! Form::select('display', ['1' => 'Hiển thị', '2' => 'Ẩn'], isset($video->display) ? $video->display : '', ['id' => 'displayFilter', 'class' => 'chosen-select']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div id="stack-controls" class="list-controls scroll-to-fixed-fixed" style="width: 98%;left: 20px; padding: 10px 10px !important;">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
                            <button name="submit" type="submit" value="Delete" class="btn btn-small btn-danger btn-strong">Delete Video</button>
                        </div>
                    </div>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button name="cancel" type="submit" value="Cancel" class="btn btn-small btn-normal btn-strong">Cancel</button>
                        </div>
                        <div class="btn-group">
                            <button name="submit" type="submit" value="Save" class="btn btn-small btn-success btn-strong">Save</button>
                        </div>
                    </div>
                </div>


            </div>

            {!! Form::close() !!}
        </div>


    </div>

@stop

@section('javascript')
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@stop