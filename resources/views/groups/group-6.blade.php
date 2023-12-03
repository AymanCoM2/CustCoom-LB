<div class="container-fluid">

    <div class="row">
        {{-- 1 --}}
        <div class="col-sm-4 {{ $errors->has('NationalAddrOrgImg') ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrOrgImg', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'NationalAddrOrgImg'])
            @endif
            @php
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

        {{-- 2 --}}
        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddress', [], 'ar') }}
                <input type="checkbox" class="unified_check_6">
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ExpiryDateNationalAddress'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateNationalAddress);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
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

        {{-- 3 --}}
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


        {{-- 4 --}}
        <div
            class="col-sm-4 sanad-g {{ $errors->has('NationalAddrFirstSupOb') && old('OrderBond') == 'موجود' ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('NationalAddrFirstSupOb', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'NationalAddrFirstSupOb'])
            @endif
            @php
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

        {{-- 5 --}}
        <div class="col-sm-4 sanad-g">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpiryDateNationalAddressReserveGuarantor', [], 'ar') }} </label>
            <input type="checkbox" class="unified_check_6">
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', [
                    'r' => $r,
                    'fdname' => 'ExpiryDateNationalAddressReserveGuarantor',
                ])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateNationalAddressReserveGuarantor);
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

        {{-- 6 --}}
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
