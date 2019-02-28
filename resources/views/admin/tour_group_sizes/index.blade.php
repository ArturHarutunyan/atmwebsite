@extends('backpack::layout')

@section('content')
    <div class="box">
        <h2>{{trans('admin.tour_group_sizes')}}</h2>
        <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
            <a class="btn btn-primary ladda-button" href="{{route('tour_group_size.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_tour_group_size')}}</a>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.size')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($tour_group_sizes as $tour_group_size)
                    <tr  @if($tour_group_size->deleted_at)
                         style="background: #cccccc!important;"
                            @endif
                    >

                        <td>{{$tour_group_size->size}}</td>
                        <td>
                            @if(!$tour_group_size->deleted_at)
                                <a href="{{route('tour_group_size.edit', ['id'=>$tour_group_size->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$tour_group_size->deleted_at)
                                <a href="{{route('tour_group_size.delete', ['id'=>$tour_group_size->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop