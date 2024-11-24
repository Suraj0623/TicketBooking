<title>Register</title>
<x-form action="{{route('registerSave')}}" method="POSt">
    <div class="form-group mb-3">
        <label for="FirstName">First Name</label>
        <input type="text" name="FirstName" id="FirstName" class="form-control @error('FirstName') is-invalid @enderror" value="{{ old('FirstName') }}" required>
        @error('FirstName')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Last Name -->
    <div class="form-group mb-3">
        <label for="LastName">Last Name</label>
        <input type="text" name="LastName" id="LastName" class="form-control @error('LastName') is-invalid @enderror" value="{{ old('LastName') }}" required>
        @error('LastName')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Mobile Number -->
    <div class="form-group mb-3">
        <label for="mobileNumber">Mobile Number</label>
        <input type="text" name="mobileNumber" id="mobileNumber" class="form-control @error('mobileNumber') is-invalid @enderror" value="{{ old('mobileNumber') }}" required>
        @error('mobileNumber')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- email --}}
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="form-group mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <!-- Submit Button -->
    <div class="form-group text-center mt-4">
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </div>

    <!-- Sign In Link -->
    <div class="text-center mt-3">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</x-form>