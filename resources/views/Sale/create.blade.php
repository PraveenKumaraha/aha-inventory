@extends('layouts.app', ['page' => 'New Sale', 'pageSlug' => 'products', 'section' => 'sale'])

@section('content')
    <style>
        .form-row {
		margin: 10px;
		margin-left: 20px;
	}

	.col-form-label1 {
		margin-right: 105px;
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
                                    <form id='create' action="" enctype="multipart/form-data" method="POST" accept-charset="utf-8" class="create needs-validation" novalidate autocomplete="off">
                                        @csrf
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="mb-0">Create Sale</h3>
                                                </div>


                                                <div class="col-4 text-right">
                                                    <button type="reset" class="btn btn-danger reset">Reset</button>

                                                    <button type="submit" class="btn btn-success save">Save</button>

                                                    <button type="button"" class="btn btn-primary back">Back</a>
                                                </div>

                                            </div>
                                        </div><br>

                                            <div class="container-sm" style="width:100%;border-style: solid;border-color: coral;">

                                                <div class="form-row">
                                                    <label class=" col-form-label" for="name">Customer/Company name:</label>
                                                    <input type="text" class="form-control col-sm-2" name="cname" id="name" />

                                                    <label class=" col-form-label" for="name">Customer Number:</label>
                                                    <input type="text" class="form-control col-sm-2" name="cnumber" id="name" />
                                                </div>

                                                <div class="form-row">
                                                    <label class=" col-form-label1" for="name">GSTIN:</label>
                                                    <input type="text" class="form-control col-sm-2" name="gstin" id="name" />

                                                    <label class=" col-form-label12" for="name">Date:</label>
                                                    <input type="date" class="form-control col-sm-2" name="date" id="name" />
                                                </div>
                                            </div>

                                            <table class="table table-bordered item-table" id="productTable">
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

                                                            <tr class="1" id="row1">
                                                                <td data-select2-id="1">
                                                                    <div class="form-group">
                                                                        <select class="form-control	select2 productName1" style="width:150px;height:80px!important" id="productName1" name="product_name[]" onchange="getProductData(1)">
                                                                            <option value="" selected="selected" disabled>Select Product</option>
                                                                            <?php foreach ($pdtproductIds as $row) { ?> <option value="<?php echo ($row["id"]); ?>" a_price="<?php echo ($row["a_price"]); ?>"><?php echo ($row["product_id"]); ?> | <?php echo ($row["product_name"]); ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            <td>
                                                                <input type="number" name="qty[]"  id="quantity1"
                                                                    min="1" class="form-control" onchange="getQtyData(1)">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rate[]" id="rate1"
                                                                    class="form-control" onchange="getRateData(1)">
                                                            </td>
                                                            <td data-select2-id="1">
                                                                <div class="form-group">
                                                                    <select class="form-control	select2" style="width:150px;height:80px!important" id="tax1" name="tax[]" onchange="getTaxData(1)">
                                                                        <option value="0" selected="selected" disabled>Select Tax</option>
                                                                        <?php foreach ($pdttaxids as $row) { ?> <option value="<?php echo ($row["id"]); ?>" taxValue="<?php echo ($row["tax_value"]); ?>"><?php echo ($row["tax_name"]); ?></option>
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

                                                                <a class="delete" title="Delete" data-toggle="tooltip" onclick="removeProductRow(1)"><i
                                                                        class="material-icons"
                                                                        style="color:red">&#xE872;</i></a>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                </tbody>
                                            </table>

                                            <button type="button" class="btn btn-primary add_field" id="addRowBtn" onclick="addRow()">add Pdt</button>
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

        });

        function addRow() {
		$("#addRowBtn").button("loading");

		var tableLength = $("#productTable tbody tr").length;
		console.log(tableLength);

		var tableRow;
		var arrayNumber;
		var count;
		if (tableLength > 0) {
			tableRow = $("#productTable tbody tr:last").attr('id');
			arrayNumber = $("#productTable tbody tr:last").attr('class');
			count = tableRow.substring(3);
			count = Number(count) + 1;
			arrayNumber = Number(arrayNumber) + 1;
			$("#addRowBtn").button("reset");
			var tr = '';
			tr += '<tr class=' + arrayNumber + ' id="row' + count + '">';
			tr += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2" style="width: 100%;" id="productName' + count + '" name="product_name[]" onchange="getProductData(' + count + ')">' +
				'<option  value="" selected="selected" disabled>Select Product</option>' + <?php foreach ($pdtproductIds as $row) { ?> '<option value="<?php echo ($row["id"]); ?>" a_price="<?php echo ($row["a_price"]); ?>"><?php echo ($row["product_id"]); ?> | <?php echo ($row["product_name"]); ?></option>' +
				<?php } ?> + '</select>' +
				'</div>' +
				'</td>';
			tr += '<td> <input type="text" name="qty[]" id="quantity' + count + '"  class="form-control quantity' + count + '"></td>';
			tr += ' <td> <input type="text" name="rate[]" id="rate' + count + '"  class="form-control rate' + count + '"> </td>'
			tr += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2 tax' + count + '" style="width: 100%;" id="tax' + count + '" name="tax[]"  onchange="getTaxData(' + count + ')">' +
				'<option value="0" selected="selected" disabled>Select Tax</option>' +
				<?php foreach ($pdttaxids as $row) { ?> '<option value="<?php echo ($row["id"]); ?>" taxValue="<?php echo ($row["tax_value"]); ?>"><?php echo ($row["tax_name"]); ?></option>' +
				<?php } ?> '</select>' +
				'</div>' +
				'</td>';
			tr += '<td> <input type="text" name="disc[]" id="discount' + count + '" value="0" class="form-control discount' + count + '"> </td>';
			tr += '<td> <input type="text" name="total[]" id="total' + count + '" class="form-control total' + count + '"> </td>';
			tr += '<td><a class="delete" title="Delete" data-toggle="tooltip" onclick="removeProductRow(' + count + ')"><i class="material-icons" style="color:red">&#xE872;</i></a></td> </tr>';

			tr += '</tr>';
			$("#productTable tbody").append(tr);
			$('#' + 'productName' + count).select2();
			$('#' + 'tax' + count).select2();
		} else {
			alert("Please Select Product");
		}
	}

	function onSelectProduct1(row) {

		var actPriceValue = $('option:selected', row).attr('a_price');
		console.log(actPriceValue);
		var $row = row.closest('tr');
		$('.rate').val();
		$('#rate' + id).val();

		console.log($row);
	}

	$(".back").on("click", function() {
		var url = "{{ route('InvSale.index') }}";
		window.location.href = url;
	});

    var item_id = "";
	$('#create').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		rules: {

			cname: {
				required: true
			}
		},


		messages: {
			cname: {
				required: "Customer Name is required."
			},

		},

		invalidHandler: function(event, validator) {
			//display error alert on form submit
			$('.alert-danger', $('.login-form')).show();
		},

		highlight: function(element) { // hightlight error inputs
			$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		success: function(label) {
			label.closest('.form-group').removeClass('has-error');
			label.remove();
		},

		submitHandler: function(form) {
			var saleData = {
				cname: $('input[name="cname"]').val(),
				cnumber: $('input[name=cnumber]').val(),
				gstIn: $('input[name=gstin]').val(),
				date: $('input[name=date]').val(),
				_token: '{{ csrf_token() }}',
				item_id: $('.item-table').find('select[name="product_name[]"]').map(function() {
					return this.value;
				}).get(),
				quantity: $('.item-table').find('input[name="qty[]"]').map(function() {
					return this.value;
				}).get(),
				rate: $('.item-table').find('input[name="rate[]"]').map(function() {
					return this.value;
				}).get(),
				tax: $('.item-table').find('select[name="tax[]"]').map(function() {
					return this.value;
				}).get(),
				discount: $('.item-table').find('input[name="disc[]"]').map(function() {
					return this.value;
				}).get(),
				total: $('.item-table').find('input[name="total[]"]').map(function() {
					return this.value;
				}).get(),

			}



			$.ajax({
				url: 'store',
				type: 'post',
				data: saleData,
				success: function(data, textStatus, jqXHR) {

					var datas = data;
					if (datas.success == "done") {
						var referenceNo = datas.referenceNo;
						$('.referenceNo').html("");
						$('.referenceNo').html(referenceNo);

						alert("Successfully completed");
					}


				},
				error: function(jqXHR, textStatus, errorThrown) {
					//alert("New Request Failed " +textStatus);
				}
			});
		}
	});

        // var add_button = $(".add_field");
        // var wrapper = $('.item-table > tbody:last-child');
        // var x = 1;
        // $(add_button).click(function() {
        //     var lastItem = $('tr:last td:first .select2').val();;

        //     var currentcount = $('table.item-table tr:last').index() + 1;



        //     if (lastItem) {
        //         var count = currentcount + 1;

        //         var html_code = '';
        //         html_code += '<tr id="row_id_' + count + '">';

        //         html_code += '<td data-select2-id="' + (count * 50) + '">' +
        //             '<div class="form-group">' +
        //             '<select class="form-control select2" style="width: 100%;" id="product-name' + count +
        //             '" name="product_name[]">' +
        //             '<option selected="selected" disabled>Select Product</option>' +
        //             <?php foreach ($pdtproductIds as $row) { ?> '<option value="<?php echo $row['id']; ?>"><?php echo $row['product_id']; ?> | <?php echo $row['product_name']; ?></option>' +
        //             <?php } ?> '</select>' +
        //             '</div>' +
        //             '</td>';
        //         html_code += '<td> <input type="text" name="rate[]" id="rate1"  class="form-control"> </td>';
        //         html_code += '<td> <input type="number" name="qty[]" id="qty1" min="1" class="form-control"> </td>';
        //         html_code += '<td data-select2-id="' + (count * 50) + '">' +
		// 		'<div class="form-group">' +
		// 		'<select class="form-control select2" style="width: 100%;" id="tax-name' + count +
        //         '" name="tax[]">' +
		// 		'<option selected="selected" disabled>Select Tax</option>' +
		// 		<?php foreach ($pdttaxids as $row) { ?> '<option value="<?php echo ($row["id"]); ?>"><?php echo ($row["tax_name"]); ?></option>' +
		// 		<?php } ?> '</select>' +
		// 		'</div>' +
		// 		'</td>';
        //         html_code +=
        //             '<td> <input type="text" name="disc[]" id="disc1" value="0" class="form-control"> </td>';
        //         html_code += '<td> <input type="text" name="total[]" id="total1" class="form-control"> </td>';
        //         html_code +=
        //             '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a></td>';

        //         wrapper.append(html_code);
        //         $('#' + 'product-name' + count, wrapper).select2();
        //         $('#' + 'tax-name' + count, wrapper).select2();
        //     }else {
        //         alert("Please Select Product");
        //     }
        // });

    </script>

    <script src="{{ asset('assets') }}/js/inventory/sale.js"></script>
@endpush
