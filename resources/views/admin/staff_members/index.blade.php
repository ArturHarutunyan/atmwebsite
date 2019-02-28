@extends('backpack::layout')

@section('content')

    <h2>{{trans('admin.staff_members')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('staff_member.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_staff_member')}}</a>
    </div>
    <div class="panel panel-default">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>{{trans('admin.image')}}</th>
                <th>{{trans('admin.staff_name')}}</th>
                <th>{{trans('admin.surname')}}</th>
                <th>{{trans('admin.position')}}</th>
                <th>Facebook</th>
                <th>Linked In</th>
                <th>{{trans('admin.edit')}}</th>
                <th>{{trans('admin.delete')}}</th>
                {{--Soft Deletes--}}
            </tr>
            </thead>

            <tbody>
            @foreach($staff_members as $staff_member)
                <tr   @if($staff_member->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>
                        <img src="{{asset($staff_member->image)}}" width="50px" height="50px" alt="{{$staff_member->name}} {{$staff_member->surname}}"/>
                    </td>
                    <td>{{$staff_member->name}}</td>
                    <td>{{$staff_member->surname}}</td>
                    <td>{{$staff_member->position}}</td>
                    <td>{{$staff_member->facebook}}</td>
                    <td>{{$staff_member->linkedin}}</td>
                    <td>
                        @if(!$staff_member->deleted_at)
                            <a href="{{route('staff_member.edit', ['id'=>$staff_member->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$staff_member->deleted_at)
                            <a href="{{route('staff_member.delete', ['id'=>$staff_member->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop