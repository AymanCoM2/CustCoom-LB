@extends('layouts.dash')

@section('content')
    <div class="container">
        <div class="row">
            <form action="">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="CRExpiryDateFrom" class="col-sm-2 col-form-label">CRExpiryDate From</label>
                        <input type="date" class="form-control" name="CRExpiryDateFrom">
                    </div>
                    <div class="col-sm-3">
                        <label for="CRExpiryDateTo" class="col-sm-2 col-form-label">CRExpiryDate To</label>
                        <input type="date" class="form-control" name="CRExpiryDateTo">
                    </div>

                    <div class="col-sm-3">
                        <label for="ValueOrderExceptionFrom" class="col-sm-2 col-form-label">ValueOrderException
                            From</label>
                        <input type="number" class="form-control" name="ValueOrderExceptionFrom">
                    </div>
                    <div class="col-sm-3">
                        <label for="ValueOrderExceptionTo" class="col-sm-2 col-form-label">ValueOrderException To</label>
                        <input type="number" class="form-control" name="ValueOrderExceptionTo">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="OwnerIDExpiryDateFrom" class="col-sm-2 col-form-label">OwnerIDExpiryDate From</label>
                        <input type="date" class="form-control" name="OwnerIDExpiryDateFrom">
                    </div>
                    <div class="col-sm-3">
                        <label for="OwnerIDExpiryDateTo" class="col-sm-2 col-form-label">OwnerIDExpiryDate To</label>
                        <input type="date" class="form-control" name="OwnerIDExpiryDateTo">
                    </div>

                    <div class="col-sm-3">
                        <label for="CreationDateOrderOrExceptionFrom"
                            class="col-sm-2 col-form-label text-wrap">CreationDateOrderOrException From</label>
                        <input type="date" class="form-control" name="CreationDateOrderOrExceptionFrom">
                    </div>
                    <div class="col-sm-3">
                        <label for="CreationDateOrderOrExceptionTo"
                            class="col-sm-2 col-form-label text-wrap">CreationDateOrderOrException To</label>
                        <input type="date" class="form-control" name="CreationDateOrderOrExceptionTo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">CustomerType</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="CustomerType1" value="آجل">
                            <label class="form-check-label" for="CustomerType1">آجل</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="CustomerType2" value="اجل مستثني">
                            <label class="form-check-label" for="CustomerType2">اجل مستثني</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="CustomerType3" value="نقدى">
                            <label class="form-check-label" for="CustomerType3">نقدى</label>
                        </div>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-sm-3">
                        <button class="btn btn-primary" type="submit">Generate Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    @isset($res)
        <div class="container">

        </div>
    @endisset
@endsection

{{-- // "CRExpiryDate": "تاريخ انتهاء السجل التجارى",
// "ValueOrderException": "قيمة سند الامر او الاستثناء",
// "CreationDateOrderOrException": "تاريخ انشاء سند الامر او الاستثناء",
// "OwnerIDExpiryDate": "تاريخ انتهاء هوية المالك",
// "CustomerType":"نوع العميل", 
// آجل , اجل مستثني  , نقدى --}}
