@extends('layouts.dash')

@section('content')
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr style="border: 5px solid black;">
        <br>
        <h2 class="text-center">Import Data : </h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('post-import-customers') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFileLg" class="form-label">Choose Excel File</label>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="excelFile">
                    </div>
                    <button type="submit" class="btn btn-primary">Import DATA</button>
                </form>
            </div>
        </div>
    </div>
@endsection
