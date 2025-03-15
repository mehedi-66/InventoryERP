@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Purchase</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="registration_date">Entry Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="registration_date"
                        value="{{ old('registration_date', $purchase->registration_date) }}" class="form-control"
                        id="registration_date">
                    <span class="text-danger">
                        @error('registration_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="invoice_no">Invoice no <span class="text-danger"><b>*</b></span></label>
                    <input type="text" name="invoice_no" value="{{ old('invoice_no', $purchase->invoice_no) }}"
                        class="form-control" id="invoice_no">
                    <span class="text-danger">
                        @error('invoice_no')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4"> 
                    <label for="product_id">Purchase Product</label>
                    <select name="product_id" class="form-control">
                        <option value="" {{ old('product_id', $purchase->product_id ?? '') == '' ? 'selected' : '' }}>
                            Select
                        </option>
                
                        @foreach($productList as $product)
                            <option value="{{ $product->product_id }}"
                                {{ old('product_id', $purchase->product_id ?? '') == $product->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="purchases_date">Purchase Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="purchases_date"
                        value="{{ old('purchases_date', $purchase->purchases_date) }}" class="form-control"
                        id="purchases_date">
                    <span class="text-danger">
                        @error('purchases_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="purchases_buy_amount">Buy Amount<span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="purchases_buy_amount" value="{{ old('purchases_buy_amount', $purchase->purchases_buy_amount) }}"
                        class="form-control" id="purchases_buy_amount">
                    <span class="text-danger">
                        @error('purchases_buy_amount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="purchases_sales_amount">Sales Amount<span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="purchases_sales_amount" value="{{ old('purchases_sales_amount', $purchase->purchases_sales_amount) }}"
                        class="form-control" id="purchases_sales_amount">
                    <span class="text-danger">
                        @error('purchases_sales_amount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="purchases_quantity">Purchase Quantity<span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="purchases_quantity" value="{{ old('purchases_quantity', $purchase->purchases_quantity) }}"
                        class="form-control" id="purchases_quantity">
                    <span class="text-danger">
                        @error('purchases_quantity')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="supplier_name">Supplier Name </label>
                    <input type="text" name="supplier_name" value="{{ old('supplier_name', $purchase->supplier_name) }}"
                        class="form-control" id="supplier_name">
                    <span class="text-danger">
                        @error('supplier_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="payment_method">Payment Method</label>
                    <input type="text" name="payment_method" value="{{ old('payment_method', $purchase->payment_method) }}"
                        class="form-control" id="payment_method">
                    <span class="text-danger">
                        @error('payment_method')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="remarks">Remarks</label>
                    <input type="text" name="remarks" value="{{ old('remarks', $purchase->remarks) }}"
                        class="form-control" id="remarks">
                    <span class="text-danger">
                        @error('remarks')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            @if($purchase->purchases_id <= 0)
            <button type="submit" class="btn btn-primary">Save</button>
        @endif
        </form>
    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
    </script>

    <!-- END View Content Here -->
@endsection
