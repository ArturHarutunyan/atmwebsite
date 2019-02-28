@extends('backpack::layout')

@section('content')
    <h2>{{trans('admin.food_and_drinks')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('food_and_drink.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_food_and_drink')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.description')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($food_and_drinks as $food_and_drink)
                <tr   @if($food_and_drink->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        @if($food_and_drink->image)
                            <img src="{{asset($food_and_drink->image)}}" width="50px" height="50px" alt="{{$food_and_drink->name}}"/>
                        @else
                            <img src="{{asset('uploads/sample_image.jpg')}}" width="50px" height="50px" alt="{{$food_and_drink->name}}"/>
                        @endif
                    </td>
                    <td>{{$food_and_drink->name}}</td>
                    <td>{!! $food_and_drink->description !!}</td>
                    <td>
                        @if(!$food_and_drink->deleted_at)
                            <a href="{{route('food_and_drink.edit', ['id'=>$food_and_drink->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$food_and_drink->deleted_at)
                            <a href="{{route('food_and_drink.delete', ['id'=>$food_and_drink->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop