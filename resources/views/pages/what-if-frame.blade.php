<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer | {{ $cardCode }}</title>
    <link href="{{ asset('css/bootstrap5.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/iframe-css.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
</head>

<body>
    <div class="fw-bolder">
        <a href="{{ route('dash-home') }}" class="btn btn-primary"> <i class='bx bx-home'></i></a>
    </div>
    <br>
    <iframe id="iframe1" src="{{ route('get-customer-form-g-what-if', $cardCode) }}"></iframe>
    <iframe id="iframe2" src="{{ route('customer-drive', $cardCode) }}"
        style="width:100%; height:100%; border:0;"></iframe>
    <script>
        function setIframeWidthToHalfScreen() {
            const screenWidth = window.innerWidth;
            const halfScreenWidth = screenWidth / 2;
            const iframe1 = document.getElementById("iframe1");
            const iframe2 = document.getElementById("iframe2");
            iframe1.style.width = halfScreenWidth + "px";
            iframe2.style.width = halfScreenWidth + "px";
        }

        setIframeWidthToHalfScreen();
        window.addEventListener("resize", setIframeWidthToHalfScreen);
        let rr = iframe2.querySelectorAll("a").forEach(b => b.setAttribute('target', 'self'));
        console.log(rr);
    </script>
</body>

</html>
