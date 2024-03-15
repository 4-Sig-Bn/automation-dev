<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ডাটাবেইজ') }}
        </h2>
    </x-slot>


    <div class="flex">
        <div class="flex-initial py-12 w-full">
            <div class="max-w mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Add a row of buttons -->
                        <div class="flex ">
                            <a href="{{route('users.create')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2">  ইউজার তৈরি  করুন  </a>
                            <a href="{{route('users.index')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2"> সকল  ইউজার  </a>
                            <a href="{{route('users.permit.index')}}" class="btn flex-auto text-gray-700 text-center bg-gray-400 px-4 py-2 m-2"> ইউজার পারমিশন </a>
                        </div>

                        <div class="py-12">
                            <div class="max-w mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                    
                                        <!-- Add a row of buttons -->
                                        <div class="flex space-x-8">
                    
                    
                                        </div>
                    
                                        <div class="mt-6">
                                            <div style="max-height: 800px; overflow-y: auto;">
                                                 <!-- Display Data in Table -->
                    
                                                <table id ="myTable" class="table table-striped nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> নাম </th>
                                                        <th> ইমেইল </th>
                                                        <th> রোল </th>
                                                        <th> স্ট্যাটাস </th>
                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @foreach ($user->roles as $role)
                                                                {{ $role->name }}<br>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if($loggedInUser && $loggedInUser->id == $user->id)
                                                                Logged in
                                                            @elseif($isLoggedIn)
                                                                User is logged in
                                                            @else
                                                                User is not logged in
                                                            @endif
                                                        </td>
                    
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                    
                                                </table>
                                            </div>
                                        </div>
                    
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


</style>


<script>
    new DataTable('#myTable', {

        paging: true,
        scrollCollapse: true,
        scrollX: true,
        autoWidth: true,
        scrollY: 590,
        
});

    
    </script>

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