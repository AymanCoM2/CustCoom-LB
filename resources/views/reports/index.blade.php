@extends('layouts.dash')

@section('content')
    <div class="container">
        <div class="row">
            <form action="">
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-primary" type="submit">Generate Report</button>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-select" aria-label="Default select example" name="reportNumber">
                            <option selected>Select Report From the Below</option>
                            <option value="1" {{ request()->reportNumber == 1 ? 'selected' : '' }}>Report One</option>
                            <option value="2">Report Two</option>
                            <option value="3">Report Three</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    @isset($res)
        <div class="container">
            {{ $res }}
        </div>
    @endisset
@endsection
