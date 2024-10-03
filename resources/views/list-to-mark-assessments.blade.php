@extends('layouts.menu-role-conditioned')
@section('content')

    @if(session('feedback'))
        <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
            {{ session('feedback') }}
        </div>
    @endif

{{--    @dd($groupedResults)--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('courses') }}">Courses Details Page</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assessment Details Page</li>
        </ol>
    </nav>

    <div class="b-divider"></div>

    <div class="container">
        <h4 class="py-1 text-center border-bottom">Mark All Enrolled Students</h4>
        <h5 class="py-1 text-center border-bottom">Assessment: <span class="text-success">{{$assesst_details->assessment_name}}</span></h5>

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
                @foreach ($groupedResults as $user_data)
                    <tr>
                        <td class="col">{{ $user_data['user']->id}}</td>
                        <td class="col">{{ $user_data['user']->user_number }}</td>
                        <td class="col">{{ $user_data['user']->fullname }}</td>
                        <td class="col">{{ $user_data['user']->email }}</td>
                        <td class="col">{{ $user_data->review_submitted_count }}</td> <!-- Review submitted count -->
                        <td class="col">{{ $user_data->review_received_count }}</td> <!-- Review received count -->

                        <td class="col justify-content-center"><input class="form-control text-center" value="@foreach ($user_data['user']['assessmentScores'] as $scores) {{ $scores->score }}@endforeach" disabled placeholder="/100"></td>

                        <td class="col d-flex justify-content-center">
                            <a href="{{route('student-reviews-and-score', ['cid' => $cid, 'sid' => $user_data['user']->user_number, 'assesst_id' => $assesst_id])}}"class="btn btn-primary">Reviews and Score</a>
                        </td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="container d-flex justify-content-center">
            {{$groupedResults->links()}}
        </div>
    </div>
@endsection
