@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.home_page_contents')}}</h2>
    <div class="panel panel-default">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{trans('admin.who_we_are_content')}}</th>
                <th>{{trans('admin.the_best_tours_content')}}</th>
                <th>{{trans('admin.unique_services_content')}}</th>
                <th>{{trans('admin.edit')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($home_page_contents as $home_page_content)
                <tr>
                    <td>{!! $home_page_content->who_we_are_content!!}</td>
                    <td>{!! $home_page_content->the_best_tours_content!!}</td>
                    <td>
                        <a href="{{route('home_page_content.edit', ['id'=>$home_page_content->id])}}" class="btn btn-xs btn-info">{{trans('admin.edit')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop