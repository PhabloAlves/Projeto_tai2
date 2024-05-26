<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Marca Aí')</title>
    <link rel="stylesheet" href="{{ url('Assets/Styles/style.css') }}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('Assets/Images/logoalone.png') }}">
</head>
<body>
    @include('partials.sidebar')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-chevron-right toggle'></i>
            <span class="text">@yield('header', 'Conteúdo')</span>
            <div class="container">
                @yield('content')
            </div>
        </div>
    </section>

    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=>{
                let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-chevron-right");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
            sidebarBtn.classList.toggle("rotated");
        });
    </script>
</body>
</html>