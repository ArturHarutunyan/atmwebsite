@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.blogs')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('blog.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_blog')}}</a>
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
            @foreach($blogs as $blog)
                <tr   @if($blog->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($blog->image)
                            <img src="{{asset($blog->image)}}" width="50px" height="50px" alt="{{$blog->title}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$blog->title}}"/>
                        @endif
                    </td>
                    <td>{{$blog->title}}</td>
                    <td>{!! $blog->text_content !!}</td>
                    <td>
                        @if(!$blog->deleted_at)
                            <a href="{{route('blog.edit', ['id'=>$blog->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>{{$blog->created_at}}</td>
                    <td>
                        @if(!$blog->deleted_at)
                            <a href="{{route('blog.delete', ['id'=>$blog->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop