@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.about_page_content')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('about_content.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_new_about_page_content')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.why_me_first_image')}}</th>
                <th>{{trans('admin.why_me_second_image')}}</th>
                <th>{{trans('admin.why_me_third_image')}}</th>
                <th>{{trans('admin.why_me_fourth_image')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($about_contents as $about_content)
                <tr>
                    <td>
                        {!! $about_content->why_me_first_image !!}
                    </td>
                    <td>
                        {!! $about_content->why_me_second_image !!}
                    </td>
                    <td>
                        {!! $about_content->why_me_third_image !!}
                    </td>
                    <td>
                        {!! $about_content->why_me_fourth_image !!}
                    </td>
                    <td>
                        <a href="{{route('about_content.edit', ['id'=>$about_content->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                    </td>
                    <td>
                        <a href="{{route('about_content.delete', ['id'=>$about_content->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop