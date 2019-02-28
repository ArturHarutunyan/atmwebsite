@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.sightseeing_places')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('sightseeing_place.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_sightseeing_place')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.type')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($sightseeing_places as $sightseeing_place)
                <tr   @if($sightseeing_place->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($sightseeing_place->image)
                            <img src="{{asset($sightseeing_place->image)}}" width="50px" height="50px" alt="{{$sightseeing_place->name}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$sightseeing_place->name}}"/>
                        @endif
                    </td>
                    <td>{{$sightseeing_place->name}}</td>
                    <td>{{$sightseeing_place->sightseeing_type->name}}</td>
                    <td>
                        @if(!$sightseeing_place->deleted_at)
                            <a href="{{route('sightseeing_place.edit', ['id'=>$sightseeing_place->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$sightseeing_place->deleted_at)
                            <a href="{{route('sightseeing_place.delete', ['id'=>$sightseeing_place->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop