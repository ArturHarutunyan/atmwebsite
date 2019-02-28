@extends('backpack::layout')

@section('content')

    <h2>{{trans('admin.meals_and_caterings')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('meals_and_catering.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_new_meals_and_catering')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($meals_and_caterings as $meals_and_catering)
                <tr   @if($meals_and_catering->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>{{$meals_and_catering->name}}</td>
                    <td>
                        @if(!$meals_and_catering->deleted_at)
                            <a href="{{route('meals_and_catering.edit', ['id'=>$meals_and_catering->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$meals_and_catering->deleted_at)
                            <a href="{{route('meals_and_catering.delete', ['id'=>$meals_and_catering->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop