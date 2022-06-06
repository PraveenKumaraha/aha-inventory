@extends('layouts.app', ['page' => 'List of Brand', 'pageSlug' => 'pass', 'section' => 'BasicMaster'])

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title" style="text-align: center;padding: 10px;margin-left: 550px;">Unit Management</h4>
                    </div>
                </div>
            <div class="row inline">
                <div class="square" style="height: 120px;width:150px;background-color:#265362;margin-left: 30px;border-radius: 20px;
                font-size: 20px;text-align: center;">
                <img src="assets/img/hotel-supplier.png" alt="" style="width: 70px;margin-top: 20px;"> 
                <div class="tee" style="font-size: 20px;color: #fff;">Total</div></div>

                <div class="square" style="height:120px;width:150px;background-color:#265362;margin-left: 250px;border-radius: 20px;margin-bottom: 10px;
                font-size: 20px;text-align: center;">
                <img src="assets/img/active.png" alt="" style="width: 70px;margin-top: 20px;"> 
                <div class="tee" style="font-size: 20px;color: #fff;">Active</div></div>

                <div class="square" style="height: 120px;width:150px;background-color:#265362;margin-left: 250px;border-radius: 20px;margin-bottom: 10px;
                font-size: 20px;text-align: center;">
                <img src="assets/img/inactive.png" alt="" style="width: 70px;margin-top: 20px;"> 
                <div class="tee" style="font-size: 20px;color: #fff;">InActive</div></div>
        
               
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                     <h4 class="card-title">Brand</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('pass.create') }}" class="btn btn-sm btn-primary">New Brand</a>
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
                            @foreach ($mods as $mod)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $mod->name }}</td>


                                    <td class="td-actions">
                                        <a href="{{ route('pass.show', $mod->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                        <a href="{{ route('pass.edit', $mod->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                            <i class="tim-icons icon-pencil"></i>
                                        </a>
                                        <form action="{{ route('pass.destroy', $mod->id) }}" method="post" class="d-inline">
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
