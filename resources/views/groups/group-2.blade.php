<div class="container-fluid ">
    <div class="row">
        {{-- 2 --}}
        <div class="col-sm-6 {{ $errors->has('OpenAccountPropose') ? 'border border-danger' : '' }} ">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('OpenAccountPropose', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'OpenAccountPropose'])
            @endif

            @php
                if (in_array('OpenAccountPropose', $allDDLColumn)):
                    echo '<div class="form-check
                                 form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OpenAccountPropose')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == old('OpenAccountPropose', $customerMySqlData->OpenAccountPropose)) {
                            $res = 'checked';
                        }
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OpenAccountPropose' id='OpenAccountPropose' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OpenAccountPropose'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->OpenAccountPropose \"
                                        name='OpenAccountPropose'>";
                endif;
            @endphp

        </div>

        {{-- 3 --}}
        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة طلب فتح الحساب</label>
            <p name="calc_g2_1">@php
                if ($customerMySqlData->CommercialRegister == 'موجود' || $customerMySqlData->CommercialRegister == 'مستثنى') {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        {{-- 4 --}}
        <div class="col-sm-6 {{ $errors->has('CommercialRegister') ? 'border border-danger' : '' }}">
            <label class="form-label bg-light w-100 fw-bold d-block">
                {{ __('CommercialRegister', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'CommercialRegister'])
            @endif
            @php
                if (in_array('CommercialRegister', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CommercialRegister')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('CommercialRegister', $customerMySqlData->CommercialRegister)) {
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
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->CommercialRegister \"
                                        name='CommercialRegister'>";
                endif;
            @endphp
        </div>

        {{-- 5  --}}
        <div class="col-sm-6 sejel">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('CRExpiryDate', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'CRExpiryDate'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->CRExpiryDate);
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

                        if ($val1->colOption == old('CRExpiryDate', $customerMySqlData->CRExpiryDate)) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='CRExpiryDate' id='CRExpiryDate' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CRExpiryDate'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"" . old('CRExpiryDate_h', $hijriData) . "\" name='CRExpiryDate_h' >";
                    if ($customerMySqlData->CRExpiryDate) {
                        echo "<input type='date' id='start'  class='form-control' value=\"" . old('CRExpiryDate', $formatted2) . "\" name='CRExpiryDate' />";
                    } else {
                        echo "<input type='date' id='start'  class='form-control' value=\"" . old('CRExpiryDate') . "\" name='CRExpiryDate' />";
                    }
                endif;
            @endphp
        </div>

        {{-- 6 --}}
        <div class="col-sm-6 sejel  {{ $errors->has('CrCnMatch') && old('CommercialRegister') == 'موجود' ? 'border border-danger' : '' }}"
            name="CrCnMatchLabel">
            <label for="" class="form-label bg-light w-100 fw-bold d-block" name="">
                {{ __('CrCnMatch', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'CrCnMatch'])
            @endif
            @php
                if (in_array('CrCnMatch', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CrCnMatch')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('CrCnMatch', $customerMySqlData->CrCnMatch)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='CrCnMatch' id='CrCnMatch' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CrCnMatch'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$customerMySqlData->CrCnMatch\"
                                        name='CrCnMatch'>";
                endif;
            @endphp
        </div>

        {{-- 7 --}}
        <div class="col-sm-6 sejel">
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

        {{-- 1 Ok  --}}
        <div class="col-sm-4">
            <label for="inputEmail4"
                class="form-label bg-light w-100 w-100 fw-bold">{{ __('GovernmentTaxIdentifier', [], 'ar') }}
                :</label>
            <p>{{ $customerSapData['LicTradNum'] }}</p>
        </div>

        {{--  --}}
        <div class="col-sm-4 {{ $errors->has('TaxCard') ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('TaxCard', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'TaxCard'])
            @endif
            @php
                if (in_array('TaxCard', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'TaxCard')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('TaxCard', $customerMySqlData->TaxCard)) {
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
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->TaxCard \"
                                        name='TaxCard'>";
                endif;
            @endphp
        </div>

        {{--  --}}
        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة البطاقة الضريبية</label>
            <p name="Rttv_dt_e"> @php
                if ($customerMySqlData->TaxCard == 'موجود' && strlen($customerSapData['LicTradNum']) == 15) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>
    </div>
</div>
