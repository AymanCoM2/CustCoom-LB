<div class="container-fluid">
    <div class="row">

        {{-- 1 --}}
        <div class="col-sm-4 {{ $errors->has('OwnerImg') ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('OwnerImg', [], 'ar') }} </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'OwnerImg'])
            @endif
            @php
                if (in_array('OwnerImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OwnerImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('OwnerImg', $customerMySqlData->OwnerImg)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OwnerImg' id='OwnerImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OwnerImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->OwnerImg \"
                                    name='OwnerImg'>";
                endif;
            @endphp
        </div>

        {{-- 2 --}}
        <div class="col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('OwnerIDExpiryDate', [], 'ar') }}
                <input type="checkbox" class="unified_check">
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'OwnerIDExpiryDate'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->OwnerIDExpiryDate);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('OwnerIDExpiryDate', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OwnerIDExpiryDate')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('OwnerIDExpiryDate', $customerMySqlData->OwnerIDExpiryDate)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='OwnerIDExpiryDate' id='OwnerIDExpiryDate' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='OwnerIDExpiryDate'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldOwnerIDExpiryDate_h = old('OwnerIDExpiryDate_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldOwnerIDExpiryDate_h\" name='OwnerIDExpiryDate_h' >";
                    $oldOwnerIDExpiryDate = old('OwnerIDExpiryDate', $customerMySqlData->OwnerIDExpiryDate ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldOwnerIDExpiryDate\" name='OwnerIDExpiryDate' />";
                endif;
            @endphp
        </div>


        {{-- 3 --}}
        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية المالك</label>
            <p name='hala_1'> @php
                if (strtotime($customerMySqlData->OwnerIDExpiryDate) > strtotime($today) + strtotime($fixedPeriod) && $customerMySqlData->OwnerImg == 'موجود') {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        {{-- 4 --}}
        <div
            class="sanad-g col-sm-4 {{ $errors->has('ObSupporterIdImg') && old('OrderBond') == 'موجود' ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObSupporterIdImg', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ObSupporterIdImg'])
            @endif
            @php
                if (in_array('ObSupporterIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObSupporterIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('ObSupporterIdImg', $customerMySqlData->ObSupporterIdImg)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObSupporterIdImg' id='ObSupporterIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObSupporterIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->ObSupporterIdImg \"
                                    name='ObSupporterIdImg'>";
                endif;
            @endphp
        </div>

        {{-- 5 --}}
        <div class="sanad-g col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpiryDateGuarantorPromissoryNote', [], 'ar') }}
                <input type="checkbox" class="unified_check">
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ExpiryDateGuarantorPromissoryNote'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateGuarantorPromissoryNote);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('ExpiryDateGuarantorPromissoryNote', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpiryDateGuarantorPromissoryNote')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('ExpiryDateGuarantorPromissoryNote', $customerMySqlData->ExpiryDateGuarantorPromissoryNote)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateGuarantorPromissoryNote' id='ExpiryDateGuarantorPromissoryNote' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateGuarantorPromissoryNote'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpiryDateGuarantorPromissoryNote_h = old('ExpiryDateGuarantorPromissoryNote_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpiryDateGuarantorPromissoryNote_h\" name='ExpiryDateGuarantorPromissoryNote_h' >";

                    $oldExpiryDateGuarantorPromissoryNote = old('ExpiryDateGuarantorPromissoryNote', $customerMySqlData->ExpiryDateGuarantorPromissoryNote ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpiryDateGuarantorPromissoryNote\" name='ExpiryDateGuarantorPromissoryNote' />";
                endif;
            @endphp
        </div>

        {{-- 6 --}}
        <div class="sanad-g col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة صورة عن هوية الضامن الاحتياطي في السند
                لأمر</label>
            <p name='hala_2'> @php
                if ($customerMySqlData->ObSupporterIdImg == 'موجود' && strtotime($today) + strtotime($fixedPeriod) < strtotime($customerMySqlData->ExpiryDateGuarantorPromissoryNote)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

        {{-- 7 --}}
        <div
            class="sanad-g col-sm-4 {{ $errors->has('ObFrstSeeIdImg') && old('OrderBond') == 'موجود' ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObFrstSeeIdImg', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ObFrstSeeIdImg'])
            @endif
            @php
                if (in_array('ObFrstSeeIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObFrstSeeIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('ObFrstSeeIdImg', $customerMySqlData->ObFrstSeeIdImg)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObFrstSeeIdImg' id='ObFrstSeeIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObFrstSeeIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->ObFrstSeeIdImg \"
                                    name='ObFrstSeeIdImg'>";
                endif;
            @endphp
        </div>

        {{-- 8 --}}
        <div class="sanad-g col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpirationDateFirstWitness', [], 'ar') }}
                <input type="checkbox" class="unified_check">
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ExpirationDateFirstWitness'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpirationDateFirstWitness);
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

                        if ($val1->colOption == old('ExpirationDateFirstWitness', $customerMySqlData->ExpirationDateFirstWitness)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpirationDateFirstWitness' id='ExpirationDateFirstWitness' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpirationDateFirstWitness'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpirationDateFirstWitness_h = old('ExpirationDateFirstWitness_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpirationDateFirstWitness_h\" name='ExpirationDateFirstWitness_h' >";
                    $oldExpirationDateFirstWitness = old('ExpirationDateFirstWitness', $customerMySqlData->ExpirationDateFirstWitness ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpirationDateFirstWitness\" name='ExpirationDateFirstWitness' />";
                endif;
            @endphp
        </div>


        {{-- 9 --}}
        <div class="sanad-g col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية الشاهد الاول في السند الامر</label>
            <p name="hala_3"> @php
                if ($customerMySqlData->ObFrstSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpirationDateFirstWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>


        {{-- 10 --}}
        <div
            class="sanad-g col-sm-4 {{ $errors->has('ObScndSeeIdImg') && old('OrderBond') == 'موجود' ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light fw-bold d-block"> {{ __('ObScndSeeIdImg', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ObScndSeeIdImg'])
            @endif
            @php
                if (in_array('ObScndSeeIdImg', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ObScndSeeIdImg')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';

                        if ($val1->colOption == old('ObScndSeeIdImg', $customerMySqlData->ObScndSeeIdImg)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ObScndSeeIdImg' id='ObScndSeeIdImg' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ObScndSeeIdImg'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\" $customerMySqlData->ObScndSeeIdImg \"
                                    name='ObScndSeeIdImg'>";
                endif;
            @endphp
        </div>


        {{-- 11 --}}
        <div class="sanad-g col-sm-4">
            <label for="" class="form-label bg-light fw-bold d-block">
                {{ __('ExpiryDateSecondWitness', [], 'ar') }}
                <input type="checkbox" class="unified_check">
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ExpiryDateSecondWitness'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpiryDateSecondWitness);
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

                        if ($val1->colOption == old('ExpiryDateSecondWitness', $customerMySqlData->ExpiryDateSecondWitness)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpiryDateSecondWitness' id='ExpiryDateSecondWitness' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpiryDateSecondWitness'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpiryDateSecondWitness_h = old('ExpiryDateSecondWitness_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpiryDateSecondWitness_h\" name='ExpiryDateSecondWitness_h' >";
                    $oldExpiryDateSecondWitness = old('ExpiryDateSecondWitness', $customerMySqlData->ExpiryDateSecondWitness ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpiryDateSecondWitness\" name='ExpiryDateSecondWitness' />";
                endif;
            @endphp
        </div>

        {{-- 12 --}}
        <div class="sanad-g col-sm-4">
            <label for="inputEmail4" class="form-label bg-light fw-bold"> حالة هوية الشاهد الثانى في السند الامر</label>
            <p p name="hala_4"> @php
                if ($customerMySqlData->ObScndSeeIdImg == 'موجود' && strtotime($customerMySqlData->ExpiryDateSecondWitness) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>

    </div>
</div>
