@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
@section('content')

    @if(session('feedback'))
        <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
            {{ session('feedback') }}
        </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="#" onclick="history.back();">Courses Details Page</a></li>
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
                <label class="h4" for="instruction">Assessment Instructions</label>
                <textarea class="form-control mb-4" name="instruction" id="instruction" rows="7">{{$assesst_details->assessment_instruction}}</textarea>

                <div class="row">
                    <div class="col">
                        <label class="h4" for="duedate">Due Date</label>
                        <input class="form-control mb-4 border-success border-1 text-center" id="duedate" name="due_date" value="{{$assesst_details->due_date}}" type="datetime-local">
                    </div>

                    <div class="col">
                        <label class="h4" for="reviewsno">Number of Reviews Required</label>
                        <input class="form-control border-success border-1 mb-4 text-center" id="reviewsno" name="reviews_required" value="{{$assesst_details->number_reviews_required}}" type="number">
                    </div>

                    <div class="col">
                        <label class="h4" for="maxscore">Maximum Score</label>
                        <input class="form-control border-success border-1 mb-4 text-center" id="maxscore" name="max_score" value="{{$assesst_details->max_score}}" type="number">
                    </div>
                </div>
            </div>

                <div class="d-flex justify-content-center">
                    @if($isthereanyreview)
                        <button class=" btn btn-secondary w-50 mb-4 bi bi-pen" type="submit" disabled> Submission Exists</button>
                    @else
                        <button class=" btn btn-success w-50 mb-4 bi bi-pen" type="submit"> Edit Assessment</button>
                    @endif
                </div>
        </form>

        <h4 class="py-1 text-center border-bottom">All Enrolled Students</h4>

        <div class="bd m-0 border-0">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Entry ID</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reviews Submitted</th>
                    <th>Reviews Received</th>
                    <th>Assessment Score</th>
                    <th>Reviews and Score</th>
                </tr>
                </thead>
                <tbody>

                {{--                @foreach($allstudents as $students)--}}
                @foreach ($groupedResults as $user_number => $data)
                    <tr>
                        <td class="col">{{ $data['user']->id }}</td>
                        <td class="col">{{ $data['user']->user_number }}</td>
                        <td class="col">{{ $data['user']->fullname }}</td>
                        <td class="col">{{ $data['user']->email }}</td>
                        <td class="col">{{$data['review_submitted_count'] }}</td>
                        <td class="col">{{$data['review_received_count'] }}</td>


                        <td class="col justify-content-center"><input class="form-control text-center" value="@foreach ($data['scores'] as $score){{ $score->score }}@endforeach" disabled placeholder="/100"></td>


                        <td class="col d-flex justify-content-center"><a href="{{route('student-reviews-and-score', ['cid' => $cid, 'sid' => $data['user']->user_number, 'assesst_id' => $assesst_id])}}"class="btn btn-primary">Reviews and Score</a>
                        </td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <nav class="d-flex justify-content-center">
            <ul class="pagination pagination-lg flex-wrap">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
