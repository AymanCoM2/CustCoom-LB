<div class="container-fluid">

    <div class="row">
        <div class="col-sm-4 {{ $errors->has('NationalAddrOrgImg') ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrOrgImg', [], 'ar') }}
            </label>
            @php
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'NationalAddrOrgImg'):
                            $data = 'Old Value : ' . $singleEditArray['oldValue'] . ' ,,New Value : ' . $singleEditArray['newValue'];
                            $data2 = ',,Editor Name : ' . App\Models\User::find($singleEditArray['editor_id'])->first()->name;
                            $fullData = $data . $data2;
                            // dd($fullData)  ;
                
                            echo "<a class=\"al\" href=''
                                           onclick=\"event.preventDefault();
                                                         document.getElementById('approval').setAttribute('value'" .
                                ',' .
                                $singleEditArray['id'] .
                                ");
                                                         document.getElementById('logout-form').submit();\">";
                            echo 'Dis-Approve';
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
                endif;
                if (in_array('NationalAddrOrgImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'NationalAddrOrgImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                
                        if ($val1->colOption == old('NationalAddrOrgImg', $customerMySqlData->NationalAddrOrgImg)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='NationalAddrOrgImg' id='NationalAddrOrgImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='NationalAddrOrgImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->NationalAddrOrgImg \"
                                        name='NationalAddrOrgImg'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddress', [], 'ar') }}
            </label>
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateNationalAddress);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                // dd($hijriData);
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'ExpiryDateNationalAddress'):
                            $data = 'Old Value : ' . $singleEditArray['oldValue'] . ' ,,New Value : ' . $singleEditArray['newValue'];
                            $data2 = ',,Editor Name : ' . App\Models\User::find($singleEditArray['editor_id'])->first()->name;
                            $fullData = $data . $data2;
                            // dd($fullData)  ;
                
                            echo "<a class=\"al\" href=''
                                           onclick=\"event.preventDefault();
                                                         document.getElementById('approval').setAttribute('value'" .
                                ',' .
                                $singleEditArray['id'] .
                                ");
                                                         document.getElementById('logout-form').submit();\">";
                            echo 'Dis-Approve';
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
                endif;
                if (in_array('ExpiryDateNationalAddress', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateNationalAddress')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                
                        if ($val1->colOption == old('ExpiryDateNationalAddress', $customerMySqlData->ExpiryDateNationalAddress)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateNationalAddress' id='ExpiryDateNationalAddress' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateNationalAddress'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpiryDateNationalAddress_h = old('ExpiryDateNationalAddress_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpiryDateNationalAddress_h\" name='ExpiryDateNationalAddress_h' >";
                    $oldExpiryDateNationalAddress = old('ExpiryDateNationalAddress', $customerMySqlData->ExpiryDateNationalAddress ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpiryDateNationalAddress\" name='ExpiryDateNationalAddress' />";
                endif;
            @endphp
        </div>

        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold"> حالة العنوان الوطنى للمؤسسة</label>
            <p name='hala_12'> @php
                if ($customerMySqlData->NationalAddrOrgImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateNationalAddress) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        <div
            class="col-sm-4 sanad-g {{ $errors->has('NationalAddrFirstSupOb') && old('OrderBond') == 'موجود' ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrFirstSupOb', [], 'ar') }}
            </label>
            @php
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'NationalAddrFirstSupOb'):
                            $data = 'Old Value : ' . $singleEditArray['oldValue'] . ' ,,New Value : ' . $singleEditArray['newValue'];
                            $data2 = ',,Editor Name : ' . App\Models\User::find($singleEditArray['editor_id'])->first()->name;
                            $fullData = $data . $data2;
                            // dd($fullData)  ;
                
                            echo "<a class=\"al\" href=''
                                           onclick=\"event.preventDefault();
                                                         document.getElementById('approval').setAttribute('value'" .
                                ',' .
                                $singleEditArray['id'] .
                                ");
                                                         document.getElementById('logout-form').submit();\">";
                            echo 'Dis-Approve';
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
                endif;
                if (in_array('NationalAddrFirstSupOb', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'NationalAddrFirstSupOb')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                
                        if ($val1->colOption == old('NationalAddrFirstSupOb', $customerMySqlData->NationalAddrFirstSupOb)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='NationalAddrFirstSupOb' id='NationalAddrFirstSupOb' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='NationalAddrFirstSupOb'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->NationalAddrFirstSupOb \"
                                        name='NationalAddrFirstSupOb'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-4 sanad-g">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddressReserveGuarantor', [], 'ar') }} </label>
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateNationalAddressReserveGuarantor);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'ExpiryDateNationalAddressReserveGuarantor'):
                            $data = 'Old Value : ' . $singleEditArray['oldValue'] . ' ,,New Value : ' . $singleEditArray['newValue'];
                            $data2 = ',,Editor Name : ' . App\Models\User::find($singleEditArray['editor_id'])->first()->name;
                            $fullData = $data . $data2;
                            // dd($fullData)  ;
                
                            echo "<a class=\"al\" href=''
                                           onclick=\"event.preventDefault();
                                                         document.getElementById('approval').setAttribute('value'" .
                                ',' .
                                $singleEditArray['id'] .
                                ");
                                                         document.getElementById('logout-form').submit();\">";
                            echo 'Dis-Approve';
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
                endif;
                if (in_array('ExpiryDateNationalAddressReserveGuarantor', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateNationalAddressReserveGuarantor')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                
                        if ($val1->colOption == old('ExpiryDateNationalAddressReserveGuarantor', $customerMySqlData->ExpiryDateNationalAddressReserveGuarantor)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateNationalAddressReserveGuarantor' id='ExpiryDateNationalAddressReserveGuarantor' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateNationalAddressReserveGuarantor'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpiryDateNationalAddressReserveGuarantor_h = old('ExpiryDateNationalAddressReserveGuarantor_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpiryDateNationalAddressReserveGuarantor_h\" name='ExpiryDateNationalAddressReserveGuarantor_h'>";
                    $oldExpiryDateNationalAddressReserveGuarantor = old('ExpiryDateNationalAddressReserveGuarantor', $customerMySqlData->ExpiryDateNationalAddressReserveGuarantor ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpiryDateNationalAddressReserveGuarantor\" name='ExpiryDateNationalAddressReserveGuarantor' />";
                endif;
            @endphp
        </div>

        <div class="col-sm-4 sanad-g">
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
