@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.news')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('news.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_news')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.title')}}</th>
                <th>{{trans('admin.content')}}</th>
                <th>{{trans('admin.date')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($news as $single_news)
                <tr   @if($single_news->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($single_news->image)
                            <img src="{{asset($single_news->image)}}" width="50px" height="50px" alt="{{$single_news->title}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$single_news->title}}"/>
                        @endif
                    </td>
                    <td>{{$single_news->title}}</td>
                    <td>{!! $single_news->text_content !!}</td>
                    <td>
                        @if(!$single_news->deleted_at)
                            <a href="{{route('news.edit', ['id'=>$single_news->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>{{$single_news->created_at}}</td>
                    <td>
                        @if(!$single_news->deleted_at)
                            <a href="{{route('news.delete', ['id'=>$single_news->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop