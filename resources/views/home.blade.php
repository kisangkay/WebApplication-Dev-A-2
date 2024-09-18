@extends('layouts.menu-logged-in')
@section('content')
    <div class="b-divider"></div>

    <div class="container px-4 py-2" id="custom-cards">
        <h2 class="text-center">YesBike <small class="fs-6">Reviews</small>

                <div class="text-center">
                    <h2 class="border-bottom text-center mt-3">
                    <a href="{{route('create-a-new-item')}}"
                       class="btn btn-primary mb-2"
                       type="button">
                        Post New Bike
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    </h2>
                </div>

        </h2>

        <div class="dropdown">
            <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sort-down fs-4 me-1" style="margin-left: 10px;"></i>
                <strong>Sort By</strong>
            </a>
            <ul class="dropdown-menu">
                <li>
{{--Thinking not to use a form  as we not doing post mthd            --}}
                        <a href="{{route('home')}}" type="submit" class="dropdown-item">Default Sorting</a>
                        <a href="{{route('home_sort_total_Reviews_desc')}}" type="submit" class="dropdown-item bi bi-sort-down">Most Reviews First</a>
                        <a href="{{route('home_sort_total_Reviews_asc')}}" type="submit" class="dropdown-item bi bi-sort-up">Least Reviews First</a>
                        <a href="{{route('home_sort_top_Reviews_desc')}}" type="submit" class="dropdown-item bi bi-sort-down">Top Rated First</a>
                        <a href="{{route('home_sort_top_Reviews_asc')}}" type="submit" class="dropdown-item bi bi-sort-up">Worst Rated First</a>
                </li>
            </ul>
        </div>

        @if(session('itsdeleted'))
            <div class=" h6 alert alert-primary alert text-light fade show border-bottom text-center" role="alert">
                Bicycle and its records deleted successfully
            </div>
        @endif
        @if(session('itisposted'))
            <div class=" h6 alert alert-primary alert fade show border-bottom text-center" role="alert">
                Bicycle posted!
            </div>
        @endif

        <div class="row row-cols-lg-3 g-5 py-5">
            @foreach($items as $bike)
                <div class="col" style="margin-bottom: 150px">
                    <div class="card card-cover h-100 m-2 text-bg-dark rounded-4"
                         style="background-image: url('./storage/{{$bike->bicycle_image}}'); position: relative;">
{{-- <img src="{{ asset('storage/' . $bike->bicycle_image) }}" alt="Bike Image">--}}
{{--   @dd($bike->bicycle_image)--}}

                        <a href="item-review-page/{{$bike->bicycle_id}}">
                            <div class="d-flex flex-column h-auto p-5 ">
                            </div>
                        </a>

{{-- have to use a form as this delete and edit use post methods--}}
                        <form method="POST" action="{{route('delete-this-bicycle', ['bicycle_id'=>$bike->bicycle_id])}}">
                            @csrf
                        <button class="btn btn-danger" type="submit" style="position: absolute; top: 10px; right: 10px;">
                            Delete
                            <i class="bi bi-trash"></i>
                        </button>
                        </form>

{{--                        <a href="{{route('delete-this-bicycle', ['bicycle_id'=>$bike->bicycle_id])}}" class="btn btn-primary mt-5" style="position: absolute; top: 10px; right: 10px;"--}}
{{--                                type="button">--}}
{{--                            Edit--}}
{{--                            <i class="bi bi-trash"></i>--}}
{{--                        </a>--}}

                    </div>
{{-- like here im using a as we only doing get--}}
                    <a href="{{route('item-review-page', ['bicycle_id'=>$bike->bicycle_id])}}" class="d-block text-decoration-none">
                        <h4 class="mt-3 fw-bold text-center text-light ">{{$bike->bicycle_name}}</h4>
                        <small class="fw-bold text-info px-2">Posted by: {{$bike->username}}</small>
                        <small class="fw-bold text-warning px-2">Total Reviews: {{$bike->bicycle_total_reviews}}</small>
                        <small class="fw-bold text-success">Average Rating: {{$bike->avg_of_ratings}}</small>

                    </a>
                    <ul class="d-flex list-unstyled mb-4 list-group border border-info">

                        <li><h6 class="text-center">{{$bike->bicycle_description}}</h6></li>
                    </ul>
                    {{--                    <h6 class="text-center" >{{$bike->bicycle_description}}</h6>--}}
                </div>
            @endforeach
        </div>
@endsection
