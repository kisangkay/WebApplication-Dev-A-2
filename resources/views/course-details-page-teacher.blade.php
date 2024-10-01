@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')

@section('content')
    <div class="b-divider"></div>

    <div class="container py-5">
{{--        <div class="h2 px-2 text-center">Reviews for {{$items[0]->bicycle_name}}--}}
        <div class="text-center">
{{--            @dd($course->course_name);--}}
            <h2 class=" text-info mb-4">{{$course->course_name}} {{$course->course_code}} Course Page</h2>
{{--            <h1>{{ $course->course_code }}</h1>--}}
                    <div class="row  row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Teachers of {{$course->course_name}}</h4>
                                </div>

                                <ul class="list-group">
                                    @foreach($teachers as $teacher)
                                    <h6 class="list-group-item">{{$teacher->fullname}}</h6>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Enrol a Registered Student</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <a href="{{route('add_registered_student',[$course->id])}}" class="btn btn-primary" >Add Student</a>
                                </ul>
                            </div>
                        </div>
                </div>

<br><br>
            <ul class="list-group"><h3>Peer Review Assessments</h3>
                @foreach($assesstthiscourse as $assessments)
                <a href="{{route('assessment-details-page',['cid' =>$course->id, 'assesst_id' => $assessments->id])}}" class="list-group-item list-group-item-action list-group-item-dark">{{$assessments->assessment_name}}
                <span>{{$assessments->due_date}}</span></a>
                @endforeach
            </ul>
            <div class="text-center">
                <h2 class="text-center mt-3">
                    <a href="{{route('create-new-assessment',['cid' =>$course->id])}}"
                        class="btn btn-primary mb-2"
                       type="button">
                        Add New Assessment
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </h2>
            </div><br>
{{--            <h5 class="mb-4">Total Reviews: {{$items[0]->bicycle_total_reviews}}</h5>--}}

{{--            <h6 class="text-center text-warning mb-4">Description: {{$items[0]->bicycle_description}}</h6>--}}


{{--            @if ($reviews)--}}
{{--                @foreach($reviews as $review)--}}
{{--                    <div class="d-flex justify-content-center mb-4">--}}
{{--                        <div class="toast show" style="width: 60%">--}}
{{--                            <div class="toast-header">--}}
{{--                                <i class="bi bi-person-circle rounded me-2"></i>--}}
{{--                                <strong class="me-auto">Review By: {{$review->username}}</strong>--}}
{{--                                <div class="" style="margin-right: 250px">--}}
{{--                                    <strong>Rated: {{$review->rating}}/5</strong>--}}
{{--                                </div>--}}

{{--                                <strong class="m-2">{{ date('d-m-Y', strtotime($review->review_date)) }}</strong>--}}
{{--                            </div>--}}
{{--                            <div class="toast-body">--}}
{{--                                --}}{{--FLAG                                --}}
{{--                                {{$review->review_text}}--}}

