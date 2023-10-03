{{-- GROUP 6  --}}
<script>
    $('.unified_check_6').on('change', function() {
        // Find the nearest radio button
        var nearestRadio = $(this).closest('.row').find('input[type="radio"]:checked');
        // Check if the nearest radio button's value is "موجود"
        if (nearestRadio.val() === 'موجود' && $(this).prop("checked")) {
            // alert('The nearest radio button value is موجود');
            $(this).closest('.col-sm-4').find('input[type="date"]').attr('required', true);
            $(this).closest('.col-sm-4').find('input[type="date"]').addClass('border border-danger');
            $(this).closest('.col-sm-4').find('input[type="date"]').prop('disabled', false);
        } else {
            // alert('The nearest radio button value is something else');
            $(this).closest('.col-sm-4').find('input[type="date"]').attr('required', false);
            $(this).closest('.col-sm-4').find('input[type="date"]').removeClass('border border-danger');
            $(this).closest('.col-sm-4').find('input[type="date"]').val('');
            // $(':input[name="OwnerIDExpiryDate_h"]').val('');
            $(this).closest('.col-sm-4').find('input[type="date"]').prop('disabled', true);
        }
    });

    $(':input[name="NationalAddrOrgImg"]').change(function() {
        firstCombination();
        var selectedValue = $(this).val();
        var checkboxValue_1 = $(this).closest('.row').find('.unified_check_6').prop("checked");
        if (selectedValue == 'موجود' & checkboxValue_1) {
            $(':input[name="ExpiryDateNationalAddress"]').attr('required', true);
            $(':input[name="ExpiryDateNationalAddress"]').addClass('border border-danger');
            $(':input[name="ExpiryDateNationalAddress"]').prop('disabled', false);
        } else {
            $(':input[name="ExpiryDateNationalAddress"]').attr('required', false);
            $(':input[name="ExpiryDateNationalAddress"]').removeClass('border border-danger');
            $(':input[name="ExpiryDateNationalAddress"]').val('');
            $(':input[name="ExpiryDateNationalAddress_h"]').val('');
            $(':input[name="ExpiryDateNationalAddress"]').prop('disabled', true);
        }
    });

    $(':input[name="ExpiryDateNationalAddress"]').change(function() {
        firstCombination();
    });
    $(':input[name="ExpiryDateNationalAddress_h"]').on('blur', function() {
        setTimeout(function() {
            firstCombination();
        }, 100); // Adjust the delay as needed
    });

    $(':input[name="NationalAddrFirstSupOb"]').change(function() {
        secondCombination();
        var selectedValue = $(this).val();
        var checkboxValue_1 = $(this).closest('.row').find('.unified_check_6').prop("checked");
        if (selectedValue == 'موجود' & checkboxValue_1) {
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').attr('required', true);
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').addClass('border border-danger');
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').prop('disabled', false);
        } else {
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').attr('required', false);
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').removeClass(
                'border border-danger');
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').val('');
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor_h"]').val('');
            $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').prop('disabled', true);
        }
    });

    $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').change(function() {
        secondCombination();
    });
    $(':input[name="ExpiryDateNationalAddressReserveGuarantor_h"]').on('blur', function() {
        setTimeout(function() {
            secondCombination();
        }, 100); // Adjust the delay as needed
    });

    function firstCombination() {
        let fixedPeriod = 1;
        let date_5_1 = $(':input[name="ExpiryDateNationalAddress"]').val();
        let check_5_2 = $('input[name="NationalAddrOrgImg"]:checked').val();
        let todayExtraFixed = new Date();
        todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
        let theirDate_345 = new Date(date_5_1);
        if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
            $('p[name="hala_12"]').text('سارى');
        } else {
            $('p[name="hala_12"]').text('يجب اعادة طلبه');
        }
    }

    function secondCombination() {
        let fixedPeriod = 1;
        let date_5_1 = $(':input[name="ExpiryDateNationalAddressReserveGuarantor"]').val();
        let check_5_2 = $('input[name="NationalAddrFirstSupOb"]:checked').val();
        let todayExtraFixed = new Date();
        todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
        let theirDate_345 = new Date(date_5_1);
        if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
            $('p[name="hala_22"]').text('سارى');
        } else {
            $('p[name="hala_22"]').text('يجب اعادة طلبه');
        }
    }
</script>
{{-- GROUP 6  --}}
