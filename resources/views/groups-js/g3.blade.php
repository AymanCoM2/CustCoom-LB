{{-- GROUP 3  --}}
<script>
    // RADIO BUTTON 
    $(':input[name="CommLicense"]').change(function() {
        var selectedValue = $(this).val();
        theMixFormulaG3_1();
        if (selectedValue == 'موجود') {
            $(':input[name="ExpirydateCommlicense"]').attr('required', true);
            $(':input[name="ExpirydateCommlicense"]').addClass('border border-danger');
        } else {
            $(':input[name="ExpirydateCommlicense"]').attr('required', false);
            $(':input[name="ExpirydateCommlicense"]').removeClass('border border-danger');
            $(':input[name="ExpirydateCommlicense"]').val(''); 
        }
    });

    // DATE input 
    $(':input[name="ExpirydateCommlicense"]').change(function() {
        var ExpirydateCommlicense = $(this).val();
        theMixFormulaG3_1()
    });

    $(':input[name="ExpirydateCommlicense_h"]').on('blur', function() {
            setTimeout(function() {
                theMixFormulaG3_1();
            }, 100); // Adjust the delay as needed
        });

    function theMixFormulaG3_1() {
        let fixedPeriod = 1;
        let date_3_1 = $(':input[name="ExpirydateCommlicense"]').val();
        var check_3_2 = $('input[name="CommLicense"]:checked').val();
        var todayExtraFixed = new Date();
        todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
        var theirDate_345 = new Date(date_3_1);
        // today.setMonth(today.getMonth() + fixedPeriod);
        // console.log(today.toISOString().substr(0, 10));
        if ((theirDate_345 > todayExtraFixed) && (check_3_2 == 'موجود')) {
            $('p[name="hyf56_34"]').text('سارى');
        } else {
            $('p[name="hyf56_34"]').text('يجب اعادة طلبه');
        }
    }
</script>
{{-- GROUP 3  --}}
