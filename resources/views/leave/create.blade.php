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
                        <form action="{{route('leave.store')}}" method="post" class="space-y-4">
                            @csrf
                            <!-- Add your form fields here -->

                            <div>
                                <label for="number" class="mt-2 block text-sm font-medium text-gray-700">নম্বর</label>
                                <input autocomplete="off" placeholder="এখানে নম্বর লিখুন " type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md">
                                <div id="searchResults" class="mt-2"></div>
                            </div>

                            <div>
                                <label for="start_date" class="mt-2 block text-sm font-medium text-gray-700"> ছুটি শুরুর তারিখ</label>
                                <input name="start_date" id="start_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>

                            <div>
                                <label for="joining_date" class="mt-2 block text-sm font-medium text-gray-700"> ছুটি শেষে প্রত্যাবর্তনের তারিখ</label>
                                <input name="joining_date" id="joining_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>

                            <div>
                                <label for="reason" class="block text-sm font-medium text-gray-700">কারণ</label>
                                <input autocomplete="off" placeholder="এখানে কারণ লিখুন " type="reason" name="reason" id="reason" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="type" class="mt-2 block text-sm font-medium text-gray-700">ছুটির ধরণ</label>
                                <select name="type" id="type" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value=""> নির্বাচন করুন</option>
                                    <option value="Night pass">Night pass</option>
                                    <option value="P/L">P/L</option>
                                    <option value="C/L">C/L</option>
                                    <option value="Medical Leave">Medical Leave</option>
                                    <option value="R/L">R/L</option>
                                    <option value="Emergency">Emergency</option>
                                </select>
                            </div>

                            <div>
                                <label for="ordered_by" class="mt-2 block text-sm font-medium text-gray-700">অনুমতি প্রদানকারী</label>
                                <select name="ordered_by" id="ordered_by" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value=""> নির্বাচন করুন</option>
                                    <option value="CO">CO</option>
                                    <option value="2IC">2IC</option>
                                    <option value="Coy  Comd">Coy  Comd</option>
                                    <option value="Adjt">Adjt</option>
                                    <option value="QM">QM</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="applicant_name" class="block text-sm font-medium text-gray-700">আবেদনকারীর নাম</label>
                                <input autocomplete="off" placeholder="এখানে আপনার নাম লিখুন " type="text" name="applicant_name" id="applicant_name" class="mt-1 p-2 w-full border rounded-md" required>
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

<script>$(document).ready(function() {
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>

