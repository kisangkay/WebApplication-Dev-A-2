@extends('layouts.menu-role-conditioned')

@section('content')
    <div class="b-divider"></div>
    <div class="container ">
        <h2 class="py-4 text-center border-bottom">Top Reviewers All Courses</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url()->previous() }}">Course Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Top Reviewers</li>
            </ol>
        </nav>


        <div class="bd m-0 border-0">
            <h6 class="text-center text-info">Strive to be among the best in providing useful peer reviews for
                students</h6>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Student Number</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Average Rating</th>
                </tr>
                </thead>

                <tbody>
                @foreach($top_reviewers as $top_reviewer)
                    <tr>
                        <td class="col text-center">{{ $top_reviewer->reviewer_user_number }}</td>
                        {{--fullname from the users model--}}
                        <td class="col text-center">{{ $top_reviewer->reviewer->fullname }}</td>
                        {{--from the review model--}}
{{--                        @dd((float)$top_reviewer->average_rating)--}}
                        <td class="col text-center">{{ number_format((float)$top_reviewer->average_rating ,1)}}</td>
{{--                        To round off to 1 dp--}}
                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>


    </div>
@endsection
