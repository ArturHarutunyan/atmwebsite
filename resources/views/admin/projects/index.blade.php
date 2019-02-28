@extends('backpack::layout')

@section('content')

    <h2>{{trans('admin.projects')}}</h2>
    <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;">
        <a class="btn btn-primary ladda-button" href="{{route('project.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_project')}}</a>
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
            @foreach($projects as $project)
                <tr   @if($project->deleted_at)
                      style="background: #cccccc!important;"
                        @endif
                >
                    <td>{{$project->name}}</td>
                    <td>
                        @if(!$project->deleted_at)
                            <a href="{{route('project.edit', ['id'=>$project->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                        @endif
                    </td>
                    <td>
                        @if(!$project->deleted_at)
                            <a href="{{route('project.delete', ['id'=>$project->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop