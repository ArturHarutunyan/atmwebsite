@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.videos')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('video.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_video')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.title')}}</th>
                <th>{{trans('admin.date')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($videos as $video)
                <tr   @if($video->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>{{$video->title}}</td>
                    <td>
                        @if(!$video->deleted_at)
                            <a href="{{route('video.edit', ['id'=>$video->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>{{$video->created_at}}</td>
                    <td>
                        @if(!$video->deleted_at)
                            <a href="{{route('video.delete', ['id'=>$video->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop