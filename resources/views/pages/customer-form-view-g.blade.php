@php
    if ($posY != 0) {
        dd($posY);
    }
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
    <title>Customer Form Grouping</title>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{-- @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach --}}
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
            <div class="alert alert-info m-2">
                Check Profile [If Approved] :
                <a href="{{ route('get-customer-form-g-what-if', $cardCode) }}" id="iframeLink">Check Link(Right
                    Side)</a>
                <a href="{{ route('customer-drive', $cardCode) }}" id="iframeLink3">Check Docs(Same page)</a>
            </div>
            {{--  --}}
            {{--  --}}
            <div class="row">
                <button id="load_what_if" class="btn btn-warning">Click To Load Data Of What If Into Form TO
                    Re-Edit</button>
                <input type="hidden" id="what_if_card_code" value="{{ $cardCode }}">
            </div>
            {{--  --}}
            {{--  --}}
        @endif
    @endif
    <form action="{{ route('approve') }}" method='POST' class='' id='logout-form'>
        @csrf
        <input type="hidden" value="" id="approval" name="approveFieldId">
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
        @include('layouts.sep', ['variableName' => 'Group - 1'])
        @include('groups.group-1')
        @include('layouts.sep', ['variableName' => 'Group - 2'])
        @include('groups.group-2')
        @include('layouts.sep', ['variableName' => 'Group - 3'])
        @include('groups.group-3')
        @include('layouts.sep', ['variableName' => 'Group - 4'])
        @include('groups.group-4')
        @include('layouts.sep', ['variableName' => 'Group - 5'])
        @include('groups.group-5')
        @include('layouts.sep', ['variableName' => 'Group - 6'])
        @include('groups.group-6')
        @include('layouts.sep', ['variableName' => 'Group - 7'])
        @include('groups.group-7')
        @include('layouts.sep', ['variableName' => 'Group - 8'])
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
                // $('#all-approve').addClass('d-none');
                $('#central').removeClass('d-none');
                $('#loadingSpinner').removeClass('d-none');
            });

            $('.al').click(function(e) {
                console.log('FFFFFF');
                // alert('vv');
                $('#groupFormUpdate').addClass('d-none');
                $('#central').removeClass('d-none');
                $('#loadingSpinner').removeClass('d-none');
            });
            // var desiredScrollValue = $('#scrollY').val(scrollYValue);
            // $(window).scrollTop(desiredScrollValue);
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
            // Disable all input, date and text fields inside divs with class 'sanad-g' when input radio button Called CustomerType is Changed and its Value is نقدى
            $(':input[name="CustomerType"]').change(function() {
                if ($(this).val() == 'نقدى' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', true);
                    $('.sanad-g').find('input, [type=date], textarea').val('');
                    $('.sanad-g').find('input[type=radio]').prop('checked', false);
                } else if ($(this).val() != '' && $(this).is(':checked')) {
                    $('.sanad-g').find('input, [type=date], textarea').prop('disabled', false);
                }
            });
            // Above is the First One  >> نقدى

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

            // Above is the Second  One 

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
                            // $('.mixsanseg').find('input[type=radio]').prop('checked', false);
                    }

                } else if ($(this).val() != '' && $(this).is(':checked')) {
                    $('.sejel').find('input, [type=date], textarea').prop('disabled', false);
                    // $('.mixsanseg').find('input, [type=date], textarea').prop('disabled', false);
                }
            });

            // ALERT START 
            // // Flag to track if form is submitted
            // let formSubmitted = false;
            // // Set a listener for form submission
            // document.getElementById('groupFormUpdate').addEventListener('submit', function() {
            //     formSubmitted = true;
            // });
            // // Set a listener for beforeunload event
            // window.addEventListener('beforeunload', function(e) {
            //     if (!formSubmitted) {
            //         e.preventDefault();
            //         e.returnValue = undefined; // Necessary for some browsers
            //         alert('Be Sure that all changes Are Saved !');
            //     }
            // });
            // ALERT END  

            // Above is the Third  One 
            const CRExpiryDateInput = document.getElementsByName("CRExpiryDate")[0];
            const CRExpiryDate_hInput = document.getElementsByName("CRExpiryDate_h")[0];
            const ExpirydateCommlicense = document.getElementsByName("ExpirydateCommlicense")[0];
            const ExpirydateCommlicense_h = document.getElementsByName("ExpirydateCommlicense_h")[0];
            const CreationDateOrderOrException = document.getElementsByName("CreationDateOrderOrException")[0];
            const CreationDateOrderOrException_h = document.getElementsByName("CreationDateOrderOrException_h")[0];
            const OwnerIDExpiryDate = document.getElementsByName("OwnerIDExpiryDate")[0];
            const OwnerIDExpiryDate_h = document.getElementsByName("OwnerIDExpiryDate_h")[0];
            const ExpiryDateGuarantorPromissoryNote = document.getElementsByName(
                "ExpiryDateGuarantorPromissoryNote")[0];
            const ExpiryDateGuarantorPromissoryNote_h = document.getElementsByName(
                "ExpiryDateGuarantorPromissoryNote_h")[0];
            const ExpirationDateFirstWitness = document.getElementsByName("ExpirationDateFirstWitness")[0];
            const ExpirationDateFirstWitness_h = document.getElementsByName("ExpirationDateFirstWitness_h")[0];
            const ExpiryDateSecondWitness = document.getElementsByName("ExpiryDateSecondWitness")[0];
            const ExpiryDateSecondWitness_h = document.getElementsByName("ExpiryDateSecondWitness_h")[0];
            const ExpiryDateNationalAddressReserveGuarantor = document.getElementsByName(
                "ExpiryDateNationalAddressReserveGuarantor")[0];
            const ExpiryDateNationalAddressReserveGuarantor_h = document.getElementsByName(
                "ExpiryDateNationalAddressReserveGuarantor_h")[0];
            const ExpiryDateNationalAddress = document.getElementsByName("ExpiryDateNationalAddress")[0];
            const ExpiryDateNationalAddress_h = document.getElementsByName("ExpiryDateNationalAddress_h")[0];

            CRExpiryDateInput.addEventListener("change", function() {
                const selectedDate = CRExpiryDateInput.value;
                if (selectedDate) {
                    console.log(selectedDate);
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    console.log(forma);
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    // Make an API call using AJAX
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            CRExpiryDate_hInput.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    CRExpiryDate_hInput.value = ""; // Reset the value if the date is cleared
                }
            });

            CRExpiryDate_hInput.addEventListener("change", function() {
                const selectedDate = CRExpiryDate_hInput.value;
                if (selectedDate) {
                    console.log(selectedDate);
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
                            console.log(forma);
                            CRExpiryDateInput.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    CRExpiryDate_hInput.value = ""; // Reset the value if the date is cleared
                }
            });

            ExpirydateCommlicense.addEventListener("change", function() {
                const selectedDate = ExpirydateCommlicense.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpirydateCommlicense_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpirydateCommlicense_h.value = "";
                }
            });

            ExpirydateCommlicense_h.addEventListener("change", function() {
                const selectedDate = ExpirydateCommlicense_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpirydateCommlicense.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpirydateCommlicense_h.value = "";
                }
            });

            CreationDateOrderOrException.addEventListener("change", function() {
                const selectedDate = CreationDateOrderOrException.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            CreationDateOrderOrException_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    CreationDateOrderOrException_h.value = "";
                }
            });

            CreationDateOrderOrException_h.addEventListener("change", function() {
                const selectedDate = CreationDateOrderOrException_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            CreationDateOrderOrException.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    CreationDateOrderOrException_h.value = "";
                }
            });

            OwnerIDExpiryDate.addEventListener("change", function() {
                const selectedDate = OwnerIDExpiryDate.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            OwnerIDExpiryDate_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    OwnerIDExpiryDate_h.value = "";
                }
            });

            OwnerIDExpiryDate_h.addEventListener("change", function() {
                const selectedDate = OwnerIDExpiryDate_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            OwnerIDExpiryDate.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    OwnerIDExpiryDate_h.value = "";
                }
            });

            ExpiryDateGuarantorPromissoryNote.addEventListener("change", function() {
                const selectedDate = ExpiryDateGuarantorPromissoryNote.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpiryDateGuarantorPromissoryNote_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateGuarantorPromissoryNote_h.value = "";
                }
            });

            ExpiryDateGuarantorPromissoryNote_h.addEventListener("change", function() {
                const selectedDate = ExpiryDateGuarantorPromissoryNote_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpiryDateGuarantorPromissoryNote.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateGuarantorPromissoryNote_h.value = "";
                }
            });

            ExpirationDateFirstWitness.addEventListener("change", function() {
                const selectedDate = ExpirationDateFirstWitness.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpirationDateFirstWitness_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpirationDateFirstWitness_h.value = "";
                }
            });

            ExpirationDateFirstWitness_h.addEventListener("change", function() {
                const selectedDate = ExpirationDateFirstWitness_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpirationDateFirstWitness.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpirationDateFirstWitness_h.value = "";
                }
            });

            ExpiryDateSecondWitness.addEventListener("change", function() {
                const selectedDate = ExpiryDateSecondWitness.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpiryDateSecondWitness_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateSecondWitness_h.value = "";
                }
            });

            ExpiryDateSecondWitness_h.addEventListener("change", function() {
                const selectedDate = ExpiryDateSecondWitness_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpiryDateSecondWitness.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateSecondWitness_h.value = "";
                }
            });
            ExpiryDateNationalAddressReserveGuarantor.addEventListener("change", function() {
                const selectedDate = ExpiryDateNationalAddressReserveGuarantor.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpiryDateNationalAddressReserveGuarantor_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateNationalAddressReserveGuarantor_h.value = "";
                }
            });

            ExpiryDateNationalAddressReserveGuarantor_h.addEventListener("change", function() {
                const selectedDate = ExpiryDateNationalAddressReserveGuarantor_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpiryDateNationalAddressReserveGuarantor.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateNationalAddressReserveGuarantor_h.value = "";
                }
            });

            ExpiryDateNationalAddress.addEventListener("change", function() {
                const selectedDate = ExpiryDateNationalAddress.value;
                if (selectedDate) {
                    const dateParts = selectedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.hijri.date;
                            ExpiryDateNationalAddress_h.value = convertedDate;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateNationalAddress_h.value = "";
                }
            });

            ExpiryDateNationalAddress_h.addEventListener("change", function() {
                const selectedDate = ExpiryDateNationalAddress_h.value;
                if (selectedDate) {
                    const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
                    fetch(apiEndpoint)
                        .then(response => response.json())
                        .then(data => {
                            const convertedDate = data.data.gregorian.date;
                            const dateParts = convertedDate.split("-");
                            const year = dateParts[0];
                            const month = dateParts[1];
                            const day = dateParts[2];
                            const forma = `${day}-${month}-${year}`;
                            ExpiryDateNationalAddress.value = forma;
                        })
                        .catch(error => {
                            console.error("Error fetching API data:", error);
                        });
                } else {
                    ExpiryDateNationalAddress_h.value = "";
                }
            });

        });
    </script>

    @include('unified.uno')
    @include('unified.HijriLoad')
    @if (Auth::user()->isSuperUser == 3)
        @include('unified.viewer-js')
    @endif

    {{-- // TODO Only if the User Is Editor Or admin  --}}
    @if (Auth::user()->isSuperUser == 1 || Auth::user()->isSuperUser == 2)
        @include('unified.load-what-if')
    @endif
</body>

</html>
