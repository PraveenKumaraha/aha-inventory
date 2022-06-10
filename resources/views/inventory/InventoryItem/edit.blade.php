@extends('layouts.app', ['page' => 'Edit Bloodgroup', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit inventoryItem</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('inventoryItem.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('inventoryItem.update', $model->id) }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">inventoryItem Information</h6>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Name</label>
                                <input type="text" name="product_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"" value=" {{ old('name',$model->product_name) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product ID</label>
                                <input type="number" name="product_id" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$model->product_id) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Brand</label>
                                <select name="brand_id" id="brand" class="form-control brand" required>
                                    <option value="">Select Brand</option>
                                    @foreach($pdtBrands as $pdtBrand)
                                    <option value="<?php echo $pdtBrand->id; ?>"<?php echo($pdtBrand->id == $model->brand_id)?'Selected="selected"':"";?>><?php echo $pdtBrand->brand_name; ?></option>
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
                                    <option value="<?php echo $pdtCategory->id; ?>"<?php echo($pdtCategory->id == $model->category_id)?'Selected="selected"':"";?>><?php echo $pdtCategory->category_name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Product Unit</label>
                                <select name="unit_id" id="unit" class="form-control unit" required>
                                    <option value="">Select Unit</option>
                                    @foreach($pdtUnits as $pdtUnit)
                                    <option value="<?php echo $pdtUnit->id; ?>"<?php echo($pdtUnit->id == $model->unit_id)?'Selected="selected"':"";?>><?php echo $pdtUnit->name; ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Actual Price</label>
                                <input type="number" name="a_price" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$model->a_price) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Selling Price</label>
                                <input type="number" name="s_price" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$model->s_price) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">GST %</label>
                                <input type="number" name="gst" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$model->gst) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Demand Limit</label>
                                <input type="number" name="limit" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',$model->limt) }}" required autofocus>
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
