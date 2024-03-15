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

                            <table id ="myTable" class="display" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th >একশন </th>
                                    <th> ফাইল নাম </th>
                                    <th> শাখা </th>
                                    <th> আপলোডের সময় </th>
                                    <th >আপলোড করেছেন</th>


                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docus as $docu)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('docu.show', $docu->file_name) }}" style="background-color: #2779bd" class="hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-full mx-auto mr-4 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                            দেখুন
                                        </a>
                                    </td>
                                    <td>{{ $docu->file_name }}</td>
                                    <td>{{ $docu->branch }}</td>
                                    <td>{{ $docu->upload_date }}</td>
                                    <td >{{ $docu->uploader->name }}</td>


                                    
                                    <!-- Add more table data columns as needed -->
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>নাম</th>
                                    <th>নম্বর</th>

                                    <th>ট্রেড</th>
                                    <th>নাম</th>
                                    <th>নাম</th>

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

    td {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

table {
  table-layout: fixed;
}
</style>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    const table = new DataTable('#myTable', {


    paging: true,
	lengthChange: false,
	autoWidth: true ,
    columnDefs: [
        { targets: 0, orderable: false },
    ],
    scrollCollapse: true,
    scrollX: true,
    order: [[3, 'desc']],
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
