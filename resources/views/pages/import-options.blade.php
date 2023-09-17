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

        <h2 class="text-center">Import Options : </h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('options') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFileOp" class="form-label">Choose Excel File</label>
                        <input class="form-control form-control-lg" id="formFileOp" type="file" name="excelFile">
                    </div>
                    <button type="submit" class="btn btn-warning">Import Options</button>
                </form>
            </div>
        </div>
    </div>
@endsection

