@extends('backpack::layout')
@push('after_styles')
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endpush
@section('content')
    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="panel panel-default" id="main">

        <div class="panel-body">
            <h2>
                {{trans('admin.add_a_new_tour_day')}}
            </h2>
            <form action="{{route('tour_day.store')}}" method="post">
                {{ csrf_field() }}
                <ul class="nav nav-tabs">
                    @foreach(config('translatable.locales') as $key=>$value)
                        <li id="li-{{$key}}" class="@if(App::isLocale($key)) active @endif" onclick="activate('{{$key}}')" href="#{{$key}}"><a data-toggle="tab" >{{$value}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach(array_keys(config('translatable.locales')) as $lang)
                        <div id="{{$lang}}" class="tab-pane fade @if(App::isLocale($lang))in active @endif">
                            <div class="form-group">
                                <label for="ckeditor-content_{{$lang}}">{{Lang::get('admin.content',[],$lang)}}</label>
                                <textarea id="ckeditor-content_{{$lang}}" class="ckeditor-content" name="text_content_{{$lang}}" class="form-control"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="tour_id">{{trans('admin.tour')}}</label>

                    <select name="tour_id" id="tour_id" class="form-control" v-model="selected" @change="changeFunction()">
                        @foreach($tours as $tour)
                            <option value="{{$tour->id}}">{{$tour->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="day_number">{{trans('admin.day_number')}}</label>
                    <select name="day_number" id="day_number" class="form-control">
                        <option v-for="n in parseInt(count)" v-bind:value="n">@{{n}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.store')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('after_scripts')
<script src="{{asset('js/tabs.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.ckeditor-content').ckeditor({
            "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
        });
    });
    new Vue({
        el: '#main',
        data: {
            selected:0,
            items: [],
            count: 0,
        },
        mounted: function () {
            //console.log(this.count);

            axios.get("{{route('tours.api')}}").then((response) => {
                this.items = response.data;
            var self=this;
            this.items.filter(function (tour) {
                if (self.selected == tour.id) {
                    self.count = tour.days_count;
                }
            })

            //console.log(this.items);
            }).catch((error) => {
                console.log(error);
            });
        },
        methods:{
            changeFunction: function () {
                axios.get("{{route('tours.api')}}").then((response) => {
                    this.items = response.data;
                    var self = this;
                    this.items.filter(function (tour) {
                    if (self.selected == tour.id) {
                        self.count = tour.days_count;
                    }
                })
            })
            }
        }
    });
</script>
@endpush