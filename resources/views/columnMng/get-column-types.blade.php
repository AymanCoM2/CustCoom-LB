@extends('layouts.dash')

@section('content')
    <div class="container">
        <form action="{{ route('col-types-post') }}" method="post">
            @csrf
            @foreach ($allColumnTypes as $column)
                <div class="mb-3 row">
                    <div class="col-6">
                        {{ __($column->colName, [], 'ar') }}
                        {{-- {{ $column->colName }} --}}
                    </div>
                    <div class="col-6">
                        <select class="form-select" aria-label="Default select example" name="{{ $column->colName }}">
                            <option @if ($column->colType == 'string') {{ 'selected' }} @endif value="string">string
                            </option>
                            <option @if ($column->colType == 'ddl') {{ 'selected' }} @endif value="ddl">ddl</option>
                            <option @if ($column->colType == 'date') {{ 'selected' }} @endif value="date">date
                            </option>
                            <option @if ($column->colType == 'number') {{ 'selected' }} @endif value="number">number
                            </option>
                        </select>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Save Types</button>
        </form>
    </div>
@endsection
