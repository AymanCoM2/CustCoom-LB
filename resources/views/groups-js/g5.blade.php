    {{-- GROUP 5  --}}
    <script>
        $('.unified_check').on("myCustomEvent change", function() {
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


        // Radio 
        $(':input[name="OwnerImg"]').on("myCustomEvent change", function() {
            firstCouple();
            var selectedValue = $(this).val();
            var checkboxValue_1 = $(this).closest('.row').find('.unified_check').prop("checked");
            if (selectedValue == 'موجود' && checkboxValue_1) {
                $(':input[name="OwnerIDExpiryDate"]').attr('required', true);
                $(':input[name="OwnerIDExpiryDate"]').addClass('border border-danger');
                $(':input[name="OwnerIDExpiryDate"]').prop('disabled', false);
            } else {
                $(':input[name="OwnerIDExpiryDate"]').attr('required', false);
                $(':input[name="OwnerIDExpiryDate"]').removeClass('border border-danger');
                $(':input[name="OwnerIDExpiryDate"]').val('');
                $(':input[name="OwnerIDExpiryDate_h"]').val('');
                $(':input[name="OwnerIDExpiryDate"]').prop('disabled', true);
            }
        });

        // DATE input 
        $(':input[name="OwnerIDExpiryDate"]').on("myCustomEvent change", function() {
            firstCouple();
        });
        $(':input[name="OwnerIDExpiryDate_h"]').on("myCustomEvent blur", function() {
            setTimeout(function() {
                firstCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObSupporterIdImg"]').on("myCustomEvent change", function() {
            secondCouple();
            var selectedValue = $(this).val();
            var checkboxValue_1 = $(this).closest('.row').find('.unified_check').prop("checked");
            if (selectedValue == 'موجود' & checkboxValue_1) {
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').attr('required', true);
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').addClass('border border-danger');
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').prop('disabled', false);
            } else {
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').attr('required', false);
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').removeClass('border border-danger');
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').val('');
                $(':input[name="ExpiryDateGuarantorPromissoryNote_h"]').val('');
                $(':input[name="ExpiryDateGuarantorPromissoryNote"]').prop('disabled', true);

            }
        });

        // DATE input 
        $(':input[name="ExpiryDateGuarantorPromissoryNote"]').on("myCustomEvent change", function() {
            secondCouple();
        });
        $(':input[name="ExpiryDateGuarantorPromissoryNote_h"]').on("myCustomEvent blur", function() {
            setTimeout(function() {
                secondCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObFrstSeeIdImg"]').on("myCustomEvent change", function() {
            thirdCouple();
            var selectedValue = $(this).val();
            var checkboxValue_1 = $(this).closest('.row').find('.unified_check').prop("checked");
            if (selectedValue == 'موجود' & checkboxValue_1) {
                // $('p[name="hala_3"]').text('سارى');
                $(':input[name="ExpirationDateFirstWitness"]').attr('required', true);
                $(':input[name="ExpirationDateFirstWitness"]').addClass('border border-danger');
                $(':input[name="ExpirationDateFirstWitness"]').prop('disabled', false);

            } else {
                // $('p[name="hala_3"]').text('يجب اعادة طلبه');
                $(':input[name="ExpirationDateFirstWitness"]').attr('required', false);
                $(':input[name="ExpirationDateFirstWitness"]').removeClass('border border-danger');
                $(':input[name="ExpirationDateFirstWitness"]').val('');
                $(':input[name="ExpirationDateFirstWitness_h"]').val('');
                $(':input[name="ExpirationDateFirstWitness"]').prop('disabled', true);
            }
        });

        // DATE input 
        $(':input[name="ExpirationDateFirstWitness"]').on("myCustomEvent change", function() {
            thirdCouple();
        });
        $(':input[name="ExpirationDateFirstWitness_h"]').on("myCustomEvent blur", function() {
            setTimeout(function() {
                thirdCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObScndSeeIdImg"]').on("myCustomEvent change", function() {
            fourthCouple();
            var selectedValue = $(this).val();
            var checkboxValue_1 = $(this).closest('.row').find('.unified_check').prop("checked");
            if (selectedValue == 'موجود' & checkboxValue_1) {
                $(':input[name="ExpiryDateSecondWitness"]').attr('required', true);
                $(':input[name="ExpiryDateSecondWitness"]').addClass('border border-danger');
                $(':input[name="ExpiryDateSecondWitness"]').prop('disabled', false);
            } else {
                $(':input[name="ExpiryDateSecondWitness"]').attr('required', false);
                $(':input[name="ExpiryDateSecondWitness"]').removeClass('border border-danger');
                $(':input[name="ExpiryDateSecondWitness"]').val('');
                $(':input[name="ExpiryDateSecondWitness_h"]').val('');
                $(':input[name="ExpiryDateSecondWitness"]').prop('disabled', true);
            }
        });

        // DATE input 
        $(':input[name="ExpiryDateSecondWitness"]').on("myCustomEvent change", function() {
            fourthCouple();
        });
        $(':input[name="ExpiryDateSecondWitness_h"]').on("myCustomEvent blur", function() {
            setTimeout(function() {
                fourthCouple();
            }, 100); // Adjust the delay as needed
        });

        // For each Couple >> Get the Radio Value & Data and Check Them

        function firstCouple() {
            let fixedPeriod = 1;
            let date_5_1 = $(':input[name="OwnerIDExpiryDate"]').val();
            let check_5_2 = $('input[name="OwnerImg"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_5_1);
            if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
                $('p[name="hala_1"]').text('سارى');
            } else {
                $('p[name="hala_1"]').text('يجب اعادة طلبه');
            }
        }

        function secondCouple() {
            let fixedPeriod = 1;
            let date_5_1 = $(':input[name="ExpiryDateGuarantorPromissoryNote"]').val();
            let check_5_2 = $('input[name="ObSupporterIdImg"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_5_1);
            if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
                $('p[name="hala_2"]').text('سارى');
            } else {
                $('p[name="hala_2"]').text('يجب اعادة طلبه');
            }
        }

        function thirdCouple() {
            let fixedPeriod = 1;
            let date_5_1 = $(':input[name="ExpirationDateFirstWitness"]').val();
            let check_5_2 = $('input[name="ObFrstSeeIdImg"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_5_1);
            if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
                $('p[name="hala_3"]').text('سارى');
            } else {
                $('p[name="hala_3"]').text('يجب اعادة طلبه');
            }
        }

        function fourthCouple() {
            let fixedPeriod = 1;
            let date_5_1 = $(':input[name="ExpiryDateSecondWitness"]').val();
            let check_5_2 = $('input[name="ObScndSeeIdImg"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_5_1);
            if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
                $('p[name="hala_4"]').text('سارى');
            } else {
                $('p[name="hala_4"]').text('يجب اعادة طلبه');
            }
        }
    </script>
    {{-- GROUP 5  --}}
