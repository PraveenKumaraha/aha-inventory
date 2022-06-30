@extends('layouts.app', ['page' => 'New Product', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">New Brand</h3>
            </div>
            <div class="col-4 text-right">
                <a href="{{ route('report.index') }}" class="btn btn-sm btn-primary">Back to List</a>
            </div>
        </div>
    </div>
    <div class="card-body">



        <div class="card-body">
            @include('alerts.success')

            <div class="">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <th scope="col">ITEM</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">TAX</th>
                        <th scope="col">DISCOUNT</th>
                        <th scope="col">TOTAL</th>
                    </thead>
                    <tbody>
                        <tr>

                            <td>
                                <select name="item_id" id="product" class="form-select ">
                                    <option value="">Select Product Name</option>
                                    @foreach ($pdtproductIds as $pdtproductId)
                                    @if($pdtproductId == ('item_id'))
                                    <option value="<?php echo $pdtproductId->id; ?>" selected><?php echo $pdtproductId->product_name; ?></option>
                                    @else
                                    <option value="<?php echo $pdtproductId->id; ?>"><?php echo $pdtproductId->product_name; ?></option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="text" name="quantity" id="quantity" class="form-control quantity" placeholder="">
                            </td>
                            <td>
                                <input type="text" name="price" id="price" class="form-control price" placeholder="">
                            </td>
                            <td>
                                <input type="text" name="tax" id="tax" class="form-control tax" placeholder="">
                            </td>
                            <td>
                                <input type="text" name="discount" id="discount" class="form-control discount" placeholder="">

                            </td>
                            <td>
                                <input type="text" name="total" id="total" class="form-control total" placeholder="">

                            </td>
                        </tr>
                    </tbody>


                </table>
            </div>
            <button class="btn btn-md btn-primary" id="addBtn">Add new Row</button>
        </div>

    </div>
</div>
</div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {


        $('#addBtn').on('click', function() {

            var row = '<tr> <td> <select name="item_id" id="product" class="form-select"><option value="">Select Product Name</option>@foreach ($pdtproductIds as $pdtproductId){@if($pdtproductId == ("item_id")){<option value="<?php echo $pdtproductId->id; ?>" selected><?php echo $pdtproductId->product_name; ?></option>}@else{<option value="<?php echo $pdtproductId->id; ?>"><?php echo $pdtproductId->product_name; ?></option>}  @endif}@endforeach</select> </td> <td> <input type="text" name="price" id="price" class="form-control price form-control" placeholder=""    > </td><td> <input type="text" name="price" id="price" class="form-control price form-control" placeholder=""    > </td><td> <input type="text" name="price" id="price" class="form-control price form-control" placeholder=""> </td><td> <input type="text" name="price" id="price" class="form-control price form-control" placeholder=""> </td><td> <input type="text" name="price" id="price" class="form-control price form-control" placeholder=""> </td></tr>';
            $('.table > tbody:last').append(row);

        });

        new SlimSelect({
            select: '.form-select'
        });

    });
</script>

@endpush