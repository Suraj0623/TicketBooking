<x-header />

<main class="container" style="margin-top: 80px;">
  <div class="card mx-auto my-4 shadow-sm" style="max-width: 600px;">
    <div class="card-body">
      <h1 class="card-title mb-4 text-center">Payment Details</h1>
      <p class="card-text text-center mb-4">
        <strong>Total Amount:</strong> Rs{{ number_format($totalAmount, 2) }}
      </p>
      <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $bookingId }}">

        <div class="mb-3">
          <label for="payment_method" class="form-label">Payment Method:</label>
          <select class="form-select" id="payment_method" name="payment_method" required>
            <option value="Esewa">Esewa</option>
            <option value="credit_card">Credit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Make Payment</button>
      </form>

      <hr class="my-4">

      <h3 class="text-center">QR Code for Payment</h3>
      <div class="text-center">
        <img src="{{ asset('qr_codes/your_qr_code.png') }}" alt="Payment QR Code" class="img-fluid" style="max-width:200px;">
      </div>
    </div>
  </div>
</main>

<x-footer />
