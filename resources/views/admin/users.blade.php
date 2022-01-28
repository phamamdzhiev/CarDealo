@extends('admin.base')
@section('main')
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">User ID</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td style="color: red; font-weight: bold">{{ $user->id }}</td>
            <td>{{ $user->created_at->format('d.m.y; H:m:s')  }}</td>
            <td>{{ $user->updated_at->format('d.m.y; H:m:s') }}</td>
            <td>{{ $user->name }}.</td>
            <td>{{ $user->email }}.</td>
        </tr>
    @endforeach
    </tbody>
</table>

<style>
    td, th {
        padding: 0 1rem;
    }
</style>
@endsection