{{--                                --}}{{-- Using session to disable flag button if submitted                               --}}
{{--                                --}}{{--                                @dd(session('flag'))--}}
{{--                                @if(session('flag') == $review->review_id)--}}
{{--                                    <form method="post"--}}
{{--                                          action="{{ route('flag-review', ['review_id' => $review->review_id])}}">--}}
{{--                                        @csrf--}}
{{--                                        <button class="btn btn-warning d-flex float-end bi bi-flag-fill text-danger"--}}
{{--                                                type="submit" disabled>{{$review->totalflagsforthisreview}}</button>--}}
{{--                                    </form>--}}
{{--                                    --}}{{-- FLAG                                   --}}
{{--                                @elseif(!session('flag') != $review->review_id)--}}
{{--                                    <form method="post"--}}
{{--                                          action="{{ route('flag-review', ['review_id' => $review->review_id])}}">--}}
{{--                                        @csrf--}}
{{--                                        <button class="btn btn-warning d-flex float-end bi bi-flag-fill text-danger"--}}
{{--                                                title="This review has been flagged {{$review->totalflagsforthisreview}} times"--}}
{{--                                                type="submit">{{$review->totalflagsforthisreview}}</button>--}}
{{--                                    </form>--}}
{{--                                @elseif(!session('flag'))--}}
{{--                                    <form method="post"--}}
{{--                                          action="{{ route('flag-review', ['review_id' => $review->review_id])}}">--}}
{{--                                        @csrf--}}
{{--                                        <button class="btn btn-warning d-flex float-end bi bi-flag-fill text-danger"--}}
{{--                                                title="This review has been flagged {{$review->totalflagsforthisreview}} times"--}}
{{--                                                type="submit">{{$review->totalflagsforthisreview}}</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--                @if($hasareview)--}}
{{--                    --}}{{--                    difference between these 2 is becuse I used view->with and redirect method -> with for hasedited--}}
{{--                    @if(session('hasedited'))--}}
{{--                        <div class=" h6 alert alert-success text-light alert fade show border-bottom text-center"--}}
{{--                             role="alert">--}}
{{--                            Edit Applied--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="h6 alert alert-warning text-light alert fade show border-bottom text-center"--}}
{{--                             role="alert">--}}
{{--                            You already reviewed this item--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                @else--}}
{{--                    <div class=" h6 alert alert-light alert fade show border-bottom text-center" role="alert">--}}
{{--                        You haven't reviewed this item yet--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                <div class=" h6 alert alert-light alert fade show border-bottom text-center" role="alert">--}}
{{--                    No reviews yet, be the first to leave a review--}}
{{--                </div>--}}
{{--            @endif--}}


{{--        </div>--}}
{{--        --}}{{-- {{$items[0]->bicycle_id}} i pass this id into the add review page to use the bicycle id as foreign key--}}
{{--        --}}{{-- so then we pass the bike id into the url as an associative array--}}

{{--        --}}{{--TO UPDATE YOUR REVIEW        --}}
{{--        @if($hasareview)--}}
{{--            <form method="post"--}}
{{--                  action="{{ route('item-review-update-action', ['bicycle_id' => $items[0]->bicycle_id])}}"--}}
{{--                  class="m-auto form-signin" style="width:auto">--}}
{{--                @csrf--}}
{{--                <h5 class="text-center">You can only edit your current review</h5>--}}
{{--                <textarea class="mb-4 form-control" rows="4" style="height:--}}
{{--                 auto;" name="new-review-text">{{$reviewtext_for_you[0]->review_text}}</textarea>--}}
{{--                <p class="text-center">Select your range out of 5</p>--}}
{{--                <input type="range" name="new-rating-range" class="form-range mb-5" value="{{$reviews[0]->rating}}"--}}
{{--                       min="1" max="5" required>--}}
{{--                <button class="btn btn-primary w-100  bi bi-pen" type="submit"> Edit</button>--}}
{{--            </form>--}}
{{--            --}}{{--to delete your review--}}
{{--            <form method="post" action="{{ route('delete-review', ['bicycle_id' => $items[0]->bicycle_id])}}"--}}
{{--                  class="m-auto w-25" style="width:auto">--}}
{{--                @csrf--}}
{{--                <button class="btn btn-danger bi bi-trash w-100 mb-4" type="submit"> Delete your review</button>--}}
{{--            </form>--}}
{{--        @else--}}
{{--            --}}{{--now we have different forms for those with already a review record and those without--}}


{{--            --}}{{--to post your review--}}
{{--            <form method="post" action="{{ route('item-review-page', ['bicycle_id' => $items[0]->bicycle_id])}}"--}}
{{--                  class="m-auto form-signin" style="width:auto">--}}
{{--                @csrf--}}
{{--                <h5 class="text-center">Please enter your review</h5>--}}
{{--                <textarea class="mb-4 form-control" rows="4" style="height: auto;" name="review-text"></textarea>--}}
{{--                <p class="text-center">Select your range out of 5</p>--}}
{{--                <input type="range" name="rating-range" value="5" class="form-range mb-5" min="1" max="5">--}}
{{--                <button class="btn btn-primary w-100 mb-4" type="submit">submit</button>--}}
{{--                @endif--}}
{{--            </form>--}}


    </div>

@endsection
