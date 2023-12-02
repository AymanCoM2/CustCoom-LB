@extends('layouts.dash')

@section('content')
    <hr style="border: 5px solid black;">
    <br>
    <h1 class="text-center">EXPORT All Data to Excel</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('backup-post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-primary w-100">EXPORT DATA</button>
            </form>
        </div>
    </div>
@endsection
