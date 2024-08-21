<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Management</title>
    <link rel="stylesheet" href="/employee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iFZ0M6OrJD+iLWllQFZq8T1bUByhF6ePcYUE00jM9pP56fY5Bqt2EBy6u" crossorigin="anonymous">
    @yield('css')  
</head>

<body>
    <div class="app-container">
        <div class="app-header">
            <div class="app-header-left">
                <span class="app-icon"></span>
                <p class="app-name">Portfolio</p>
                <div class="search-wrapper">
                    <input class="search-input" type="text" placeholder="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="feather feather-search" viewBox="0 0 24 24">
                        <defs></defs>
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                </div>
            </div>
            <div class="app-header-right">
                <button class="add-btn" title="Add New Project">
                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
                <button class="notification-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                </button>
                <button class="profile-btn">
                        <button onclick="toggleDropdown()" class="dropbtn">{{ Auth::user()->name }}</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                        </div>
                </button>
            </div>
            <button class="messages-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-message-circle">
                    <path
                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                </svg>
            </button>
        </div>
        <div class="app-content">
            <div class="app-sidebar">
                <a href="{{ route('employee.dasboard') }}" class="app-sidebar-link active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <a href="" class="app-sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" height="30" width="30">
                        <g id="user-multiple-group--close-geometric-human-multiple-person-up-user">
                            <path id="Union" fill="#000" fill-rule="evenodd" d="M17.142857142857142 9.642857142857142a6.428571428571429 6.428571428571429 0 1 1 -12.857142857142858 0 6.428571428571429 6.428571428571429 0 0 1 12.857142857142858 0Zm-6.428571428571429 8.571428571428571a10.714285714285714 10.714285714285714 0 0 0 -10.714285714285714 10.714285714285714 1.0714285714285714 1.0714285714285714 0 0 0 1.0714285714285714 1.0714285714285714h19.285714285714285a1.0714285714285714 1.0714285714285714 0 0 0 1.0714285714285714 -1.0714285714285714 10.714285714285714 10.714285714285714 0 0 0 -10.714285714285714 -10.714285714285714Zm18.214285714285715 11.785714285714285h-4.975714285714286c0.10071428571428571 -0.3385714285714286 0.15428571428571428 -0.6985714285714286 0.15428571428571428 -1.0714285714285714a13.371428571428572 13.371428571428572 0 0 0 -5.34 -10.70142857142857A10.714285714285714 10.714285714285714 0 0 1 30 28.928571428571427a1.0714285714285714 1.0714285714285714 0 0 1 -1.0714285714285714 1.0714285714285714ZM19.285714285714285 16.07142857142857a6.428571428571429 6.428571428571429 0 0 1 -1.8599999999999999 -0.27214285714285713A9.075000000000001 9.075000000000001 0 0 0 19.82142857142857 9.642857142857142a9.075000000000001 9.075000000000001 0 0 0 -2.395714285714286 -6.156428571428572A6.428571428571429 6.428571428571429 0 1 1 19.285714285714285 16.07142857142857Z" clip-rule="evenodd" stroke-width="2.142857142857143">       
                            </path>
                        </g>
                        </svg>
                </a>
                <a href="" class="app-sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-calendar">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </a>
                <a href="" class="app-sidebar-link">
                    <svg class="link-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="feather feather-settings" viewBox="0 0 24 24">
                        <defs />
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                    </svg>
                </a>
            </div>
            <div class="projects-section">
                @yield('content')   
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modeSwitch = document.querySelector('.mode-switch');

            modeSwitch.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                modeSwitch.classList.toggle('active');
            });

            var listView = document.querySelector('.list-view');
            var gridView = document.querySelector('.grid-view');
            var projectsList = document.querySelector('.project-boxes');

            listView.addEventListener('click', function() {
                gridView.classList.remove('active');
                listView.classList.add('active');
                projectsList.classList.remove('jsGridView');
                projectsList.classList.add('jsListView');
            });

            gridView.addEventListener('click', function() {
                gridView.classList.add('active');
                listView.classList.remove('active');
                projectsList.classList.remove('jsListView');
                projectsList.classList.add('jsGridView');
            });

            document.querySelector('.messages-btn').addEventListener('click', function() {
                document.querySelector('.messages-section').classList.add('show');
            });

            document.querySelector('.messages-close').addEventListener('click', function() {
                document.querySelector('.messages-section').classList.remove('show');
            });
        });



        function toggleDropdown() {
            var dropdownContent = document.getElementById("myDropdown");
            dropdownContent.classList.toggle("show");
        }

        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

    </script>
       @yield('js')  
</body>

</html>
