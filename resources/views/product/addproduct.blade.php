@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Product</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="registration_date"
                        value="{{ old('registration_date', $product->registration_date) }}" class="form-control"
                        id="registration_date">
                    <span class="text-danger">
                        @error('registration_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_name">Product Name <span class="text-danger"><b>*</b></span></label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                        class="form-control" id="product_name">
                    <span class="text-danger">
                        @error('product_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_code">Product Code</label>
                    <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}"
                        class="form-control" id="product_code">
                </div>

                <div class="form-group col-md-4">
                    <label for="product_description">Product Description</label>
                    <input type="text" name="product_description"
                        value="{{ old('product_description', $product->product_description) }}" class="form-control"
                        id="product_description">
                </div>
                <div class="form-group col-md-4"> 
                    <label for="product_category">Product Category</label>
                    <select name="product_category" class="form-control">
                        <option value=""
                            {{ old('product_category', $product->product_category) == '' ? 'selected' : '' }}>
                            Select
                        </option>
                        <option value="jewelry"
                            {{ old('product_category', $product->product_category) == 'jewelry' ? 'selected' : '' }}>
                            Jewelry
                        </option>
                        <option value="books"
                            {{ old('product_category', $product->product_category) == 'books' ? 'selected' : '' }}>
                            Books
                        </option>
                        <option value="electronics"
                            {{ old('product_category', $product->product_category) == 'electronics' ? 'selected' : '' }}>
                            Electronics
                        </option>
                        <option value="clothing"
                            {{ old('product_category', $product->product_category) == 'clothing' ? 'selected' : '' }}>
                            Clothing
                        </option>
                        <option value="rice"
                            {{ old('product_category', $product->product_category) == 'rice' ? 'selected' : '' }}>
                            Rice
                        </option>
                        <option value="fruit"
                            {{ old('product_category', $product->product_category) == 'fruit' ? 'selected' : '' }}>
                            Fruit
                        </option>
                        <option value="vegetable"
                            {{ old('product_category', $product->product_category) == 'vegetable' ? 'selected' : '' }}>
                            Vegetable
                        </option>
                    </select>
                </div>
                
                {{-- <div class="form-group col-md-4">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" class="form-control" id="product_image">
                </div> --}}
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
    </script>

    <!-- END View Content Here -->
@endsection
