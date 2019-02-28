@extends('backpack::layout')

@section('content')
    <div class="box">
        <div>
            <h2>{{trans('admin.page_names')}}</h2>
            <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
                <a class="btn btn-primary ladda-button" href="{{route('page_name.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_page_name')}}</a>
            </div>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($page_names as $page_name)
                    <tr  @if($page_name->deleted_at)
                         style="background: #cccccc!important;"
                            @endif
                    >
                        <td>{{$page_name->name}}</td>
                        <td>
                            @if(!$page_name->deleted_at)
                                <a href="{{route('page_name.edit', ['id'=>$page_name->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$page_name->deleted_at)
                                <a href="{{route('page_name.delete', ['id'=>$page_name->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop