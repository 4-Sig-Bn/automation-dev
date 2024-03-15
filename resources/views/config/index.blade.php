<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ডাটাবেইজ') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">

        <div class="flex py-12 w-1/2 ">
            <div class="max-w mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Add a row of buttons -->
                        <div class="flex ">
                            <a href="{{route('users.create')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2">  ইউজার তৈরি  করুন  </a>
                            <a href="{{route('users.index')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2"> সকল  ইউজার  </a>
                            <a href="{{route('users.permit.index')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2"> ইউজার পারমিশন </a>
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
