@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.events')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('event.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_event')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.date')}}</th>
                <th>{{trans('admin.description')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($events as $event)
                <tr   @if($event->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($event->image)
                            <img src="{{asset($event->image)}}" width="50px" height="50px" alt="{{$event->name}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$event->name}}"/>
                        @endif
                    </td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->date}}</td>
                    <td>{!! $event->description !!}</td>
                    <td>
                        @if(!$event->deleted_at)
                            <a href="{{route('event.edit', ['id'=>$event->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$event->deleted_at)
                            <a href="{{route('event.delete', ['id'=>$event->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop