<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light w-100 fw-bold">Creation Date :</label>
            <p>{{ $customerSapData['CreateDate'] }}</p>
        </div>
        <div class="col-sm-6">
            <label for="inputEmail4" class="form-label bg-light  w-100 fw-bold">Group :</label>
            <p>{{ $customerSapData['GroupName'] }}</p>
        </div>
        <div class="col-sm-6">
            <label for="inputPassword4" class="form-label bg-light  w-100 fw-bold"> {{ __('CardCode', [], 'ar') }}
            </label>
            <p>{{ $customerSapData['CardCode'] }} </p>
        </div>
        <div class="col-sm-6">
            <label for="inputPassword4" class="form-label bg-light  w-100 fw-bold"> {{ __('CardName', [], 'ar') }}
            </label>
            <p>{{ $customerSapData['CardName'] }} </p>
        </div>

        <div class="col-sm-6">
            <label for="" class="form-label bg-light  w-100 fw-bold d-block"> {{ __('CustomerType', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CustomerType'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CustomerType;
                    endif;
                endforeach;
                
                if (in_array('CustomerType', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CustomerType')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>' ; 
                        echo "<input class='form-check-inline m-2' type='radio' name='CustomerType' id='CustomerType' $res  value=\"$val1->colOption\" />";
                        echo "<label class=\"form-check-label\" for='CustomerType'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>' ; 
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='CustomerType'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-6">
            <label for="" class="form-input-label bg-light  w-100 fw-bold"> {{ __('CustomerName', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'CustomerName'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->CustomerName;
                    endif;
                endforeach;
                if (in_array('CustomerName', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'CustomerName')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo "<input class='form-check-inline m-2' type='radio' name='CustomerName' id='CustomerName' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='CustomerName'>";
                        echo $val1->colOption;
                        echo '</label>';
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='CustomerName'>";
                endif;
            @endphp
        </div>

        <div class="col-sm-12">
            <label for="" class="form-input-label bg-light  w-100 fw-bold"> {{ __('OrgLegalStatue', [], 'ar') }}
            </label>
            @php
                foreach ($r as $singleEditArray):
                    if ($singleEditArray['fieldName'] == 'OrgLegalStatue'):
                        $whatIfData = $singleEditArray['newValue'];
                        break;
                    else:
                        $whatIfData = $customerMySqlData->OrgLegalStatue;
                    endif;
                endforeach;
                if (in_array('OrgLegalStatue', $allDDLColumn)):
                    echo '<div class="form-check form-check-inline">';
                    $allOptions = App\Models\ColumnOption::where('colName', 'OrgLegalStatue')->get();
                    foreach ($allOptions as $k1 => $val1):
                        $res = '';
                        if ($val1->colOption == $whatIfData) {
                            $res = 'checked';
                        }
                        echo '<div>' ; 
                        echo "<input class='form-check-inline m-2' type='radio' name='OrgLegalStatue' id='OrgLegalStatue' $res  value=\"$val1->colOption\" />";
                        echo "<label class='form-check-label' for='OrgLegalStatue'>";
                        echo $val1->colOption;
                        echo '</label>';
                        echo '</div>' ; 
                    endforeach;
                    echo '</div>';
                else:
                    echo "<input type='text' class='form-control' value=\"$whatIfData\"
                                        name='OrgLegalStatue'>";
                endif;
            @endphp
        </div>
    </div>
</div>
