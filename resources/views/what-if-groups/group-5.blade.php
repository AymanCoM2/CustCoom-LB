<div class="container-fluid">
    <div class="row">

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('OwnerImg', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'OwnerImg'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->OwnerImg;
                    endif;
                endforeach;
                if (in_array('OwnerImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OwnerImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OwnerImg' id='OwnerImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OwnerImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                    name='OwnerImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('OwnerIDExpiryDate', [], 'ar') }}
            </label>
            @php
                
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'OwnerIDExpiryDate'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->OwnerIDExpiryDate;
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
                if (in_array('OwnerIDExpiryDate', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OwnerIDExpiryDate')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OwnerIDExpiryDate' id='OwnerIDExpiryDate' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OwnerIDExpiryDate'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='OwnerIDExpiryDate' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='OwnerIDExpiryDate' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية المالك</label>
            <p name="hala_1"> @php
                if (strtotime($customerMySqlData->OwnerIDExpiryDate) > strtotime($today) + strtotime($fixedPeriod) && $customerMySqlData->OwnerImg == 'موجود') {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObSupporterIdImg', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ObSupporterIdImg'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ObSupporterIdImg;
                    endif;
                endforeach;
                if (in_array('ObSupporterIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObSupporterIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObSupporterIdImg' id='ObSupporterIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObSupporterIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                    name='ObSupporterIdImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpiryDateGuarantorPromissoryNote', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ExpiryDateGuarantorPromissoryNote'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ExpiryDateGuarantorPromissoryNote;
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
                if (in_array('ExpiryDateGuarantorPromissoryNote', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateGuarantorPromissoryNote')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateGuarantorPromissoryNote' id='ExpiryDateGuarantorPromissoryNote' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateGuarantorPromissoryNote'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='ExpiryDateGuarantorPromissoryNote' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='ExpiryDateGuarantorPromissoryNote' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة صورة عن هوية الضامن الاحتياطي في السند
                لأمر</label>
            <p name="hala_2"> @php
                if ($customerMySqlData->ObSupporterIdImg == 'موجود' && strtotime($today) + strtotime($fixedPeriod) < strtotime($customerMySqlData->ExpiryDateGuarantorPromissoryNote)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>


        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObFrstSeeIdImg', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ObFrstSeeIdImg'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ObFrstSeeIdImg;
                    endif;
                endforeach;
                if (in_array('ObFrstSeeIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObFrstSeeIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObFrstSeeIdImg' id='ObFrstSeeIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObFrstSeeIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                    name='ObFrstSeeIdImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpirationDateFirstWitness', [], 'ar') }}
            </label>
            @php
                
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ExpirationDateFirstWitness'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ExpirationDateFirstWitness;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('ExpirationDateFirstWitness', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpirationDateFirstWitness')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpirationDateFirstWitness' id='ExpirationDateFirstWitness' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpirationDateFirstWitness'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='ExpirationDateFirstWitness' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='ExpirationDateFirstWitness' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية الشاهد الاول في السند الامر</label>
            <p name="hala_3"> @php
                if ($customerMySqlData->ObFrstSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpirationDateFirstWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObScndSeeIdImg', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ObScndSeeIdImg'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ObScndSeeIdImg;
                    endif;
                endforeach;
                if (in_array('ObScndSeeIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObScndSeeIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObScndSeeIdImg' id='ObScndSeeIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObScndSeeIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                    name='ObScndSeeIdImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpiryDateSecondWitness', [], 'ar') }} </label>
            @php
                
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ExpiryDateSecondWitness'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ExpiryDateSecondWitness;
                    endif;
                endforeach;
                $uxDate = strtotime($whatIfData);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('ExpiryDateSecondWitness', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateSecondWitness')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateSecondWitness' id='ExpiryDateSecondWitness' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateSecondWitness'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    if ($whatIfData) {
                        echo "<input type='date' id='start'  class='form-control' value=\"$whatIfData\" name='ExpiryDateSecondWitness' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"\" name='ExpiryDateSecondWitness' />";
                    }
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية الشاهد الثانى في السند الامر</label>
            <p name="hala_4"> @php
                if ($customerMySqlData->ObScndSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateSecondWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

    </div>
</div>
