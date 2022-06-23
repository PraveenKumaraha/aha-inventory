@extends('layouts.app', ['page' => 'List of tax', 'pageSlug' => 'tax', 'section' => 'BasicMaster'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">New Tax</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('tax.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('tax.store') }}" autocomplete="off">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Tax Name</label>
                                <input type="text" name="tax_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Tax Name" value="{{ old('name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Tax Value</label>
                                <input type="number" name="tax_value" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Tax Value" value="{{ old('name') }}" required autofocus>
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