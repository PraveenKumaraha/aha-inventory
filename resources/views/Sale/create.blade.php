@extends('layouts.app', ['page' => 'New Sale', 'pageSlug' => 'products', 'section' => 'sale'])

@section('content')
    <style>
        .form-row {
		margin: 10px;
		margin-left: 20px;
	}

	.col-form-label1 {
		margin-right: 62px;
		padding-right: 40px;
	}

	.col-form-label12 {
		margin-right: 80px;
		padding-right: 40px;
	}
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">

                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
                        rel="stylesheet" />
                    <!-- jQuery -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                    <!-- Select2 JS -->

                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
                    <div class="container-fluid mt--7">
                        <div class="row">
                            <div class="col-xl-12 order-xl-1">

                                <div class="card-body">
                                    <form method="POST" action="{{ route('sale.store') }}" autocomplete="off">
                                        @csrf
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="mb-0">Create Sale</h3>
                                                </div>


                                                <div class="col-4 text-right">
                                                    <button type="reset" class="btn">Reset</button>

                                                    <button type="submit" class="btn">Save</button>

                                                    <a href="{{ route('sale.index') }}" class="btn">Back to List</a>
                                                </div>

                                            </div>
                                        </div><br>

                                            <div class="container-sm" style="width:100%;border-style: solid;border-color: coral;">

                                                <div class="form-row">
                                                    <label class=" col-form-label" for="name">Customer Number:</label>
                                                    <input type="text" class="form-control col-sm-2" name="customer_name" id="name" />

                                                    <label class=" col-form-label" for="name">Customer Number:</label>
                                                    <input type="text" class="form-control col-sm-2" name="customer_name" id="name" />
                                                </div>

                                                <div class="form-row">
                                                    <label class=" col-form-label1" for="name">GSTIN:</label>
                                                    <input type="text" class="form-control col-sm-2" name="gstin" id="name" placeholder="12345" disabled />

                                                    <label class=" col-form-label12" for="name">Date:</label>
                                                    <input type="date" class="form-control col-sm-2" name="date" id="name" />
                                                </div>
                                            </div>

                                            <table class="table table-bordered item-table">
                                                <thead class="thead-light">
                                                    <th>item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Tax</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    <div class="col-sm-12 rowInvoice1">
                                                        <tr class="rowInvoice">

                                                            <td data-select2-id="1">
                                                                <div class="form-group">
                                                                    <select class="form-control select2"
                                                                        style="width:150px;height:80px!important"
                                                                        id="product-name1" name="product_name[]">
                                                                        <option selected="selected" disabled>Select Product
                                                                        </option>
                                                                        <?php foreach ($pdtproductIds as $row) { ?> <option
                                                                            value="<?php echo $row['id']; ?>">
                                                                            <?php echo $row['product_id']; ?> | <?php echo $row['product_name']; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="qty[]" id="qty1"
                                                                    min="1" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rate[]" id="rate1"
                                                                    class="form-control">
                                                            </td>
                                                            <td data-select2-id="1">
                                                                <div class="form-group">
                                                                    <select class="form-control	select2" style="width:150px;height:80px!important" id="tax-name1" name="tax[]">
                                                                        <option selected="selected" disabled>Select Tax</option>
                                                                        <?php foreach ($pdttaxids as $row) { ?> <option value="<?php echo ($row["id"]); ?>"><?php echo ($row["tax_name"]); ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="disc[]" id="disc1"
                                                                    value="0" class="form-control">
                                                            </td>

                                                            <td>
                                                                <input type="text" name="total[]" id="total1"
                                                                    class="form-control">
                                                            </td>
                                                            <td>

                                                                <a class="delete" title="Delete" data-toggle="tooltip"><i
                                                                        class="material-icons"
                                                                        style="color:red">&#xE872;</i></a>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-primary add_field">add Pdt</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            //initailizeSelect2();
            //$("#selProduct1").select2();
            $('.select2').select2();
        });

        var add_button = $(".add_field");
        var wrapper = $('.item-table > tbody:last-child');
        var x = 1;
        $(add_button).click(function() {
            var lastItem = $('tr:last td:first .select2').val();;

            var currentcount = $('table.item-table tr:last').index() + 1;



            if (lastItem) {
                var count = currentcount + 1;

                var html_code = '';
                html_code += '<tr id="row_id_' + count + '">';

                html_code += '<td data-select2-id="' + (count * 50) + '">' +
                    '<div class="form-group">' +
                    '<select class="form-control select2" style="width: 100%;" id="product-name' + count +
                    '" name="product_name[]">' +
                    '<option selected="selected" disabled>Select Product</option>' +
                    <?php foreach ($pdtproductIds as $row) { ?> '<option value="<?php echo $row['id']; ?>"><?php echo $row['product_id']; ?> | <?php echo $row['product_name']; ?></option>' +
                    <?php } ?> '</select>' +
                    '</div>' +
                    '</td>';
                html_code += '<td> <input type="text" name="rate[]" id="rate1"  class="form-control"> </td>';
                html_code += '<td> <input type="number" name="qty[]" id="qty1" min="1" class="form-control"> </td>';
                html_code += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2" style="width: 100%;" id="tax-name' + count +
                '" name="tax[]">' +
				'<option selected="selected" disabled>Select Tax</option>' +
				<?php foreach ($pdttaxids as $row) { ?> '<option value="<?php echo ($row["id"]); ?>"><?php echo ($row["tax_name"]); ?></option>' +
				<?php } ?> '</select>' +
				'</div>' +
				'</td>';
                html_code +=
                    '<td> <input type="text" name="disc[]" id="disc1" value="0" class="form-control"> </td>';
                html_code += '<td> <input type="text" name="total[]" id="total1" class="form-control"> </td>';
                html_code +=
                    '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a></td>';

                wrapper.append(html_code);
                $('#' + 'product-name' + count, wrapper).select2();
                $('#' + 'tax-name' + count, wrapper).select2();
            }else {
                alert("Please Select Product");
            }
        });
    </script>
@endpush
