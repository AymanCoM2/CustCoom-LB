    <script>
        Group2();

        function Group2() {
            if ($(':input[name="OpenAccountPropose_if"]:checked').val() == 'موجود' || $(
                    ':input[name="OpenAccountPropose_if"]:checked').val() == 'مستثنى') {
                $('p[name="calc_g2_1_gg"]').text('سارى');
            } else {
                $('p[name="calc_g2_1_gg"]').text('يجب اعادة طلبه');
            }

            let selectedValue234 = $(':input[name="TaxCard"]:checked').val();
            if (selectedValue234 == 'موجود') {
                $('p[name="Rttv_dt_e"]').text('سارى');
            } else {
                $('p[name="Rttv_dt_e"]').text('يجب اعادة طلبه');
            }
            let fixedPeriod = 1;
            let date_2_22 = $(':input[name="CRExpiryDate"]').val();
            let check_2_1 = $(':input[name="CommercialRegister"]:checked').val();
            let check_2_2 = $(':input[name="CrCnMatch"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_2_22);
            if ((theirDate_345 > todayExtraFixed) && (check_2_1 == 'موجود') && (check_2_2 == 'مطابق')) {
                $('p[name="calc_g2_2"]').text('سارى');
            } else {
                $('p[name="calc_g2_2"]').text('يجب اعادة طلبه');
            }
        }
        Group3();

        function Group3() {
            let fixedPeriod = 1;
            let date_3_1 = $(':input[name="ExpirydateCommlicense"]').val();
            let check_3_2 = $(':input[name="CommLicense"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_3_1);
            if ((theirDate_345 > todayExtraFixed) && (check_3_2 == 'موجود')) {
                $('p[name="hyf56_34"]').text('سارى');
            } else {
                $('p[name="hyf56_34"]').text('يجب اعادة طلبه');
            }
        }

        Group4();

        function Group4() {
            let mazValue = 0;
            var selectedValue = $(':input[name="OrderBond"]:checked').val();
            if (selectedValue == 'موجود') {
                if ($('#COM').text() == 'LB') {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) / 2);
                    mazValue = Number(Number($(':input[name="ValueOrderException"]').val()) / 2);
                } else {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) * 0.8);
                    mazValue = Number(Number($(':input[name="ValueOrderException"]').val())  * 0.8);
                }
            } else if (selectedValue == 'مستثنى') {
                mazValue = Number(Number($(':input[name="ValueOrderException"]').val()));
                $('p[name="mazbota"]').text($(':input[name="ValueOrderException"]').val());
            } else {
                mazValue = 0;
                $('p[name="mazbota"]').text('0');
            }

            let creditSapValue = Number($('p[name="CreditLine_p"]').val());
            if (mazValue == creditSapValue) {
                $('p[name="motabaqa"]').text('مطابق');
            } else if (mazValue > creditSapValue) {
                $('p[name="motabaqa"]').text('السند اكبر');
            } else if (mazValue == 0) {
                $('p[name="motabaqa"]').text('السند غير موجود');
            } else {
                $('p[name="motabaqa"]').text('السند اصغر');
            }

            let fixedPeriod = 3;
            let date_5_1 = $(':input[name="CreationDateOrderOrException"]').val();
            let theirDate_345 = new Date(date_5_1);
            theirDate_345.setFullYear(theirDate_345.getFullYear() + fixedPeriod);
            $('p[name="year_from_now"]').text(theirDate_345.toISOString().substr(0, 10));
        }


        firstCouple();
        secondCouple();
        thirdCouple();
        fourthCouple();

        function firstCouple() {
            let fixedPeriod = 1;
            let date_5_1 = $(':input[name="OwnerIDExpiryDate"]').val();
            let check_5_2 = $(':input[name="OwnerImg"]:checked').val();
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
            let check_5_2 = $(':input[name="ObSupporterIdImg"]:checked').val();
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
            let check_5_2 = $(':input[name="ObFrstSeeIdImg"]:checked').val();
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
            let check_5_2 = $(':input[name="ObScndSeeIdImg"]:checked').val();
            let todayExtraFixed = new Date();
            todayExtraFixed.setMonth(todayExtraFixed.getMonth() + fixedPeriod)
            let theirDate_345 = new Date(date_5_1);
            if ((theirDate_345 > todayExtraFixed) && (check_5_2 == 'موجود')) {
                $('p[name="hala_4"]').text('سارى');
            } else {
                $('p[name="hala_4"]').text('يجب اعادة طلبه');
            }
        }

        firstCombination();
        secondCombination();
        claculateHSL();

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

        function claculateHSL() {
            // ([[سند الامر]]=="موجود",
            // ([[سند الامر]]="مستثنى",
            // ([[سند الامر]]="نقدى"
            let a = $(':input[name="OrderBond"]:checked').val() == "موجود";
            let b = $(':input[name="OrderBond"]:checked').val() == "مستثنى";
            let c = $(':input[name="OrderBond"]:checked').val() == "نقدى";

            // ,[@[مطابقة الحد الائتمانى]]="السند اكبر", 
            let d = $('p[name="motabaqa"]').text() == 'السند اكبر';
            let d_two = $('p[name="motabaqa"]').text() == 'مطابق';

            // [@[مطابقة رقم السجل التجارى بسند الامر]]="مطابق"),
            let e = $(':input[name="ObCrMatch"]:checked').val() == "مطابق";


            // [@[تاريخ انتهاء سند الامر او الاستثناء]]  >> PART ONE 
            // >TODAY()+'Other Data'!$B$23 >> PART 2 
            let calculatedDate = new Date($('p[name="year_from_now"]').text());
            let tods = new Date();
            tods.setMonth(tods.getMonth() + 1)
            let f = calculatedDate > tods;
            // f TODO 

            let cond1 = a && f && d && e;
            let cond2 = b && d_two; // Ok 
            let cond3 = a && f && d_two && e;
            let cond4 = b && d; // OK 
            let cond5 = c && d_two; // ok 
            if (cond1 || cond2) {
                $('p[name="hsl"]').text('سارى');
            } else if (cond3 || cond4) {
                $('p[name="hsl"]').text('سارى');
            } else if (cond5) {
                $('p[name="hsl"]').text('سارى');
            } else {
                $('p[name="hsl"]').text("يجب اعادة طلبه");
            }

        } // End of CalcHSL() 


        // Function to disable all interactive elements
        function disablePage() {
            const interactiveElements = document.querySelectorAll(
                "input, textarea, select, button, a, area, object, embed, [tabindex]:not([tabindex='-1'])"
            );

            interactiveElements.forEach(element => {
                element.setAttribute("disabled", "true");
            });

            const overlay = document.getElementById("overlay");
            overlay.style.display = "block";
        }

        // Call the function to disable the page
        disablePage();
    </script>
    {{-- GROUP 6  --}}
