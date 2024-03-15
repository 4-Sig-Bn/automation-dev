<?php require_once(resource_path('views/leave/helpers.php')); ?>


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
                    {{-- " --}}
                    {{-- <form  action="{{ route('soldierprofile.csvupload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div>
                            <label for="csv_file">Upload CSV File</label>
                            <input type="file" name="csv_file" id="csv_file">
                        </div>
                    
                        <button class="btn mb-6" type="submit">Upload</button>
                    </form> --}}
                    
                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        <a href="{{route('leave.create')}}" class="btn">ছুটির আবেদন করুন </a>
                        <a href="{{route('leave.index')}}" class="btn">সকল আবেদন গুলো দেখুন </a>

                    </div>
                    @php

                    $count = 0;
                

                   
                    @endphp

                    <div class="mt-6">
                        <div style="max-height: 800px; overflow-y: auto;">
                             <!-- Display Data in Table -->

                            <table id ="myTable" class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> ছবি</th>
                                        <th> নাম</th>
                                        <th >নম্বর</th>
                                        <th >কোম্পানি</th>
                                        <th >গমনের তারিখ</th>
                                        <th >আগমনের তারিখ</th>
                                        <th >ছুটির ধরণ </th>
                                        <th >ছুটির কারণ </th>

                                        <th >অনুমোদন কারী</th>
                                        <th >আবেদনকারী</th>
                                        <th >স্ট্যাটাস </th>
                                        <th > একশন </th>
                                        <!-- Add more table headers as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaves as $leave)
                                    <tr>
                                        <td>{{ $count = $count + 1;}}</td>
                                        <td>
                                            <img src="{{ asset('upload/profileImage/' . $leave->profile->image) }}" alt="Profile Image" style="max-width: 50px; max-height: 50px; width: 50px; height: auto;">
                                        </td>
                                        
                                        <td>{{ $leave->profile->name }}</td>
                                        <td >{{ $leave->profile->number }}</td>

                                        <td >{{ $leave->profile->coy }}</td>
                                        @php
                                            $enrolmentDate = \Carbon\Carbon::createFromFormat('Y-m-d', $leave->start_date)->format('d-m-Y');
                                            $unitJoinDate = \Carbon\Carbon::createFromFormat('Y-m-d', $leave->end_date)->format('d-m-Y');
                                        @endphp
                                        <td>{{ bn_number(date('d', strtotime($enrolmentDate))) }}-{{ bn_number(date('m', strtotime($enrolmentDate))) }}-{{ bn_number(date('Y', strtotime($enrolmentDate))) }}</td>
                                        <td>{{ bn_number(date('d', strtotime($unitJoinDate))) }}-{{ bn_number(date('m', strtotime($unitJoinDate))) }}-{{ bn_number(date('Y', strtotime($unitJoinDate))) }}</td>

                                        <td >{{ $leave->type }}</td>
                                        <td >{{ $leave->reason }}</td>
                                        <td >{{ $leave->ordered_by }}</td>
                                        <td >{{ $leave->applicant_name }}</td>
                                        <td >{{ $leave->status }}</td>
                                    
                                        <td class="text-center">
                                            @if($leave->status === 'pending' && auth()->user()->email === 'admin@4sig.com')
                                            <!-- Your code here -->

                                            <form id="approveForm{{ $leave->id }}" action="{{ route('leave.statusChange', $leave->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" style="background-color: #145d39; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mr-1 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                                    Approve
                                                </button>
                                            </form>
                                            
                                            <form id="rejectForm{{ $leave->id }}" action="{{ route('leave.statusChange', $leave->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" style="background-color: #921515; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mr-1 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                                    Reject
                                                </button>
                                            </form>
                                            
                                        
                                            <a href="{{ route('leave.edit', $leave->id) }}" style="background-color: #2779bd; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mx-auto mr-4 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                                এডিট
                                            </a>
                                            @endif
                                        

                                            @if($leave->status ===  'pending' && auth()->user()->email != 'admin@4sig.com') 

                                            <a href="{{ route('leave.edit', $leave->id) }}" style="background-color: #2779bd; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mx-auto mr-4 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                                এডিট
                                            </a>
                                            
                                            @endif


                                            

                                            
                                        
                                        </td>
                                        
                                        <!-- Add more table data columns as needed -->
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
        order: [[0, 'desc']], 
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