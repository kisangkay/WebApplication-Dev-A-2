@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
@section('content')
    <div class="b-divider"></div>
    <div class="container" id="custom-cards">
        <div class="card">
            <div class="card-header">
{{--if couse posted--}}
                @if(session('feedback'))
                    <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
                        {{ session('feedback') }}
                    </div>
                @endif
                <h4 class="text-center">Student Reviews and Score</h4>
            </div>
            <ul class="list-group">
                <h6 class="list-group-item text-center">Student Name: <span class="text-warning fw-bold">{{$reviewer_all_data->fullname}}</span></h6>
                <h6 class="list-group-item text-center">Assessment Name: <span class="text-warning fw-bold">{{$assessment_data->assessment_name}}</span></h6>
                <h6 class="list-group-item text-center">Student Number: <span class="text-warning fw-bold">{{$reviewer_all_data->user_number}}</span></h6>
            </ul>
        </div>
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

        @if($assessment_score)
        <form method="post" action="{{route('update-assessment-score',['cid' => $cid, 'assesst_id' => $assesst_id,'sid' => $sid])}}" class="m-auto" style="width:auto" enctype="multipart/form-data">
            @csrf
            @else
                <form method="post" action="{{route('post-assessment-score',['cid' => $cid, 'assesst_id' => $assesst_id,'sid' => $sid])}}" class="m-auto" style="width:auto" enctype="multipart/form-data">
                    @csrf
            @endif

            <h4 class="text-center text-light my-2">Assessment Score for {{$reviewer_all_data->fullname}}</h4>
            <input type="number" class="form-control text-center w-100 my-2" name="score" placeholder="/100" value="{{ optional($assessment_score)->score }}">

            @if($assessment_score)
                <button class="btn btn-warning w-100 mb-4 bi bi-upload" type="submit"> Edit Score</button>
            @else
            <button class="btn btn-success w-100 mb-4 bi bi-upload" type="submit"> Submit Score</button>
            @endif

        </form>
    </div>



    <div class="b-divider"></div>
@endsection
