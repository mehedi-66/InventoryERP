@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Products</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Products</h5> --}}

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Edit</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Created</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($products as  $prod)
                <tr>
                    <td style="width: 6%">{{ $prod->product_id }}</td>
                    <td style="width: 5%">
                        <a class="" href="{{url('/product/edit')}}/{{$prod->product_id}}"><i class="fa fa-edit"></i></a> 
                    </td>
                    <td>{{$prod->product_name}}</td>
                    <td>{{$prod->product_code}}</td>
                    <td>{{$prod->registration_date}}</td>
                    {{-- <td style="width: 7%"> 
                       <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{url('/product/delete')}}/{{$prod->product_id}}')"><i class="fa fa-trash"></i></a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>
    <script type="text/javascript">
    document.getElementById('PageName').innerText = 'Product List';
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