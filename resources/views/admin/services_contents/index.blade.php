@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.services_page_content')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('services_content.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_new_services_content')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.for_fit_image')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($services_contents as $services_content)
                <tr>
                    <td>
                        <img src="{{asset($services_content->for_fit_image)}}" width="50px" height="50px" alt="{{$services_content->for_fit_image}}"/>
                    </td>
                    <td>
                        <a href="{{route('services_content.edit', ['id'=>$services_content->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                    </td>
                    <td>
                        <a href="{{route('services_content.delete', ['id'=>$services_content->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop