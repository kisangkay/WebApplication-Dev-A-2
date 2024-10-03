@extends('layouts.menu-role-conditioned')
@section('content')
    <div class="b-divider"></div>

    {{--VALIDATION ERROR MESSAGE    --}}
    @if(session('feedback'))
        <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
            {{ session('feedback') }}
        </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url()->previous() }}">Courses Details Page</a></li>
            <li class="breadcrumb-item active" aria-current="page">Courses</li>
        </ol>
    </nav>

    <div class="container " id="custom-cards">
        <h2 class="py-4 text-center">Create a New Assessment for <span class="text-info">{{$nameofthiscourse}}</span></h2>

        <form method="post" action="{{route('post-new-assessment',['cid' => $cid])}}" class="m-auto form-signin" style="width:auto"
              enctype="multipart/form-data">
            @csrf
            <h5 class="text-center ">Assessment Title</h5>
            <input value="{{old('assessment_title')}}" name="assessment_title" type="text" placeholder="Assessment Title" class="mb-3 form-control"
                   style="height: auto;" >
            <x-input-error :messages="$errors->get('assessment_title')"/>

            <h5 class="text-center mb-1">Assessment Instruction</h5>
            <textarea value="{{old('assessment_instruction')}}" class="mb-4 form-control" rows="4" style="height: auto;" name="assessment_instruction" placeholder="Assessment Instruction"></textarea>
            <x-input-error :messages="$errors->get('assessment_instruction')"/>

            <h5 class="text-center ">Number of reviews required: </h5>
            <input value="{{old('number_of_reviews')}}" name="number_of_reviews" type="number" placeholder="Reviews Required" class="mb-3 form-control"
                   style="height: auto;">
            <x-input-error :messages="$errors->get('number_of_reviews')"/>

            <h5 class="text-center ">Max Score: </h5>
            <input value="{{old('maximum_score')}}" name="maximum_score" type="number" placeholder="Maximum Score out of 100" class="mb-3 form-control"
                   style="height: auto;" >
            <x-input-error :messages="$errors->get('maximum_score')"/>

            <h5 class="text-center ">Due Date & Time: </h5>
            <input value="{{old('v')}}" name="due_date_and_time" type="datetime-local" placeholder="Due Date and Time" class="mb-3 form-control"
                   style="height: auto;" >
            <x-input-error :messages="$errors->get('due_date_and_time')"/>

            <div class="container mb-4">
                <h5 class="text-center">Peer Review Type</h5>
                <div class="form-check">
                    <input class="form-check-input fs-4" type="radio" name="assessment_type" id="type_student_selec" value="Student-Select" checked>
                    <label class="form-check-label" for="type_student_selec">Student-Select</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input fs-4" type="radio" name="assessment_type" id="type_teacher_assig" value="Teacher-Assign">
                    <label class="form-check-label" for="type_teacher_assig">Teacher-Assign</label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('assessment_type')"/>

            <button class="btn btn-primary w-100 mb-4 bi bi-upload" type="submit"> Post New Assessment</button>

        </form>


    </div>
    <div class="b-divider"></div>
@endsection
