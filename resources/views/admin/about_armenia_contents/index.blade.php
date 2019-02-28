@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.about_armenia_page_content')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('about_armenia_content.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_new_about_armenia_content')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.history_image')}}</th>
                <th>{{trans('admin.religion_image')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($about_armenia_contents as $about_armenia_content)
                <tr>
                    <td>
                        <img src="{{asset($about_armenia_content->history_image)}}" width="50px" height="50px" alt="{{$about_armenia_content->history_image}}"/>
                    </td>
                    <td>
                        <img src="{{asset($about_armenia_content->religion_image)}}" width="50px" height="50px" alt="{{$about_armenia_content->religion_image}}"/>
                    </td>
                    <td>
                        <a href="{{route('about_armenia_content.edit', ['id'=>$about_armenia_content->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                    </td>
                    <td>
                        <a href="{{route('about_armenia_content.delete', ['id'=>$about_armenia_content->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop