@extends('layouts.app', ['page' => 'List of Purchase', 'pageSlug' => 'purchase', 'section' => 'purchase'])

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
            Purchase
        </div>
        <div class="card-body">

            <div class="row">
                <div class="first col-md-3 col-sm-3 col-md-pull-3">
                    <div class="h-100 d-flex align-items-center justify-content-center ">
                        <div class="SplitData activeSplitterDiv" data-value="AllData" style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                        font-size: 20px;text-align: center;">
                            <img src="assets/img/badge.png" alt="" style="width: 50px;margin-top:10px;">
                            <div class="tee" style="font-size: 20px;color: #fff;">Total</div>
                        </div>
                    </div>
                </div>
                <div class="middle col-md-3 col-md-push-3 col-sm-3">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <div class="SplitData" data-value="activeData" style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                        font-size: 20px;text-align: center; ">
                            <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                            <div class="tee" style="font-size: 20px;color: #fff;">Active</div>
                        </div>
                    </div>
                </div>
                <div class="last col-md-3 col-sm-3 ">
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
                            <a href="{{ route('InvPurchase.create') }}" class="btn btn-sm btn-primary">Add Purchase</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">#</th>
                                <th scope="col">Purchase No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>


                            </thead>
                            <tbody>
                            @foreach($models as $model)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $model->reference_no }}</td>
                                <td>{{ $model->date }}</td> 

                                <td class="td-actions">
                                    <a href="{{ url('InvPurchase/'.$model->purchaseId.'/edit') }}"" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <form action="{{ url('InvPurchase/{InvPurchase}', $model->id) }}" method="post" class="d-inline">
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

        });
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
                url: "{{ route('getBrandSplitedData') }}",
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
                        var editurl = '{{ route('InvPurchase.edit', ':id') }}';
                        editurl = editurl.replace(':id', value.id);

                        var deleteurl = '{{ route('InvPurchase.destroy', ':id') }}';
                        deleteurl = deleteurl.replace(':id', value.id);

                        var row = `<tr role="row" class="odd"><td>` + (key + 1) + `</td><td>` + value
                            .brand_name + `</td><td class="td-actions"><a href ="` + editurl +
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
