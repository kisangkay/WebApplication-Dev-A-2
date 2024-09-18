@extends('layouts.menu-logged-in')
@section('content')
    <div class="b-divider"></div>

{{--VALIDATION ERROR MESSAGE    --}}
    @if(session('validationerror'))
        <div class=" h6 alert alert-info border-bottom text-center" role="alert">
            {{ session('validationerror') }}
        </div>
    @endif
    <div class="container " id="custom-cards">
        <h2 class="py-4 text-center">Add a new Bicycle</h2>

        <form method="post" action="{{route('create-new-bicycle')}}" class="m-auto form-signin" style="width:auto"  enctype="multipart/form-data">
            @csrf
            <h5 class="">Bicycle Name</h5>
            <input  name="bicycle_name" type="text" placeholder="Bicycle name" class="mb-4 form-control" style="height: auto;" required>

            <div class="container mb-4">
            <h5 class="text-center">Select the manufacturer</h5>
            @foreach($all_manufacturers as $manufacturers)
                <div class="form-check">
                    <input class="form-check-input fs-4" type="radio"  value="{{ $manufacturers->manufacturer_id}}" name="manufacturerid" required>
                    <label class="form-check-label" for="flexRadioDefault1">{{$manufacturers->manufacturer_name}}</label>
{{--                    just to show the manuf name above, but we pass the manuf id in the value--}}
                </div>
            @endforeach
            </div>

            <div class="container mb-4">
            <label>Bike Image</label>
            <input type="file" class="form-control" id="image" name="bike_image" accept="image/*" required>
            </div>

            <p class="text-center">Bicycle Description</p>
            <textarea class="mb-4 form-control" rows="4" style="height: auto;" name="bike_description" required></textarea>

            <button class="btn btn-primary w-100 mb-4 bi bi-upload" type="submit"> Post new Bicycle</button>

        </form>


    </div>
    <div class="b-divider"></div>
@endsection
