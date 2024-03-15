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
                    <div class="flex space-x-16">
                        <a href="{{route('leave.create')}}" class="btn mr-2">ছুটির আবেদন করুন </a>
                        <a href="{{route('leave.index')}}" class="btn">সকল আবেদন গুলো দেখুন </a>
                        {{-- <a href="{{route('adjtreport.home')}}" class="btn">Report to Adjutant </a> --}}
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