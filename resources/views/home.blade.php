
<x-header/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Background container */
    .background-container {
        position: relative;
        height: 80vh; /* Height for the background */
        overflow: hidden;
        background-color: #f0f0f0;
        background-image: url('{{ asset('images/journey.webp') }}');
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

    

    /* Form styling */
    .search-form {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 30px;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 800px;
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
    <!-- Search Form -->
    <form action="{{route('transport.search')}}" method="Post" class="search-form">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="origin">Origin</label>
                <select id="origin" name="origin" required>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Chitwan">Chitwan</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lalitpur">Lalitpur</option>
                    <option value="Bhaktapur">Bhaktapur</option>
                    <option value="Biratnagar">Biratnagar</option>
                    <option value="Dharan">Dharan</option>
                    <option value="Itahari">Itahari</option>
                    <option value="Janakpur">Janakpur</option>
                    <option value="Hetauda">Hetauda</option>
                    <option value="Bharatpur">Bharatpur</option>
                    <option value="Butwal">Butwal</option>
                    <option value="Tansen">Tansen</option>
                    <option value="Nepalgunj">Nepalgunj</option>
                    <option value="Dhangadhi">Dhangadhi</option>
                    <option value="Mahendranagar">Mahendranagar</option>
                    <option value="Birgunj">Birgunj</option>
                    <option value="Ghorahi">Ghorahi</option>
                    <option value="Tulsipur">Tulsipur</option>
                    <option value="Ilam">Ilam</option>
                    <option value="Bhimdatta">Bhimdatta</option>
                    <option value="Kalaiya">Kalaiya</option>
                    <option value="Rajbiraj">Rajbiraj</option>
                    <option value="Lahan">Lahan</option>
                    <option value="Jumla">Jumla</option>
                    <option value="Simara">Simara</option>
                                </select>
            </div>

            <div class="col-md-4">
                <label for="destination">Destination</label>
                <select id="destination" name="destination" required>
                    <option value="Pokhara">Pokhara</option>
                    <option value="Kathmandu">Kathmandu</option>
                    <option value="Chitwan">Chitwan</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lalitpur">Lalitpur</option>
                    <option value="Bhaktapur">Bhaktapur</option>
                    <option value="Biratnagar">Biratnagar</option>
                    <option value="Dharan">Dharan</option>
                    <option value="Itahari">Itahari</option>
                    <option value="Janakpur">Janakpur</option>
                    <option value="Hetauda">Hetauda</option>
                    <option value="Bharatpur">Bharatpur</option>
                    <option value="Butwal">Butwal</option>
                    <option value="Tansen">Tansen</option>
                    <option value="Nepalgunj">Nepalgunj</option>
                    <option value="Dhangadhi">Dhangadhi</option>
                    <option value="Mahendranagar">Mahendranagar</option>
                    <option value="Birgunj">Birgunj</option>
                    <option value="Ghorahi">Ghorahi</option>
                    <option value="Tulsipur">Tulsipur</option>
                    <option value="Ilam">Ilam</option>
                    <option value="Bhimdatta">Bhimdatta</option>
                    <option value="Kalaiya">Kalaiya</option>
                    <option value="Rajbiraj">Rajbiraj</option>
                    <option value="Lahan">Lahan</option>
                    <option value="Jumla">Jumla</option>
                    <option value="Simara">Simara</option>                </select>
            </div>

            <div class="col-md-4">
                <label for="departure_date">Date</label>
                <input type="date" id="departure_date" name="departure_date" required>
            </div>
            <div class="col-md-12">
                <label class="d-block mb-2 fw-semibold" style="font-size: 0.9rem;">Transport Type</label>
                <div class="d-flex gap-2" >
                    <div class="form-check" style="font-size: 0.85rem;">
                        <input type="radio" id="bus" name="transport_type" value="Bus" class="form-check-input" style="transform: scale(0.6);" required>
                        <label for="bus" class="form-check-label">🚌 Bus</label>                    </div>
                    <div class="form-check" style="font-size: 0.85rem;">
                        <input type="radio" id="train" name="transport_type" value="Train" class="form-check-input" style="transform: scale(0.6);" required>
                        <label for="train" class="form-check-label">🚆 Train</label>                    </div>
                    <div class="form-check" style="font-size: 0.85rem;">
                        <input type="radio" id="flight" name="transport_type" value="Flight" class="form-check-input" style="transform: scale(0.6);" required>
                        <label for="flight" class="form-check-label">✈️ Flight</label>
                    </div>
                </div>
            </div>
            
            <div class="col-12 text-end">
                <button type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-5">
    <div>
        @include('offer')
    </div>
</div>
<x-footer/>
