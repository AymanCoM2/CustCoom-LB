<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('OrderBond', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'OrderBond'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->OrderBond;
                    endif;
                endforeach;
                if (in_array('OrderBond', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OrderBond')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='OrderBond' id='OrderBond' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OrderBond'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='OrderBond'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ValueOrderException', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ValueOrderException'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ValueOrderException;
                    endif;
                endforeach;
                if (in_array('ValueOrderException', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ValueOrderException')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='ValueOrderException' id='ValueOrderException' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ValueOrderException'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='ValueOrderException'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('CreationDateOrderOrException', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CreationDateOrderOrException'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CreationDateOrderOrException;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('CreationDateOrderOrException', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CreationDateOrderOrException')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='CreationDateOrderOrException' id='CreationDateOrderOrException' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CreationDateOrderOrException'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='CreationDateOrderOrException' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='CreationDateOrderOrException' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">تاريخ انتهاء سند الامر او الاستثناء
            </label>
            <p name="year_from_now"> @php
                $calcFive = null;
                if ($customerMySqlData->CreationDateOrderOrException) {
                    $currentDate = strtotime($customerMySqlData->CreationDateOrderOrException);
                    $nextThreeYears = $currentDate + 3 * $oneYear;
                    $calcFive = $nextThreeYears;
                    echo date('Y-m-d', $nextThreeYears);
                } else {
                    echo '';
                }
                // echo 'Calc TODO';
            @endphp</p>
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> قيمة سند الامر المضبوطة </label>
            <p name="mazbota"> @php
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
            @endphp</p>
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">Credit Line :</label>
            <p name="CreditLine_p"> {{ round($customerSapData['CreditLine'], 2) }} </p>
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> مطابقة الحد الائتمانى </label>
            <p name="motabaqa">@php
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
            @endphp</p>
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('ObCrMatch', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ObCrMatch'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ObCrMatch;
                    endif;
                endforeach;
                if (in_array('ObCrMatch', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObCrMatch')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='ObCrMatch' id='ObCrMatch' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObCrMatch'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='ObCrMatch'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> حالة سند الامر </label>
            <p name="hsl"> @php
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
            @endphp</p>
        </div>
    </div>

</div>
