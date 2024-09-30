@extends('layouts.menu-teacher')
@section('content')
    <div class="b-divider"></div>

    <div class="container px-4 py-5" id="custom-cards">
        <h2 class="text-center">All Manufacturers </h2>

        <div class="border-bottom d-flex justify-content-center pb-4">
            <label class="btn btn-primary ">Total {{$totalmanufs[0]->countofmanufacturers}} Manufacturers</label>
        </div>


        {{--All manufacturers and some buttons inside them            --}}
        <div class="row row-cols-lg-3  g-4 py-5">
            @foreach($allmanufacturers as $manufacturer)
                {{--                    @dd($manufacturer->manufacturer_id);--}}
                <div class="col">
                    <div class="card card-cover text-bg-dark rounded-4"
                         style=" height: 300px;background-image: url('./images/manufacturer.png'); position: relative;">

                        {{--No need to use a form for the link as we are doing get--}}
                        <a class="btn btn-success"
                           href="{{route('to_manufacturer_specific_page_action', ['manufacturer_id'=>$manufacturer->manufacturer_id, 'manufacturer_name'=> $manufacturer->manufacturer_name])}}"
                           style="position: absolute; top: 10px; right: 10px;"
                           type="button">
                            All their Bicycles
                            <i class="bi bi-shop-window"></i>
                        </a>
                    </div>

                    <a class="d-block text-decoration-none">
                        <h4 class="mt-2 fw-bold text-center text-info">
                            <img src="./images/manufacturer.png" width="36" height="32"
                                 class="rounded-circle border border-danger">{{$manufacturer->manufacturer_name}}</h4>
                    </a>
                    <ul class="mt-3 list-group border border-info">
                        <li class="d-flex justify-content-center text-warning list-group-item"><strong maxlength="2">Average
                                Rating: {{$manufacturer->average}}</strong></li>
                        {{--                            <li class="d-flex justify-content-center text-warning list-group-item"><strong>Sum of Rating: {{$manufacturer->sumofratings}}</strong></li>--}}
                        <li class="d-flex justify-content-center list-group-item"><strong class="list-unstyled">Total
                                Reviews: {{$manufacturer->manufacturer_total_reviews}}</strong></li>
                        <li class="d-flex justify-content-center list-group-item"><small>Year
                                Established {{$manufacturer->manufacturer_year_established}}</small></li>
                        <li class="d-flex justify-content-center list-group-item"><small class="text-center">Headquarters: {{$manufacturer->manufacturer_headquarters}}</small>
                        </li>
                    </ul>
                </div>
            @endforeach
            {{-- END OF ALL MANUFACTURERS               --}}
        </div>
    </div>

@endsection
