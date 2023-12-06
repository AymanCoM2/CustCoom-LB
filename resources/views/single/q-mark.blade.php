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
            $fullData = $fullData . $fieldId;
            break;
        endif;
    endforeach;
@endphp

@if ($fullData != null)
    <button type="button" class="btn btn-danger p-1 m-0" data-bs-toggle="modal"
        data-bs-target="#approveModal-{{ $fieldId }}">
        Dis-Approver
    </button>

    <div class='col-6'>
        <span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='{{ $fullData }}' data-bs-html='true'>
            <input type="hidden" id="">
            <button class='btn btn-danger w-50 p-0 m-2' style='pointer-events: none;' type='button' disabled>
                <i class='bx bx-question-mark'></i>
            </button>
        </span>
    </div>

    <div class="modal fade" id="approveModal-{{ $fieldId }}" tabindex="-1" aria-labelledby="approveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="somekind" cols="30" rows="5" class="w-100"></textarea>
                    <input type="hidden" id="{{ $fieldId }}" value="{{ $fieldId }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="al btn btn-primary"
                        onclick="event.preventDefault();
    document.getElementById('approval').setAttribute('value', document.getElementById('{{ $fieldId }}').value);
    document.getElementById('reason').setAttribute('value', document.getElementById('somekind').value);
    document.getElementById('logout-form').submit();">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
