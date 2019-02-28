@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.certificates')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('certificate.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_certificate')}}</a>
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
            @foreach($certificates as $certificate)
                <tr   @if($certificate->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($certificate->image)
                            <img src="{{asset($certificate->image)}}" width="50px" height="50px" alt="{{$certificate->title}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$certificate->title}}"/>
                        @endif
                    </td>
                    <td>{{$certificate->title}}</td>
                    <td>{!! $certificate->text_content !!}</td>
                    <td>
                        @if(!$certificate->deleted_at)
                            <a href="{{route('certificate.edit', ['id'=>$certificate->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>{{$certificate->created_at}}</td>
                    <td>
                        @if(!$certificate->deleted_at)
                            <a href="{{route('certificate.delete', ['id'=>$certificate->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop