@extends('layouts.menu-role-conditioned')
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
        <h4 class="py-1 text-center border-bottom">Peer Review Assessment Instructions</h4>

        <div class="form-group ">
            <label class="" for="instruction">Assessment Instructions</label>
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
                {{--I create a HIDDEN INPUT TO PASS THE NUMBER OF REVIEWS REQUIRED TO THE FORM SO IT CAN LOOP THE CREATE ELOQUENT --}}
                <input class="invisible" name="number_of_reviews_required" value="{{$assesst_details->number_reviews_required}}">
                <div class="form-group">
                    <h4 class="text-center" for="instruction">Submit A peer review</h4>
                    <h6 class="text-center text-warning">You have submitted {{$my_total_reviews}} Reviews out of {{$assesst_details->number_reviews_required}}</h6>

                    {{--if my total reviews is less than number_reviews_required--}}
                    @php
                        //                    $my_total_reviews is 0 because i havent made any review hence i am not filling the review forms
                                                $total_reviews_different_name_so_submit_button_wont_disable = $my_total_reviews; //so incrementor value from db to show input fields x times
                    @endphp
                    @while($total_reviews_different_name_so_submit_button_wont_disable != $assesst_details->number_reviews_required)

                        {{--I LOOP THIS FORM ACCORDING TO THE NUMBER OF REVIEWS REQUIRED FOR THIS ASSESSMENT --}}
                        {{--I ALSO SHOULD LOOP IN THE CREATE ELOQUENT --}}
                        <div class="d-flex justify-content-center">
                            {{--                            @dd($total_reviews_different_name_so_submit_button_wont_disable)--}}
                            {{--Thinking of using 0 then increment to match the number of reviews required. this way we can validate if a student was selected for this review field x--}}
                            <select name="reviewee_user_number[]" class="custom-select custom-select-sm form-control w-50 my-4 text-center">

                                @foreach($students_and_course_inthiscourse as $student)
                                    <option value="{{$student->user->user_number }}">{{ $student->user->fullname }} - sNumber: {{ $student->user->user_number }}</span></option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('reviewee_user_number[]')"/>

                        <div class="container w-75">
                            <label class="h4" for="reviewtext">Review Text</label>
                            {{-- will look like review_text0 --}}
                            {{-- will look like review_text1 --}}
                            <textarea class="form-control mb-4" name="review_text{{$total_reviews_different_name_so_submit_button_wont_disable}}" id="reviewtext"rows="7" placeholder="Your review here">{{ old('review_text' . $total_reviews_different_name_so_submit_button_wont_disable) }}</textarea>
                            <x-input-error :messages="$errors->get('review_text'.$total_reviews_different_name_so_submit_button_wont_disable)"/>
{{--                                                    @dd("review_text{$total_reviews_different_name_so_submit_button_wont_disable}[]");--}}
                        </div>
                        @php
                            $total_reviews_different_name_so_submit_button_wont_disable ++;
                        @endphp
                </div>
                {{--END OF LOOP THIS FORM ACCORDING TO THE NUMBER OF REVIEWS REQUIRED FOR THIS ASSESSMENT--}}
                @endwhile

                <div class="d-flex justify-content-center">
                    @if($my_total_reviews>=$assesst_details->number_reviews_required)
                        <button class=" btn btn-danger w-50 mb-4 bi bi-pen" type="submit" disabled> Reached Required Submissions</button>
                    @else
                        <button class=" btn btn-info w-25 mb-4 bi bi-pen" type="submit"> Submit Review</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{--    CREATING A TWO COLUMN FOR REVIEWS GIVEN VS REVIEWS RECEIVED--}}
    <div class="container">
        <div class="row row-cols-md-2 g-4">
            <div class="col px-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews <span class="text-warning">Received</span> for this assessment</h4>
                    </div>

                    {{-- REVIEWS YOU HAVE BEEN GIVEN/RECEIVED   --}}
                    <div class="b-divider"></div>

                    <form class="container my-4 form-group">

                        @foreach($my_received_reviews as $individual_review)

                            <div class=" text-center d-flex justify-content-center">
                                <a class="w-50 list-group list-group-item list-group-item-action list-group-item-success text-light" style="background-color: #198754">
                                    Reviewer: {{$individual_review->reviewer->fullname}}</a>
                            </div>

                            <textarea class="form-control mb-4 border-success" name="review_text" id="reviewtext" rows="7" placeholder="Your review here" readonly>
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
                                    <button class="btn btn-primary bi bi-upload mb-4" type="submit"> Submit Rating</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>

            {{--SECOND COLUMN FOR REVIEWS GIVEN--}}
            <div class="col px-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews You <span class="text-warning">Posted</span> for this Assessment</h4>
                    </div>

                    {{-- REVIEWS YOU HAVE GIVEN   --}}
                    <div class="b-divider"></div>

                    <div class="container my-4 form-group">

                        @foreach($my_given_reviews as $individual_review)

                            <div class=" text-center d-flex justify-content-center">
                                <a class="w-50 list-group list-group-item list-group-item-action list-group-item-success text-light" style="background-color: #198754">
                                    Reviewer (You): {{$individual_review->reviewer->fullname}}</a>
                                {{--Reviewee in $individual_review->reviewee->fullname is from the reviewee method in the controller derived from the medthod in the model that declares the relationship--}}
                                <a class="w-50 list-group list-group-item list-group-item-action list-group-item-success text-light" style="background-color: #dc3545">
                                    Reviewee : {{$individual_review->reviewee->fullname}}</a>
                            </div>

                            <textarea class="form-control mb-4 border-success" name="review_text" id="reviewtext" rows="7" placeholder="Your review here" readonly>
                {{$individual_review->review_submitted}}
            </textarea>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        {{--        SOME STYLING FOR THE DROPDOWN COLORS --}}
        .custom-select {
            background-color: #135626; /* Default background */
            color: white; /* Default text color */
            font-weight: bold;
        }
    </style>
@endsection
