@extends('layouts.menu-teacher')
@section('content')
    <div class="b-divider"></div>

    {{--VALIDATION ERROR MESSAGE    --}}
    @if(session('validationerror'))
        <div class=" h6 alert alert-info border-bottom text-center" role="alert">
            {{ session('validationerror') }}
        </div>
    @endif
    <div class="container " id="custom-cards">
        <h2 class="py-4 text-center">Create a New Assessment</h2>

        <form method="post" action="" class="m-auto form-signin" style="width:auto"
              enctype="multipart/form-data">
            @csrf
            <h5 class="text-center ">Assessment Title</h5>
            <input name="assessment_title" type="text" placeholder="Assessment Title" class="mb-3 form-control"
                   style="height: auto;" >
            <h5 class="text-center mb-1">Assessment Instruction</h5>
            <textarea class="mb-4 form-control" rows="4" style="height: auto;" name="assessment_instruction" placeholder="Assessment Instruction"></textarea>

            <h5 class="text-center ">Number of reviews required: </h5>
            <input name="reviews_number" type="number" placeholder="Reviews Required" class="mb-3 form-control"
                   style="height: auto;">

            <h5 class="text-center ">Max Score: </h5>
            <input name="max_score" type="number" placeholder="Maximum Score out of 100" class="mb-3 form-control"
                   style="height: auto;" >

            <h5 class="text-center ">Due Date & Time: </h5>
            <input name="due_date_time" type="datetime-local" placeholder="Due Date and Time" class="mb-3 form-control"
                   style="height: auto;" >

            <div class="container mb-4">
                <h5 class="text-center">Peer Review Type</h5>
{{--                @foreach($all_manufacturers as $manufacturers)--}}
                    <div class="form-check">
                        <input class="form-check-input fs-4" type="radio" value="" name="type_student_select">
                        <label class="form-check-label" for="flexRadioDefault1">Student-Select</label>
                    </div>

                        <div class="form-check">
                        <input class="form-check-input fs-4" type="radio" value="" name="type_teacher_assign">
                        <label class="form-check-label" for="flexRadioDefault1">Teacher-Assign</label>
                        {{--                    just to show the manuf name above, but we pass the manuf id in the value--}}
                    </div>
{{--                @endforeach--}}
            </div>

{{--            <div class="container mb-4">--}}
{{--                <label>Bike Image</label>--}}
{{--                <input type="file" class="form-control" id="image" name="bike_image" accept="image/*" required>--}}
{{--            </div>--}}

            <button class="btn btn-primary w-100 mb-4 bi bi-upload" type="submit"> Post New Assessment</button>

        </form>


    </div>
    <div class="b-divider"></div>
@endsection
