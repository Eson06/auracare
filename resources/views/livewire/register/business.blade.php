@extends('back.layout.auth')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Business Owner')

<link rel="manifest" href="{{ asset('/manifest.json') }}">
<script src="{{ asset('/sw.js') }}"></script>

@section('content')
<style>
  body {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 1rem;
    padding: 2rem;
  }

  .form-label {
    font-weight: 500;
  }

  .btn-primary {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    border: none;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
  }

  .section-title {
    font-weight: 600;
    border-left: 4px solid #2575fc;
    padding-left: 8px;
  }
</style>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="container py-5">
  <div class="card glass-card shadow-lg" style="max-width: 600px; margin: auto;">
    
    <div class="text-center mb-4">
      <a href="." class="navbar-brand">
        <img src="{{ asset('images/AuraCare_Logo.png') }}" alt="AuraCare Logo" style="height: 70px;">
      </a>
      <h4 class="fw-bold mt-3 text-dark">Business Owner Registration</h4>
      <p class="text-muted small">Please fill out the form to register your business account</p>
    </div>

    <form action="{{ route('store.business') }}" method="POST" autocomplete="off">
      @csrf

      {{-- Personal Information --}}
      <h5 class="section-title mb-3">Personal Information</h5>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="contact_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" required>
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Home Address</label>
        <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
      </div>

      <hr class="my-4">

      {{-- Business Information --}}
      <h5 class="section-title mb-3">Business Information</h5>

      <div class="mb-3">
        <label for="business_type" class="form-label">Business Type</label>
        <select class="form-select" id="business_type" name="business_type" required>
          <option value="">-- Select Business Type --</option>
          <option value="spa">Spa</option>
          <option value="salon">Salon</option>
          <option value="spa and salon">Spa and Salon</option>
        </select>
      </div>
      

      <div class="mb-3">
        <label for="business_name" class="form-label">Business Name</label>
        <input type="text" class="form-control" id="business_name" name="business_name" required>
      </div>

      <div class="mb-3">
        <label for="business_address" class="form-label">Business Address</label>
        <textarea class="form-control" id="business_address" name="business_address" rows="2" required></textarea>
      </div>

      <div class="mb-3">
        <label for="business_permit" class="form-label">Business Permit No.</label>
        <input type="text" class="form-control" id="business_permit" name="business_permit" required>
      </div>

      <div class="mb-3">
        <label for="expiration_date" class="form-label">Permit Expiration Date</label>
        <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
      </div>

      <div class="mb-3">
        <label for="opening_time" class="form-label">Opening Time</label>
        <select class="form-select" id="opening_time" name="opening_time" required>
            <option value="">-- Select Opening Time --</option>
            @foreach ([
                '01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM',
                '07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM',
                '01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM',
                '07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM','12:00 AM'
            ] as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="closing_time" class="form-label">Closing Time</label>
        <select class="form-select" id="closing_time" name="closing_time" required>
            <option value="">-- Select Closing Time --</option>
            @foreach ([
                '01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM',
                '07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM',
                '01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM',
                '07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM','12:00 AM'
            ] as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </select>
    </div>
    


      <hr class="my-4">

      {{-- Login Credentials --}}
      <h5 class="section-title mb-3">Login Credentials</h5>
      <div class="mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
        <i class="bi bi-briefcase me-1"></i> Register Business
      </button>

      <div class="text-center mt-3">
        <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
          Already have an account? <span class="text-primary">Sign in</span>
        </a>
      </div>
    </form>

  </div>
</div>
@endsection
