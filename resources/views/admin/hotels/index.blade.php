@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.hotels')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('hotel.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_hotel_category')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.address')}}</th>
                    <th>{{trans('admin.category')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
            </thead>
            <tbody>
            @foreach($hotels as $hotel)
                <tr   @if($hotel->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>{{$hotel->name}}</td>
                    <td>{{$hotel->address}}</td>
                    <td>{{$hotel->category->name}}</td>
                    <td>
                        @if(!$hotel->deleted_at)
                            <a href="{{route('hotel.edit', ['id'=>$hotel->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$hotel->deleted_at)
                            <a href="{{route('hotel.delete', ['id'=>$hotel->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop