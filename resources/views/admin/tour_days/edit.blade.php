@extends('backpack::layout')
@push('after_styles')
    <link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
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
                {{trans('admin.edit_the_tour_day')}}
            </h2>
            <form id="main-form" action="{{route('tour_day.update',['id'=>$tour_day->id])}}" method="post">
                {{ csrf_field() }}
                <ul class="nav nav-tabs">
                    @foreach(config('translatable.locales') as $key=>$value)
                        <li id="li-{{$key}}" class="@if(App::isLocale($key)) active @endif" onclick="activate('{{$key}}')" href="#{{$key}}"><a data-toggle="tab" >{{$value}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach(array_keys(config('translatable.locales')) as $lang)
                        @if($tour_day->hasTranslation($lang))
                            <div id="{{$lang}}" class="tab-pane fade @if(App::isLocale($lang))in active @endif">
                                <div class="form-group">
                                    <label for="ckeditor-content_{{$lang}}">{{Lang::get('admin.content',[],$lang)}}</label>
                                    <textarea id="ckeditor-content_{{$lang}}" class="ckeditor-content" name="text_content_{{$lang}}" class="form-control">{{$tour_day->getTranslation($lang)->text_content}}</textarea>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="tour_id">{{trans('admin.tour')}}</label>
                    {{--
                        <select name="tour_id" id="tour_id" class="form-control" v-model="selected" @change="fetchTypeList()">
                    --}}
                    <select name="tour_id" id="tour_id" class="form-control" v-model="selected" @change="changeFunction()">
                        @foreach($tours as $tour)
                            <option data-days="{{$tour->days_count}}" value="{{$tour->id}}"
                                    @if($tour->id==$tour_day->tour->id)
                                    selected
                                    @endif
                            >{{$tour->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="day_number">{{trans('admin.day_number')}}</label>
                    <select name="day_number" id="day_number" class="form-control">
                        <option v-for="n in parseInt(count)" v-bind:value="n" v-bind:selected="n=='<?=$tour_day->day_number?>'">@{{n}}</option>
                    </select>
                </div>
                <input type="hidden" name="images_encoded">
            </form>
            <div class="form-group">
                <label for="images-dropzone">{{trans('admin.upload_images')}}</label>
                <div class="bottom-figure--wrapper">
                    @foreach($tour_day->tour_day_images as $tour_image)
                        <figure class="bottom-figure--container">
                            <a class="btn btn-danger remove-button" href="{{route('tour_day.remove_single_image',['id'=>$tour_image->id])}}">&times;</a>
                            <img src="{{asset($tour_image->name)}}">
                        </figure>
                    @endforeach
                </div>
                <form action="{{route('tour_day.add_image')}}"
                      class="dropzone"
                      method="post"
                      id="images-dropzone">
                    {{csrf_field()}}
                </form>
            </div>
            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" id="main_submit" type="submit" form="main-form">{{trans('admin.update')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after_scripts')
<script src="{{asset('js/tabs.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>

<script>
    var files=[];
    Dropzone.options.imagesDropzone = {
        maxFilesize: 2, // MB
        timeout: 1000000,
        maxFiles: 20,
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 100,
        init: function() {
            var self=this;
            var mainForm = document.getElementById('main-form');
            mainForm.addEventListener("submit", function (event) {
                event.preventDefault();
                var c=0;
                files.length=0;
                for (var i = 0; i < self.files.length; i++) {
                    let f= new FormData();
                    f.append('file',self.files[i]);
                    c=i;
                    axios.post("{{route('tour_day.add_image')}}", f)
                        .then((response) => {
                            if(response.data){
                                files.push(JSON.stringify(response.data));
                                $('[name="images_encoded"]').val(JSON.stringify(files));
                                if(files.length===self.files.length){
                                    mainForm.submit();
                                }
                            }
                        });
                }
            });
        }
    };
    $(document).ready(function() {
        $('.ckeditor-content').ckeditor({
            "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
        });
    });
    new Vue({
        el: '#main',
        data: {
            selected:'<?=$tour_day->tour_id?>',
            items: [],
            count: '<?=$tour_day->day_number?>',
        },
        mounted: function () {
            axios.get("{{route('tours.api')}}").then((response) => {
                this.items = response.data;
            var self=this;
            this.items.filter(function (tour) {
                if (self.selected == tour.id) {
                    self.count = tour.days_count;
                }
            })
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
                });
            }
        }
    });
</script>
@endpush