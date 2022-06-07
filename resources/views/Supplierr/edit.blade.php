@extends('layouts.app', ['page' => 'Edit Bloodgroup', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Supplier</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('supplier.update', $Supplier->id) }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">Supplier Information</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Name</label>
                                <input type="text" name="supplier_name" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" value="{{ old('name', $Supplier->supplier_name) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'Supplier_name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier ID</label>
                                <input type="text" name="supplier_id" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" value="{{ old('name', $Supplier->supplier_id) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_id'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Email</label>
                                <input type="email" name="supplier_email" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" value="{{ old('name',$Supplier->supplier_email) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Phone</label>
                                <input type="number" name="supplier_phone" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" value="{{ old('name',$Supplier->supplier_phone) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Adders</label>
                                <input type="testarea" name="supplier_adders" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" value="{{ old('name',$Supplier->supplier_adders) }}" required autofocus>
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