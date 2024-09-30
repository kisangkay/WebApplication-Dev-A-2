@extends('layouts.menu-teacher')
@section('content')
    <div class="b-divider"></div>
    <div class="container" id="custom-cards">
        <h4 class="py-4 text-center">Student Reviews for {{$reviewer_all_data->fullname}} and Score for {{$assessment_data->assessment_name}} Assessment</h4>
        <div class="row row-cols-1 row-cols-md-2 g-4">

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews Submitted</h4>
                    </div>

                    <ul class="list-group">
                        @foreach($reviewssubmitted as $reviewsubmitted)
                        <li class="list-group-item"><p>{{$reviewsubmitted->review_submitted}}</p></li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews Received</h4>
                    </div>

                    <ul class="list-group">
                        @foreach($reviewsreceived as $reviewreceived)
                            <li class="list-group-item"><p>{{$reviewreceived->review_submitted}}</p></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4 card card mx-5 list-group-item list-group-item-info">
        <form method="post" action="{{route('create-new-bicycle')}}" class="m-auto" style="width:auto"
              enctype="multipart/form-data">
            @csrf

            <h4 class="text-center text-light my-2">Assessment Score for {{$reviewer_all_data->fullname}}</h4>
            <input type="number" class="form-control text-center w-100 my-2" placeholder="/100" value="{{$assessment_score->score}}">
            <button class="btn btn-primary w-100 mb-4 bi bi-upload" type="submit"> Submit Score</button>

        </form>
    </div>



    <div class="b-divider"></div>
@endsection
