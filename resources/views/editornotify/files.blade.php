@extends('layouts.dash')

@section('content')
    <hr style="border: 5px solid black;">
    <br>
    <h1 class="text-center">File Notifications</h1>
    @php
        $allNotify = \App\Models\EditorOnceTimeDocs::where('editor_id', request()->user()->id)->get();
    @endphp

    @foreach ($allNotify as $notify)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $notify->file_name }}</h5>
                <p class="card-text">
                    <a href="" class="btn btn-danger float-end">Mark as Read</a>
                </p>
            </div>
        </div>
    @endforeach
@endsection


<script>
    // alert('done') ; 
</script>
