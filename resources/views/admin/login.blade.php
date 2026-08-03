<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin — Fredian Farm</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/tabler/css/tabler.min.css') }}">
<style>
  body{font-family:'Inter',sans-serif;background:#EEF5EC;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
  .login-card{width:100%;max-width:400px;background:#fff;border:1px solid #eef0f2;border-radius:16px;box-shadow:0 10px 30px rgba(31,61,34,.12);padding:2rem;}
  .login-card h1{font-size:1.25rem;font-weight:800;color:#1F3D22;margin:0 0 .25rem;}
  .login-card .sub{font-size:.85rem;color:#9aa1a8;margin-bottom:1.5rem;}
  .form-control{font-size:.9rem;padding:.6rem .75rem;}
  .btn-login{width:100%;background:#2E7D32;color:#fff;font-weight:700;border:none;border-radius:8px;padding:.65rem;}
  .btn-login:hover{background:#1F3D22;}
</style>
</head>
<body>
  <div class="login-card">
    <div class="d-flex align-items-center gap-2 mb-3">
      <img src="{{ asset('images/logo.png') }}" alt="Fredian Farm" style="height:36px;width:auto;">
      <div>
        <h1>Login Admin</h1>
        <div class="sub">Masuk untuk mengelola Fredian Farm</div>
      </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger py-2" style="font-size:.85rem">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
      </div>
      <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember" style="font-size:.85rem;color:#5a6169">Ingat saya</label>
      </div>
      <button type="submit" class="btn-login">Masuk</button>
    </form>
    <div class="text-center mt-3">
      <a href="{{ url('/') }}" class="text-secondary" style="font-size:.8rem">&larr; Kembali ke website</a>
    </div>
  </div>
</body>
</html>
