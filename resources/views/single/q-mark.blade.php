{{-- $r , the-field-name , [[ OutPuts : $fullData , $singleEditArray['id'] ]] --}}
@php
    $fieldId = null;
    $fullData = null;
    foreach ($r as $singleEditArray):
        if ($singleEditArray['fieldName'] == $fdname):
            $data = 'Old Value : ' . $singleEditArray['oldValue'] . '<br>New Value:' . $singleEditArray['newValue'];
            $data2 = '<br>Editor Name:' . App\Models\User::find($singleEditArray)->first()->name;
            $fullData = $data . $data2;
            $fieldId = $singleEditArray['id'];
            break;
        endif;
    endforeach;
@endphp

@if ($fullData != null)
    <a class="al"
        onclick="event.preventDefault();
document.getElementById('approval').setAttribute('value', '{{ $fieldId }}');
document.getElementById('logout-form').submit();">
        Dis-Approve
    </a>

    <div class='col-6'>
        <span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='{{ $fullData }}' data-bs-html='true'>
            <button class='btn btn-danger w-50 p-0 m-2' style='pointer-events: none;' type='button' disabled>
                <i class='bx bx-question-mark'></i>
            </button>
        </span>
    </div>
@endif
