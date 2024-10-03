@extends('layouts.menu-role-conditioned')
@section('content')
    <div class="b-divider"></div>
    <div class="container ">
        <h2 class="py-4 text-center border-bottom">All Registered Students</h2>
{{--in controller we getting by first() so no need to loop over one record--}}
        <h4 class="text-center border-bottom">Enroll A Registered Student to <span class="text-info">{{$this_course_name_for_header->course->course_name}}</span></h4>
        @if(session('feedback'))
            <div class=" h6 alert alert-warning border-bottom text-center text-light" role="alert">
                {{ session('feedback') }}
            </div>
        @endif

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url()->previous() }}">Courses Details Page</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Registered Student</li>
            </ol>
        </nav>



        <div class="bd m-0 border-0">
            <h6 class="text-center text-warning ">Enter Student ID to Manually Enroll a Student to this course</h6>

            <form method="post" action="{{route('enroll-student')}}">
                @csrf

                <div class="container w-50">

                    <div class="container d-flex justify-content-center w-50">
{{--  Student number should not be null on input validation --}}
                        <input name="student_id_to_add" id="student_id_to_add" class="form-control text-light" style="background-color: rgba(41,173,224,0.3)" type="number" placeholder="Student Number">
                        <button class="btn btn-primary bi bi-check-circle w-50 ms-3"> Enroll</button>
                    </div>
                    <input name="course_id" class="invisible" value="{{$cid}}">
                </div>
            </form>

            <div class="d-flex justify-content-center">
            <table class="table table-striped w-75">
                <thead>
                <tr>
                    <th class=" text-center">Student Number</th>
                    <th class="text-center">Full Name</th>
                    <th class="text-center">Student Email</th>
                </tr>
                </thead>
                <tbody>

                @foreach($all_users as $allusrs)
                    <tr>
                        <td class="col text-center">{{ $allusrs->user_number }}</td>
                        <td class="col text-center">{{ $allusrs->fullname }}</td>
                        <td class="col text-center">{{ $allusrs->email }}</td>

                    </tr>
                @endforeach


                </tbody>
            </table>
            </div>

        </div>

        <div class="container d-flex justify-content-center">
            {{$all_users->links()}}
        </div>
    </div>
@endsection
