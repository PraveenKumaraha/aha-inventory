@extends('layouts.app', ['page' => 'List of Category', 'pageSlug' => 'category', 'section' => 'BasicMaster'])

@section('content')
<style>
    .first {
        float: left;
        width: 33%;
    }

    .middle {
        float: left;
        width: 33%;
    }

    .last {
        float: left;
        width: 33%;
    }

    .card {
        max-width: 100%;
        overflow-x: hidden !important;
    }
</style>
<div class="card">
    <div class="card-header text-center font-weight-bold text-white" style="background-color: #5e72e4;">
        Category
    </div>
    <div class="card-body">

        <div class="row">
            <div class="first col-md-3 col-sm-3 col-md-pull-3">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                        <img src="assets/img/options-lines.png" alt="" style="width: 50px;margin-top:10px;">
                        <div class="tee" style="font-size: 20px;color: #fff;">Total Category</div>
                    </div>
                </div>
            </div>
            <div class="middle col-md-3 col-md-push-3 col-sm-3">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                        <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                        <div class="tee" style="font-size: 20px;color: #fff;">Active</div>
                    </div>
                </div>
            </div>
            <div class="last col-md-3 col-sm-3">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                        <img src="assets/img/inactive.png" alt="" style="width: 50px;margin-top:10px;">
                        <div class="tee" style="font-size: 20px;color: #fff;">In-Active</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row" style="display: none;">
    <div class="col-md-12">
        <div class="card">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="text-align: center;padding: 10px;margin-left: 550px;">Category Management
                    </h4>
                </div>
            </div>
            <div class="row inline">
                <div class="square" style="height: 120px;width:150px;background-color:#265362;margin-left: 30px;border-radius: 20px;
                font-size: 20px;text-align: center;">
                    <img src="assets/img/options-lines.png" alt="" style="width: 70px;margin-top: 20px;">
                    <div class="tee" style="font-size: 20px;color: #fff;">Total Category</div>
                </div>

                <div class="square" style="height:120px;width:150px;background-color:#265362;margin-left: 250px;border-radius: 20px;margin-bottom: 10px;
                font-size: 20px;text-align: center;">
                    <img src="assets/img/active.png" alt="" style="width: 70px;margin-top: 20px;">
                    <div class="tee" style="font-size: 20px;color: #fff;">Active</div>
                </div>

                <div class="square" style="height: 120px;width:150px;background-color:#265362;margin-left: 250px;border-radius: 20px;margin-bottom: 10px;
                font-size: 20px;text-align: center;">
                    <img src="assets/img/inactive.png" alt="" style="width: 70px;margin-top: 20px;">
                    <div class="tee" style="font-size: 20px;color: #fff;">InActive</div>
                </div>


            </div>
        </div>
    </div>
</div>


<div class="row" style="margin-top: -15px;">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">New Category</a>
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
                                <td>{{ $model->category_name }}</td>
                                <td class="td-actions">

                                    <a href="{{ route('category.edit', $model->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <form action="{{ route('category.destroy', $model->id) }}" method="post" class="d-inline">
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
