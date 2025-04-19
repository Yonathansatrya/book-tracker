<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 Not Found</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-white">
  <div class="w-full flex justify-center">
    <img src="{{ asset('404/Books.svg') }}" alt="Books Hanging" class="w-[300px] md:w-[450px]" />
  </div>

  <main class="grid place-items-center px-6 py-10 text-center">
    <div>
      <h1 class="text-6xl font-bold text-amber-600">404</h1>
      <p class="mt-4 text-2xl font-semibold text-gray-900">Looks like you’ve got lost…</p>
      <p class="mt-2 text-gray-500 text-base">The page you’re looking for doesn’t exist or has been moved.</p>

      <a href="{{ route('home') }}" class="mt-6 inline-block bg-amber-800 text-white px-5 py-2 rounded-[4px] hover:bg-amber-700 transition">
        Go Home
      </a>
    </div>
  </main>

  <div class="w-full flex justify-end pr-20 pb-4">
    <img src="{{ asset('404/father_and_son.svg') }}" alt="People Reading" class="w-[160px] md:w-[200px]" />
  </div>

</body>
</html>
