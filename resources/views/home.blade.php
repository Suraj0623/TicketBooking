<x-header/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background container */
        .background-container {
            position: relative;
            height: 80vh; /* Height for the background */
            overflow: hidden;
            background-color: #f0f0f0;
            background-image: url('{{ asset('images/road.jpeg') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center; /* Centering the content vertically and horizontally */
            transition: background-position 0.5s ease-in-out;
        }

        /* Bus animation */
        .moving-bus {
            position: absolute;
            bottom: 10%;
            left: -300px;
            width: 300px;
            height: auto;
            animation: moveBus 10s linear infinite;
        }

        /* Keyframes for moving the bus */
        @keyframes moveBus {
            0% {
                left: -300px;
            }
            100% {
                left: 100%;
            }
        }

        /* Form styling */
        .search-form {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 500px;
        }

        .search-form label {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .search-form select, .search-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border 0.3s ease-in-out;
        }

        .search-form select:focus, .search-form input:focus {
            border-color: #007bff;
            outline: none;
        }

        .search-form button {
            width: 100%;
            padding: 12px;
            background-color: #0c2d5079;
            color: black;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 15px;
        }

        .search-form button:hover {
            background-color: #092f36;
        }

        .search-form button:active {
            transform: scale(0.98);
        }

    </style>

    <div class="background-container">
        <!-- Bus image animation -->
        <img class="moving-bus" src="{{ asset('images/bus.jpeg')}}" alt="Moving Bus">

        <!-- Search Form -->
        <form action="{{route('transport.search')}}" method="Post" class="search-form">
           @csrf
            <div>
                <label for="origin">Origin</label>
                <select id="origin" name="origin" required>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Chitwan">Chitwan</option>
                    <option value="Delhi">Delhi</option>
                    <!-- Add other options here -->
                </select>
            </div>
        
            <div>
                <label for="destination">Destination</label>
                <select id="destination" name="destination" required>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Chitwan">Chitwan</option>
                    <option value="Delhi">Delhi</option>
                    <!-- Add other options here -->
                </select>
            </div>
        
            <div>
                <label for="departure_date">Date</label>
                <input type="date" id="departure_date" name="departure_date" required>
            </div>
        
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="container mt-5">
        <div>
            @include('offer')
        </div>
    </div>
<x-footer/>

