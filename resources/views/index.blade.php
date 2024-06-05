<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="https://developing.nl/wp-content/themes/developing/public/img/decoration5.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>UrenRegistratie</title>
</head>
<body>
    <div class="w-full text-center">
        <div class="w-full flex justify-center items-center min-h-screen">
            <div class="w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-5/12 bg-slate-600 p-8 sm:p-10 rounded-xl">
                <a href="{{ route('getTimeEntries') }}" class="block bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-2 py-2 px-4 rounded">&#x21BB; Time Entries</a>
                <a href="{{ route('refreshTagsData') }}" class="block bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-2 py-2 px-4 rounded">&#x21BB; Tags</a>
                <a href="{{ route('getEmployees') }}" class="block bg-blue-500 text-black hover:bg-black hover:text-white font-bold my-2 py-2 px-4 rounded">&#x21BB; Users</a>

                <h1 class="text-center text-white text-2xl font-bold mt-6 mb-4">Rapportage downloaden</h1>
                <form action="{{ route('filterUren') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label for="start-date" class="text-white">Van</label>
                        <input type="date" id="start-date" class="block w-full p-2 rounded-lg border border-gray-300">

                        <label for="end-date" class="text-white">Tot</label>
                        <input type="date" id="end-date" class="block w-full p-2 rounded-lg border border-gray-300">

                        <label for="country" class="text-white">Tag</label>
                        <select id="country" class="block w-full p-2 rounded-lg border border-gray-300">
                            @if ($tags->isNotEmpty())
                            @foreach ($tags as $tag)
                            <option>{{ $tag->tag }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="w-full text-center mt-6">
                        <button type="submit" class="w-[35%] sm:w-[40%] bg-blue-500 text-white hover:bg-pink-500 font-bold py-2 px-4 rounded">
                            Download PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
