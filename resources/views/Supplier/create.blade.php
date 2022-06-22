@extends('layouts.app', ['page' => 'New Product', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">New Supplier</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('supplier.store') }}" autocomplete="off">
                        @csrf

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier ID</label>
                                <input type="text" name="supplier_id" id="input-name" class="form-control form-control-alternative{{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" placeholder="Supplier ID" value="{{ old('supplier_id') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_id'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Name</label>
                                <input type="text" name="supplier_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Supplier Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_name'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Email</label>
                                <input type="text" name="supplier_email" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Supplier Email" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_email'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Contact</label>
                                <input type="text" name="supplier_contact" id="input-name" class="form-control form-control-alternative{{ $errors->has('supplier_contact') ? ' is-invalid' : '' }}" placeholder="Supplier Contact" value="{{ old('supplier_contact') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_contact'])
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Supplier Address</label>
                                <input type="text" name="supplier_address" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Supplier Address" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'supplier_address'])
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
