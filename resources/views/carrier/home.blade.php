<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ক্যারিয়ার প্ল্যান') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        <a href="{{route('carrier.create')}}" class="btn">ক্যারিয়ার প্ল্যান তৈরি করুন </a>
                        <a href="{{route('carrier.index')}}" class="btn">সকল প্ল্যান</a>
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