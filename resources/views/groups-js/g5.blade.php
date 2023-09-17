    {{-- GROUP 5  --}}
    <script>
        // Radio 
        $(':input[name="OwnerImg"]').change(function() {
            firstCouple();
            var selectedValue = $(this).val();
            if (selectedValue == 'موجود') {
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
        $(':input[name="OwnerIDExpiryDate"]').change(function() {
            firstCouple();
        });
        $(':input[name="OwnerIDExpiryDate_h"]').on('blur', function() {
            setTimeout(function() {
                firstCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObSupporterIdImg"]').change(function() {
            secondCouple();
            var selectedValue = $(this).val();
            if (selectedValue == 'موجود') {
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
        $(':input[name="ExpiryDateGuarantorPromissoryNote"]').change(function() {
            secondCouple();
        });
        $(':input[name="ExpiryDateGuarantorPromissoryNote_h"]').on('blur', function() {
            setTimeout(function() {
                secondCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObFrstSeeIdImg"]').change(function() {
            thirdCouple();
            var selectedValue = $(this).val();
            if (selectedValue == 'موجود') {
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
        $(':input[name="ExpirationDateFirstWitness"]').change(function() {
            thirdCouple();
        });
        $(':input[name="ExpirationDateFirstWitness_h"]').on('blur', function() {
            setTimeout(function() {
                thirdCouple();
            }, 100); // Adjust the delay as needed
        });

        // Radio 
        $(':input[name="ObScndSeeIdImg"]').change(function() {
            fourthCouple();
            var selectedValue = $(this).val();
            if (selectedValue == 'موجود') {
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
        $(':input[name="ExpiryDateSecondWitness"]').change(function() {
            fourthCouple();
        });
        $(':input[name="ExpiryDateSecondWitness_h"]').on('blur', function() {
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
