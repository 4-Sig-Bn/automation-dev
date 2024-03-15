<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ডাটাবেইজ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        <a href="{{route('docu.upload')}}" class="btn">ফাইল আপলোড (পিডিএফ)</a>
                        <a href="{{route('docu.view')}}" class="btn"> চিঠি দেখুন </a>
                    </div>


                    <div class="mt-16 container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                               
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">ফাইল আপলোড করুন</label>
                                                <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">

                                            </div>

                                            <div class="mb-3">

                                                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">শাখা</label>
                                                    <select name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option selected>শাখা নির্বাচন করুন</option>
                                                        <option value="এ শাখা">এ শাখা</option>
                                                        <option value="জি শাখা">জি শাখা</option>
                                                        <option value="কিউ শাখা">কিউ শাখা</option>
                                                        <option value="কমিউনিকেশন শাখা">কমিউনিকেশন শাখা</option>
                                                    </select>

                                            </div>

                                            <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">সাবমিট</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                
            </div>

            
        </div>
    </div>
</x-app-layout>


<style>
.btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #3490dc;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2779bd;
}

</style>

<body>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</body>