<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ছুটি সংক্রান্ত - আবেদন ফর্ম') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Add a row of buttons -->
                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        <a href="{{route('leave.create')}}" class="btn">ছুটির আবেদন করুন </a>
                        <a href="{{route('leave.index')}}" class="btn">সকল আবেদন গুলো দেখুন </a>
                    </div>

                    <div class="mt-16">
                        <form action="{{route('leave.update')}}" method="post" class="space-y-4">
                            @csrf
                            <!-- Add your form fields here -->



                            <div>
                                <label for="number" class="mt-2 block text-sm font-medium text-gray-700">নম্বর</label>
                                <input disabled value="{{{$leave->profile->number}}}" autocomplete="off" placeholder="এখানে নম্বর লিখুন " type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md">
                                <span class="mt-2"> {{$leave->profile->rank }} {{$leave->profile->name}}, {{$leave->profile->coy}} কোম্পানি</span>
                                <div id="searchResults" class="mt-2"></div>
                            </div>

                            <div>
                                <label for="start_date" class="mt-2 block text-sm font-medium text-gray-700"> ছুটি শুরুর তারিখ</label>
                                <input value="{{$startDate}}" name="start_date" id="start_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">

                           
                            </div>



                            <div>
                                <label for="joining_date" class="mt-2 block text-sm font-medium text-gray-700"> ছুটি শেষে প্রত্যাবর্তনের তারিখ</label>
                                <input value="{{$joinDate}}" name="joining_date" id="joining_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mb-2  mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                                {{-- <span id="date_difference"> দিন</span> --}}
                            </div>

                            <div>
                                <label for="reason" class="block text-sm font-medium text-gray-700">কারণ</label>
                                <input value="{{$leave->reason}}" autocomplete="off" placeholder="এখানে কারণ লিখুন " type="reason" name="reason" id="reason" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="type" class="mt-2 block text-sm font-medium text-gray-700">ছুটির ধরণ</label>
                                <select name="type" id="type" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value=""> নির্বাচন করুন</option>
                                    <option value="Night pass" {{ $leave->type === 'Night pass' ? 'selected' : '' }}>Night pass</option>
                                    <option value="P/L" {{ $leave->type === 'P/L' ? 'selected' : '' }}>P/L</option>
                                    <option value="C/L" {{ $leave->type === 'C/L' ? 'selected' : '' }}>C/L</option>
                                    <option value="Medical Leave" {{ $leave->type === 'Medical Leave' ? 'selected' : '' }}>Medical Leave</option>
                                    <option value="R/L" {{ $leave->type === 'R/L' ? 'selected' : '' }}>R/L</option>
                                    <option value="Emergency" {{ $leave->type === 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="ordered_by" class="mt-2 block text-sm font-medium text-gray-700">অনুমতি প্রদানকারী</label>
                                <select name="ordered_by" id="ordered_by" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value=""> নির্বাচন করুন</option>
                                    <option value="CO" {{ $leave->ordered_by === 'CO' ? 'selected' : '' }}>CO</option>
                                    <option value="2IC" {{ $leave->ordered_by === '2IC' ? 'selected' : '' }}>2IC</option>
                                    <option value="Coy Comd" {{ $leave->ordered_by === 'Coy Comd' ? 'selected' : '' }}>Coy Comd</option>
                                    <option value="Adjt" {{ $leave->ordered_by === 'Adjt' ? 'selected' : '' }}>Adjt</option>
                                    <option value="QM" {{ $leave->ordered_by === 'QM' ? 'selected' : '' }}>QM</option>
                                    <option value="Other" {{ $leave->ordered_by === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="applicant_name" class="block text-sm font-medium text-gray-700">আবেদনকারীর নাম</label>
                                <input value="{{$leave->applicant_name}}" autocomplete="off" placeholder="এখানে আপনার নাম লিখুন " type="text" name="applicant_name" id="applicant_name" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>



                             

                            <!-- Add more form fields as needed -->
                            <input style="visibility: hidden" value="{{{$leave->id}}}" name="id">
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

{{-- <script>$(document).ready(function() {
    $('#number').on('input', function() {
        var query = $(this).val();

        // Perform AJAX request to fetch matching profiles
        $.ajax({
            url: '/search-profiles',
            method: 'GET',
            data: { query: query },
            success: function(response) {
                var results = response.data;

                // Clear previous search results
                $('#searchResults').empty();

                // Append search results as cards
                results.forEach(function(profile) {
                    var card = $('<div class="card bg-gray-100 p-4 mb-2">' +
                                    '<div class="font-semibold">' + profile.number + '</div>' +
                                    '<div>' + profile.name + '</div>' +
                                    '<div>' + profile.rank + '</div>' +
                                    '<div>' + profile.trade + '</div>' +
                                    // Add more profile details as needed
                                '</div>');

                    card.click(function() {
                        // Populate input field with selected profile number
                        $('#number').val(profile.number);
                        // Clear search results
                        $('#searchResults').empty();
                    });

                    $('#searchResults').append(card);
                });
            }
        });
    });
});


</script> --}}


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



<body>
   
    

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.25.0/date-fns.min.js"></script>
<script>
    // Function to calculate the difference in days between two dates
    function calculateDateDifference() {
        var startDateStr = document.getElementById('start_date').value;
        var joinDateStr = document.getElementById('joining_date').value;

        // Parse the dates
        var startDateParts = startDateStr.split('/');
        var joinDateParts = joinDateStr.split('/');

        // Ensure we have three parts for each date
        if (startDateParts.length !== 3 || joinDateParts.length !== 3) {
            console.error("Invalid date format. Please enter dates in the format dd/mm/yyyy.");
            return;
        }

        // Reconstruct the date strings in the format recognized by Date constructor (mm/dd/yyyy)
        var startDateObj = new Date(startDateParts[2], startDateParts[1] - 1, startDateParts[0]);
        var joinDateObj = new Date(joinDateParts[2], joinDateParts[1] - 1, joinDateParts[0]);

        // Check if the dates are valid
        if (isNaN(startDateObj.getTime()) || isNaN(joinDateObj.getTime())) {
            console.error("Invalid date format. Please enter dates in the format dd/mm/yyyy.");
            return;
        }

        // Calculate the difference in milliseconds
        var differenceInMs = joinDateObj - startDateObj;

        // Convert milliseconds to days
        var differenceInDays = Math.floor(differenceInMs / (1000 * 60 * 60 * 24));

        // Display the difference in the span element
        document.getElementById('date_difference').textContent = differenceInDays + ' দিন';
    }

    // Add input event listeners to both date input fields to trigger the calculation
    document.getElementById('start_date').addEventListener('input', calculateDateDifference);
    document.getElementById('joining_date').addEventListener('input', calculateDateDifference);

    // Call the function initially to display the initial difference
    calculateDateDifference();
</script>

