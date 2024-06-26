<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Hall Booking System') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        /* New styles for a drastically changed design */
        .navbar {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 1rem 2rem;
        }
        .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: #ecf0f1;
        }
        .navbar-nav {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .nav-item {
            margin-left: 1.5rem;
        }
        .nav-link {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1rem;
        }
        .nav-link:hover {
            color: #3498db;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #34495e;
            border: 1px solid #2980b9;
            border-radius: 0.25rem;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        .dropdown-menu.show {
            display: block;
        }
        .dropdown-item {
            color: #ecf0f1;
            padding: 0.5rem 1rem;
            text-decoration: none;
            display: block;
        }
        .dropdown-item:hover {
            background-color: #2980b9;
        }
        .navbar-toggler {
            color: #ecf0f1;
            font-size: 1.25rem;
        }
        @media (max-width: 768px) {
            .navbar-nav {
                flex-direction: column;
                background-color: #34495e;
                position: absolute;
                top: 3.5rem;
                left: 0;
                width: 100%;
                display: none;
            }
            .navbar-nav.show {
                display: flex;
            }
            .nav-item {
                margin: 0;
                border-top: 1px solid #2980b9;
                text-align: center;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="app">
        <nav class="navbar">
            <div class="container mx-auto flex justify-between items-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Hall Booking System
                </a>
                <button class="navbar-toggler md:hidden" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    &#9776;
                </button>
                <div id="navbarContent" class="navbar-nav md:flex md:items-center">
                    <!-- Right Side Of Navbar (Reversed Order) -->
                    <ul class="navbar-nav md:flex md:space-x-4 ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item relative">
                                <a id="navbarDropdown" class="nav-link cursor-pointer">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div id="dropdownMenu" class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('halls.index') }}">{{ __('Halls') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bookings.index') }}">{{ __('Bookings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employees.index') }}">{{ __('Employees') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer-cares.index') }}">{{ __('Customer Care') }}</a>
                            </li>
                            <!-- Add Executive Section Link -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('executive.index') }}">{{ __('Executive') }}</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-8">
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('navbarDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarContent = document.getElementById('navbarContent');

            let showTimeout;
            let hideTimeout;

            function showDropdown() {
                clearTimeout(hideTimeout);
                showTimeout = setTimeout(() => {
                    dropdownMenu.classList.add('show');
                }, 100);
            }

            function hideDropdown() {
                clearTimeout(showTimeout);
                hideTimeout = setTimeout(() => {
                    dropdownMenu.classList.remove('show');
                }, 100);
            }

            dropdown.addEventListener('mouseenter', showDropdown);
            dropdown.addEventListener('mouseleave', hideDropdown);
            dropdownMenu.addEventListener('mouseenter', showDropdown);
            dropdownMenu.addEventListener('mouseleave', hideDropdown);

            navbarToggler.addEventListener('click', function() {
                navbarContent.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
