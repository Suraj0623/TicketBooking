<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seats</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- External CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Include the admin header -->
    @include('partials.admin_header')

    <section id="seat">
        <div id="head">
            <h4>Seat Status</h4>
        </div>
        <div id="main">
            <form action="{{ route('seats.index') }}" method="GET">
                <div class="searchBus">
                    <input type="text" id="bus-no" name="bus_no" placeholder="Bus Number" class="busnoInput">
                    <div class="sugg"></div>
                </div>

                <!-- Passing bus data as JSON -->
                <input type="hidden" id="busJson" name="busJson" value='@json($buses)'>
                <button type="submit" name="submit">Search</button>
            </form>

            <div id="seat-results">
                @if(isset($seats) && count($seats) > 0)
                    <table id="displaySeats" data-seats="{{ $bookedSeats }}">
                        @for ($i = 1; $i <= 38; $i++)
                            @if ($i % 10 == 1)
                                <tr>
                            @endif
                            <td id="seat-{{ $i }}" data-name="{{ $i }}">{{ $i }}</td>
                            @if ($i % 10 == 0)
                                </tr>
                            @endif
                        @endfor
                    </table>
                    <div style="text-align: center; color: #9a031e; font-weight: bold;">
                        {{ $busNo }}
                    </div>
                @else
                    <p>No seats booked.</p>
                @endif
            </div>
        </div>
    </section>

    <script src="{{ asset('js/admin_seat.js') }}"></script>
</body>
</html>
