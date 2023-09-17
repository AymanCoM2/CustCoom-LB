<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrOrgImg', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'NationalAddrOrgImg'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->NationalAddrOrgImg;
                    endif;
                endforeach;
                if (in_array('NationalAddrOrgImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'NationalAddrOrgImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='NationalAddrOrgImg' id='NationalAddrOrgImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='NationalAddrOrgImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='NationalAddrOrgImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddress', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ExpiryDateNationalAddress'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ExpiryDateNationalAddress;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                // dd($hijriData);
                if (in_array('ExpiryDateNationalAddress', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateNationalAddress')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateNationalAddress' id='ExpiryDateNationalAddress' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateNationalAddress'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='ExpiryDateNationalAddress' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='ExpiryDateNationalAddress' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> حالة العنوان الوطنى للمؤسسة</label>
            <p name="hala_12"> @php
                if ($customerMySqlData->NationalAddrOrgImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateNationalAddress) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrFirstSupOb', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'NationalAddrFirstSupOb'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->NationalAddrFirstSupOb;
                    endif;
                endforeach;
                if (in_array('NationalAddrFirstSupOb', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'NationalAddrFirstSupOb')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='NationalAddrFirstSupOb' id='NationalAddrFirstSupOb' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='NationalAddrFirstSupOb'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='NationalAddrFirstSupOb'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddressReserveGuarantor', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ExpiryDateNationalAddressReserveGuarantor'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ExpiryDateNationalAddressReserveGuarantor;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('ExpiryDateNationalAddressReserveGuarantor', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateNationalAddressReserveGuarantor')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateNationalAddressReserveGuarantor' id='ExpiryDateNationalAddressReserveGuarantor' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateNationalAddressReserveGuarantor'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='ExpiryDateNationalAddressReserveGuarantor' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='ExpiryDateNationalAddressReserveGuarantor' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> حالة العنوان الوطني للضامن الاحتياطي في
                سند
                الامر</label>
            <p name="hala_22"> @php
                if ($customerMySqlData->NationalAddrFirstSupOb == 'موجود' && strtotime($customerMySqlData->ExpiryDateNationalAddressReserveGuarantor) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>
    </div>
</div>
