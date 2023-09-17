@extends('layouts.dash')

@section('content')
    <div class="container">
        <form action="{{ route('bbb-post') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="formFileLg" class="form-label">Enter the New User Code:</label>
                <input class="form-control form-control-lg" id="formFileLg" type="text" name="newCode">
            </div>
            <button type="submit" class="btn btn-primary">Check Customer</button>
        </form>
    </div>
@endsection
