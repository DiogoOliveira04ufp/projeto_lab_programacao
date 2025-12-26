<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
</head>
<body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial; background:#f6f6f6;">
  <main style="max-width:420px;margin:60px auto;padding:18px;background:#fff;border:1px solid #ddd;border-radius:10px;">
    <h1 style="margin:0 0 14px 0;">Login</h1>
    <p style="margin:0 0 18px 0;color:#444;">Entra com a tua conta.</p>

    @if ($errors->any())
      <div style="margin:12px 0;padding:10px;border:1px solid #f1b0b7;background:#ffe5e8;border-radius:8px;">
        @foreach ($errors->all() as $error)
          <p style="color:#842029;margin:0;">{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
      @csrf

      <div style="margin:12px 0;">
        <label for="email" style="display:block;margin-bottom:6px;">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          value="{{ old('email') }}"
          required
          autofocus
          autocomplete="email"
          style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"
        >
      </div>

      <div style="margin:12px 0;">
        <label for="password" style="display:block;margin-bottom:6px;">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          autocomplete="current-password"
          style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"
        >
      </div>
      <button
        type="submit"
        style="width:100%;padding:10px;border:0;border-radius:8px;background:#111;color:#fff;cursor:pointer;font-weight:600;"
      >
        Entrar
      </button>
    </form>
  </main>
</body>
</html>
