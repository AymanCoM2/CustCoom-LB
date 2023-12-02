@extends('layouts.dash')

@section('content')
    <hr style="border: 5px solid black;">
    <br>
    <h1 class="text-center">Edits Notifications</h1>
    @php
        $allNotify = \App\Models\EditorOnceTimeNOtification::where('editor_id', request()->user()->id)->get();
    @endphp
    @foreach ($allNotify as $notify)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $notify->file_name }}</h5>
                <p class="card-text">
                    <span class="">Old Value : {{ $notify->field_old_value }}</span> <i class='bx bx-dots-vertical'></i>
                    <span class="">New Value : {{ $notify->field_new_value }}</span> <i class='bx bx-dots-vertical'></i>
                    <span class="">State OF Approval : {{ $notify->state ? 'Approved' : 'Not approved' }}</span> <i
                        class='bx bx-dots-vertical'></i>
                    <a href="" class="btn btn-danger float-end">Mark as Read</a>
                </p>
            </div>
        </div>
    @endforeach
@endsection


<script>
    // alert('done') ; 
</script>
