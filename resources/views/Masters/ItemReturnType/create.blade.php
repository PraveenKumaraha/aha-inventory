@extends('layouts.app',  ['page' => 'List of itemReturnType', 'pageSlug' => 'itemReturnType', 'section' => 'BasicMaster'])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">New Item Return Type</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('itemReturnType.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('itemReturnType.store') }}" autocomplete="off">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">Name</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('brand_name') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'brand_name'])
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
