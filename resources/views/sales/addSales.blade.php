@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Sales</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <div class="row card">
            <div class="card-body">
                <form action="{{ $url }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="sales_date">Sales Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="sales_date" value="{{ old('sales_date', $sales->sales_date) }}"
                                class="form-control" id="sales_date">
                            <span class="text-danger">
                                @error('sales_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="invoice_no">Invoice no <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="invoice_no" value="{{ old('invoice_no', $sales->invoice_no) }}"
                                class="form-control" id="invoice_no">
                            <span class="text-danger">
                                @error('invoice_no')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="customer_name">Customer Name<span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="customer_name"
                                value="{{ old('customer_name', $sales->customer_name) }}" class="form-control"
                                id="customer_name">
                            <span class="text-danger">
                                @error('customer_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="customer_phone">Customer Phone</label>
                            <input type="text" name="customer_phone"
                                value="{{ old('customer_phone', $sales->customer_phone) }}" class="form-control"
                                id="customer_phone">
                            <span class="text-danger">
                                @error('customer_phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    @if ($sales->saless_id <= 0)
                        <div class="row d-flex justify-content-end">

                            <button type="submit" style="width: 100px" class="btn btn-primary mx-3">Save</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row card">
            <div class="card-body">
                <form action="{{ $urlProductDetails }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="product_id">Purchase Product</label>
                            <select name="product_id" class="form-control" onchange="getProductId(this)">
                                <option value=""
                                    {{ old('product_id', $purchase->product_id ?? '') == '' ? 'selected' : '' }}>
                                    Select
                                </option>

                                @foreach ($productList as $product)
                                    <option value="{{ $product->product_id }}"
                                        {{ old('product_id', $sales_details->product_id ?? '') == $product->product_id ? 'selected' : '' }}>
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="available_quantity">Available Quantity </label>
                            <input type="number" disabled name="available_quantity" value="" class="form-control"
                                id="available_quantity">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="product_unit_price">Unit Price</label>
                            <input type="number" name="product_unit_price"
                                value="{{ old('product_unit_price', $sales_details->product_unit_price) }}"
                                class="form-control" id="product_unit_price">
                            <span class="text-danger">
                                @error('product_unit_price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="product_quantity">Buy Quantity<span class="text-danger"><b>*</b></span></label>
                            <input type="number" name="product_quantity"
                                value="{{ old('product_quantity', $sales_details->product_quantity) }}"
                                class="form-control" id="product_quantity" oninput="handleProductQuantityChange()">
                            <span class="text-danger">
                                @error('product_quantity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Total">Total</label>
                            <input type="number" disabled name="Total" value="" class="form-control"
                                id="Total">
                            <span class="text-danger">
                                @error('Total')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>

                    @if ($sales->saless_id <= 0)
                        <div class="row d-flex justify-content-end">

                            <button type="submit" style="width: 100px" class="btn btn-primary mx-3">Add</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="row card">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalCost = 0;
                    @endphp
                    @foreach($sales_details_list as  $prod)
                    @php
                        $totalCost += ($prod->product_quantity * $prod->product_unit_price);
                    @endphp
                    <tr>
                        <td>{{$prod->product_name}}</td>
                        <td>{{$prod->product_unit_price}}</td>
                        <td>{{$prod->product_quantity}}</td>
                        <td>{{$prod->product_quantity * $prod->product_unit_price}}</td>
                      
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><b> Total </b></td>
                        <td > <b> {{ $totalCost}} </b></td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';

        let productList = @json($productList);

        function getProductId(element) {
            var selectedProductId = element.value;
            console.log("Selected Product ID:", selectedProductId);
            console.log(productList);

            let selectedProduct = productList.find(item => item.product_id == selectedProductId);
            console.log("Selected Product Info:", selectedProduct);


            if (selectedProduct) {
                document.getElementById('available_quantity').value = selectedProduct.purchases_current_quantity;
                document.getElementById('product_unit_price').value = selectedProduct.purchases_sales_amount;
                console.log("Product Name:", selectedProduct.product_name);
            }
        }

        function handleProductQuantityChange() {

            var quantity = document.getElementById('product_quantity').value;

            console.log("Product Quantity Changed:", quantity);

            if (isNaN(quantity)) {
                alert("Please enter a valid number for product quantity.");
            }
            else{
              let price =   document.getElementById('product_unit_price').value;
              document.getElementById('Total').value = quantity * price;
            }
        }
    </script>

    <!-- END View Content Here -->
@endsection
