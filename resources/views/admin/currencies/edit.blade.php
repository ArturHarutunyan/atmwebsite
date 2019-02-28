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
                {{trans('admin.edit_the_currency')}}
            </h2>
            <form action="{{route('currency.update',['id'=>$currency->id])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$currency->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sign">{{trans('admin.sign')}}</label>
                    <input type="text" name="sign" id="sign" value="{{$currency->sign}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="rate">{{trans('admin.rate')}}</label>
                    <input type="number" name="rate" id="rate" value="{{$currency->rate}}" class="form-control">
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