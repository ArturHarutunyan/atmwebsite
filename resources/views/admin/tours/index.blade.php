@extends('backpack::layout')

@section('content')
    <div class="box">
        <h2>{{trans('admin.tours')}}</h2>
        <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
            <a class="btn btn-primary ladda-button" href="{{route('tour.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_tour')}}</a>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.image')}}</th>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.types')}}</th>
                    <th>{{trans('admin.season')}}</th>
                    <th>{{trans('admin.period')}}</th>
                    <th>{{trans('admin.group_size')}}</th>
                    <th>{{trans('admin.start_price')}}</th>
                    <th>{{trans('admin.days')}}</th>
                    <th>{{trans('admin.nights')}}</th>
                    <th>{{trans('admin.hotel')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($tours as $tour)
                    <tr @if($tour->deleted_at)
                        style="background: #cccccc!important;"
                            @endif>
                        <td>
                            @if($tour->tour_image)
                                <img src="{{asset($tour->tour_image)}}" width="50px" height="50px" alt="{{$tour->name}}"/>
                            @else
                                <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$tour->name}}"/>
                            @endif
                        </td>
                        <td>{{$tour->name}}</td>
                        <td>
                            @foreach($tour->tour_types as $t)
                                <p>{{$t->name}}</p>
                            @endforeach
                        </td>
                        <td>{{$tour->season->name}}</td>
                        <td>{{$tour->period->name}}</td>
                        <td>{{$tour->group_size->size}}</td>
                        <td>{{number_format($tour->start_price)}}</td>
                        <td>{{$tour->days_count}}</td>
                        <td>{{$tour->nights_count}}</td>
                        <td>{{$tour->hotel->name}}</td>
                        <td>
                            @if(!$tour->deleted_at)
                                <a href="{{route('tour.edit', ['id'=>$tour->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$tour->deleted_at)
                                <a href="{{route('tour.delete', ['id'=>$tour->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop