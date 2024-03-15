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

                    <!-- Add a row of buttons -->

                    <div class="mt-6">
                        <div style="max-height: 800px; overflow-y: auto;">
                             <!-- Display Data in Table -->

                            <table id ="myTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th> নম্বর </th>
                                    <th> নাম </th>
                                    <th> কোম্পানি </th>
                                    <th> ট্রেড </th>
                                    <th >বর্ষ</th>
                                    <th >১ম প্রশিক্ষণ চক্র </th>
                                    <th >২য়  প্রশিক্ষণ চক্র </th>
                                    <th >৩য়  প্রশিক্ষণ চক্র </th>
                                    <th >৪র্থ  প্রশিক্ষণ চক্র </th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carriers as $carrier)
                                <tr>
                                    <td>{{ $carrier->profile->number }}</td>
                                    <td>{{ $carrier->profile->name }}</td>
                                    <td>{{ $carrier->profile->coy }}</td>
                                    <td>{{ $carrier->profile->trade }}</td>
                                    <td >{{ $carrier->year }}</td>
                                    <td >{{ $carrier->cycle_1 }}</td>
                                    <td >{{ $carrier->cycle_2 }}</td>
                                    <td >{{ $carrier->cycle_3 }}</td>
                                    <td >{{ $carrier->cycle_4 }}</td>
                                    
                                    
                                    <!-- Add more table data columns as needed -->
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>নাম</th>
                                    <th>নম্বর</th>
                                    <th>পদবী</th>
                                    <th>ট্রেড</th>
                                    <th>নাম</th>
                                    <th>নম্বর</th>
                                    <th>পদবী</th>
                                    <th>ট্রেড</th>
                                    <th>ট্রেড</th>
                                </tr>
                            </tfoot>
                            </table>
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
    .dataTables_wrapper .dataTables_length select {
    /* box-sizing: border-box; */
    width: 67px;
    }
</style>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    const table = new DataTable('#myTable', {

    fixedColumns: {
        heightMatch: 'none'
    },
    paging: true,
    scrollCollapse: true,
    scrollX: true,
    scrollY: 590,

    initComplete: function () {
        this.api()
            .columns()
            .every(function () {
                let column = this;
 
                // Create select element
                let select = document.createElement('select');
                select.add(new Option(''));

                
                column.footer().replaceChildren(select);
 
                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    var val = DataTable.util.escapeRegex(select.value);
 
                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
 
                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        select.add(new Option(d));
                    });
            });
    },
    });
    document.querySelectorAll('a.toggle-vis').forEach((el) => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
    
            let columnIdx = e.target.getAttribute('data-column');
            let column = table.column(columnIdx);
    
            // Toggle the visibility
            column.visible(!column.visible());
        });


    });
</script>
