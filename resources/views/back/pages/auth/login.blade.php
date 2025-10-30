@extends('back.layout.auth')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login Page')

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
    font-family: "Inter", sans-serif;
    color: #000;
  }

  .glass-card {
    backdrop-filter: blur(15px);
    background: rgba(255, 255, 255, 0.85);
    border: none;
    border-radius: 1rem;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.3);
  }

  .form-control {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    color: #000;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    background-color: #fff;
    color: #000;
    box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.25);
    border-color: #2575fc;
  }

  .btn-primary {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    background: linear-gradient(90deg, #5b0ecb, #1b65f5);
  }

  .btn-modern {
    background: linear-gradient(135deg, #ffb800 0%, #ff8c00 100%);
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
  }

  .btn-modern:hover {
    background: linear-gradient(135deg, #ffca2b 0%, #ff9a1c 100%);
    box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
    transform: translateY(-2px);
  }

  .login-title {
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    color: #000;
  }

  .alert {
    border-radius: 0.5rem;
  }

  label.form-label {
    font-weight: 600;
    color: #000;
  }

  .navbar-brand img {
    width: 150px;
    height: auto;
    object-fit: contain;
  }

  .register-buttons {
    margin-top: 0.5rem;
    text-align: center;
  }

  .register-buttons .btn {
    margin-top: 0.25rem;
  }
</style>

<div class="container py-5">
  <div class="card glass-card p-4 shadow-lg w-100" style="max-width: 550px; margin: auto;">

    <div class="text-center mb-4">
      <a href="." class="navbar-brand">
        <img src="{{ asset('images/AuraCare_Logo.png') }}" alt="AuraCare Logo">
      </a>
    </div>

    <div class="text-center login-title">Login to Your Account</div>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-1"></i> 
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill me-1"></i>
        {{ session('error') }}
      </div>
    @endif

    @if(Session::get('fail'))
      <div class="alert alert-warning d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ Session::get('fail') }}
      </div>
    @endif

    @if(Session::get('ban'))
      <div class="alert alert-danger d-flex align-items-center">
        <i class="bi bi-x-circle-fill me-2"></i>
        {{ Session::get('ban') }}
      </div>
    @endif

    <form action="{{ route('custom.login') }}" method="POST" autocomplete="off">
      @csrf
      <div class="mb-3">
        <label class="form-label">User Name</label>
        <input type="text" 
               class="form-control @error('user_name') is-invalid @enderror"
               name="user_name"
               placeholder="Enter your User Name"
               autofocus>
        @error('user_name')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <!-- ✅ Updated Password Field with Show/Hide -->
      <div class="mb-4">
        <label class="form-label">Password</label>
        <div class="input-group">
          <input type="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 name="password" 
                 id="password"
                 placeholder="Enter your password">
          <button type="button" class="btn btn-outline-secondary" id="togglePassword">
            <i class="bi bi-eye"></i>
          </button>
        </div>
        @error('password')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
        <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
      </button>
    </form>

    <div class="register-buttons">
      <p class="mb-2 fw-semibold">Don’t have an account?</p>
      <div class="d-grid gap-2">
        <a href="{{ route('business') }}" class="btn btn-modern py-2">
          🏢 Register as Business Owner
        </a>
        <a href="{{ route('customer') }}" class="btn btn-modern py-2">
          👤 Register as Customer
        </a>
      </div>
    </div>

  </div>
</div>

<!-- ✅ Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- ✅ Show/Hide Password Script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
      this.innerHTML = type === "password"
        ? '<i class="bi bi-eye"></i>'
        : '<i class="bi bi-eye-slash"></i>';
    });
  });
</script>

<script>
if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("/sw.js").then(
    () => console.log("PWA is now fully prepared for use!"),
    (error) => console.error(`Service worker registration failed: ${error}`)
  );
} else {
  console.error("Service workers are not supported.");
}
</script>
@endsection
