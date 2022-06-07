@extends('layouts.app', ['page' => 'New stockproduct', 'pageSlug' => 'stockproduct', 'section' => 'BasicMaster'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">New Product</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('inventoryItem.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('inventoryItem.store') }}" autocomplete="off">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Name</label>
                                <input type="text" name="product_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product ID</label>
                                <input type="number" name="product_id" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Brand</label>
                                <select name="brand_id" id="catgory" class="form-control brand" required>
                                    <option value="">Select Brand</option>
                                    @foreach($pdtBrands as $pdtBrand)
                                    <option value="<?php echo $pdtBrand->id; ?>"><?php echo $pdtBrand->brand_name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Category</label>
                                <select name="category_id" id="catgory" class="form-control category" required>
                                    <option value="">Select Category</option>
                                    @foreach($pdtCategorys as $pdtCategory)
                                    <option value="<?php echo $pdtCategory->id; ?>"><?php echo $pdtCategory->category_name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Unit</label>
                                <select name="unit_id" id="catgory" class="form-control unit" required>
                                    <option value="">Select Unit</option>
                                    @foreach($pdtUnits as $pdtUnit)
                                    <option value="<?php echo $pdtUnit->id; ?>"><?php echo $pdtUnit->name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Actual Price</label>
                                <input type="number" name="a_price" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Selling Price</label>
                                <input type="number" name="s_price" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">GST %</label>
                                <input type="number" name="gst" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Demand Limt</label>
                                <input type="number" name="limt" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="stockproduct Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Save</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
<script>
    new SlimSelect({
        select: '.form-select'
    })
</script>
@endpush