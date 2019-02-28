@extends('backpack::layout')

@section('content')

    <h2>{{trans('admin.guides')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('guide.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_guide')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.staff_name')}}</th>
                <th>{{trans('admin.surname')}}</th>
                <th>{{trans('admin.language')}}</th>
                <th>Facebook</th>
                <th>Linked In</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($guides as $guide)
                <tr   @if($guide->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        <img src="{{asset($guide->image)}}" width="50px" height="50px" alt="{{$guide->name}} {{$guide->surname}}"/>
                    </td>
                    <td>{{$guide->name}}</td>
                    <td>{{$guide->surname}}</td>
                    <td>{{$guide->language}}</td>
                    <td>{{$guide->facebook}}</td>
                    <td>{{$guide->linkedin}}</td>
                    <td>
                        @if(!$guide->deleted_at)
                            <a href="{{route('guide.edit', ['id'=>$guide->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$guide->deleted_at)
                            <a href="{{route('guide.delete', ['id'=>$guide->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop