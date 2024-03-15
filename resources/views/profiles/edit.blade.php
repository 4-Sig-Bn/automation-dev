<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ডাটাবেইজ') }}
        </h2>
    </x-slot>

    <?php
           include_once(app_path('Helpers/function.php'));         
    ?>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Add a row of buttons -->

                    <div class="flex space-x-8">
                        
                        <a href="{{ route('soldierprofile.create') }}" class="btn">প্রোফাইল তৈরি করুন</a>
                        <a href="{{ route('soldierprofile.index') }}" class="btn">সকল প্রোফাইল</a>
                    </div>

                    <div class="mt-16">
                        <form action="{{ route('soldierprofile.update', $profile->id) }}" method="post" class="space-y-4" enctype="multipart/form-data">

                            @csrf

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">বর্তমান ছবি</label>
                                <img src="{{ asset('upload/profileImage/' . $profile->image) }}" alt="Profile Image" style="max-width: 150px; max-height: 150px; width: 150px; height: auto;">
                                <label for="image" class="block text-sm font-medium text-gray-700">ছবি আপলোড করুন</label>
                                
                                <input name="image" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/*" >
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG (MAX. 500*500 px).</p>
                                
                                <!-- The 'accept' attribute restricts the file types to images only -->
                            </div>
                            <!-- Add your form fields here -->

                            <div>
                                <label for="number_type" class="mt-2 block text-sm font-medium text-gray-700"> নং</label>
                                <select name="number_type" id="number_type" class="mt-1 p-2 w-full border rounded-md" required onchange="toggleInputField()">
                                    <option value=""> ধরণ নির্বাচন করুন</option>
                                    <option value="Only number"  @if($profile->number_type === "Only number") selected @endif>সৈনিক নম্বর</option>
                                    <option value="BJO-number"  @if($profile->number_type === "BJO-number") selected @endif>বিজেও-নম্বর</option>
                                    <option value="BJO-NOYA"  @if($profile->number_type === "BJO-NOYA") selected @endif>বিজেও-নয়া</option>
                                    <option value="na"  @if($profile->number_type === "na") selected @endif>অপ্রযোজ্য</option>
                                </select>
                                <div id="inputField" style="@php echo ($profile->number_type === 'Only number' || $profile->number_type === 'BJO-number') ? 'display:block;' : 'display:none;'; @endphp">
                                    <input value="@php if($profile->number_type != null ) echo $profile->number; @endphp" placeholder="" type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md" required>
                                </div>
                                
                            </div>
                            <div>
                                <label for="rank" class="mt-2 block text-sm font-medium text-gray-700">পদবী</label>
                                <select name="rank" id="rank" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value="">পদবী নির্বাচন করুন</option>
                                    <option value="সৈনিক" @if($profile->rank === "সৈনিক") selected @endif>সৈনিক</option>
                                    <option value="ল্যান্স কর্পোরাল" @if($profile->rank === "ল্যান্স কর্পোরাল") selected @endif>ল্যান্স কর্পোরাল</option>
                                    <option value="কর্পোরাল" @if($profile->rank === "কর্পোরাল") selected @endif>কর্পোরাল</option>
                                    <option value="সার্জেন্ট" @if($profile->rank === "সার্জেন্ট") selected @endif>সার্জেন্ট</option>
                                    <option value="ওয়ারেন্ট অফিসার" @if($profile->rank === "ওয়ারেন্ট অফিসার") selected @endif>ওয়ারেন্ট অফিসার</option>
                                    <option value="সিনিয়র ওয়ারেন্ট অফিসার" @if($profile->rank === "সিনিয়র ওয়ারেন্ট অফিসার") selected @endif>সিনিয়র ওয়ারেন্ট অফিসার</option>
                                    <option value="মাস্টার ওয়ারেন্ট অফিসার" @if($profile->rank === "মাস্টার ওয়ারেন্ট অফিসার") selected @endif>মাস্টার ওয়ারেন্ট অফিসার</option>
                                </select>
                            </div>
                            

                            <div>
                                <label for="trade" class="mt-2 block text-sm font-medium text-gray-700">পেশা</label>
                                <select name="trade" id="trade" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($tradeStatusOptions as $value => $label)
                                        <option value="{{ $value }}" @if($value === $profile->trade) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">নাম</label>
                                <input autocomplete="off" value ="{{$profile->name}}" type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md">
                            </div>





                            

                            
                            <div>
                                <label for="coy" class="mt-2 block text-sm font-medium text-gray-700">কোম্পানি</label>
                                <select name="coy" id="coy" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($coyStatusOptions as $value => $label)
                                        <option value="{{ $value }}" @if($value === $profile->coy) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            

                            <div>
                                <label for="marital_status" class="mt-2 block text-sm font-medium text-gray-700">বৈবাহিক অবস্থা</label>
                                <select name="marital_status" id="marital_status" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($maritalStatusOptions as $value => $label)
                                        <option value="{{ $value }}" @if($value === $profile->marital_status) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div>
                                <label for="blood_gp" class="mt-2 block text-sm font-medium text-gray-700">রক্তের শ্রেণী</label>
                                <select name="blood_gp" id="blood_gp" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value="">রক্তের শ্রেণী নির্বাচন করুন</option>
                                    <option value="এ+" @if($profile->blood_gp === "এ+") selected @endif>এ+</option>
                                    <option value="এ-" @if($profile->blood_gp === "এ-") selected @endif>এ-</option>
                                    <option value="বি+" @if($profile->blood_gp === "বি+") selected @endif>বি+</option>
                                    <option value="বি-" @if($profile->blood_gp === "বি-") selected @endif>বি-</option>
                                    <option value="এবি+" @if($profile->blood_gp === "এবি+") selected @endif>এবি+</option>
                                    <option value="এবি-" @if($profile->blood_gp === "এবি-") selected @endif>এবি-</option>
                                    <option value="ও+" @if($profile->blood_gp === "ও+") selected @endif>ও+</option>
                                    <option value="ও-" @if($profile->blood_gp === "ও-") selected @endif>ও-</option>
                                </select>
                            </div>
                            

                            <div class="flex">
                                <div class="mr-2">
                                    <label for="height_feet" class="mt-2  block text-sm font-medium text-gray-700">উচ্চতা (ফুট)</label>
                                    <input autocomplete="off" value ="{{$profile->height_feet  }}" placeholder="ফুট (সংখ্যা)" type="text" name="height_feet" id="height_feet" class="mt-1 p-2 w-full border rounded-md" required>
                                </div>
                                <div>
                                    <label for="height_inch" class="mt-2 block text-sm font-medium text-gray-700">উচ্চতা (ইঞ্চি)</label>
                                    <input autocomplete="off" value ="{{$profile->height_inch}}" placeholder="ইঞ্চি (সংখ্যা) " type="text" name="height_inch" id="height_inch" class="mt-1 p-2 w-full border rounded-md" required>
                                </div>
                            </div>
                            <div>
                                <label for="weight" class="mt-2 block text-sm font-medium text-gray-700">ওজন (পাউন্ড)</label>
                                <input autocomplete="off" value ="{{$profile->weight}}" placeholder="পাউন্ডে ওজন লিখুন (সংখ্যা) " type="text" name="weight" id="weight" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="present_address" class="mt-2 block text-sm font-medium text-gray-700">বর্তমান ঠিকানা (ইউনিট)</label>
                                <input autocomplete="off" value ="{{$profile->present_address}}" placeholder="এখানে বর্তমান ঠিকানা/ইউনিট লিখুন   " type="text" name="present_address" id="present_address" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="permanent_address" class="mt-2 block text-sm font-medium text-gray-700">স্থায়ী ঠিকানা</label>
                                
                                <input autocomplete="off" value="{{$profile->vil}}" placeholder="গ্রাম/বাড়ি" type="text" name="vil" id="vil" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" value ="{{$profile->union}}"  placeholder="ইউনিয়ন/পৌরসভা/ওয়ার্ড" type="text" name="union" id="union" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" value ="{{$profile->upazila}}" placeholder="থানা/উপজেলা" type="text" name="upazila" id="upazila" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" value ="{{$profile->po}}" placeholder="পোস্ট-অফিস" type="text" name="po" id="po" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" value ="{{$profile->district}}"placeholder="জেলা" type="text" name="district" id="district" class="mt-1 p-2 w-full border rounded-md" required>
                                
                                <!-- Add more input fields for additional details if needed -->
                            </div>

                            <div>
                                <label for="distance_from_border" class="mt-2 block text-sm font-medium text-gray-700">বর্ডার হতে দূরত্ব (কিলোমিটার) </label>
                                <input autocomplete="off" value ="{{$profile->distance_from_border}}" placeholder="বর্ডার হতে দূরত্ব (কিলোমিটার সংখ্যা) " type="text" name="distance_from_border" id="distance_from_border" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>
                            

                            <div class="mt-2">
                                <label for="birth_date" class="block text-sm font-medium text-gray-700">জন্ম তারিখ</label>
                                <input autocomplete="off" value="{{$birthDate}}" name="birth_date" id="birth_date" datepicker datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                            </div>
                            
                            <div>
                                <label for="enrolment_date" class="mt-2 block text-sm font-medium text-gray-700"> ভর্তির তারিখ</label>
                                <input autocomplete="off" value="{{$enrolmentDate}}" name="enrolment_date" id="enrolment_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>
                            
                            <div>
                                <label for="unit_join_date" class="mt-2 block text-sm font-medium text-gray-700"> ইউনিটে যোগদানের তারিখ</label>
                                <input autocomplete="off" value="{{$unitJoinDate}}" name="unit_join_date" id="unit_join_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>
                            
                            <div>
                                <label for="retirement_date" class="mt-2 block text-sm font-medium text-gray-700"> অবসর গ্রহণের তারিখ</label>
                                <input autocomplete="off" value="{{$retirementDate}}" name="retirement_date" id="retirement_date" datepicker  datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required autocomplete="off">
                            </div>

                            
                            <div>
                                <label for="punishment" class="block text-sm font-medium text-gray-700">শাস্তির বিবরণ</label>
                                <input autocomplete="off" placeholder="শাস্তির বিবরণ দিন (যদি থাকে)" value ="{{$profile->punishment}}" type="text" name="punishment" id="punishment" class="mt-1 p-2 w-full border rounded-md">
                            </div>


                            
                            <!-- Add more form fields as needed -->

                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">আপডেট</button>
                            </form>
                            <form action="{{ route('soldierprofile.delete', $profile->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    ডিলেট
                                </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#birth_date", {
            dateFormat: "d/m/Y", // Set the date format to "dd/mm/yyyy"
        });
    });
</script>

<script>
    function toggleInputField() {
        var selectBox = document.getElementById("number_type");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var inputField = document.getElementById("inputField");
        if (selectedValue === "Only number" || selectedValue === "BJO-number") {
            inputField.style.display = "block";
            document.getElementById("number").placeholder = "সৈনিক নম্বর লিখুন (সংখ্যা)";
            document.getElementById("number").value = "";
            if (selectedValue === "BJO-number") {
                document.getElementById("number").value = 'বিজেও-' + ""; // Prefix "BJO-"
            }
        } else {
            inputField.style.display = "none";
            if (selectedValue === "BJO-NOYA") {
                document.getElementById("number").value = "বিজেও-নয়া"; // Set value to "BJO-NOYA"
            }
            if (selectedValue === "na") {
                document.getElementById("number").value = "অপ্রযোজ্য"; // A"
            }
        }
    }
</script>