<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>UrenRegistratie</title>
</head>
<body>
    <div class="w-full text-center">
    <div class="w-full flex justify-center items-center h-screen">
        <div class="w-[40%] bg-slate-600 p-20 rounded-xl">
            <a href="time_entries_page.html" class="w-auto bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-10 mx-5 py-2 px-4 rounded">&#x21BB; Time Entries </a>
            <a href="tags_page.html" class="w-auto bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-10 mx-5 py-2 px-4 rounded">&#x21BB; Tags</a>
            <a href="users_page.html" class="w-auto bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-10 mx-5 py-2 px-4 rounded">&#x21BB; Users</a>

            <h1 class="text-center text-white text-2xl font-bold mb-6">Rapportage downloaden</h1>
            <form action="{{ route('filterUren') }}" method="post">
               @csrf
                <div class="grid grid-cols-2">
                    <label for="start-date" class="text-white">Van</label>
                    <input type="date" id="start-date" class="block mx-auto my-2 p-2 rounded-lg border border-gray-300">
                    <label for="end-date" class="text-white">Tot</label>
                    <input type="date" id="end-date" class="block mx-auto my-2 p-2 rounded-lg border border-gray-300 ">
                    <label for="country" class="text-white">Tag</label>
                    <select id="country" class="block mx-auto my-2 p-2 rounded-lg border border-gray-300 ">
                        @if ($tags->isNotEmpty())
                        @foreach ($tags as $tag)
                        <option>{{ $tag->tag }}</option>

                        @endforeach

                        @endif
                        {{-- <option selected disabled>bedrijf</option>
                        <option value="US">United States</option> --}}
                    </select>
                </div>
                <div class="w-full text-center">
                <button type="submit" class="w-[35%] bg-blue-500 text-white hover:bg-pink-500 font-bold mt-10 py-2 px-4 rounded">
                    Download PDF
                </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
