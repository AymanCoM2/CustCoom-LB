<div class="container-fluid ">
    <div class="row">

        <div class="col-sm-4">
            <label for="inputEmail4"
                class="form-label bg-light w-100 w-100 fw-bold">{{ __('GovernmentTaxIdentifier', [], 'ar') }}
                :</label>
            <p>{{ $customerSapData['LicTradNum'] }}</p>
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('OpenAccountPropose', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'OpenAccountPropose'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->OpenAccountPropose;
                    endif;
                endforeach;
                if (in_array('OpenAccountPropose', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OpenAccountPropose')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OpenAccountPropose_if' id='OpenAccountPropose' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OpenAccountPropose'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='OpenAccountPropose_if'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة طلب فتح الحساب</label>
            <p name="calc_g2_1_gg"></p>
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('CommercialRegister', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CommercialRegister'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CommercialRegister;
                    endif;
                endforeach;
                if (in_array('CommercialRegister', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CommercialRegister')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='CommercialRegister' id='CommercialRegister' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CommercialRegister'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='CommercialRegister'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('CRExpiryDate', [], 'ar') }}
            </label>
            @php
                $uxDate = strtotime($customerMySqlData->CRExpiryDate);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CRExpiryDate'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CRExpiryDate;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('CRExpiryDate', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CRExpiryDate')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='CRExpiryDate' id='CRExpiryDate' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CRExpiryDate'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='CRExpiryDate' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='CRExpiryDate' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('CrCnMatch', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CrCnMatch'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CrCnMatch;
                    endif;
                endforeach;
                if (in_array('CrCnMatch', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CrCnMatch')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='CrCnMatch' id='CrCnMatch' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CrCnMatch'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='CrCnMatch'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة السجل التجاري</label>
            <p name="calc_g2_2"> @php
                $thirdCondition = strtotime($today) + strtotime($fixedPeriod) < strtotime($customerMySqlData->CRExpiryDate);
                if ($customerMySqlData->CommercialRegister == 'موجود' && $customerMySqlData->CrCnMatch == 'مطابق' && $thirdCondition) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('TaxCard', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'TaxCard'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->TaxCard;
                    endif;
                endforeach;
                if (in_array('TaxCard', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'TaxCard')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='TaxCard' id='TaxCard' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='TaxCard'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='TaxCard'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة البطاقة الضريبية</label>
            <p name="Rttv_dt_e"> @php
                if ($customerMySqlData->TaxCard == 'موجود' && strlen($customerMySqlData->GovernmentTaxIdentifier) == 15) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>
    </div>
</div>
