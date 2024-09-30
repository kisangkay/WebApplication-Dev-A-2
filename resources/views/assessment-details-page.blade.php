@extends('layouts.menu-teacher')
@section('content')

    {{-- Restricted page access to super admin on the route --}}

    <div class="b-divider"></div>
    <div class="container ">
        <h2 class="py-4 text-center border-bottom">Week 1 Assessment Details Page</h2>
        <h5 class="py-1 text-center border-bottom">All Enrolled Students</h5>

        <div class="bd m-0 border-0">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Reviews Received</th>
                    <th>Reviews Submitted</th>
                    <th>Assessment Score</th>
                    <th>Reviews and Score</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allstudents as $students)
                    <tr>
                        <td class="col">{{ $students->id }}</td>
                        <td class="col">{{ $students->user_number }}</td>
                        <td class="col">{{ $students->fullname }}</td>
                        <td class="col">{{ $students->fullname }}</td>
                        <td class="col">{{ $students->email }}</td>
{{--                        <td class="col"><input type="number" class="form-control w-25 text-center" value="{{$students->score}}" disabled></td>--}}

                        {{--                                  @dd($allusrs['user']->id);--}}
                        <td class="col"><a href="{{route('student-reviews-and-score', ['cid' => $courseid, 'sid' => $students->id, 'assesst_id' => $assesst_id])}}"class="btn btn-primary">Reviews and Score</a>

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
