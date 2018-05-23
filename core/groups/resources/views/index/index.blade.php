@extends('bases::layouts.master')

@section('content')
    <div class="page-header"></div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('group.index') }}">Danh sách nhóm</a>
            </li>
        </ul>
    </div>

    <div class="row">

        <div class="col-sm-9">

            <div class="box box-color box-bordered">

                <div class="box-title">
                    <h3>
                        <i class="fa fa-th-list"></i>Danh sách tất cả nhóm
                    </h3>
                </div>

                <div class="box-content">
                    {!! $tree !!}
                </div>

            </div>
        </div>

    </div>


@stop
@section('javascript')
    <script>
        $(document).ready(function () {
            $("#browser").treeview();
        });
    </script>
@stop