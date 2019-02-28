@extends('backpack::layout')

@section('content')
    <div class="box">
        <div>
            <h2>{{trans('admin.custom_meta_tags')}}</h2>
            <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
                <a class="btn btn-primary ladda-button" href="{{route('custom_meta_tag.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_meta_tag')}}</a>
            </div>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.description')}}</th>
                    <th>{{trans('admin.page_name')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($custom_meta_tags as $custom_meta_tag)
                    <tr  @if($custom_meta_tag->deleted_at)
                         style="background: #cccccc!important;"
                            @endif
                    >
                        <td>{{$custom_meta_tag->name}}</td>
                        <td>{{$custom_meta_tag->description}}</td>
                        <td>{{$custom_meta_tag->page_name}}</td>
                        <td>
                            @if(!$custom_meta_tag->deleted_at)
                                <a href="{{route('custom_meta_tag.edit', ['id'=>$custom_meta_tag->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$custom_meta_tag->deleted_at)
                                <a href="{{route('custom_meta_tag.delete', ['id'=>$custom_meta_tag->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop