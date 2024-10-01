@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
@section('content')
    <div class="b-divider"></div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Courses</li>
        </ol>
    </nav>
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
                                    <h5 class="card-title">Enrol/De-enroll a Registered Student</h5>
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
                <a href="{{route('assessment-details-page-teacher',['cid' =>$course->id, 'assesst_id' => $assessments->id])}}" class="list-group-item list-group-item-action list-group-item-dark">{{$assessments->assessment_name}}
                    <span class="text-success">Due: {{ \Carbon\Carbon::parse($assessments->due_date)->format('F j, Y, g:i A') }}</span>
                </a>
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
    </div>

@endsection
