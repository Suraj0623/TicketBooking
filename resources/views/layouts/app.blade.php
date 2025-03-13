<x-header/>

    <!-- Main Content -->
    <div class="container mt-5">
        @yield('content')
    </div>

   
    <x-footer/>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                // Example validation logic
                const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
                let isValid = true;
    
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid'); // Add a class to style invalid fields
                        const errorMessage = input.nextElementSibling || document.createElement('span');
                        errorMessage.textContent = 'This field is required.';
                        errorMessage.style.color = 'red';
                        input.after(errorMessage);
                    } else {
                        input.classList.remove('is-invalid');
                        const errorMessage = input.nextElementSibling;
                        if (errorMessage) {
                            errorMessage.textContent = '';
                        }
                    }
                });
    
                if (!isValid) {
                    event.preventDefault(); // Prevent the form submission if validation fails
                    alert('Please fill out all required fields.');
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>