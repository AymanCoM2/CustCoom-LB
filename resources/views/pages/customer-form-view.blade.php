@php
    // dd($customerSapData);
    $oneDay = 60 * 60 * 24;
    $oneYear = 365 * $oneDay;
    $today = date('Y-m-d H:i:s');
    // ;
    $fixedPeriod = $oneDay * 30;
    // $dbDate = $customerMySqlData->CRExpiryDate;
    // $unixTime = strtotime($dbDate);
    // $anotherUnix = $unixTime + $oneDay * 5;
    // $another = date($unixTime);
    // echo $dbDate;
    // echo '<br/>';
    // echo $unixTime;
    // echo '<br/>';
    // echo $anotherUnix;
    // echo '<br/>';
    // echo date('Y-m-d H:i:s ', $anotherUnix);
    // echo '<br/>';
    // die();
    $allDDLColumn = App\Models\ColumnType::where('colType', 'ddl')
        ->pluck('colName')
        ->all();
    // dd($allDDLColumn);     <<<< OK OK OK
    // dd(in_array("Branches",$allDDLColumn));
    //------------------ $allOptions  = App\Models\ColumnOption::where('colName','Branches')->get();
    //------------------ dd($allOptions[0]->colOption);
    // dd($allOptions[$allDDLColumn[0]]);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

    <link href="{{ asset('css/bootstrap5.css') }}" rel="stylesheet" />
    <title>Customer Form</title>
</head>

