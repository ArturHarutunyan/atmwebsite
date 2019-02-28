@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.tourist_info_content')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('tourist_info_content.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_new_tourist_info_content')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.visa_content')}}</th>
                <th>{{trans('admin.climate_content')}}</th>
                <th>{{trans('admin.currency_content')}}</th>
                <th>{{trans('admin.safety_content')}}</th>
                <th>{{trans('admin.edit')}}</th>
                {{--<th>{{trans('admin.delete')}}</th>--}}
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($tourist_info_contents as $tourist_info_content)
                <tr>
                    <td>
                        {!! $tourist_info_content->visa_content !!}
                    </td>
                    <td>
                        {!! $tourist_info_content->climate_content !!}
                    </td>
                    <td>
                        {!! $tourist_info_content->currency_content !!}
                    </td>
                    <td>
                        {!! $tourist_info_content->safety_content !!}
                    </td>
                    <td>
                        <a href="{{route('tourist_info_content.edit', ['id'=>$tourist_info_content->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                    </td>
                    {{--<td>--}}
                        {{--<a href="{{route('tourist_info_content.delete', ['id'=>$tourist_info_content->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>--}}
                    {{--</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop