@extends("layouts.default")
@section("title", "Login")
@section("content")
<body class="bg-gray-100 h-screen flex items-center justify-center" style="background-image: url('/path/to/background-image.jpg'); background-size: cover; background-position: center;">
    <main class="w-full max-w-md bg-white shadow-md rounded-lg p-8 bg-opacity-80 backdrop-filter backdrop-blur-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>
        @if (session('error'))
            <div class="mb-4 text-white text-center bg-red-500 py-2 px-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route("login.post") }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 shadow-sm" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="text-red-600">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 shadow-sm" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="text-red-600">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="mb-4">
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700 shadow-md">Login</button>
        </div>
        </form>
    </main>
</body>
@endsection
