@php
    $oneDay = 60 * 60 * 24;
    $oneYear = 365 * $oneDay;
    $today = date('Y-m-d ');
    $fixedPeriod = $oneDay * 30;
    $allDDLColumn = App\Models\ColumnType::where('colType', 'ddl')
        ->pluck('colName')
        ->all();
    $r = App\Models\EditHistory::where('cardCode', $customerMySqlData->CardCode)
        ->where('isApproved', 0)
        ->get()
        ->makeHidden(['created_at', 'updated_at'])
        ->toArray();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap5.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/load-what-if.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastify.min.css') }}">
    <title>Customer Form Grouping</title>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <li>Check Errors in Field Below , Make Sure Date Fields are filled</li>
            </ul>
        </div>
    @endif

    @if (Auth::user()->isSuperUser == 1 || Auth::user()->isSuperUser == 2)
        @if (session()->has('init'))
            <div class="alert alert-warning">
                {{ session('init') }}
            </div>
        @endif

        @if ((bool) $r)
            <h3>Check Profile [If Approved] :</h3>
            <a class="btn rounded-pill p-1 btn-info" href="{{ route('get-customer-form-g-what-if', $cardCode) }}"
                id="iframeLink">
                Check Link(RightSide)
            </a>
            <a class="btn rounded-pill p-1 btn-warning" href="{{ route('customer-drive', $cardCode) }}"
                id="iframeLink3">
                Check Docs(Same page)
            </a>
            @if (Auth::user()->isSuperUser == 1)
                <a class="btn rounded-pill p-1 btn-primary" href="{{ route('appro-mode', $cardCode) }}"
                    id="iframeLink">Appro-Mode</a>
            @endif
            <button id="load_what_if" class="">Load Data Of What-If Into Form</button>
            <input type="hidden" id="what_if_card_code" value="{{ $cardCode }}">
        @endif
    @endif
    <form action="{{ route('approve') }}" method='POST' id='logout-form'>
        @csrf
        <input type="hidden" value="" id="approval" name="approveFieldId">
        <input type="hidden" value="" id="reason" name="reasonField">
        @if (session()->get('posY'))
            <input type="hidden" value="{{ session()->get('posY') }}" id="scrollY" name="scrollY" />
        @else
            <input type="hidden" value="0" id="scrollY" name="scrollY" />
        @endif
    </form>

    <form action="{{ route('approve-all') }}" method='POST' id='all-approve'>
        @csrf
        <input type="hidden" value="{{ $cardCode }}" name="allApproveCustomerCode">
    </form>

    <form action="{{ route('handle-update-form') }}" method="POST" id='groupFormUpdate'>
        @csrf
        <input type="hidden" name="id" value="{{ $customerMySqlData->id }}">
        <input type="hidden" name="CardCode" value="{{ $customerSapData['CardCode'] }}">
        <input type="hidden" name="created_at" value="">
        <input type="hidden" name="updated_at" value="">


        @include('layouts.sep', ['variableName' => 'مجموعة - 1'])
        @include('groups.group-1')
        @include('layouts.sep', ['variableName' => 'مجموعة - 2'])
        @include('groups.group-2')
        @include('layouts.sep', ['variableName' => 'مجموعة - 3'])
        @include('groups.group-3')
        @include('layouts.sep', ['variableName' => 'مجموعة - 4'])
        @include('groups.group-4')
        @include('layouts.sep', ['variableName' => 'مجموعة - 5'])
        @include('groups.group-5')
        @include('layouts.sep', ['variableName' => 'مجموعة - 6'])
        @include('groups.group-6')
        @include('layouts.sep', ['variableName' => 'مجموعة - 7'])
        @include('groups.group-7')
        @include('layouts.sep', ['variableName' => 'مجموعة - 8'])
        @include('groups.group-7-1')
        <br>
        @if (Auth::user()->isSuperUser == 1)
            <div class="d-flex justify-content-center">
                @if ((bool) $r)
                    <input type="submit" name="submit" id="" value="Approve All"
                        class="form-group btn btn-success"
                        onclick="event.preventDefault();
                        document.getElementById('all-approve').submit();">
                @else
                    <input type="submit" name="submit" id="" value="Submit"
                        class="form-group btn btn-danger">
                @endif
            </div>
        @endif

        @if (Auth::user()->isSuperUser == 2)
            <div class="d-flex justify-content-center">
                <input type="submit" name="submit" id="" value="Submit" class="form-group btn btn-danger">
            </div>
        @endif
        <br>
    </form>


    <div class="container d-flex justify-content-center align-items-center vh-100 d-none" id="central">
        <div class="spinner-grow d-none" role="status" id="loadingSpinner"></div>
    </div>

    <script src="{{ asset('js/code.jquery.com_jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log($('#scrollY').val());
            $(window).scrollTop($('#scrollY').val());

            $('#groupFormUpdate').submit(function(e) {
                $('#groupFormUpdate').addClass('d-none');
                $('#central').removeClass('d-none');
                $('#loadingSpinner').removeClass('d-none');
            });

            $('#all-approve').submit(function(e) {
                $('#groupFormUpdate').addClass('d-none');
                $('#central').removeClass('d-none');
                $('#loadingSpinner').removeClass('d-none');
            });

            $('.al').click(function(e) {
                console.log('FFFFFF');
                $('#groupFormUpdate').addClass('d-none');
                $('#central').removeClass('d-none');
                $('#loadingSpinner').removeClass('d-none');
            });
            $(window).on('scroll', function() {
                var scrollYValue = $(window).scrollTop();
                $('#scrollY').val(scrollYValue);
            });
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    @include('groups-js.g1')
    @include('groups-js.g2')
    @include('groups-js.g3')
    @include('groups-js.g4')
    @include('groups-js.g5')
    @include('groups-js.g6')


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(':input[name="CustomerType"]').change(function() {
                if ($(this).val() == 'نقدى' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', true);
                    $('.sanad-g').find('input, [type=date], textarea').val('');
                    $('.sanad-g').find('input[type=radio]').prop('checked', false);
                } else if ($(this).val() != '' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', false);
                }
            });

            $(':input[name="OrderBond"]').change(function() {
                if ($(this).val() == 'غير موجود' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', true);
                    $('.sanad-g').find('input, [type=date], textarea').val('');
                    $('.sanad-g').find('input[type=radio]').prop('checked', false);
                    $(this).prop('disabled', false);
                    $(this).prop('checked', true);
                    $(this).val('غير موجود');
                } else if ($(this).val() != '' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', false);
                }
            });

            $(':input[name="CommercialRegister"]').change(function() {
                if ($(this).val() == 'غير موجود' && $(this).is(':checked')) {
                    $('.mixsanseg').find('input, [type=date], textarea').prop('disabled', true);
                    $('.sejel').find('input, [type=date], textarea').prop('disabled', true);
                    $('.sejel').find('input, [type=date], textarea').val('');
                    $('.sejel').find('input[type=radio]').prop('checked', false);
                    $('.mixsanseg').find('input[type=radio]').prop('checked', false);
                } else if ($(this).val() == 'موجود' && $(this).is(':checked')) {
                    // Check OrderBond 
                    if ($(':input[name="OrderBond"]').val() == 'موجود' || $(':input[name="OrderBond"]')
                        .val() == 'مستثنى') {
                        $('.mixsanseg').find('input, [type=date], textarea').prop('disabled', false);
                    }
                } else if ($(this).val() != '' && $(this).is(':checked')) {
                    $('.sejel').find('input, [type=date], textarea').prop('disabled', false);
                }
            });

            // ! This is Code For Converting Dates While the User Is Typing them 
            function twoDatesConverter(gregoryDateObject, hijriDateObject) {
                gregoryDateObject.addEventListener("change", function() {
                    const selectedDate = gregoryDateObject.value;
                    if (selectedDate) {
                        // console.log(selectedDate);
                        const dateParts = selectedDate.split("-");
                        const year = dateParts[0];
                        const month = dateParts[1];
                        const day = dateParts[2];
                        const forma = `${day}-${month}-${year}`;
                        // console.log(forma);
                        const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                        // Make an API call using AJAX
                        fetch(apiEndpoint)
                            .then(response => response.json())
                            .then(data => {
                                const convertedDate = data.data.hijri.date;
                                hijriDateObject.value = convertedDate;
                            })
                            .catch(error => {
                                console.error("Error fetching API data:", error);
                            });
                    } else {
                        hijriDateObject.value = ""; // Reset the value if the date is cleared
                    }
                });

                hijriDateObject.addEventListener("change", function() {
                    const selectedDate = hijriDateObject.value;
                    if (selectedDate) {
                        // console.log(selectedDate);
                        const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                        // Make an API call using AJAX
                        fetch(apiEndpoint)
                            .then(response => response.json())
                            .then(data => {
                                const convertedDate = data.data.gregorian.date;
                                const dateParts = convertedDate.split("-");
                                const year = dateParts[0];
                                const month = dateParts[1];
                                const day = dateParts[2];
                                const forma = `${day}-${month}-${year}`;
                                // console.log(forma);
                                gregoryDateObject.value = forma;
                            })
                            .catch(error => {
                                console.error("Error fetching API data:", error);
                            });
                    } else {
                        hijriDateObject.value = ""; // Reset the value if the date is cleared
                    }
                });

                gregoryDateObject.addEventListener("myCustomEvent", function() {
                    const selectedDate = gregoryDateObject.value;
                    if (selectedDate) {
                        // console.log(selectedDate);
                        const dateParts = selectedDate.split("-");
                        const year = dateParts[0];
                        const month = dateParts[1];
                        const day = dateParts[2];
                        const forma = `${day}-${month}-${year}`;
                        // console.log(forma);
                        const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                        // Make an API call using AJAX
                        fetch(apiEndpoint)
                            .then(response => response.json())
                            .then(data => {
                                const convertedDate = data.data.hijri.date;
                                hijriDateObject.value = convertedDate;
                            })
                            .catch(error => {
                                console.error("Error fetching API data:", error);
                            });
                    } else {
                        hijriDateObject.value = ""; // Reset the value if the date is cleared
                    }
                });

                hijriDateObject.addEventListener("myCustomEvent", function() {
                    const selectedDate = hijriDateObject.value;
                    if (selectedDate) {
                        // console.log(selectedDate);
                        const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                        // Make an API call using AJAX
                        fetch(apiEndpoint)
                            .then(response => response.json())
                            .then(data => {
                                const convertedDate = data.data.gregorian.date;
                                const dateParts = convertedDate.split("-");
                                const year = dateParts[0];
                                const month = dateParts[1];
                                const day = dateParts[2];
                                const forma = `${day}-${month}-${year}`;
                                // console.log(forma);
                                gregoryDateObject.value = forma;
                            })
                            .catch(error => {
                                console.error("Error fetching API data:", error);
                            });
                    } else {
                        hijriDateObject.value = ""; // Reset the value if the date is cleared
                    }
                });
            }
            const CRExpiryDateInput = document.getElementsByName("CRExpiryDate")[0];
            const CRExpiryDate_hInput = document.getElementsByName("CRExpiryDate_h")[0];
            twoDatesConverter(CRExpiryDateInput, CRExpiryDate_hInput);
            const ExpirydateCommlicense = document.getElementsByName("ExpirydateCommlicense")[0];
            const ExpirydateCommlicense_h = document.getElementsByName("ExpirydateCommlicense_h")[0];
            twoDatesConverter(ExpirydateCommlicense, ExpirydateCommlicense_h);
            const CreationDateOrderOrException = document.getElementsByName("CreationDateOrderOrException")[0];
            const CreationDateOrderOrException_h = document.getElementsByName("CreationDateOrderOrException_h")[0];
            twoDatesConverter(CreationDateOrderOrException, CreationDateOrderOrException_h);
            const OwnerIDExpiryDate = document.getElementsByName("OwnerIDExpiryDate")[0];
            const OwnerIDExpiryDate_h = document.getElementsByName("OwnerIDExpiryDate_h")[0];
            twoDatesConverter(OwnerIDExpiryDate, OwnerIDExpiryDate_h);
            const ExpiryDateGuarantorPromissoryNote = document.getElementsByName(
                "ExpiryDateGuarantorPromissoryNote")[0];
            const ExpiryDateGuarantorPromissoryNote_h = document.getElementsByName(
                "ExpiryDateGuarantorPromissoryNote_h")[0];
            twoDatesConverter(ExpiryDateGuarantorPromissoryNote, ExpiryDateGuarantorPromissoryNote_h);
            const ExpirationDateFirstWitness = document.getElementsByName("ExpirationDateFirstWitness")[0];
            const ExpirationDateFirstWitness_h = document.getElementsByName("ExpirationDateFirstWitness_h")[0];
            twoDatesConverter(ExpirationDateFirstWitness, ExpirationDateFirstWitness_h);
            const ExpiryDateSecondWitness = document.getElementsByName("ExpiryDateSecondWitness")[0];
            const ExpiryDateSecondWitness_h = document.getElementsByName("ExpiryDateSecondWitness_h")[0];
            twoDatesConverter(ExpiryDateSecondWitness, ExpiryDateSecondWitness_h);
            const ExpiryDateNationalAddressReserveGuarantor = document.getElementsByName(
                "ExpiryDateNationalAddressReserveGuarantor")[0];
            const ExpiryDateNationalAddressReserveGuarantor_h = document.getElementsByName(
                "ExpiryDateNationalAddressReserveGuarantor_h")[0];
            twoDatesConverter(ExpiryDateNationalAddressReserveGuarantor,
                ExpiryDateNationalAddressReserveGuarantor_h);
            const ExpiryDateNationalAddress = document.getElementsByName("ExpiryDateNationalAddress")[0];
            const ExpiryDateNationalAddress_h = document.getElementsByName("ExpiryDateNationalAddress_h")[0];
            twoDatesConverter(ExpiryDateNationalAddress, ExpiryDateNationalAddress_h);
        });
    </script>

    @include('unified.uno')
    {{-- @include('unified.HijriLoad') --}}
    @if (Auth::user()->isSuperUser == 3)
        @include('unified.viewer-js')
    @endif

    {{-- // TODO Only if the User Is Editor Or admin  --}}
    @if (Auth::user()->isSuperUser == 1 || Auth::user()->isSuperUser == 2)
        @include('unified.load-what-if')
    @endif
    <script src="{{ asset('js/toastify-js.js') }}"></script>
</body>

</html>
