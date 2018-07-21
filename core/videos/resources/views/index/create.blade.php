@extends('bases::layouts.master')

@section('content')

    <div id="update-video-screen">

        <div class="page-header"></div>
        <div class="breadcrumbs">
            <h2>Update video <a class="label opac5" href="#addVideo" onclick="location.href='#addVideo';" data-toggle="modal">+ add new</a></h2>
        </div>

        <div class="row">

            {!! Form::open(array(/*'route' => 'video.update',*/ 'method'=>'post','class'=>'form-inline')) !!}

            <div id="post-page">
                <?php
                  //  dd($video);
                ?>
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
                            <label class="control-label" for="">Duration: <span id="value-yt_length"><strong>4 min. 3 sec.</strong></span> <a href="#" id="show-duration">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Comments: <span id="value-comments"><strong>allowed</strong></span> <a href="#" id="show-comments">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Embedding: <span id="value-embedding"><strong>allowed</strong></span> <a href="#" id="show-embedding">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label>Featured: <span id="value-featured"><strong>no</strong></span> <a href="#" id="show-featured">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Requires registration: <span id="value-register"><strong>no</strong></span> <a href="#" id="show-visibility">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Views: <span id="value-views"><strong>0</strong></span> <a href="#" id="show-views">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Submitted by: <span id="value-submitted"><strong>jules</strong></span> <a href="#" id="show-user">Edit</a></label>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="">Publish date: <span id="value-publish"><strong>Jul 21, 2018 3:40 AM</strong></span> <a href="#" id="show-publish">Edit</a></label>
                        </div>
                    </div>

                    <div class="widget border-radius4 shadow-div upload-file-dropzone" id="subtitle-dropzone">
                        <h4>Nhóm Video</h4>
                        <div>
                            {!! $groupsNested !!}
                        </div>
                    </div>

                    <div class="widget border-radius4 shadow-div">
                        <h4>Tags</h4>
                        <div class="control-group">
                            <div class="controls">
                                <div class="tagsinput" style="width: 100%;">
                                    <input type="text" name="tags" value="" id="tags_addvideo_1" data-tagsinput-init="true" style="display: none;"><div id="tags_addvideo_1_tagsinput" class="tagsinput" style="width: auto; min-height: auto; height: auto;"><div id="tags_addvideo_1_addTag"><input id="tags_addvideo_1_tag" value="" data-default="" data-tagsinput-init="true" style="color: rgb(102, 102, 102); width: 50px;"></div><div class="tags_clear"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div id="stack-controls" class="list-controls scroll-to-fixed-fixed" style="width: 98%;left: 20px; padding: 10px 10px !important;">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
                            <!--<a href="#" onClick='del_video_id("6d8c82535", "1", "")' class="btn btn-small btn-danger btn-strong" rel="tooltip" title="Are you sure?">Delete Video</a>-->
                            <a href="modify.php?vid=6d8c82535&amp;a=3" class="btn btn-small btn-danger btn-strong" title="">Move to Trash</a>
                        </div>
                    </div>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button name="cancel" type="button" value="Cancel" onclick="location.href='videos.php'" class="btn btn-small btn-normal btn-strong">Cancel</button>
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