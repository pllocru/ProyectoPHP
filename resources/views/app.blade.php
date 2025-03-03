<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @inertiaHead
    <script>
    
</script>

  </head>
  <body>
    @inertia
    <body>
    <div id="app" data-page="{{ json_encode($page) }}"></div> {{-- 👈 Esto es clave para evitar el error --}}
    @vite(['resources/js/app.js'])
</body>

  </body>
</html>