@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
{{--used ternary operator for my if statement as @if wont work with extends condition ? value_if_true : value_if_false;--}}

@section('content')
    <div class="b-divider"></div>

    <div class="container px-4 py-2" id="custom-cards">
        <h2 class="text-center">{{$whichrole}}</h2>

        <div class="row row-cols-lg-3 g-5 py-5">
            @foreach($courses_for_this_user as $course)
                <div class="col">
                    <div class="card card-cover h-50 m-2 text-bg-dark rounded-4"
                         style="background-image: url('./storage/{{$course->course_image}}'); position: relative;">
                            @if(auth()->user()->user_role === 'teacher')
                                <a href="{{route('courses_teacher',[$course->id],'courses_teacher')}}">
                            @else
                                <a href="{{route('courses_student',[$course->id],'courses_student')}}">
                                    @endif
                            <div class="d-flex flex-column h-auto p-5 ">
                            </div>
                        </a>
                    </div>

                        <ul class="w-50 mx-auto list-unstyled list-group border border-light">
                            <li>
                                <h6 class="text-center text-light m-1">Course Code: {{$course->course_code}}</h6>
                            </li>
                        </ul>
                        <h5 class="mt-1 fw-medium text-light text-center">Course Name: {{$course->course_name}}</h5>

                        <div class="text-center">
{{--                            <small class="fw-bold text-info px-2">Assessments: {{$course->bicycle_total_reviews}}</small>--}}
{{--                            <small class="fw-bold text-success px-2">Total Teachers: {{$course->xxxx}}</small>--}}
{{--                            <small class="fw-bold text-warning px-2">Total Students: {{$course->xxx}}</small>--}}
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
@endsection
