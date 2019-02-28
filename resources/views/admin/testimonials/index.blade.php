@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.testimonials')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('testimonial.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_testimonial')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.author')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($testimonials as $testimonial)
                <tr   @if($testimonial->deleted_at)
                          style="background: #cccccc!important;"
                      @endif
                    >
                    <td>
                        @if($testimonial->author_image)
                            <img src="{{asset($testimonial->author_image)}}" width="50px" height="50px" alt="{{$testimonial->author}}"/>
                        @elseif($testimonial->gender==1)
                            <img src="{{asset('uploads/images/main/woman.svg')}}" width="50px" height="50px" alt="{{$testimonial->author}}"/>
                        @else
                            <img src="{{asset('uploads/images/main/man.svg')}}" width="50px" height="50px" alt="{{$testimonial->author}}"/>
                        @endif
                    </td>
                    <td>{{$testimonial->author}}</td>
                    <td>
                        @if(!$testimonial->deleted_at)
                            <a href="{{route('testimonial.edit', ['id'=>$testimonial->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$testimonial->deleted_at)
                            <a href="{{route('testimonial.delete', ['id'=>$testimonial->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop