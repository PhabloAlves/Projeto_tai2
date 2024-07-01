<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<<<<<<< HEAD
=======

>>>>>>> a6be3177e877b16c1ef0d60bd0c2489adb9936b0
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Marca Aí')</title>
    <link rel="stylesheet" href="{{ url('Assets/Styles/style.css') }}">
<<<<<<< HEAD
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('Assets/Images/logoalone.png') }}">
</head>
=======
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('Assets/Images/logoalone.png') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

>>>>>>> a6be3177e877b16c1ef0d60bd0c2489adb9936b0
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
<<<<<<< HEAD

    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=>{
                let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
=======
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @if (isset($jsFile))
    <script src="{{ asset('js/' . $jsFile) }}"></script>
    @endif
    
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecionando o pai principal da seta
>>>>>>> a6be3177e877b16c1ef0d60bd0c2489adb9936b0
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-chevron-right");
        console.log(sidebarBtn);
<<<<<<< HEAD
        sidebarBtn.addEventListener("click", ()=>{
=======
        sidebarBtn.addEventListener("click", () => {
>>>>>>> a6be3177e877b16c1ef0d60bd0c2489adb9936b0
            sidebar.classList.toggle("close");
            sidebarBtn.classList.toggle("rotated");
        });
    </script>
</body>
<<<<<<< HEAD
=======

>>>>>>> a6be3177e877b16c1ef0d60bd0c2489adb9936b0
</html>