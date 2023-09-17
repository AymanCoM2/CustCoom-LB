<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6">
            <label for="" class="form-label bg-light w-100 fw-bold d-block">
                {{ __('CustomerLocation', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CustomerLocation'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CustomerLocation;
                    endif;
                endforeach;
                if (in_array('CustomerLocation', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CustomerLocation')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
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
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='CustomerLocation'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-input-label bg-light w-100 fw-bold"> {{ __('Branches', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'Branches'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->Branches;
                    endif;
                endforeach;
                if (in_array('Branches', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'Branches')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='Branches' id='Branches' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='Branches'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='Branches'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-input-label bg-light w-100 fw-bold">
                {{ __('ValueBondOrExceptionBranches', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'ValueBondOrExceptionBranches'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->ValueBondOrExceptionBranches;
                    endif;
                endforeach;
                if (in_array('ValueBondOrExceptionBranches', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'ValueBondOrExceptionBranches')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='ValueBondOrExceptionBranches' id='ValueBondOrExceptionBranches' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='ValueBondOrExceptionBranches'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='ValueBondOrExceptionBranches'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-12">
            <label for="" class="form-input-label bg-light w-100 fw-bold"> {{ __('Notes', [], 'ar') }} </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'Notes'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->Notes;
                    endif;
                endforeach;
                if (in_array('Notes', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'Notes')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='Notes' id='Notes' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='Notes'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<textarea class='form-control' name='Notes' rows='3'>$whatIfData</textarea>";
                endif;
            @endphp
        </div>
    </div>
</div>
