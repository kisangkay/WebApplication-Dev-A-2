@extends(auth()->user()->user_role === 'teacher' ? 'layouts.menu-teacher' : 'layouts.menu-student')
@section('content')

    {{-- Restricted page access to super admin on the route --}}

    <div class="b-divider"></div>
    <div class="container ">
        <h2 class="py-4 text-center border-bottom">All Registered Students</h2>
        @if(session('feedback'))
            <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
                {{ session('feedback') }}
            </div>
        @endif

        <div class="bd m-0 border-0">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-sm-1 text-center">Student Number</th>
                    <th class="text-center">Full Name</th>
                    <th class="text-center">Student Email</th>
                    <th>De-Enroll</th>
                    <th>Enroll</th>
                </tr>
                </thead>
                <tbody>

                @foreach($userwithenrollmentstatus as $allusrs)
                    <tr>
                        <td class="col text-center">{{ $allusrs['user']->user_number }}</td>
                        <td class="col text-center">{{ $allusrs['user']->fullname }}</td>
                        <td class="col text-center">{{ $allusrs['user']->email }}</td>

                        <td class="col col-sm-2">
                            <form method="post"
{{--                                  @dd($allusrs['courseid']);--}}
{{--                                  @dd($allusrs['user']->id);--}}
                                action="{{route('de-enroll-student', ['cid' => $allusrs['courseid'], 'sid' => $allusrs['user']->user_number])}}">
                                @csrf
                                @if($allusrs['enrolled'])
                                    <button class="btn btn-danger bi bi-ban"> De-enroll</button>
                                @else
                                    <button class="btn btn-danger bi bi-ban" disabled> De-enroll</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <form method="post"
                                  action="{{route('enroll-student', ['cid' => $allusrs['courseid'], 'sid' => $allusrs['user']->user_number])}}">
{{--                                  action="{{ route('super-admin-unban-user', ['userid' => $allusrs->user_id])}}">--}}
                                @csrf
                                @if(!$allusrs['enrolled'])
                                    <button class="btn btn-success bi bi-check-circle"> Enroll</button>
                                @else
                                    <button class="btn btn-success bi bi-check-circle" disabled> Enroll</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>


    </div>
@endsection
