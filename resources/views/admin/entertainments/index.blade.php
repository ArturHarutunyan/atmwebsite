@extends('backpack::layout')

@section('content')

    <h2>{{trans('admin.entertainments')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('entertainment.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_entertainment')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($entertainments as $entertainment)
                <tr   @if($entertainment->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($entertainment->image)
                            <img src="{{asset($entertainment->image)}}" width="50px" height="50px" alt="{{$entertainment->name}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$entertainment->name}}"/>
                        @endif
                    </td>
                    <td>{{$entertainment->name}}</td>
                    <td>
                        @if(!$entertainment->deleted_at)
                            <a href="{{route('entertainment.edit', ['id'=>$entertainment->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$entertainment->deleted_at)
                            <a href="{{route('entertainment.delete', ['id'=>$entertainment->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop