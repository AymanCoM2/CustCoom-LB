    {{-- GROUP 1  --}}
    <script></script>
    {{-- GROUP 1  --}}

    {{-- GROUP 2  --}}
    <script>
        // /////////////////////// 1 
        // حالة طلب فتح الحساب
        var calcElement_1 = $('p[name="calc_g2_1"]');
        $(':input[name="OpenAccountPropose"]').on("myCustomEvent change", function() {
            if ($(this).is(':checked')) {
                var selectedValue = $(this).val();
                // console.log("Radio button selected. Its value is: " + selectedValue);
                if (selectedValue == 'موجود' || selectedValue == 'مستثنى') {
                    calcElement_1.text('سارى');
                } else {
                    calcElement_1.text('يجب اعادة طلبه');
                }
            } else {
                console.log("Radio button unchecked.");
            }
        });

        // /////////////////////// 2 
        $(':input[name="CommercialRegister"]').on("myCustomEvent change", function() {
            if ($(this).is(':checked')) {
                var selectedValue = $(this).val();
                theMixFormulaG2_1();
                if (selectedValue == 'موجود') {
                    $(':input[name="CRExpiryDate"]').attr('required', true);
                    $(':input[name="CrCnMatch"]').attr('required', true);
                    $(':input[name="CRExpiryDate"]').addClass('border border-danger');
                    $(':input[name="CrCnMatch"]').addClass('border border-danger');
                } else {
                    $(':input[name="CRExpiryDate"]').attr('required', false);
                    $(':input[name="CrCnMatch"]').attr('required', false);
                    $(':input[name="CRExpiryDate"]').removeClass('border border-danger');
                    $(':input[name="CrCnMatch"]').removeClass('border border-danger');
                }
            } else {
                console.log("Radio button unchecked.");
            }
        });


        // /////////////////////// 3 
        $(':input[name="TaxCard"]').on("myCustomEvent change", function() {
            if ($(this).is(':checked')) {
                var selectedValue = $(this).val();
                // console.log("Radio button selected. Its value is: " + selectedValue);
                if (selectedValue == 'موجود') {
                    $('p[name="Rttv_dt_e"]').text('سارى');
                } else {
                    $('p[name="Rttv_dt_e"]').text('يجب اعادة طلبه');
                }
            } else {
                console.log("Radio button unchecked.");
            }
        });

        $(':input[name="CRExpiryDate"]').on("myCustomEvent change", function() {
            var CRExpiryDate = $(this).val();
            console.log(CRExpiryDate);
            theMixFormulaG2_1();
        });

        $(':input[name="CRExpiryDate_h"]').on("myCustomEvent blur", function() {
            setTimeout(function() {
                theMixFormulaG2_1();
            }, 100); // Adjust the delay as needed
        });

        $(':input[name="CrCnMatch"]').on("myCustomEvent change", function() {
            theMixFormulaG2_1();
        });

        function theMixFormulaG2_1() {
            let fixedPeriod = 1;
            let date_2_22 = $(':input[name="CRExpiryDate"]').val();
            console.log('Gorgy Now  : ', date_2_22);
            var check_2_1 = $('input[name="CommercialRegister"]:checked').val();
            var check_2_2 = $('input[name="CrCnMatch"]:checked').val();
            var todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            var theirDate_345 = new Date(date_2_22);
            if ((theirDate_345 > todayExtraFixed) && (check_2_1 == 'موجود') && (check_2_2 == 'مطابق')) {
                $('p[name="calc_g2_2"]').text('سارى');
            } else {
                $('p[name="calc_g2_2"]').text('يجب اعادة طلبه');
            }
        }
    </script>
    {{-- GROUP 2  --}}
