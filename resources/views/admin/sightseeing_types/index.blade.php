@extends('backpack::layout')

@section('content')

    <div class="box">
        <h2>{{trans('admin.sightseeing_types')}}</h2>
        <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
            <a class="btn btn-primary ladda-button" href="{{route('sightseeing_type.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_sightseeing_type')}}</a>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.trash')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($sightseeing_types as $sightseeing_type)
                    <tr  @if($sightseeing_type->deleted_at)
                         style="background: #cccccc!important;"
                            @endif
                    >
                        <td>{{$sightseeing_type->name}}</td>
                        <td>
                            @if(!$sightseeing_type->deleted_at)
                                <a href="{{route('sightseeing_type.edit', ['id'=>$sightseeing_type->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$sightseeing_type->deleted_at)
                                <a href="{{route('sightseeing_type.delete', ['id'=>$sightseeing_type->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop