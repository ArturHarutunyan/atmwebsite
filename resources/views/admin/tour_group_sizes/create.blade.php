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
                {{trans('admin.add_a_new_tour_group_size')}}
            </h2>
            <form action="{{route('tour_group_size.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="size">{{trans('admin.size')}}</label>
                    <input type="text" name="size" id="size" class="form-control">
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