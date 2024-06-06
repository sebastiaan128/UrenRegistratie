<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="https://developing.nl/wp-content/uploads/2023/02/icon.png" />
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
                    @if (session('error'))
                    <div id="alert-box" class="bg-red-100 border border-red-400 text-red-700 px-4 mb-4 py-3 rounded relative" role="alert">
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-red-500 cursor-pointer" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                            </svg>
                        </span>
                        {{ session('error') }}
                    </div>
                @endif
                
                <script>
                    function closeAlert() {
                        document.getElementById('alert-box').style.display = 'none';
                    }
                </script>
                
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label for="start-date" class="text-white">Van</label>
                        <input type="date" id="start-date" name="start_date" class="block w-full p-2 rounded-lg border border-gray-300">
                
                        <label for="end-date" class="text-white">Tot</label>
                        <input type="date" id="end-date" name="end_date" class="block w-full p-2 rounded-lg border border-gray-300">
                
                        <label for="country" class="text-white">Tag</label>
                        <select id="country" name="tag" class="block w-full p-2 rounded-lg border border-gray-300">
                            @if ($tags->isNotEmpty())
                            @foreach ($tags as $tag)
                            <option>{{ $tag->tag }}</option>
                            @endforeach
                            @endif
                        </select>
                        
                        {{-- Uncomment and add name attributes for additional fields as needed --}}
                        {{-- <label for="employees" class="text-white">Employees</label>
                        <select id="employees" name="employee" class="block w-full p-2 rounded-lg border border-gray-300">
                            @if ($employees->isNotEmpty())
                            @foreach ($employees as $username)
                            <option>{{ $username->username }}</option>
                            @endforeach
                            @endif
                        </select>
                
                        <label for="task" class="text-white">Task</label>
                        <select id="task" name="task" class="block w-full p-2 rounded-lg border border-gray-300">
                            @if ($time_entries->isNotEmpty())
                            @foreach ($time_entries as $task)
                            <option>{{ $task->task }}</option>
                            @endforeach
                            @endif
                        </select>
                
                        <label for="is_billable" class="text-white">Is Billable</label>
                        <select id="is_billable" name="is_billable" class="block w-full p-2 rounded-lg border border-gray-300">
                            <option value="true">Ja</option>
                            <option value="false">Nee</option>
                        </select> --}}
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
