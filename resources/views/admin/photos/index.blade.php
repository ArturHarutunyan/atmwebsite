@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.photos')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('photo.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_photo')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.title')}}</th>
                <th>{{trans('admin.date')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($photos as $photo)
                <tr   @if($photo->deleted_at)
                      style="background: #cccccc!important;"
                      @endif
                >
                    <td>{{$photo->title}}</td>
                    <td>
                        @if(!$photo->deleted_at)
                            <a href="{{route('photo.edit', ['id'=>$photo->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>{{$photo->created_at}}</td>
                    <td>
                        @if(!$photo->deleted_at)
                            <a href="{{route('photo.delete', ['id'=>$photo->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop