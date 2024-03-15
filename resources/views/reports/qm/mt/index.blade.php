<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ডাটাবেইজ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        {{-- <a href="{{route('soldierprofile.create')}}" class="btn">প্রোফাইল তৈরি করুন </a> --}}
                        <a href="{{route('mtreport.all')}}" class="btn">সকল রিপোর্ট</a>
                    </div>

                    <div class="mt-16">
                        <form action="{{route('mtreport.store')}}" method="post" class="space-y-4">
                            @csrf
                            <!-- Add your form fields here -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">বিবরণ</label>
                                <textarea placeholder="এখানে বিবরণ লিখুন " name="content" id="content" class="mt-1 p-2 w-full border rounded-md"></textarea>
                            </div>
                            
                            <!-- Add more form fields as needed -->

                            <button type="submit" class="mt-6 btn bg-blue-500 text-white">সাবমিট</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<body>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
</body>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>