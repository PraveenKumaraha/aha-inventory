@extends('layouts.app', ['page' => 'List of Supplier', 'pageSlug' => 'supplier', 'section' => 'Supplier'])

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

        .activeSplitterDiv {
            border: 2px solid blue !important;
        }
    </style>
    <div class="card">
        <div class="card-header text-center font-weight-bold text-white" style="background-color: #5e72e4;">
            Other Cr/Dr
        </div>
        <div class="card-body">

            <div class="row">
                <div class="first col-md-3 col-sm-3 col-md-pull-3">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <div class="SplitData activeSplitterDiv" data-value="AllData" style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                    font-size: 20px;text-align: center;">
                            <img src="assets/img/hotel-supplier.png" alt="" style="width: 50px;margin-top:10px;">
                            <div class="tee" style="font-size: 20px;color: #fff;">Total</div>
                        </div>
                    </div>
                </div>
                <div class="middle col-md-3 col-md-push-3 col-sm-3">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <div class="SplitData" data-value="activeData" style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                    font-size: 20px;text-align: center;">
                            <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                            <div class="tee" style="font-size: 20px;color: #fff;">Active</div>
                        </div>
                    </div>
                </div>
                <div class="last col-md-3 col-sm-3">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <div class="SplitData" data-value="inActiveData" class="activeSplitterDiv" style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
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
                        <h4 class="card-title" style="text-align: center;padding: 10px;margin-left: 550px;">Supplier
                            Management
                        </h4>
                    </div>
                </div>
                <div class="row inline">
                    <div class="square" style="height: 120px;width:150px;background-color:#265362;margin-left: 30px;border-radius: 20px;
                    font-size: 20px;text-align: center;">
                        <img src="assets/img/hotel-supplier.png" alt="" style="width: 70px;margin-top: 20px;">
                        <div class="tee" style="font-size: 20px;color: #fff;">Total Supplier</div>
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
    <style>
    .switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 20px;
  vertical-align: middle;
  margin-top: 8px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: red;
  -webkit-transition: .4s;
  transition: .4s;

}

.slider:before {
  position: absolute;
  content: "";
 height: 16px;
width: 14px;
left: 2px;
bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


</style>

    <div class="row" style="margin-top: -15px;">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title"></h4>
                            <input type="text" id="search" placeholder="Type to search" autocomplete="off">
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('otherCrDr.create') }}" class="btn btn-sm btn-primary">New Other Cr/Dr</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">#</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">IN Detail</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th> 
                                <th scope="col">Actions</th>

                            </thead>
                            <tbody>
                            @foreach ($models as $model)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $model->transaction }}</td>
                                        <td>{{ $model->detail }}</td>
                                        <td>{{ $model->amount }}</td>
                                        <td>{{ $model->type }}</td>
                                        <td><label class="switch">
                                            <input type="checkbox" onchange="changeStatus(event.target,'{{$model->id}}')"
                                                                                       <?php 
                                            if($model->status == "1"){echo"checked";}else{ echo "unchecked";}
                                            ?>><span class="slider round"></span></label>
                                        </td>

                                        <td class="td-actions">

                                            <a href="{{ route('otherCrDr.edit', $model->id) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('otherCrDr.destroy', $model->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete Product"
                                                    onclick="confirm('Are you sure you want to remove this product? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

        });
        function changeStatus(_this,id) {
           
           var status = $(_this).prop('checked') == true ? 1 : 0;
           console.log(id);
           console.log(status);
           
           let _token = $('meta[name="csrf-token"]').attr('content');

           $.ajax({
               url: `changeOtherCrDrTypeStatus`,
               type: 'post',
               data: {
                   _token: _token,
                   id: id,
                   status: status 
               },
               success: function (result) {             
           console.log("success");
               }
           });
       }
        var $rows = $('.table tbody tr');
        $('#search').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });

        var type = null;
        $('.SplitData').click(function(e) {
            $("body").find('.SplitData').removeClass('activeSplitterDiv');

            $(this).addClass('activeSplitterDiv');
            type = $(this).attr('data-value');
            splitData(type);
        });

        function splitData(type) {

            $.ajax({
                url: "{{ route('getOtherCrDrTypeData') }}",
                type: "post",
                data: type,
                data: {
                    _token: '{{ csrf_token() }}',
                    type: type,

                },
                success: function(response) {

                    var Result = response.data;
                    $(".table tbody").html("");
                    $.each(Result, function(key, value) {
                        var status = value.status;
                        var StatusRes = "unchecked";
                        if(status =="1"){
                            StatusRes = "checked";
                        }
                        var editurl = '{{ route('otherCrDr.edit', ':id') }}';
                        editurl = editurl.replace(':id', value.id);

                        var deleteurl = '{{ route('otherCrDr.destroy', ':id') }}';
                        deleteurl = deleteurl.replace(':id', value.id);

                        var row = `<tr role="row" class="odd"><td>` + (key + 1) + `</td><td>` + value
                            .transaction + `</td><td>` + value
                            .detail + `</td><td>` + value
                            .amount + `</td><td>` + value
                            .type + `</td><td><label class="switch"> <input type="checkbox" onchange="changeStatus(event.target,`+value.id+`)" `+StatusRes+` ><span class="slider round"></span></label></td><td class="td-actions"><a href ="` + editurl +
                            `" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit"> <i class="tim-icons icon-pencil"></i></a><form id="deleteStudentForm" action="` +
                            deleteurl + `" method="post" class="d-inline"> @csrf @method('DELETE') <button type="submit" class="btn btn-link" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete Product" onclick="return confirm('Are you sure?')">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button></form></td></tr>`;
                        //$('.table tbody').append('<tr> <td>' + (key + 1) + '</td><td>' + value.brand_name + '</td><td><a href ="" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit"> <i class="tim-icons icon-pencil"></i></a><form action="" method="post" class="d-inline">@csrf @method('delete')<button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Product" onclick="confirm("Are you sure you want to remove this product? The records that contain it will continue to exist.") ? this.parentElement.submit() : ' + " " + '"> <i class="tim-icons icon-simple-remove"></i></button></form></td></tr>');
                        $('.table tbody').append(row);
                    })
                    // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
@endsection
