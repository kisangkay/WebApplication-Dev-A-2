@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
@section('content')

    @if(session('feedback'))
        <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
            {{ session('feedback') }}
        </div>
    @elseif(session('feedback_error'))
        <div class=" h6 alert alert-danger border-bottom text-center text-light" role="alert">
            {{ session('feedback_error') }}
        </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url()->previous() }}">Courses Details Page</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assessment Details Page</li>
        </ol>
    </nav>


    <div class="b-divider"></div>
    <div class="container ">
        <h4 class="py-4 text-center border-bottom">Assessment: <span class="text-success">{{$assesst_details->assessment_name}}</span> Details Page</h4>
        <h4 class="py-1 text-center border-bottom">Assessment Peer Review Submission</h4>

        <div class="form-group text-center">
            <label class="h4" for="instruction">Assessment Instructions</label>
            <textarea class="form-control mb-4" name="instruction" id="instruction" rows="7" readonly>{{$assesst_details->assessment_instruction}}</textarea>

            <div class="row">
                <div class="col">
                    <label class="h5" for="duedate">Due Date and Time</label>
                    <span class="form-control mb-4 border-success border-1" id="duedate">Due: {{ \Carbon\Carbon::parse($assesst_details->due_date)->format('F j, Y, g:i A') }}</span>

                </div>
                <div class="col">
                    <label class="h5" for="reviewsno">Number of Reviews Required</label>
                    <input class="form-control border-success border-1 mb-4 text-center" id="reviewsno" name="reviews_required" value="{{$assesst_details->number_reviews_required}}" type="number" readonly>

                </div>
                <div class="col">
                    <label class="h5" for="maxscore">Maximum Score</label>
                    <input class="form-control border-success border-1 mb-4 text-center" id="maxscore" name="max_score" value="{{$assesst_details->max_score}}" type="number" readonly>

                </div>
            </div>
        </div>

        {{--  Submission--}}
        <div class="container col-lg-8">

            <form method="post" action="{{route('post-review',['cid' => $cid, 'assesst_id' => $assesst_id])}}" class="m-auto" style="width:auto" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h4 class="text-center" for="instruction">Submit A peer review</h4>
                    <h6 class="text-center text-warning">You have submitted {{$my_total_reviews}} Reviews out of {{$assesst_details->number_reviews_required}}</h6>


                    <div class="d-flex justify-content-center">
                        <select name="reviewee_user_number" class="custom-select custom-select-sm form-control w-50 my-4 text-center">
                            <option selected>Select Student Reviewee</option>

                            @foreach($students_and_course_inthiscourse as $student)
                                <option value="{{ $student->user->user_number }}">{{ $student->user->fullname }} - sNumber: {{ $student->user->user_number }}</span></option>
                            @endforeach
                        </select>
                    </div>

                    <label class="h4" for="reviewtext">Review ATLEAST5WORDS</label>
                    <textarea class="form-control mb-4" name="review_text" id="reviewtext" rows="7" placeholder="Your review here"></textarea>
                </div>

                <div class="d-flex justify-content-center">
                    @if($my_total_reviews>=$assesst_details->number_reviews_required)
                        <button class=" btn btn-danger w-50 mb-4 bi bi-pen" type="submit" disabled> Reached Required Submissions</button>
                    @else
                        <button class=" btn btn-success w-50 mb-4 bi bi-pen" type="submit"> Submit Review</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- REVIEWS YOU HAVE BEEN GIVEN/RECEIVED   --}}
    <div class="b-divider"></div>

    <div class="container my-4 form-group">

        <h4 class="text-center" for="instruction">Reviews you have been Given</h4>

        @foreach($myreviews as $individual_review)

            <div class=" text-center d-flex justify-content-center">
                <a class="w-50 list-group list-group-item list-group-item-action list-group-item-info text-light" style="background-color: #087990">
                    Review from {{$individual_review->reviewer->fullname}}</a>
            </div>

            <textarea class="form-control mb-4 border-info" name="review_text" id="reviewtext" rows="7" placeholder="Your review here" readonly>
                {{$individual_review->review_submitted}}
            </textarea>
{{--RATE THIS REVIEWER SLIDER--}}
            <p class="h5 text-center text-warning">Rate this Review in Terms of its Usefulness</p>

{{--SUBMIT RATING RATE THIS REVIEWER SLIDER--}}
            <form method="post" action="{{route('post-edit-reviewer-rating',['cid' => $cid, 'assesst_id' => $assesst_id])}}" class="m-auto" enctype="multipart/form-data">

                @csrf
{{--Reviewee Rates Here--}}
{{--                @dd($individual_review->reviewee_rated)--}}
                <div class="container d-flex justify-content-center">
                    <input type="range" name="reviewee_is_rating_as" class="form-range mt-4 w-50" value="{{$individual_review->reviewee_rated}}"
                           min="1" max="5" id="range">
                </div>
{{--HIDDEN INPUT TO PASS REVIEWER_ID TO FORM FOR SUBMISSION TO DB --}}
                <input class="invisible" value="{{$individual_review->reviewer->user_number}}" name="reviewer_id">
{{--LOCATION HAS TO MATCH REVIEWER_ID REVIEWEE_ID ASSESST_ID AND COURSE_ID --}}
                <div class="container d-flex justify-content-center">
                    <button class="btn btn-success bi bi-upload mb-4" type="submit"> Submit Rating</button>
                </div>
            </form>
        @endforeach
    </div>


    <style>
        .custom-select {
            background-color: #135626; /* Default background */
            color: white; /* Default text color */
            font-weight: bold;
        }
    </style>
@endsection
