@extends('layouts.menu-teacher')
@section('content')

    @if(session('feedback'))
        <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
            {{ session('feedback') }}
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
        <h4 class="py-1 text-center border-bottom">Assessment Management</h4>

        <form method="post" action="{{route('update-assessment-details',['cid' => $cid, 'assesst_id' => $assesst_id])}}" class="m-auto" style="width:auto" enctype="multipart/form-data">
            @csrf
            <div class="form-group text-center">
                <label class="h6" for="instruction">Assessment Instructions</label>
                <textarea class="form-control mb-4" name="instruction" id="instruction" rows="7">{{$assesst_details->assessment_instruction}}</textarea>

                <div class="row">
                    <div class="col">
                        <label class="h4" for="duedate">Due Date</label>
                        <input class="form-control mb-4 border-success border-1 text-center" id="duedate" name="due_date" value="{{$assesst_details->due_date}}" type="datetime-local">
                    </div>

                    <div class="col">
                        <label class="h4" for="reviewsno">Reviews Required</label>
                        <input class="form-control border-success border-1 mb-4 text-center" id="reviewsno" name="reviews_required" value="{{$assesst_details->number_reviews_required}}" type="number">
                    </div>

                    <div class="col">
                        <label class="h4" for="maxscore">Maximum Score</label>
                        <input class="form-control border-success border-1 mb-4 text-center" id="maxscore" name="max_score" value="{{$assesst_details->max_score}}" type="number">
                    </div>

                    <div class="col">
                        <label for="pr_type" class="h4">Peer Review Type</label>
                        <select name="pr_assessment_type" class="custom-select custom-select-sm form-control border-success border-1 text-center" id="pr_type">
                            <option selected>{{$assesst_details->peer_review_type}}</option>
                            <option value="Student-Select">Student-Select</option>
                            <option value="Teacher-Assign">Teacher-Assign</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-center">
                @if($isthereanyreview)
                    <button class=" btn btn-secondary w-50 mb-4 bi bi-pen" type="submit" disabled> Submission Exists</button>
                @else
                    <button class=" btn btn-success w-50 mb-4 bi bi-upload" type="submit"> Update Assessment</button>
                @endif
            </div>
        </form>

        <div class="container d-flex justify-content-center">
            <a href="{{route('list-assessments',['cid' =>$cid, 'assesst_id' => $assesst_id])}}"
               class=" btn btn-primary w-50 mb-4 bi bi-pencil-square" type="submit"> Mark Enrolled Students</a>
        </div>

    </div>
@endsection
