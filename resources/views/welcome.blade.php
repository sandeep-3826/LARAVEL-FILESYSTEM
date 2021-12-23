@extends('layouts.master')

@section('title' | 'All User Details')

@section('content')
    
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <a href="{{ URL('create-user') }}" type="button" class="btn btn-success">Create User</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SN.</th>
                <th>User Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allUsers as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->first_name }}</td>
                    <td>{{ $value->last_name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->username }}</td>
                </tr>
            @empty
                <td colspan="6" style="text-align: center;">No Records Found</td>
            @endforelse
        </tbody>
    </table>

@endsection