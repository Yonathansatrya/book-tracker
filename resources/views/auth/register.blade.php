<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<body class="min-h-screen flex">
    <div class="w-full md:w-1/2 flex flex-col justify-center px-35 py-16 bg-white">
        <h2 class="text-3xl text-center font-bold mb-6">Get Started Now</h2>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            @method('POST')
            <div>
                <input type="text" name="name" placeholder="Name"
                    class="w-full px-4 py-2 border rounded-[4px] focus:outline-none focus:ring focus:border-blue-300"
                    required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email address"
                    class="w-full px-4 py-2 border rounded-[4px] focus:outline-none focus:ring focus:border-blue-300"
                    required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-2 border rounded-[4px] focus:outline-none focus:ring focus:border-blue-300"
                    required>
            </div>

            <div class="flex items-center">
                <input type="checkbox" class="mr-2" required>
                <label>I agree to the terms & policy</label>
            </div>

            <button type="submit"
                class="w-full bg-amber-800 text-white py-2 rounded-[4px] hover:bg-amber-700 transition">
                Signup
            </button>
        </form>

        <div class="my-4 text-center text-[#F5F5F5]">——————— <span class="text-black">or</span>———————</div>

        <div class="flex gap-4">
            <button class="w-full border py-2 rounded-lg flex items-center justify-center gap-2 hover:bg-gray-100">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                Sign in with Google
            </button>
            <button class="w-full border py-2 rounded-lg flex items-center justify-center gap-2 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 256 315">
                    <path
                        d="M213.803 167.03c.442 47.58 41.74 63.413 42.197 63.615c-.35 1.116-6.599 22.563-21.757 44.716c-13.104 19.153-26.705 38.235-48.13 38.63c-21.05.388-27.82-12.483-51.888-12.483c-24.061 0-31.582 12.088-51.51 12.871c-20.68.783-36.428-20.71-49.64-39.793c-27-39.033-47.633-110.3-19.928-158.406c13.763-23.89 38.36-39.017 65.056-39.405c20.307-.387 39.475 13.662 51.889 13.662c12.406 0 35.699-16.895 60.186-14.414c10.25.427 39.026 4.14 57.503 31.186c-1.49.923-34.335 20.044-33.978 59.822M174.24 50.199c10.98-13.29 18.369-31.79 16.353-50.199c-15.826.636-34.962 10.546-46.314 23.828c-10.173 11.763-19.082 30.589-16.678 48.633c17.64 1.365 35.66-8.964 46.64-22.262" />
                </svg>
                Sign in with Apple
            </button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
            Have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Sign in</a>
        </p>
    </div>

    <div class="hidden md:flex w-1/2 bg-[#F3D2A1] rounded-l-[32px] items-center justify-center">
        <img src="{{ asset('bookshelf.svg') }}" alt="Bookshelf" class="w-[350px] h-auto">
    </div>
</body>

</html>
