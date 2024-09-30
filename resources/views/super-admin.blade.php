@extends('layouts.menu-teacher')
@section('content')

    {{-- Restricted page access to super admin on the route --}}

    <div class="b-divider"></div>
    <div class="container ">
        <h2 class="py-4 text-center border-bottom">Ban Fake Reviewers</h2>

        <div class="bd m-0 border-0">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Flag Counts</th>
                    <th>Banned?</th>
                    <th>Ban</th>
                    <th>Unban</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allusers as $allusrs)
                    <tr>
                        <td class="col">{{ $allusrs->user_id }}</td>
                        <td class="col">{{ $allusrs->username }}</td>
                        <td class="col">{{ $allusrs->totalflags }}</td>
                        <td class="col">{{ $allusrs->banned }}</td>

                        <td class="col col-sm-2">
                            <form method="post"
                                  action="{{ route('super-admin-ban-user', ['userid' => $allusrs->user_id])}}">
                                @csrf
                                @if($allusrs->banned == 'no' && $allusrs->username != 'admin')
                                    <button class="btn btn-danger bi bi-ban"> Ban user</button>
                                @else
                                    <button class="btn btn-danger bi bi-ban" disabled> Ban user</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <form method="post"
                                  action="{{ route('super-admin-unban-user', ['userid' => $allusrs->user_id])}}">
                                @csrf
                                @if($allusrs->banned != 'no' && $allusrs->username != 'admin')
                                    <button class="btn btn-success bi bi-check-circle"> Unban user</button>
                                @else
                                    <button class="btn btn-success bi bi-check-circle" disabled> Unban user</button>
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
