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
                    <div class="flex space-x-8">
                        <a href="{{route('soldierprofile.create')}}" class="btn">প্রোফাইল তৈরি করুন </a>
                        <a href="{{route('soldierprofile.index')}}" class="btn">সকল প্রোফাইল</a>
                    </div>

                    <div class="mt-16">
                        <form action="{{route('soldierprofile.store')}}" method="post" class="space-y-4" enctype="multipart/form-data">
                            @csrf
                            <!-- Add your form fields here -->


                            {{-- <div>
                                <label for="number" class="mt-2 block text-sm font-medium text-gray-700">সেনা নং</label>
                                <input placeholder="এখানে নম্বর লিখুন " type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md" required>
                            </div> --}}

                            <div>
                               
                                <label for="image" class="block text-sm font-medium text-gray-700">ছবি আপলোড করুন</label>
                                
                                <input name="image" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" accept="image/*" required>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG (MAX. 500*500 px).</p>
                                
                                <!-- The 'accept' attribute restricts the file types to images only -->
                            </div>
                            
                           
                            
                            <div>
                                <label for="number_type" class="mt-2 block text-sm font-medium text-gray-700"> নং</label>
                                <select name="number_type" id="number_type" class="mt-1 p-2 w-full border rounded-md" required onchange="toggleInputField()">
                                    <option value=""> ধরণ নির্বাচন করুন</option>
                                    <option value="Only number">সৈনিক নম্বর</option>
                                    <option value="BJO-number">বিজেও-নম্বর</option>
                                    <option value="BJO-NOYA">বিজেও-নয়া</option>
                                    <option value="na">অপ্রযোজ্য</option>
                                </select>
                                <div id="inputField" style="display: none;">
                                    <input placeholder="" type="text" name="number" id="number" class="mt-1 p-2 w-full border rounded-md" required >
                                </div>
                            </div>


                            <div>
                                <label for="rank" class="mt-2 block text-sm font-medium text-gray-700">পদবী</label>
                                <select name="rank" id="rank" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value="">পদবী নির্বাচন করুন</option>
                                    <option value="সৈনিক">সৈনিক</option>
                                    <option value="ল্যান্স কর্পোরাল">ল্যান্স কর্পোরাল</option>
                                    <option value="কর্পোরাল">কর্পোরাল</option>
                                    <option value="সার্জেন্ট">সার্জেন্ট</option>
                                    <option value="ওয়ারেন্ট অফিসার">ওয়ারেন্ট অফিসার</option>
                                    <option value="সিনিয়র ওয়ারেন্ট অফিসার">সিনিয়র ওয়ারেন্ট অফিসার </option>
                                    <option value="মাস্টার ওয়ারেন্ট অফিসার">মাস্টার ওয়ারেন্ট অফিসার </option>
                                </select>
                            </div>


                            <div>
                                <label for="trade" class="mt-2 block text-sm font-medium text-gray-700">পেশা</label>
                                <select name="trade" id="trade" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($tradeStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">নাম</label>
                                <input autocomplete="off" placeholder="এখানে নাম লিখুন " type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>


                            
                             
                            <div>
                                <label for="coy" class="mt-2 block text-sm font-medium text-gray-700">কোম্পানি</label>
                                <select name="coy" id="coy" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($coyStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="marital_status" class="mt-2 block text-sm font-medium text-gray-700">বৈবাহিক অবস্থা</label>
                                <select name="marital_status" id="marital_status" class="mt-1 p-2 w-full border rounded-md" required>
                                    @foreach($maritalStatusOptions as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div>
                                <label for="blood_gp" class="mt-2 block text-sm font-medium text-gray-700">রক্তের শ্রেণী</label>
                                <select name="blood_gp" id="blood_gp" class="mt-1 p-2 w-full border rounded-md" required>
                                    <option value="">রক্তের শ্রেণী নির্বাচন করুন</option>
                                    <option value="এ+">এ+</option>
                                    <option value="এ-">এ-</option>
                                    <option value="বি+">বি+</option>
                                    <option value="বি-">বি-</option>
                                    <option value="এবি+">এবি+</option>
                                    <option value="এবি-">এবি-</option>
                                    <option value="ও+">ও+</option>
                                    <option value="ও-">ও-</option>
                                </select>
                            </div>
                            <div class="flex">
                                <div class="mr-2">
                                    <label for="height_feet" class="mt-2  block text-sm font-medium text-gray-700">উচ্চতা (ফুট)</label>
                                    <input autocomplete="off" placeholder="ফুট (সংখ্যা)" type="text" name="height_feet" id="height_feet" class="mt-1 p-2 w-full border rounded-md" required>
                                </div>
                                <div>
                                    <label for="height_inch" class="mt-2 block text-sm font-medium text-gray-700">উচ্চতা (ইঞ্চি)</label>
                                    <input autocomplete="off" placeholder="ইঞ্চি (সংখ্যা) " type="text" name="height_inch" id="height_inch" class="mt-1 p-2 w-full border rounded-md" required>
                                </div>
                            </div>
                            
                            <div>
                                <label for="weight" class="mt-2 block text-sm font-medium text-gray-700">ওজন (পাউন্ড)</label>
                                <input autocomplete="off" placeholder="পাউন্ডে ওজন লিখুন (সংখ্যা) " type="text" name="weight" id="weight" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="present_address" class="mt-2 block text-sm font-medium text-gray-700">বর্তমান ঠিকানা (ইউনিট)</label>
                                <input autocomplete="off" placeholder="এখানে বর্তমান ঠিকানা/ইউনিট লিখুন   " type="text" name="present_address" id="present_address" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>

                            <div>
                                <label for="permanent_address" class="mt-2 block text-sm font-medium text-gray-700">স্থায়ী ঠিকানা</label>
                                
                                <input autocomplete="off" placeholder="গ্রাম/বাড়ি" type="text" name="vil" id="vil" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" placeholder="ইউনিয়ন/পৌরসভা/ওয়ার্ড" type="text" name="union" id="union" class="mt-1 p-2 w-full border rounded-md" required>
                                <input  autocomplete="off" placeholder="থানা/উপজেলা" type="text" name="upazila" id="upazila" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" placeholder="পোস্ট-অফিস" type="text" name="po" id="po" class="mt-1 p-2 w-full border rounded-md" required>
                                <input autocomplete="off" placeholder="জেলা" type="text" name="district" id="district" class="mt-1 p-2 w-full border rounded-md" required>
                                
                                <!-- Add more input fields for additional details if needed -->
                            </div>

                            <div>
                                <label for="distance_from_border" class="mt-2 block text-sm font-medium text-gray-700">বর্ডার হতে দূরত্ব (কিলোমিটার) </label>
                                <input autocomplete="off" placeholder="বর্ডার হতে দূরত্ব (কিলোমিটার সংখ্যা) " type="text" name="distance_from_border" id="distance_from_border" class="mt-1 p-2 w-full border rounded-md" required>
                            </div>
                            

                            <div class="mt-2">
                                <label for="birth_date" class="block text-sm font-medium text-gray-700">জন্ম তারিখ</label>
                                <input name="birth_date" id="birth_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন " required autocomplete="off">
                            </div>
                            
                            <div>
                                <label for="enrolment_date" class="mt-2 block text-sm font-medium text-gray-700"> ভর্তির তারিখ</label>
                                <input name="enrolment_date" id="enrolment_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>
                            
                            <div> 
                                <label for="unit_join_date" class="mt-2 block text-sm font-medium text-gray-700"> ইউনিটে যোগদানের তারিখ</label>
                                <input name="unit_join_date" id="unit_join_date" datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>
                            
                            <div>
                                <label for="retirement_date" class="mt-2 block text-sm font-medium text-gray-700"> অবসর গ্রহণের তারিখ</label>
                                <input name="retirement_date" id="retirement_date" datepicker  datepicker-autohide datepicker-format="dd/mm/yyyy" type="text" class="mt-1 p-2 w-full border rounded-md bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="তারিখ নির্বাচন করুন" required autocomplete="off">
                            </div>
                            

                            <div>
                                <label for="punishment" class="block text-sm font-medium text-gray-700">শাস্তির বিবরণ</label>
                                <input placeholder="শাস্তির বিবরণ দিন (যদি থাকে)" value ="" type="text" name="punishment" id="punishment" class="mt-1 p-2 w-full border rounded-md"  autocomplete="off">
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
                document.getElementById("number").value = "বিজেও-"; // Prefix "BJO-"
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