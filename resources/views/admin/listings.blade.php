@extends('admin.base')
@section('main')
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Offer id</th>
        <th scope="col">User ID</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listings as $listing)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $listing->id }}</td>
            <td>{{ $listing->user_id }}</td>
            <td>{{ $listing->created_at->format('d.m.y; H:m:s')  }}</td>
            <td>{{ $listing->updated_at->format('d.m.y; H:m:s') }}</td>
            <td>{{ $listing->title }}</td>
            <td>{{ $listing->price }} lv.</td>
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
