<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Sections</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        .hidden {
            display: none;
        }
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .tabs button {
            padding: 8px 12px;
            cursor: pointer;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Buttons to switch views -->
        <div class="tabs">
            <button id="activitiesBtn">Activities</button>
            <button id="busBtn">Bus</button>
        </div>

        <!-- Activities Section -->
        <div id="activitiesSection">
            <div class="flex flex-col items-center justify-around w-full gap-2 py-4 lg:px-3 bg-white rounded-[20px] md:gap-0 md:flex-row tab shadow-[0_2px_4px_0px_rgba(0,0,0,0.25)] mt-[10px] mb-5">
                <article class="border-[1px] border-[#b1b1b1] py-[6px] sm:py-2 px-3 flex items-center justify-between rounded-md w-[95%] md:w-[35%] relative cursor-pointer" id="from">
                    <aside class="flex flex-col">
                        <p class="text-[11px] md:text-sm font-semibold mb-[2px]">Search keyword</p>
                        <div class="icon-and-input">
                            <input type="text" class="text-sm font-semibold uppercase sector-input sm:text-base lg:text-lg sm:font-bold" placeholder="Kathmandu / Zipflyer">
                        </div>
                    </aside>
                </article>

                <article class="border-[1px] border-[#b1b1b1] flex items-center rounded-md w-[95%] md:w-[45%] justify-between relative cursor-pointer">
                    <div class="flex items-center justify-between w-full px-3 py-[6px] sm:py-2">
                        <aside class="flex flex-col">
                            <p class="text-[11px] md:text-sm font-semibold mb-[2px]">Select Activities</p>
                            <div class="icon-and-input">
                                <input type="text" class="text-sm font-semibold sector-input sm:text-base lg:text-lg sm:font-bold" placeholder="ZIPFLYER">
                            </div>
                        </aside>
                    </div>
                </article>

                <button class="py-2 md:py-5 md:px-3 bg-primary-400 rounded-md font-bold text-sm sm:text-base lg:text-xl text-white min-w-[95%] md:min-w-[15%] hover:opacity-80 transition-opacity ease-in duration-300 text-center">
                    Search
                </button>
            </div>
        </div>

        <!-- Bus Section -->
        <div id="busSection" class="hidden">
            <h3>Select Shift</h3>
            <div class="shift-group">
                <label>
                    <input type="radio" name="shift" value="Both Shift" checked> Both Shift
                </label>
                <label>
                    <input type="radio" name="shift" value="Day Shift"> Day Shift
                </label>
                <label>
                    <input type="radio" name="shift" value="Night Shift"> Night Shift
                </label>
            </div>

            <div class="location-input">
                <label for="location">Enter Location:</label>
                <input type="text" id="location" placeholder="e.g., Kathmandu">
            </div>

            <div class="selected-info">
                <strong>Selected Shift:</strong> <span id="selectedShift">Both Shift</span> <br>
                <strong>Location:</strong> <span id="selectedLocation">Not Entered</span>
            </div>
        </div>
    </div>

    <script>
        const activitiesBtn = document.getElementById("activitiesBtn");
        const busBtn = document.getElementById("busBtn");
        const activitiesSection = document.getElementById("activitiesSection");
        const busSection = document.getElementById("busSection");

        activitiesBtn.addEventListener("click", function () {
            activitiesSection.classList.remove("hidden");
            busSection.classList.add("hidden");
        });

        busBtn.addEventListener("click", function () {
            busSection.classList.remove("hidden");
            activitiesSection.classList.add("hidden");
        });

        // Shift selection logic
        const shiftRadios = document.querySelectorAll('input[name="shift"]');
        const locationInput = document.getElementById("location");
        const selectedShiftDisplay = document.getElementById("selectedShift");
        const selectedLocationDisplay = document.getElementById("selectedLocation");

        shiftRadios.forEach(radio => {
            radio.addEventListener("change", function () {
                selectedShiftDisplay.textContent = this.value;
            });
        });

        locationInput.addEventListener("input", function () {
            selectedLocationDisplay.textContent = this.value || "Not Entered";
        });
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Sections</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .hidden {
            display: none;
        }
        .tabs button {
            padding: 8px 12px;
            cursor: pointer;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="tabs flex gap-2 mb-4">
            <button id="activitiesBtn">Activities</button>
            <button id="busBtn">Bus</button>
            <button id="flightsBtn">Flights</button>
        </div>

        <div id="activitiesSection">
            <h3>Activities Search</h3>
            <input type="text" placeholder="Search Activities" class="border p-2 w-full">
            <button class="bg-red-500 text-white px-4 py-2 mt-3 w-full">SEARCH</button>
        </div>

        <div id="busSection" class="hidden">
            <h3>Bus Search</h3>
            <input type="text" placeholder="Enter Location" class="border p-2 w-full">
            <button class="bg-red-500 text-white px-4 py-2 mt-3 w-full">SEARCH</button>
        </div>

        <div id="flightsSection" class="hidden">
            <h3>Flight Search</h3>
            <input type="text" placeholder="From (e.g., Kathmandu)" class="border p-2 w-full">
            <input type="text" placeholder="To (e.g., Pokhara)" class="border p-2 w-full mt-2">
            <input type="date" class="border p-2 w-full mt-2">
            <button class="bg-red-500 text-white px-4 py-2 mt-3 w-full">SEARCH</button>
        </div>
    </div>

    <script>
        const activitiesBtn = document.getElementById("activitiesBtn");
        const busBtn = document.getElementById("busBtn");
        const flightsBtn = document.getElementById("flightsBtn");
        const activitiesSection = document.getElementById("activitiesSection");
        const busSection = document.getElementById("busSection");
        const flightsSection = document.getElementById("flightsSection");

        function toggleSection(activeSection) {
            activitiesSection.classList.add("hidden");
            busSection.classList.add("hidden");
            flightsSection.classList.add("hidden");
            activeSection.classList.remove("hidden");
        }

        activitiesBtn.addEventListener("click", () => toggleSection(activitiesSection));
        busBtn.addEventListener("click", () => toggleSection(busSection));
        flightsBtn.addEventListener("click", () => toggleSection(flightsSection));
    </script>

</body>
</html>
