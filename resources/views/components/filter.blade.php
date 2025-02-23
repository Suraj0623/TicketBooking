{{-- <div class="filter">
  <h2>Filter by:</h2>
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" oninput="filterMovies(this.value)">
  
  <label for="genre">Genre:</label>
  <select id="genre" name="genre" onchange="filterMovies(this.value)">
    <option value="">All</option>
    <option value="Action">Action</option>
    <option value="Comedy">Comedy</option>
    <option value="Drama">Drama</option>
  </select>
  
  <label for="rating">Rating:</label>
  <select id="rating" name="rating" onchange="filterMovies(this.value)">
    <option value="">All</option>
    <option value="1">1+</option>
    <option value="2">2+</option>
    <option value="3">3+</option>
    <option value="4">4+</option>
    <option value="5">5+</option>
  </select>
</div> --}}


<main>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles if needed */
        .filter-container {
            border: 1px solid #B1B1B1;
            border-radius: 8px;
            padding: 20px;
        }
        .filter-header {
            font-weight: bold;
        }
        .slider-container {
            margin-top: 10px;
        }
    </style>

   <body>
    <div class="container mt-5">
        <!-- Filter Sidebar Section -->
        <div class="filter-container">
            <h3 class="text-lg">Filter By</h3>

            <div class="py-3 border-y">
                <h4 class="my-3">Price Range (NPR)</h4>
                <!-- Price Range Slider -->
                <div class="slider-container">
                    <input type="range" class="form-range" id="price-range" min="0" max="25000" step="100" value="0">
                    <div class="d-flex justify-content-between">
                        <span id="min-price">0</span>
                        <span id="max-price">25000</span>
                    </div>
                </div>

                <!-- Price Range Input Boxes -->
                <div class="d-flex gap-2 mt-2">
                    <input type="number" id="min-input" class="form-control" value="0" min="0" max="25000">
                    <input type="number" id="max-input" class="form-control" value="25000" min="0" max="25000">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to update range slider and input values dynamically
        const priceRange = document.getElementById('price-range');
        const minInput = document.getElementById('min-input');
        const maxInput = document.getElementById('max-input');
        const minPriceDisplay = document.getElementById('min-price');
        const maxPriceDisplay = document.getElementById('max-price');

        // Update slider value and input fields
        priceRange.addEventListener('input', function () {
            const value = priceRange.value;
            const min = Math.min(value, maxInput.value);
            const max = Math.max(value, minInput.value);

            minInput.value = min;
            maxInput.value = max;

            minPriceDisplay.textContent = min;
            maxPriceDisplay.textContent = max;
        });

        // Update slider when input values change
        minInput.addEventListener('input', function () {
            const minValue = Math.min(parseInt(minInput.value), parseInt(maxInput.value));
            priceRange.value = minValue;
            minPriceDisplay.textContent = minValue;
        });

        maxInput.addEventListener('input', function () {
            const maxValue = Math.max(parseInt(minInput.value), parseInt(maxInput.value));
            priceRange.value = maxValue;
            maxPriceDisplay.textContent = maxValue;
        });
    </script>
   </body>
</main> 
