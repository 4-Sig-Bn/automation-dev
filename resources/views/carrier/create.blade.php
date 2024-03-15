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
                    <!-- Add a row of buttons -->
                    <div class="flex space-x-8">
                        <a href="{{route('carrier.create')}}" class="btn">ক্যারিয়ার প্ল্যান তৈরি করুন </a>
                        <a href="{{route('carrier.index')}}" class="btn">সকল প্ল্যান</a>
                    </div>

                    <div class="mt-16">
                        <form action="{{route('carrier.store')}}" method="post" class="space-y-4">
                            @csrf
                            <!-- Add your form fields here -->

                            <div>
                                <label for="number" class="mt-2 block text-sm font-medium text-gray-700">নম্বর</label>
                                <input placeholder="এখানে নম্বর লিখুন " type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md">
                                <div id="searchResults" class="mt-2"></div>
                            </div>

                            <div>
                                <label for="year" class="mt-2 block text-sm font-medium text-gray-700">বর্ষ</label>
                                <input disabled value="২০২৪" type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md">
                            </div>


                            <div>
                                <label for="cycle_status_1" class="mt-2 block text-sm font-medium text-gray-700">১ম প্রশিক্ষণ চক্র</label>
                                <select name="cycle_status_1" id="cycle_status_1" class="mt-1 p-2 w-full border rounded-md">
                                    @foreach($carrierStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach 
                                </select>
                            </div>

                            <div>
                                <label for="cycle_status_2" class="mt-2 block text-sm font-medium text-gray-700">২য় প্রশিক্ষণ চক্র</label>
                                <select name="cycle_status_2" id="cycle_status_2" class="mt-1 p-2 w-full border rounded-md">
                                    @foreach($carrierStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div>
                                <label for="cycle_status_3" class="mt-2 block text-sm font-medium text-gray-700">৩য় প্রশিক্ষণ চক্র</label>
                                <select name="cycle_status_3" id="cycle_status_3" class="mt-1 p-2 w-full border rounded-md">
                                    @foreach($carrierStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div>
                                <label for="cycle_status_4" class="mt-2 block text-sm font-medium text-gray-700">৪র্থ প্রশিক্ষণ চক্র</label>
                                <select name="cycle_status_4" id="cycle_status_4" class="mt-1 p-2 w-full border rounded-md">
                                    @foreach($carrierStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach 
                                </select>
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

