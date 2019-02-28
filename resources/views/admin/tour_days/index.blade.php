@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.tour_days')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('tour_day.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_tour_day')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.tour')}}</th>
                <th>{{trans('admin.day_number')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($tour_days as $tour_day)
                <tr   @if($tour_day->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>{{$tour_day->tour->name}}</td>
                    <td>{{$tour_day->day_number}}</td>
                    <td>
                        @if(!$tour_day->deleted_at)
                            <a href="{{route('tour_day.edit', ['id'=>$tour_day->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$tour_day->deleted_at)
                            <a href="{{route('tour_day.delete', ['id'=>$tour_day->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop