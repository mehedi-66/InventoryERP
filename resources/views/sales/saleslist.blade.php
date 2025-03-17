@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Sales List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Purchases</h5> --}}

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Sales ID</th>
                    <th>Edit</th>
                    <th>Sales Date</th>
                    <th>Invoice no</th>
                    <th>Customer Name</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as  $prod)
                <tr>
                    <td style="width: 6%">{{ $prod->sales_id }}</td>
                    <td style="width: 5%">
                        <a class="" href="{{url('/sales/edit')}}/{{$prod->sales_id}}"><i class="fa fa-edit"></i></a> 
                    </td>
                    <td>{{$prod->sales_date}}</td>
                    <td>{{$prod->invoice_no}}</td>
                    <td>{{$prod->customer_name}}</td>
                    <td>{{$prod->total_items}}</td>
                    <td>{{$prod->total_amount}}</td>
                   
                    {{-- <td style="width: 7%"> 
                       <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{url('/product/delete')}}/{{$prod->purchases_id}}')"><i class="fa fa-trash"></i></a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>
    <script type="text/javascript">
    document.getElementById('PageName').innerText = 'Sales List';
       // let table = new DataTable('#myTable');
       let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [[0, 'desc']], // Maintain initial order based on first column
        });
        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>


    <!-- END View Content Here -->
@endsection