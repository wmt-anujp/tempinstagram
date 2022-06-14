@extends('layouts.master2')
@section('title')
   Admin Dashboard
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-12 mt-5 justify-content-center">
                <table class="table border border-2" id="usertable">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td><a href="" class="btn btn-sm btn-primary" id="userStatus">Active</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        {{ $users->links() }}
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#usertable').DataTable({});
        });
        $(function () {
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.Dashboard') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        });
    });
    </script>
@endsection
