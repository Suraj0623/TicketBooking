
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
        <div class="container-fluid">
            <div class="d-flex w-100">
              
                
                <div class="ms-auto">
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-lg" title="Logout from your account">Logout</a>
                </div>
             
               
            </div>
        </div>
    <div class="container-fluid">
        <div class="row">
           
            <!-- Sidebar -->
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <h1 class="nav-link active">Welcome,{{Auth::user()->FirstName}}</h1>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('offer.create')}}">
                                Offers
                             </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('booking.index') }}">
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                           
                            <a class="nav-link"  href="{{route('transports.index')}}" >
                                Transport
                            </a>
                          
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('route.index') }}">
                                Routes
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('seat.index') }}">
                                Seats
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.index') }}">
                                Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tours.index') }}">
                                Tours
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('movies.index')}}">
                                Movies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.index')}}">
                               Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.manage')}}">
                                Admins
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="container">
                    <section id="dashboard">
                        <!-- Content here -->
                        <div id="status">
                            <div id="Booking" class="info-box status-item">
                                <div class="heading">
                                    <h5>Bookings</h5>
                                    <div class="info">
                                        <i class="fas fa-ticket-alt"></i>
                                    </div>
                                </div>
                                <div class="info-content">
                                    <p>Total Bookings</p>
                                    <p class="num">
                                        {{-- {{ $bookingCount }} --}}
                                    </p>
                                </div>
                                <a href="{{ route('booking.index') }}">View More <i class="fas fa-arrow-right"></i></a>
                            </div>
                            
                            <!-- Other status items here -->
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

    <footer class="fixed-bottom">
        <p>
            &copy; {{ date('Y') }} - Simple Bus Ticket Booking System
        </p>
    </footer>

    <!-- Bootstrap JS and custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin_dashboard.js') }}"></script>
</body>
</html>
