@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Purchases</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Purchases</h5> --}}

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Edit</th>
                    <th>Purchase Date</th>
                    <th>Invoice no</th>
                    <th>Product Name</th>
                    <th>Buy Amount</th>
                    <th>Sales Amount</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Purchases as  $prod)
                <tr>
                    <td style="width: 6%">{{ $prod->purchases_id }}</td>
                    <td style="width: 5%">
                        <a class="" href="{{url('/purchase/edit')}}/{{$prod->purchases_id}}"><i class="fa fa-edit"></i></a> 
                    </td>
                    <td>{{$prod->purchases_date}}</td>
                    <td>{{$prod->invoice_no}}</td>
                    <td>{{$prod->product_name}}</td>
                    <td>{{$prod->purchases_buy_amount}}</td>
                    <td>{{$prod->purchases_sales_amount}}</td>
                    <td>{{$prod->purchases_current_quantity}}</td>
                    {{-- <td style="width: 7%"> 
                       <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{url('/product/delete')}}/{{$prod->purchases_id}}')"><i class="fa fa-trash"></i></a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>
    <script type="text/javascript">
    document.getElementById('PageName').innerText = 'Purchase List';
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