    {{-- GROUP 4  --}}
    <script>
        $(':input[name="ObCrMatch"]').change(function() {
            claculateHSL()
        });

        $(':input[name="OrderBond"]').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'موجود') {
                markRequired();
                if ($('#COM').text() == 'LB') {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) / 2);
                } else {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) * 0.8);
                }

                // HERE 
                let creditSapValue = Number($('p[name="CreditLine_p"]').text());
                let mazValue = Number($('p[name="mazbota"]').text());
                if (Number(mazValue) == creditSapValue) {
                    $('p[name="motabaqa"]').text('مطابق');
                } else if (Number(mazValue) > creditSapValue) {
                    $('p[name="motabaqa"]').text('السند اكبر');
                } else if (Number(mazValue) == 0) {
                    $('p[name="motabaqa"]').text('السند غير موجود');
                } else {
                    $('p[name="motabaqa"]').text('السند اصغر');
                }
                // HERE 
            } else if (selectedValue == 'مستثنى') {
                markRequired();
                $('p[name="mazbota"]').text($(':input[name="ValueOrderException"]').val());
                // HERE 
                let creditSapValue = Number($('p[name="CreditLine_p"]').text());
                let mazValue = Number($('p[name="mazbota"]').text());
                if (Number(mazValue) == creditSapValue) {
                    $('p[name="motabaqa"]').text('مطابق');
                } else if (Number(mazValue) > creditSapValue) {
                    $('p[name="motabaqa"]').text('السند اكبر');
                } else if (Number(mazValue) == 0) {
                    $('p[name="motabaqa"]').text('السند غير موجود');
                } else {
                    $('p[name="motabaqa"]').text('السند اصغر');
                }
                // HERE 
            } else {
                removeRequired();
                $('p[name="mazbota"]').text('0');
            }
            claculateHSL()
        });
        // 
        $(':input[name="ValueOrderException"]').on('input', function() {
            let mazValue = 0;
            let selectedValue = $(':input[name="OrderBond"]:checked').val();
            if (selectedValue == 'موجود') {
                // markRequired();
                if ($('#COM').text() == 'LB') {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) / 2);
                    mazValue = Number(Number($(':input[name="ValueOrderException"]').val()) / 2);
                } else {
                    $('p[name="mazbota"]').text(Number($(':input[name="ValueOrderException"]').val()) * 0.8);
                    mazValue = Number(Number($(':input[name="ValueOrderException"]').val())  * 0.8);
                }

                // console.log(mazValue);
            } else if (selectedValue == 'مستثنى') {
                // markRequired();
                $('p[name="mazbota"]').text($(':input[name="ValueOrderException"]').val());
                mazValue = Number(Number($(':input[name="ValueOrderException"]').val()));
                console.log(mazValue);
            } else {
                // removeRequired();
                $('p[name="mazbota"]').text('0');
                mazValue = 0;
                console.log(mazValue);
            }

            let creditSapValue = Number($('p[name="CreditLine_p"]').text());
            if (Number(mazValue) == creditSapValue) {
                $('p[name="motabaqa"]').text('مطابق');
            } else if (Number(mazValue) > creditSapValue) {
                $('p[name="motabaqa"]').text('السند اكبر');
            } else if (Number(mazValue) == 0) {
                $('p[name="motabaqa"]').text('السند غير موجود');
            } else {
                $('p[name="motabaqa"]').text('السند اصغر');
            }
            claculateHSL()
        });

        // CreationDateOrderOrException
        $(':input[name="CreationDateOrderOrException"]').change(function() {
            let fixedPeriod = 3;
            let date_5_1 = $(':input[name="CreationDateOrderOrException"]').val();
            let theirDate_345 = new Date(date_5_1);
            theirDate_345.setFullYear(theirDate_345.getFullYear() + fixedPeriod);
            $('p[name="year_from_now"]').text(theirDate_345.toISOString().substr(0, 10));
            claculateHSL()
        });

        $(':input[name="CreationDateOrderOrException_h"]').on('blur', function() {
            setTimeout(function() {
                let fixedPeriod = 3;
                let date_5_1 = $(':input[name="CreationDateOrderOrException"]').val();
                let theirDate_345 = new Date(date_5_1);
                theirDate_345.setFullYear(theirDate_345.getFullYear() + fixedPeriod);
                $('p[name="year_from_now"]').text(theirDate_345.toISOString().substr(0, 10));
                claculateHSL()
            }, 100); // Adjust the delay as needed
        });

        function markRequired() {
            $(':input[name="ValueOrderException"]').attr('required', true);
            $(':input[name="CreationDateOrderOrException"]').attr('required', true);
            $(':input[name="ValueOrderException"]').addClass('border border-danger');
            $(':input[name="CreationDateOrderOrException"]').addClass('border border-danger');
        }

        function removeRequired() {
            $(':input[name="ValueOrderException"]').attr('required', false);
            $(':input[name="CreationDateOrderOrException"]').attr('required', false);
            $(':input[name="ValueOrderException"]').removeClass('border border-danger');
            $(':input[name="CreationDateOrderOrException"]').removeClass('border border-danger');
        }
        // =============================================================

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
    </script>
    {{-- GROUP 4  --}}
