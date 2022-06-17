@extends('layouts.app', ['page' => 'Edit Purchase', 'pageSlug' => 'purchase', 'section' => 'purchase'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Purchase</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('purchase.update', $model->id) }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">Purchase Information</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier ID</label>
                                <select name="supplier_id" id="supplier" class="form-control supplier_id" required>
                                    <option value="">Select Supplier ID</option>
                                    @foreach($pdtsupplierIds as $pdtsupplierId)
                                    <option value="<?php echo $pdtsupplierId->id; ?>"<?php echo($pdtsupplierId->id == $model->supplier_id)?'Selected="selected"':"";?>><?php echo $pdtsupplierId->supplier_id; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product ID</label>
                                <select name="item_id" id="supplier" class="form-control supplier" required>
                                    <option value="">Select Product ID</option>
                                    @foreach($pdtproductIds as $pdtproductId)
                                    <option value="<?php echo $pdtproductId->id; ?>"<?php echo($pdtproductId->id == $model->item_id)?'Selected="selected"':"";?>><?php echo $pdtproductId->product_name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Category</label>
                                <input type="text" name="Category" id="Category" class="form-control Category form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Category" value="{{ $model->categoryName }}" required autofocus disabled>
                                @include('alerts.feedback', ['field' => 'Category'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Brand</label>
                                <input type="text" name="Brand" id="Brand" class="form-control Brand form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Brand" value="{{ $model->brandName }}" required autofocus disabled>
                                @include('alerts.feedback', ['field' => 'Brand'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control Unit form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Unit" value="{{ $model->unitName }}" required autofocus disabled>
                                @include('alerts.feedback', ['field' => 'unit'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Quantity</label>
                                <input type="text" name="quantity" id="input-name" class="form-control quantity form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Quantity" value="{{ old('name',$model->quantity) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'quantity'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Barcode</label>
                                <input type="text" name="barcode" id="input-name" class="form-control barcode form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Barcode" value="{{ old('name',$model->barcode) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'barcode'])
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
