<div class="container-fluid">
    <div class="row">
        {{--  --}}
        <div class="col-sm-4 {{ $errors->has('CommLicense') ? 'border border-danger' : '' }}">
            <label for="" class="form-label bg-light w-100 fw-bold d-block"> {{ __('CommLicense', [], 'ar') }}
            </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'CommLicense'])
            @endif
            @php
                if (in_array('CommLicense', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CommLicense')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == old('CommLicense', $customerMySqlData->CommLicense)) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo '<div>';
                        echo "<input class='form-check-inline m-2' type='radio' name='CommLicense' id='CommLicense' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CommLicense'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$customerMySqlData->CommLicense\"
                                    name='CommLicense'>";
                endif;
            @endphp
        </div>

        {{--  --}}
        <div class="col-sm-4">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('ExpirydateCommlicense', [], 'ar') }} </label>
            @if (Auth::user()->isSuperUser == 1)
                @include('single.q-mark', ['r' => $r, 'fdname' => 'ExpirydateCommlicense'])
            @endif
            @php
                $uxDate = strtotime($customerMySqlData->ExpirydateCommlicense);
                $formatted = date('d-m-Y', $uxDate);
                $formatted2 = date('Y-m-d', $uxDate);
                $baseLink = 'http://api.aladhan.com/v1/gToH/' . $formatted;
                $response = Http::get($baseLink);
                $resBody = $response->json();
                $hijriData = $resBody['data']['hijri']['date']; // 8-14-2023 = GET Hijri ,DD-MM-YYYY
                if (in_array('ExpirydateCommlicense', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ExpirydateCommlicense')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $customerMySqlData->ExpirydateCommlicense) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='ExpirydateCommlicense' id='ExpirydateCommlicense' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='ExpirydateCommlicense'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    $oldExpirydateCommlicense_h = old('ExpirydateCommlicense_h', $hijriData);
                    echo "<input type='text' class='form-control' value=\"$oldExpirydateCommlicense_h\" name='ExpirydateCommlicense_h' >";
                    $oldExpirydateCommlicense = old('ExpirydateCommlicense', $customerMySqlData->ExpirydateCommlicense ? $formatted2 : '');
                    echo "<input type='date' id='start'  class='form-control' value=\"$oldExpirydateCommlicense\" name='ExpirydateCommlicense' />";
                endif;
            @endphp
        </div>

        {{--  --}}
        <div class="col-sm-4">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">حالة رخصة النشاط التجارى </label>
            <p name="hyf56_34"> @php
                if (strtotime($customerMySqlData->ExpirydateCommlicense) > strtotime($today) + strtotime($fixedPeriod)) {
                    echo 'سارى';
                } else {
                    echo 'يجب اعادة طلبه';
                }
            @endphp</p>
        </div>
    </div>
</div>