<body>
    <div class="container-fluid">
        {{-- ----------------Sap Data START --------------- --}}
        <h2>Sap Data :</h2>
        <table class="table table-striped table-hover">
            <tbody>
                @foreach ($customerSapData as $key => $value)
                    <tr>
                        <th scope="row">{{ $key }}</th>
                        <td colspan="2">{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        {{-- --------------  Sap Data END  ----------------- --}}

        <form id='logout-form' action="{{ route('approve') }}" method='POST' class='d-none'>
            @csrf
            <input type="hidden" value="" id="approval" name="approveFieldId">
        </form>
        {{-- ------------------MySQL DatA START -------------------- --}}
        @if ($customerMySqlData)
            @php
                $r = App\Models\EditHistory::where('cardCode', $customerMySqlData->CardCode)
                    ->where('isApproved', 0)
                    ->get()
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toArray();
                // dd($r);
            @endphp
            <h2>MySql Data :</h2>
            <form action="{{ route('handle-update-form') }}" method="POST">
                @csrf
                <div>
                    @foreach ($customerMySqlData->getAttributes() as $key => $value)
                        <div class="container">
                            <div class="row">
                                @php
                                    foreach ($r as $singleEditArray):
                                        if ($singleEditArray['fieldName'] == $key):
                                            $data = 'Old Value : ' . $singleEditArray['oldValue'] . ' ,,New Value : ' . $singleEditArray['newValue'];
                                            $data2 = ',,Editor Name : ' . App\Models\User::find($singleEditArray['editor_id'])->first()->name;
                                            $fullData = $data . $data2;
                                            // dd($fullData)  ;
                                    
                                            echo "<a class=\"\" href=''
                                       onclick=\"event.preventDefault();
                                                     document.getElementById('approval').setAttribute('value'" .
                                                ',' .
                                                $singleEditArray['id'] .
                                                ");
                                                     document.getElementById('logout-form').submit();\">";
                                            echo 'Approve';
                                            echo '</a>';
                                            echo "
                                            <div class='col-6'><span class='d-inline-block' tabindex='0' data-toggle='tooltip'
                                        title=\"$fullData\" >
                                        <button class='btn btn-danger w-50 p-0 m-2' style='pointer-events: none;'
                                            type='button' disabled><i class='bx bx-question-mark'></i></button>
                                    </span>
                                </div>
                                ";
                                        endif;
                                    endforeach;
                                @endphp
                                <div class="col-6"> {{ __($key, [], 'ar') }}</div>
                            </div>


                            @if (in_array($key, $allDDLColumn))
                                {{-- This Means it Has Options --}}
                                <div class="form-check form-check-inline">
                                    @php
                                        $allOptions = App\Models\ColumnOption::where('colName', $key)->get();
                                        foreach ($allOptions as $k1 => $val1):
                                            $res = '';
                                            if ($val1->colOption == $value) {
                                                $res = 'checked';
                                            }
                                            //    echo $val1->colOption ;
                                            echo "<input class='form-check-inline m-2' type='radio' name=$key id=$key $res  value=\"$val1->colOption\" />";
                                            echo "<label class=\"form-check-label\" for=\"$key\">";
                                            echo $val1->colOption;
                                            echo ' </label>';
                                        endforeach;
                                    @endphp
                                </div>
                            @else
                                <div class="row">
                                    <input type="text" class="form-control" value="{{ $value }}"
                                        name="{{ $key }}">
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>
                <input type="submit" name="submit" id="" value="Submit" class="form-group btn btn-warning">
            </form>
        @endif
        {{-- -------------------- MySQL DatA END--------------------- --}}
    </div>



    {{-- ------------------------ Calculated DatA START --------------------- --}}
    @if ($customerMySqlData)
        <hr style="border-width:5px ">
        <h1>Calculated Data : </h1>
        <div class="container">
            <table class="table table-striped table-hover">
                <tbody>
                    {{--  1  OK _ OK --}}
                    <tr>
                        <th scope="row">حالة طلب فتح الحساب</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->OpenAccountPropose == 'موجود' || $customerMySqlData->OpenAccountPropose == 'مستثنى') {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 2 OK __ OK  --}}
                    <tr>
                        <th scope="row">حالة السجل التجاري</th>
                        <td colspan="2">
                            @php
                                $thirdCondition = strtotime($today) + strtotime($fixedPeriod) < strtotime($customerMySqlData->CRExpiryDate);
                                if ($customerMySqlData->CommercialRegister == 'موجود' && $customerMySqlData->CrCnMatch == 'مطابق' && $thirdCondition) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 3 OK _ OK --}}
                    <tr>
                        <th scope="row"> حالة البطاقة الضريبية </th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->TaxCard == 'موجود' && strlen($customerMySqlData->GovernmentTaxIdentifier) == 15) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 4 OK _ OK --}}
                    <tr>
                        <th scope="row"> حالة رخصة النشاط التجارى </th>
                        <td colspan="2">
                            @php
                                if (strtotime($customerMySqlData->ExpirydateCommlicense) > strtotime($today) + strtotime($fixedPeriod)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 5 OK _ OK --}}
                    <tr>
                        <th scope="row">تاريخ انتهاء سند الامر او الاستثناء </th>
                        <td colspan="2">
                            @php
                                $calcFive = null;
                                if ($customerMySqlData->CreationDateOrderOrException) {
                                    $currentDate = strtotime($customerMySqlData->CreationDateOrderOrException);
                                    $nextThreeYears = $currentDate + 3 * $oneYear;
                                    $calcFive = $nextThreeYears;
                                    echo date('Y-m-d H:i:s ', $nextThreeYears);
                                } else {
                                    echo '';
                                }
                                // echo 'Calc TODO';
                            @endphp
                        </td>
                    </tr>

                    {{-- 6 OK __ OK --}}
                    <tr>
                        <th scope="row">قيمة سند الامر المضبوطة </th>
                        <td colspan="2">
                            @php
                                $finalValue = 0;
                                if ($customerMySqlData->OrderBond == 'غير موجود') {
                                    echo $finalValue;
                                } elseif ($customerMySqlData->OrderBond == 'مستثنى') {
                                    $finalValue = (int) $customerMySqlData->ValueOrderException;
                                    echo $finalValue;
                                } else {
                                    if ($customerMySqlData->COM == 'LB') {
                                        $finalValue = (int) $customerMySqlData->ValueOrderException / 2;
                                    } else {
                                        $finalValue = (int) $customerMySqlData->ValueOrderException * 0.8;
                                    }
                                    echo $finalValue;
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 7 OK __ OK --}}
                    <tr>
                        <th scope="row">مطابقة الحد الائتمانى </th>
                        <td colspan="2">
                            @php
                                // dd($finalValue) ;
                                // In Excel There is A problem , The Data Not Matching With SAP data
                                // Credit Line From SAP  = 0
                                // Creadit Line from Excel = 50000 ?????
                                $calcSix = '';
                                if ($finalValue == (int) $customerSapData['CreditLine']) {
                                    $calcSix = 'مطابق';
                                    echo $calcSix;
                                } elseif ($finalValue > (int) $customerSapData['CreditLine']) {
                                    $calcSix = 'السند اكبر';
                                    echo $calcSix;
                                } else {
                                    // if ($finalValue == 0) ?????
                                    $calcSix = 'السند غير موجود';
                                    echo $calcSix;
                                }
                            @endphp
                        </td>
                    </tr>

                    {{--  8 //   --}}
                    <tr>
                        <th scope="row">حالة سند الامر </th>
                        <td colspan="2">
                            @php
                                $f_1 = $customerMySqlData->OrderBond == 'موجود';
                                $f_2 = $calcFive > strtotime($today) + strtotime($fixedPeriod);
                                $f_3 = $calcSix == 'مطابق';
                                $f_4 = $customerMySqlData->ObCrMatch == 'مطابق';
                                $firstTrue = $f_1 && $f_2 && $f_3 && $f_4;
                                
                                $s_1 = $customerMySqlData->OrderBond == 'مستثنى';
                                $s_2 = $customerMySqlData->ValueOrderException == $customerSapData['CreditLine'];
                                $secondTrue = $s_1 && $s_2;
                                
                                if ($firstTrue || $secondTrue) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{--  9  OK __ OK --}}
                    <tr>
                        <th scope="row">حالة هوية المالك</th>
                        <td colspan="2">
                            @php
                                if (strtotime($customerMySqlData->OwnerIDExpiryDate) > strtotime($today) + strtotime($fixedPeriod) && $customerMySqlData->OwnerImg == 'موجود') {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{-- 10 Ok __ Ok  --}}
                    <tr>
                        <th scope="row">حالة صورة عن هوية الضامن الاحتياطي في السند لأمر</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->ObSupporterIdImg == 'موجود' && strtotime($today) + strtotime($fixedPeriod) < strtotime($customerMySqlData->ExpiryDateGuarantorPromissoryNote)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{--  11 OK __ Ok --}}
                    <tr>
                        <th scope="row"> حالة هوية الشاهد الاول في السند الامر</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->ObFrstSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpirationDateFirstWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{--  12 Ok _ Ok  --}}
                    <tr>
                        <th scope="row"> حالة هوية الشاهد الثانى في السند الامر</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->ObScndSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateSecondWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>

                    {{--  13  OK __ OK  --}}
                    <tr>
                        <th scope="row">حالة العنوان الوطنى للمؤسسة</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->NationalAddrOrgImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateNationalAddress) > strtotime($today) + strtotime($fixedPeriod)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>
                    {{--  14 OK __ OK  --}}
                    <tr>
                        <th scope="row">حالة العنوان الوطني للضامن الاحتياطي في سند الامر</th>
                        <td colspan="2">
                            @php
                                if ($customerMySqlData->NationalAddrFirstSupOb == 'موجود' && strtotime($customerMySqlData->ExpiryDateNationalAddressReserveGuarantor) > strtotime($today) + strtotime($fixedPeriod)) {
                                    echo 'سارى';
                                } else {
                                    echo 'يجب اعادة طلبه';
                                }
                            @endphp
                        </td>
                    </tr>
                    {{-- ---------------------------------- --}}
                </tbody>
            </table>
            <hr>
        </div>
    @endif
    {{-- ------------------------ Calculated DatA END --------------------- --}}
    <script src="{{ asset('js/code.jquery.com_jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>


</html>
