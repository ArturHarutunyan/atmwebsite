@extends('backpack::layout')

@section('content')
    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="panel panel-default">

        <div class="panel-body">
            <h2>
                {{trans('admin.edit_the_partner')}}
            </h2>
            <form action="{{route('partner.update',['id'=>$partner->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$partner->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">{{trans('admin.link')}}</label>
                    <input type="text" name="link" id="link" value="{{$partner->link}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="partner_image">{{trans('admin.partner_image')}}</label>
                    @if($partner->partner_image)
                        <img class="img-responsive old-image" src="{{asset($partner->partner_image)}}">
                    @endif
                    <input type="file" name="partner_image" id="partner_image" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.update')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection