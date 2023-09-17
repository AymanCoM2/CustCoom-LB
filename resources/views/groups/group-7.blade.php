<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('CustomerLocation', [], 'ar') }} </label>
            @php
                
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'CustomerLocation'):
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
                endif;
                if (in_array('CustomerLocation', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CustomerLocation')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $customerMySqlData->CustomerLocation) {
                            $res = 'checked';
                        }
                        //    echo $val1->colOption ;
                        echo "<input class='form-check-inline m-2' type='radio' name='CustomerLocation' id='CustomerLocation' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CustomerLocation'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"" . old('CustomerLocation', $customerMySqlData->CustomerLocation) . "\" name='CustomerLocation'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-input-label bg-light w-100 fw-bold"> {{ __('Branches', [], 'ar') }} </label>
            @php
                
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'Branches'):
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
                endif;
                if (in_array('Branches', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'Branches')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $customerMySqlData->Branches) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='Branches' id='Branches' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='Branches'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"" . old('Branches', $customerMySqlData->Branches) . "\" name='Branches'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-input-label bg-light w-100 fw-bold">
                {{ __('ValueBondOrExceptionBranches', [], 'ar') }}
            </label>
            @php
                
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'ValueBondOrExceptionBranches'):
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
                endif;
                if (in_array('ValueBondOrExceptionBranches', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ValueBondOrExceptionBranches')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $customerMySqlData->ValueBondOrExceptionBranches) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='ValueBondOrExceptionBranches' id='ValueBondOrExceptionBranches' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='ValueBondOrExceptionBranches'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"" . old('ValueBondOrExceptionBranches', $customerMySqlData->ValueBondOrExceptionBranches) . "\" name='ValueBondOrExceptionBranches'>";
                endif;
            @endphp
        </div>

        
        <div class="col-sm-12">
            <label for="" class="form-input-label bg-light w-100 fw-bold"> {{ __('Notes', [], 'ar') }} </label>
            @php
                
                if (Auth::user()->isSuperUser == 1):
                    foreach ($r as $singleEditArray):
                        if ($singleEditArray['fieldName'] == 'Notes'):
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
                endif;
                if (in_array('Notes', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'Notes')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $customerMySqlData->Notes) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='Notes' id='Notes' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='Notes'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<textarea class='form-control' name='Notes' rows='3'>" . old('Notes', $customerMySqlData->Notes) . '</textarea>';
                endif;
            @endphp
        </div>
    </div>
</div>
