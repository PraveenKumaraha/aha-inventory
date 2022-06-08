@extends('layouts.app', ['page' => 'New Product', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Add Purchase</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('purchase.store') }}" autocomplete="off">
                        @csrf

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier ID</label>
                                <select name="supplier_id" id="catgory" class="form-control unit" required>
                                    <option value="">Select Spplier ID</option>
                                    @foreach($pdtsupplierIds as $pdtsupplierId)
                                    <option value="<?php echo $pdtsupplierId->id; ?>"><?php echo $pdtsupplierId->supplier_id; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Name</label>
                                <select name="item_id" id="catgory" class="form-control unit" required>
                                    <option value="">Select Product Name</option>
                                    @foreach($pdtproductIds as $pdtproductId)
                                    <option value="<?php echo $pdtproductId->id; ?>"><?php echo $pdtproductId->product_name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Quantity</label>
                                <input type="text" name="quantity" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Quantity" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'quantity'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Barcode</label>
                                <input type="text" name="barcode" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Barcode" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'barcode'])
                            </div>
                        </div>

                        <!-- <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Address</label>
                                <input type="text" name="supplier_address" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Supplier Address" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_address'])
                            </div>
                        </div> -->



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
