<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
</head>
<body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;">
  <main style="max-width:700px;margin:60px auto;">
    <h1 style="margin:0 0 10px 0;">Dashboard</h1>
    <p style="margin:0 0 18px 0;">Estás autenticado.</p>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" style="padding:10px 14px;border:1px solid #ccc;border-radius:8px;cursor:pointer;">
        Logout
      </button>
    </form>
  </main>
</body>
</html>
