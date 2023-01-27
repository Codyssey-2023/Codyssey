<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
    <link rel="icon" type="image/x-icon" href="media/opencart.svg">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Swiper CSS --}}
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <script src="https://kit.fontawesome.com/1498afddd8.js" crossorigin="anonymous"></script>
    {{-- AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- livewire --}}
    @livewireStyles
</head>
<body class="parallax position-relative" id="parallaxBody">
    <x-nav/>
    <x-floatingSearch/>
    <div class="positionToNav">
        {{$slot}}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content CBF">
                <h2 class="text-center fs-1 fw-bold fst-italic txt-CY">PRESTO!</h2>
                <form class="d-flex" role="search" action="{{route('search.search')}}" method="GET">
                    <input name='searched' class="rounded-start form-control-custom mx-0" type="search" placeholder="{{__('ui.searchBarPL')}}" aria-label="Search">
                    <button class="border-0 btn-customNegative rounded-end mx-0" type="submit">{{__('ui.search')}}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="padToFooter"></div>
    <x-footer/>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    {{-- Swiper controller --}}
    <script>
        let swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            keyboard: {
                enabled: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    </script>
    
    <script>
        let swiper2 = new Swiper(".mySwiper2", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            keyboard: {
                enabled: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                992: {
                    slidesPerView: 2,
                },
            },
        });
    </script>
    
    <script>
        let swiper3 = new Swiper(".mySwiper3", {
            effect: "cards",
            grabCursor: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            keyboard: {
                enabled: true,
            },
            
        });
    </script>
    
    <script>
        let swiper4 = new Swiper(".mySwiper4", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
            scrollbar: {
                el: ".swiper-scrollbar",
            },
            keyboard: {
                enabled: true,
            },
        });
    </script>
    
    {{-- AOS JS + Inizialization --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    {{-- livewire --}}
    @livewireScripts
</body>
</html>