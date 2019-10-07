@extends('backpack::layout')

@push('after_styles')
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('wcit/css/wcit_orders.css')}}" rel="stylesheet">
@endpush
@push('after_scripts')
    <script src="{{asset('wcit/scripte/orders.js')}}"></script>
@endpush
@section('content')
    <div class="container-fluid mainContainer">

          <div>



                @foreach($days as $day)
                    <div class="colum">
                        <div class="date">
                            {{date("d.m.Y", $day->date)}}
                        </div>
                        <!-- add tour name backgroundColor inline  -->
                        <!-- adding status color inline  -->
                       <div class="tours">
                           @foreach($day->orders as $order)
                            <div class="tour">
                                <div class="tourName" style="background-color:{{$order->wcit_excursion->excursion_details->color}}">
                                    {{$order->wcit_excursion->name}}
                                </div>
                                <div class="iconsWrapper">
                                    <div class="icon">
                                        @if($order->status=='1')
                                            <img src="{{asset('/wcit/images/checked.svg')}}" alt="confirm">
                                        @elseif($order->status=='2')
                                            <img src="{{asset('/wcit/images/cancel.svg')}}" alt="rejected">
                                        @else
                                            <img src="{{asset('/wcit/images/more.gif')}}" alt="not reviewed">
                                        @endif
                                    </div>
                                    <div class="iconsContainer">
                                        <div class="icon">
                                            {{$order->people_count}}
                                        </div>
                                        <div class="icon">
                                            @if($order->excursion_type_id=='1')
                                                <img src="{{asset('/wcit/images/individual.svg')}}" alt="individual">
                                            @elseif($order->excursion_type_id=='2')
                                                <img src="{{asset('/wcit/images/multiple-users-silhouette.svg')}}" alt="join_a_group">
                                            @endif
                                        </div>
                                        <div class="icon">
                                            ֏
                                        </div>
                                        <div class="icon">
                                            @if($order->tour_language_id=='1')
                                                EN
                                            @elseif($order->tour_language_id=='2')
                                                RU
                                            @endif
                                        </div>
                                    </div>
                                    <div class="icon openDetails">
                                        <img src="{{asset('/wcit/images/arrow-down-sign-to-navigate.svg')}}" alt="down icon">
                                    </div>
                                </div>
                                <span class="fullDetailsTourInfo" style="display: none">
                                    <p><span>Person Quantity:</span> <span>{{$order->people_count}}</span></p>
                                    <p>
                                        <span>Group / individual:</span>
                                        <span>
                                            @if($order->excursion_type_id=='1')
                                                Individual
                                            @elseif($order->excursion_type_id=='2')
                                                Group
                                            @endif
                                        </span>
                                    </p>
                                    <p><span>Price:</span> <span>AMD{{$order->price}}</span></p>
                                    <p><span>Language:</span> <span>{{$order->tour_language_id==1?'English':'Russian'}}</span></p>
                                    <p>
                                        <span>Status:</span>
                                        @if($order->status==0)
                                            <span class="not-reviewed">Not Reviewed</span>
                                        @elseif($order->status==1)
                                            <span class="confirmed">Confirmed</span>
                                        @elseif($order->status==2)
                                            <span class="rejected">Rejected</span>
                                        @endif
                                    </p>
                                    {{--<p><span>Guide Contacts:</span>
                                <div>
                                    <p>077777777</p>
                                    <p>petrosyan@gmail.com</p>
                                </div>
                                </p>
                                <p><span>Transport Contacts:</span>
                                    <div>
                                <p>077777777</p>
                                <p>Mercedes Benz</p>
                                <p>petrosyan@gmail.com</p>
                            </div>
                            </p>--}}
                                    <p><span>Payment Confirmed:</span> <span>no</span></p>
                                    <p><span>Customer:</span> <span>{{$order->wcit_customer->name}} {{$order->wcit_customer->surname}}</span></p>
                                    <p><span>Email:</span> <span>{{$order->wcit_customer->email}}</span></p>
                                    <p><span>Phone:</span> <span>{{$order->wcit_customer->phone?$order->wcit_customer->phone:''}}</span></p>
                                    <p><span>Organization:</span> <span>{{$order->wcit_customer->organization}}</span></p>
                                    <p><span>notes:</span> <span>{{$order->wcit_customer->notes?$order->wcit_customer->notes:''}}</span></p>
                                </span>
                            </div>
                            @endforeach
                            </div>
                        </div>
            @endforeach
    </div>
</div>
@endsection