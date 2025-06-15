<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>BrightMind - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link
        href="{{ asset('css/style.css') }}"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        !function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
    </script>
    <link href="{{ asset('icon.png') }}"
        rel="shortcut icon" type="image/x-icon" />
    <link
        href="{{ asset('icon.png') }}"
        rel="apple-touch-icon" />
        @livewireStyles
</head>

<body>
    @include('sweetalert::alert')
    <div class="page-wrapper">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-inner">
                    <a href="/" class="brand w-inline-block w--current">
                        <img
                            src="{{ asset('logo.png') }}"
                             alt="brand logo" />
                        </a>
                    <div class="nav-menu-wrapper">
                        <div class="navbar-menu-canvas-tray-only"><a href="/" aria-label="Brand Logo"
                                aria-current="page" class="brand w-inline-block w--current"><img
                                    src="https://cdn.prod.website-files.com/67ae25e5b332f13dff9ebd8d/67af50daa967ed79e69af963_Navbar%20Logo.png"
                                    loading="lazy" alt="brand logo" /></a>
                            <div data-w-id="68d3cf6f-bf63-ccc4-f678-e260212178df" class="navbar-close"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 19 18" fill="none"
                                    class="nav-cross-icon">
                                    <path d="M1 17L17.4805 1.66661" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                    <path d="M1 1L17.4805 16.3334" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg></div>
                        </div>
                        <ul role="list" class="nav-menu-list">
                            <li class="nav-menu-list-item">
                                <a wire:navigate href="{{ route('home') }}" aria-current="page"
                                    class="nav-menu-link w-inline-block w--current">
                                    <div class="text-regular">Home</div>
                                </a></li>
                            <li class="nav-menu-list-item"><a wire:navigate href="{{ route('contact') }}" class="nav-menu-link w-inline-block">
                                    <div class="text-regular">Contact</div>
                                </a></li>
                            <li class="nav-menu-list-item"><a href="{{ route('login') }}" class="nav-menu-link w-inline-block">
                                    <div class="text-regular">Login</div>
                                </a></li>
                            <li class="nav-menu-list-item"><a  href="{{ route('register') }}" class="nav-menu-link w-inline-block">
                                    <div class="text-regular">Register</div>
                                </a></li>
                           
                        </ul>
                    </div>
                    <div class="nav-menu-right-wrapper">
                        <div class="nav-menu-extra">
                            <div class="navbar-button">
                                <div class="nav-button-slot"><a  href="{{ route('login') }}"
                                        class="button-primary w-variant-f789925b-7d55-2947-50db-fba3fe2f3408 w-inline-block">
                                        <div>Login</div>
                                    </a>
                                </div>
                            </div>
                            <div data-w-id="68d3cf6f-bf63-ccc4-f678-e260212178fd" class="navbar-toggler">
                                <div class="navbar-toggler-icon-bars">
                                    <div class="navbar-toggle-bar _1"></div>
                                    <div class="navbar-toggle-bar _2"></div>
                                    <div class="navbar-toggle-bar _3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="main-wrapper">
            {{ $slot }}
        </main>
        <footer class="footer">
            <div class="section-padding padding-footer">
                <div class="container">
                    <div class="section-inner section-footer">
                        <div class="footer-top">
                            <div class="footer-info">
                                <div class="footer-info-top">
                                    <a href="/" aria-label="Brand Logo" aria-current="page"
                                        class="brand w-inline-block w--current">
                                        <img src="{{ asset('logo.png') }}" loading="lazy" alt="Footer Brand image" />
                                    </a>
                                    <div>
                                        We are an edutech platform that integrates AI to make course recommendation easy
                                        for students.
                                    </div>
                                </div>
                                <div class="button-wrapper left">
                                    <a href="/contact" class="button-primary w-inline-block">
                                        <div>Contact Us</div>
                                    </a>
                                </div>
                            </div>
                            <div class="footer-links">
                                <div class="footer-link-column">
                                    <div class="text-xlarge">Pages</div>
                                    <div class="footer-link-wrapper"><a href="/" aria-current="page"
                                            class="footer-link-item w-inline-block w--current">
                                            <div class="button-link-text">Home</div>
                                        </a>
                                        <a href="/about" class="footer-link-item w-inline-block">
                                            <div class="button-link-text">Login</div>
                                        </a>
                                        <a href="/courses" class="footer-link-item w-inline-block">
                                            <div class="button-link-text">Register</div>
                                        </a>
                                        <a href="/contact" class="footer-link-item w-inline-block">
                                            <div class="button-link-text">Contact</div>
                                        </a>
                                    </div>
                                </div>

                                <div class="footer-link-column">
                                    <div class="text-xlarge">Contact</div>
                                    <div class="footer-link-wrapper">

                                        <a href="mailto:support@brightmind.com?subject=Hello"
                                            class="footer-link-item font-normalcase w-inline-block">
                                            <div class="button-link-text">support@brightmind.com</div>
                                        </a>
                                        <div class="footer-item">
                                            <div> PMB 1.0.2 LASU Road Ojo, Lagos.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @livewireScripts
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('js/script1.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('js/script2.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('js/script3.js') }}"
        type="text/javascript"></script>
</body>

</html>