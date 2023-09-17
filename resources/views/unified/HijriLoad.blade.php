<script>
    const CRExpiryDateInput = document.getElementsByName("CRExpiryDate")[0];
    const CRExpiryDate_hInput = document.getElementsByName("CRExpiryDate_h")[0];
    const ExpirydateCommlicense = document.getElementsByName("ExpirydateCommlicense")[0];
    const ExpirydateCommlicense_h = document.getElementsByName("ExpirydateCommlicense_h")[0];
    const CreationDateOrderOrException = document.getElementsByName("CreationDateOrderOrException")[0];
    const CreationDateOrderOrException_h = document.getElementsByName("CreationDateOrderOrException_h")[0];
    const OwnerIDExpiryDate = document.getElementsByName("OwnerIDExpiryDate")[0];
    const OwnerIDExpiryDate_h = document.getElementsByName("OwnerIDExpiryDate_h")[0];
    const ExpiryDateGuarantorPromissoryNote = document.getElementsByName(
        "ExpiryDateGuarantorPromissoryNote")[0];
    const ExpiryDateGuarantorPromissoryNote_h = document.getElementsByName(
        "ExpiryDateGuarantorPromissoryNote_h")[0];
    const ExpirationDateFirstWitness = document.getElementsByName("ExpirationDateFirstWitness")[0];
    const ExpirationDateFirstWitness_h = document.getElementsByName("ExpirationDateFirstWitness_h")[0];
    const ExpiryDateSecondWitness = document.getElementsByName("ExpiryDateSecondWitness")[0];
    const ExpiryDateSecondWitness_h = document.getElementsByName("ExpiryDateSecondWitness_h")[0];
    const ExpiryDateNationalAddressReserveGuarantor = document.getElementsByName(
        "ExpiryDateNationalAddressReserveGuarantor")[0];
    const ExpiryDateNationalAddressReserveGuarantor_h = document.getElementsByName(
        "ExpiryDateNationalAddressReserveGuarantor_h")[0];
    const ExpiryDateNationalAddress = document.getElementsByName("ExpiryDateNationalAddress")[0];
    const ExpiryDateNationalAddress_h = document.getElementsByName("ExpiryDateNationalAddress_h")[0];

    function f1() {
        const selectedDate = CRExpiryDateInput.value;
        if (selectedDate) {
            console.log(selectedDate);
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            console.log(forma);
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            // Make an API call using AJAX
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    CRExpiryDate_hInput.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            CRExpiryDate_hInput.value = ""; // Reset the value if the date is cleared
        }
    }

    function f2() {
        const selectedDate = CRExpiryDate_hInput.value;
        if (selectedDate) {
            console.log(selectedDate);
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            // Make an API call using AJAX
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    console.log(forma);
                    CRExpiryDateInput.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            CRExpiryDate_hInput.value = ""; // Reset the value if the date is cleared
        }
    }

    function f3() {
        const selectedDate = ExpirydateCommlicense.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpirydateCommlicense_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpirydateCommlicense_h.value = "";
        }
    }

    function f4() {
        const selectedDate = ExpirydateCommlicense_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpirydateCommlicense.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpirydateCommlicense_h.value = "";
        }
    }

    function f5() {
        const selectedDate = CreationDateOrderOrException.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    CreationDateOrderOrException_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            CreationDateOrderOrException_h.value = "";
        }
    }

    function f6() {
        const selectedDate = CreationDateOrderOrException_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    CreationDateOrderOrException.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            CreationDateOrderOrException_h.value = "";
        }
    }

    function f7() {
        const selectedDate = OwnerIDExpiryDate.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    OwnerIDExpiryDate_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            OwnerIDExpiryDate_h.value = "";
        }
    }

    function f8() {
        const selectedDate = OwnerIDExpiryDate_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    OwnerIDExpiryDate.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            OwnerIDExpiryDate_h.value = "";
        }
    }

    function f9() {
        const selectedDate = ExpiryDateGuarantorPromissoryNote.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpiryDateGuarantorPromissoryNote_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateGuarantorPromissoryNote_h.value = "";
        }
    }

    function f10() {
        const selectedDate = ExpiryDateGuarantorPromissoryNote_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpiryDateGuarantorPromissoryNote.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateGuarantorPromissoryNote_h.value = "";
        }
    }

    function f11() {
        const selectedDate = ExpirationDateFirstWitness.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpirationDateFirstWitness_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpirationDateFirstWitness_h.value = "";
        }
    }

    function f12() {
        const selectedDate = ExpirationDateFirstWitness_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpirationDateFirstWitness.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpirationDateFirstWitness_h.value = "";
        }
    }

    function f13() {
        const selectedDate = ExpiryDateSecondWitness.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpiryDateSecondWitness_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateSecondWitness_h.value = "";
        }
    }

    function f15() {
        const selectedDate = ExpiryDateSecondWitness_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpiryDateSecondWitness.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateSecondWitness_h.value = "";
        }
    }

    function f16() {
        const selectedDate = ExpiryDateNationalAddressReserveGuarantor.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpiryDateNationalAddressReserveGuarantor_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateNationalAddressReserveGuarantor_h.value = "";
        }
    }

    function f17() {
        const selectedDate = ExpiryDateNationalAddressReserveGuarantor_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpiryDateNationalAddressReserveGuarantor.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateNationalAddressReserveGuarantor_h.value = "";
        }
    }

    function f18() {
        const selectedDate = ExpiryDateNationalAddress.value;
        if (selectedDate) {
            const dateParts = selectedDate.split("-");
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            const forma = `${day}-${month}-${year}`;
            const apiEndpoint = `http://api.aladhan.com/v1/gToH/${forma}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.hijri.date;
                    ExpiryDateNationalAddress_h.value = convertedDate;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateNationalAddress_h.value = "";
        }
    }

    function f19() {
        const selectedDate = ExpiryDateNationalAddress_h.value;
        if (selectedDate) {
            const apiEndpoint = `http://api.aladhan.com/v1/hToG/${selectedDate}`;
            fetch(apiEndpoint)
                .then(response => response.json())
                .then(data => {
                    const convertedDate = data.data.gregorian.date;
                    const dateParts = convertedDate.split("-");
                    const year = dateParts[0];
                    const month = dateParts[1];
                    const day = dateParts[2];
                    const forma = `${day}-${month}-${year}`;
                    ExpiryDateNationalAddress.value = forma;
                })
                .catch(error => {
                    console.error("Error fetching API data:", error);
                });
        } else {
            ExpiryDateNationalAddress_h.value = "";
        }
    }


    f1();
    f2();
    f3();
    f4();
    f5();
    f6();
    f7();
    f8();
    f9();
    f10();
    f11();
    f12();
    f13();
    f15();
    f16();
    f17();
    f18();
    f19();
</script>
