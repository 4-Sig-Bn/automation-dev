@include('leave/helpers')

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
                        <a href="{{ route('soldierprofile.create') }}" style="background-color: #2779bd; font-size: 16px;" class="hover:bg-blue-700 text-white  py-2 px-2 rounded  focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            প্রোফাইল তৈরি করুন
                        </a>
                        <a href="{{ route('soldierprofile.index') }}" style="background-color: #2779bd; font-size: 16px;" class="hover:bg-blue-700 text-white  py-2 px-2 rounded  focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            সকল প্রোফাইল
                        </a>

                        <a href="{{ route('backup.download') }}" style="background-color: #2779bd; font-size: 16px;" class="hover:bg-blue-700 text-white  py-2 px-2 rounded  focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            ব্যাকআপ
                        </a>


                    </div>
                    {{-- @php
                    function bn_number($number) {
                                        $bn_digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                                        $bn_number = '';
                                        $number = (string) $number; // Convert to string to handle each digit individually

                                        for ($i = 0; $i < strlen($number); $i++) {
                                            $bn_number .= $bn_digits[$number[$i]]; // Append Bengali numeral equivalent
                                        }

                                        return $bn_number;
                                    }
                    @endphp --}}

                    <div class="mt-6">
                        <div style="max-height: 800px; overflow-y: auto;">
                             <!-- Display Data in Table -->

                            <table id ="myTable" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> ছবি</th>
                                    <th> নাম</th>
                                    <th >নম্বর</th>
                                    <th >পদবী</th>
                                    <th >ট্রেড</th>
                                    <th >কোম্পানি</th>
                                    <th >বৈবাহিক অবস্থা</th>
                                    <th >চাকুরীতে যোগদানের তারিখ</th>
                                    <th >ইউনিটে যোগদানের তারিখ</th>
                                    <th > একশন </th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profiles as $profile)
                                <tr>
                                    <td>
                                        <img src="{{ asset('upload/profileImage/' . $profile->image) }}" alt="Profile Image" style="max-width: 50px; max-height: 50px; width: 50px; height: auto;">
                                    </td>
                                    
                                    <td>{{ $profile->name }}</td>
                                    <td >{{ $profile->number }}</td>
                                    <td >{{ $profile->rank }}</td>
                                    <td >{{ $profile->trade }}</td>
                                    <td >{{ $profile->coy }}</td>
                                    <td >{{ $profile->marital_status }}</td>
                                    @php
                                        $birthDate = \Carbon\Carbon::createFromFormat('Y-m-d', $profile->birth_date)->format('d-m-Y');
                                        $enrolmentDate = \Carbon\Carbon::createFromFormat('Y-m-d', $profile->enrolment_date)->format('d-m-Y');
                                        $unitJoinDate = \Carbon\Carbon::createFromFormat('Y-m-d', $profile->unit_join_date)->format('d-m-Y');
                                    @endphp
                                    
                                    <td>{{ bn_number(date('d', strtotime($enrolmentDate))) }}-{{ bn_number(date('m', strtotime($enrolmentDate))) }}-{{ bn_number(date('Y', strtotime($enrolmentDate))) }}</td>
                                    <td>{{ bn_number(date('d', strtotime($unitJoinDate))) }}-{{ bn_number(date('m', strtotime($unitJoinDate))) }}-{{ bn_number(date('Y', strtotime($unitJoinDate))) }}</td>
                                    <td class="text-center">
                                        
                                        <a href="{{ route('soldierprofile.view', $profile->id) }}" style="background-color: #cb6709; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mr-1 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                            দেখুন
                                        </a>

                                        <a href="{{ route('soldierprofile.edit', $profile->id) }}" style="background-color: #2779bd; font-size: 14px;" class="hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full mx-auto mr-4 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                            এডিট
                                        </a>



                                        
                                        {{-- <form action="{{ route('soldierprofile.delete', $profile->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded-full mx-auto focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                                ডিলেট
                                            </button>
                                        </form> --}}
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
        
});

    
    </script>
