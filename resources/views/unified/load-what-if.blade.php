<script>
    // Select Elements On By Sumbmitted With the New Data  -> 

    // 1
    let userCardCode = $('#what_if_card_code').val();
    $('#load_what_if').on('click', function() {
        alert('Button is Clicked ' + userCardCode);
        loadDataFromLink(userCardCode);
    });

    // 2 
    function loadDataFromLink(userCardCode) {
        $.ajax({
            type: 'GET',
            url: "{{ route('load-what-if-data') }}",
            data: {
                cardCode: userCardCode
            },
            success: function(data) {
                // console.log('Result  : ' + data.result);
                fillTheForm(data.result);
            },
            error: function(err) {
                console.log('Error : ' + err);
            }
        });
    } // End of loadDataFromLink

    // 3 
    function fillTheForm(resultJsonData) {
        let jsonDataObject = JSON.parse(resultJsonData);
        jsonDataObject.forEach(element => {
            console.log(element.fieldName, element.newValue);
            let els = document.getElementsByName(element.fieldName);
            if (els.length > 0) {
                // Check the type of the first element in the collection (index 0)
                let el = els[0];
                if (el.type === "radio") {
                    // For radio buttons, loop through all elements with the same name
                    for (let i = 0; i < els.length; i++) {
                        if (els[i].value === element.newValue) {
                            els[i].checked = true;
                            // let event = new Event("change", {
                            //     bubbles: true,
                            //     cancelable: true
                            // });
                            // el.dispatchEvent(event);
                        } else {
                            els[i].checked = false;
                        }
                    }
                } else {
                    el.value = element.newValue;
                    let event = new Event("change", {
                        bubbles: true,
                        cancelable: true
                    });
                    el.dispatchEvent(event);
                }
                // Create and dispatch a "change" event

            }
        });
    } // End Of fillTheForm
</script>
