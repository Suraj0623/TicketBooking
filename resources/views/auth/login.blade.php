<x-form action="{{route('LoginMatch')}}" method="POST">
 <!-- Email Address -->
 <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Password -->
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Remember Me Checkbox (optional) -->
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember" name="remember">
    <label class="form-check-label" for="remember">Remember me</label>
</div>

<!-- Forgot Password Link -->
<div class="d-flex justify-content-between mb-3">
    {{-- <a href="{{ route('password.request') }}">Forgot Password?</a> --}}
    <a href="">Forgot Password?</a>
</div>

<!-- Login Button -->
<button type="submit" class="btn btn-primary w-100">Login</button>
<div class="text-center mt-4">
    <p>New User <a href="{{ route('register') }}">Registration</a></p>
</div>
</x-form>

