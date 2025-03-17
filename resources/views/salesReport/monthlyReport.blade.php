@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Products Sales</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->



    <div class="px-5">
        <div class="row mb-2">

            <div class="col-11 d-flex">
                <img style="width:80px; margin: 0 auto" src="{{ url('/') }}/img/logo.png" />
            </div>
            <div class="col-1">

            </div>
            <div class="col-11">
                <h6 class="text-center " style="letter-spacing: 1px;">Sales on {{ \Carbon\Carbon::parse($FormDate)->startOfMonth()->format('jS') }} to {{ \Carbon\Carbon::parse($FormDate)->endOfMonth()->format('jS F Y') }}</h6> 
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-2">

                <input type="date"  value="{{ \Carbon\Carbon::parse($FormDate)->format('Y-m-d') }}" id="searchInput" class="form-control" />

            </div>
            <div class="col-6">
                <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>

            </div>
            <div class="col-4">
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p>
            </div>
        </div>


         <table id="myTable" class="table-bordered">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Date</th>
                    <th>Invoice no</th>
                    <th>Customer Name</th>
                    <th>Total Items</th>
                    <th>Total Amount</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($salesInvoiceList as $prod)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$prod->sales_date}}</td>
                    <td>{{$prod->invoice_no}}</td>
                    <td>{{$prod->customer_name}}</td>
                    <td>{{$prod->total_items}}</td>
                    <td>{{$prod->total_amount}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> 

    </div>
    <script>
        $(document).ready(function() {
            // Initialize the first DataTable instance
            let table = $('#myTable').DataTable({
                paging: false, // Disable pagination
                sortable: false, // Disable sorting
                ordering: false, // Disable ordering
                dom: 'Bfrtip', // Define the table control elements
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copy',
                        className: 'btn  btn-sm  btn-primary'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        className: 'btn  btn-sm  btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export to CSV',
                        className: 'btn  btn-sm  btn-warning'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        className: 'btn  btn-sm  btn-danger'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'btn  btn-sm  btn-info'
                    }
                ]
            });


        });
    </script>
    <script type="text/javascript">
        // let table = new DataTable('#myTable');
        // let table = new DataTable('#myTable', {
        //     perPage: 10, // Number of entries per page
        //     sortable: true, // Allow sorting
        //     order: [
        //         [0, 'asc']
        //     ], // Maintain initial order based on first column
        // });

        function printPage() {
            console.log('print  page');
            window.print();
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ url('/report/allSalesMonthly') }}/" + date;
        }
    </script>


    <!-- END View Content Here -->
@endsection
