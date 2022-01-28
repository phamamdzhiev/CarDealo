@extends('admin.base')

@section('main')

    <pre>
        {{ Auth::user() }}
    </pre>
    <br>
    <br>
    <pre>
        {{ Auth::guard('admin')->user() }}

</pre>
@endsection
