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
                {{trans('admin.add_a_new_partner')}}
            </h2>
            <form action="{{route('partner.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">{{trans('admin.link')}}</label>
                    <input type="text" name="link" id="link" class="form-control">
                </div>
                <div class="form-group">
                    <label for="partner_image">{{trans('admin.partner_image')}}</label>
                    <input type="file" name="partner_image" id="partner_image" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.store')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection