@extends('backpack::layout')

@section('content')
    <div class="box">
        <h2>{{trans('admin.partners')}}</h2>
        <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
            <a class="btn btn-primary ladda-button" href="{{route('partner.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_partner')}}</a>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.image')}}</th>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.link')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.trash')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                <?php
                $k=0;
                ?>
                @foreach($partners as $partner)
                    <?php
                    ++$k;
                    ?>
                    <tr class="
                    @if($k%2)
                            odd
@else
                            even
@endif" @if($partner->deleted_at)
                        style="background: #cccccc!important;"
                            @endif
                    >
                        <td>
                            <img src="{{asset($partner->partner_image)}}" width="150px" height="50px" alt="{{$partner->name}}"/>
                        </td>
                        <td>{{$partner->name}}</td>
                        <td>{{$partner->link}}</td>
                        <td>
                            @if(!$partner->deleted_at)
                                <a href="{{route('partner.edit', ['id'=>$partner->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
                            @endif
                        </td>
                        <td>
                            @if(!$partner->deleted_at)
                                <a href="{{route('partner.delete', ['id'=>$partner->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop