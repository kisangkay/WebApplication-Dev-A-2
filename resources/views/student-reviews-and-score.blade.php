@extends('layouts.menu-teacher')
@section('content')
    <div class="b-divider"></div>

    <div class="container" id="custom-cards">
        <h4 class="py-4 text-center">Student (Name) Reviews and Score for (Assessment name)</h4>

        <div class="row row-cols-1 row-cols-md-2 g-4">

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews Submitted</h4>
{{--                        <h4>Teachers of {{$items[0]->bicycle_description}}</h4>--}}
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> for (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> for (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> for (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> for (student name)</p></li>

                    </ul>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Reviews Received</h4>
                        {{--                        <h4>Teachers of {{$items[0]->bicycle_description}}</h4>--}}
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> by (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> by (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> by (student name)</p></li>
                        <li class="list-group-item"><p>A second itemdawdawd adwdaw<br>dawdwada<br> by (student name)</p></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4 card card mx-5 list-group-item list-group-item-info">
        <form method="post" action="{{route('create-new-bicycle')}}" class="m-auto" style="width:auto"
              enctype="multipart/form-data">
            @csrf


            <h4 class="text-center text-light my-2">Assessment Score</h4>
            <input type="number" class="form-control text-center w-100 my-2" placeholder="/100">
            <button class="btn btn-primary w-100 mb-4 bi bi-upload" type="submit"> Submit Score</button>

        </form>
    </div>



    <div class="b-divider"></div>
@endsection
