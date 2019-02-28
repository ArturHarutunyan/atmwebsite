@extends('backpack::layout')

@section('content')
    <div class="box">
        <div>
            <h2>{{trans('admin.currencies')}}</h2>
            <div style="display:flex; justify-content: flex-start; padding-bottom: 15px;" class="box-header with-border">
                <a class="btn btn-primary ladda-button" href="{{route('currency.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_a_new_currency')}}</a>
            </div>
        </div>
        <div class="box-body overflow-hidden">
            <table id="crudTable" class="table table-striped table-hover display responsive nowrap dataTable dtr-inline" cellspacing="0" role="grid" aria-describedby="crudTable_info">
                <thead>
                <tr>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.rate')}}</th>
                    <th>{{trans('admin.edit')}}</th>
                    <th>{{trans('admin.delete')}}</th>
                    {{--Soft Deletes--}}
                </tr>
                </thead>

                <tbody>
                @foreach($currencies as $currency)
                    <tr  @if($currency->deleted_at)
                         style="background: #cccccc!important;"
                            @endif
                    >
                        <td>{{$currency->name}}</td>
                        <td>{{$currency->rate}}</td>
                        <td>
                            @if(!$currency->deleted_at)
                                <a href="{{route('currency.edit', ['id'=>$currency->id])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!$currency->deleted_at)
                                <a href="{{route('currency.delete', ['id'=>$currency->id])}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop