<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKM Citra System') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"/>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
          integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
          integrity="sha512-1fPmaHba3v4A7PaUsComSM4TBsrrRGs+/fv0vrzafQ+Rw+siILTiJa0NtFfvGeyY5E182SDTaF5PqP+XOHgJag=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="{{ mix('css/homepage.css') }}" rel="stylesheet"/>
</head>
<body>


<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="#">UKMCS</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#team">Team</a></li>
                <li class="d-none d-md-block">&#124;</li>
                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
        <h1>Welcome to UKM</h1>
        <h2>????</h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section><!-- End Hero -->


<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                    <img src="https://placekitten.com/640/360" class="img-fluid" alt=""/>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </li>
                        <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate
                            velit.
                        </li>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu
                            fugiat nulla pariatur.
                        </li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                        in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Objective Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">

                <div class="col-lg-4" data-aos="fade-up">
                    <div class="box">
                        <span>01</span>
                        <h4>Lorem Ipsum</h4>
                        <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="150">
                    <div class="box">
                        <span>02</span>
                        <h4>Repellat Nihil</h4>
                        <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="box">
                        <span>03</span>
                        <h4> Ad ad velit qui</h4>
                        <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Objective Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">

            <div class="row d-flex align-items-center">

                <div class="col-6">
                    <img src="{{ asset('images/logo_ukm.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-6">
                    <img src="{{ asset('images/logo_citra.png') }}" class="img-fluid" alt="">
                </div>

            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container">

            <div class="section-title">
                <span>Team</span>
                <h2>Team</h2>
                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
            </div>

            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="https://www.fillmurray.com/225/225" height="225" width="225" alt="">
                        <h4>Haiqal Najmi</h4>
                        <span>Scrum Manager</span>
                        <p>
                            Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat
                            qui aut aut aut
                        </p>
                        <div class="social">
                            <a target="_blank" href="https://www.instagram.com/redspiderlily.png"><i
                                    class="bi bi-instagram"></i></a>
                            <a target="_blank"
                               href="https://www.linkedin.com/in/muhammad-haiqal-najmi-zulkarnain-3a87431b8/"><i
                                    class="bi bi-linkedin"></i></a>
                            <a target="_blank" href="https://github.com/HaiqalNajmi"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="https://www.fillmurray.com/225/225" height="225" width="225" alt="">
                        <h4>Wong Yew Keong</h4>
                        <span>UI/UX Designer</span>
                        <p>
                            Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum
                            temporibus
                        </p>
                        <div class="social">
                            <a target="_blank" href="https://github.com/WongYewKeong"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="{{ asset('images/team/arfan.jpg') }}" height="225" width="225" alt="">
                        <h4>Muhammad Arfan</h4>
                        <span>Technical Lead</span>
                        <p>
                            Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro
                            des clara
                        </p>
                        <div class="social">
                            <a target="_blank" href="https://www.instagram.com/mh.darfan"><i
                                    class="bi bi-instagram"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/in/muhdarfan20/"><i
                                    class="bi bi-linkedin"></i></a>
                            <a target="_blank" href="https://github.com/muhdarfan"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="https://www.fillmurray.com/225/225" height="225" width="225" alt="">
                        <h4>Aifaa Athirah</h4>
                        <span>Test Lead</span>
                        <p>
                            Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro
                            des clara
                        </p>
                        <div class="social">
                            <a target="_blank" href="https://www.instagram.com/aaiiffaaaa"><i
                                    class="bi bi-instagram"></i></a>
                            <a target="_blank"
                               href="https://www.linkedin.com/in/nur-aifaa-athirah-mohd-azmi-7063a11a5/"><i
                                    class="bi bi-linkedin"></i></a>
                            <a target="_blank" href="https://github.com/NurAifaaAthirah"><i
                                    class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Team Section -->
</main>

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>{{ __('Useful Links') }}</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('homepage') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://www.ukm.my">UKM</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://warga.ukm.my/">Gerbang Warga</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://ukmfolio.ukm.my/">UKMFolio</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://ewarga.ukm.my/efact/">eFACt</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            Copyright &copy; 2021-{{ date('Y') }} <strong><span>UKM Citra System</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Brought by <a target="_blank" href="http://lepak.xyz/">Lepak Corp.</a> |
            Designed by <a target="_blank" href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>


<!-- SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="{{ mix('js/homepage.js') }}"></script>
</body>
</html>
