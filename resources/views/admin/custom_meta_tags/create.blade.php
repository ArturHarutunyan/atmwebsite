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
                {{trans('admin.add_a_new_meta_tag')}}
            </h2>
            <form action="{{route('custom_meta_tag.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">{{trans('admin.description')}}</label>
                    <textarea type="text" name="description" id="description" class="form-control" placeholder="{{trans('admin.description_placeholder')}}"></textarea>
                </div>
                <label>{{trans('admin.page_names')}}</label>
                @foreach($page_names as $page_name)
                    <div class="checkbox">
                        <label><input type="checkbox" checked="checked" name="page_names[]" value="{{$page_name->id}}">{{$page_name->name}}</label>
                    </div>
                @endforeach
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection