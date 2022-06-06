@extends('layouts.app', ['page' => 'List of Country', 'pageSlug' => 'Country', 'section' => 'BasicMaster'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Country</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('Country.create') }}" class="btn btn-sm btn-primary">New Country</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>

                        </thead>
                        <tbody>
                            @foreach ($models as $model)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $model->name }}</td>
                            
                                 
                                    <td class="td-actions">
                                        <a href="{{ route('products.show', $model->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                        <a href="{{ route('Country.edit', $model->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                            <i class="tim-icons icon-pencil"></i>
                                        </a>
                                        <form action="{{ route('Country.destroy', $model->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Product" onclick="confirm('Are you sure you want to remove this product? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end">

                </nav>
            </div>
        </div>
    </div>
</div>
@endsection