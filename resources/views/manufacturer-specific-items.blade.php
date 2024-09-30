@extends('layouts.menu-teacher')
@section('content')
    <div class="b-divider"></div>

    <h2 class="text-center">All Bikes From {{$themanuf_name}} </h2>

    <div class="row row-cols-lg-3  g-4 p-5">
        @foreach($fromthismanufacturer as $bike)
            <div class="col" style="margin-bottom: 150px">
                <div class="card card-cover h-100 m-2 text-bg-dark rounded-4"
                     style="background-image: url('../.././storage/{{$bike->bicycle_image}}'); position: relative;">
                    {{-- <img src="{{ asset('storage/' . $bike->bicycle_image) }}" alt="Bike Image">--}}
                    {{--   @dd($bike->bicycle_image)--}}

                    <a href="item-review-page/{{$bike->bicycle_id}}">
                        <div class="d-flex flex-column h-auto p-5 ">
                        </div>
                    </a>
                </div>
                {{-- like here im using a as we only doing get--}}
                <a href="{{route('item-review-page', ['bicycle_id'=>$bike->bicycle_id])}}"
                   class="d-block text-decoration-none">
                    <h4 class="mt-3 fw-bold text-center text-info">{{$bike->bicycle_name}}</h4>
                    {{--                    <small class="fw-bold text-info">Posted by: {{$bike->username}}</small>--}}

                </a>
                <ul class="d-flex list-unstyled mt-auto">
                    <li><h6 class="text-center">{{$bike->bicycle_description}}</h6></li>
                </ul>
                <ul class="mt-3 list-group border border-info">
                    <li class="d-flex justify-content-center text-warning list-group-item"><strong>Average
                            Rating: </strong></li>
                    <li class="d-flex justify-content-center list-group-item"><strong class="list-unstyled">Total
                            Reviews: {{$bike->bicycle_total_reviews}}</strong></li>
                    </li>
                </ul>
                {{--                    <h6 class="text-center" >{{$bike->bicycle_description}}</h6>--}}
            </div>
        @endforeach
    </div>

    <div class="b-divider"></div>
@endsection
