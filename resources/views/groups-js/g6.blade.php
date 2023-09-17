{{-- GROUP 6  --}}
<script>
    $(':input[name="NationalAddrOrgImg"]').change(function() {
        firstCombination();
        var selectedValue = $(this).val();
        if (selectedValue == 'موجود') {
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
        if (selectedValue == 'موجود') {
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
