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
                {{trans('admin.edit_the_meta_tag')}}
            </h2>
            <form action="{{route('custom_meta_tag.update',['id'=>$custom_meta_tag->id])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$custom_meta_tag->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sign">{{trans('admin.description')}}</label>
                    <textarea type="text" name="description" id="description" class="form-control">{{$custom_meta_tag->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{trans('admin.page_names')}}</label>
                    @foreach($page_names as $page_name)
                        <div class="checkbox">
                            <label><input type="checkbox" name="page_names[]" value="{{$page_name->id}}"
                                @foreach($custom_meta_tag->page_names as $t)
                                    @if($page_name->id==$t->id)
                                        <?='checked="checked"'?>
                                    @endif
                                @endforeach
                                >{{$page_name->name}}</label>
                        </div>
                    @endforeach
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