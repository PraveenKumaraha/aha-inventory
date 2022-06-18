@extends('layouts.app', ['page' => 'Add Inv', 'pageSlug' => 'addinv', 'section' => 'Add Inv'])

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

        .addinv1 {
            float: left;

        }

        .addinv {
            float: right;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>




    <div class="row" style="margin-top: -15px;">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title"></h4>
                            {{-- <input type="text" id="search" placeholder="Type to search" autocomplete="off"> --}}
                            <h2>Add Inv </h2>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('addinv.index') }}" class="btn btn-sm btn-primary"> Back to list</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts.success')

                    <div class="product">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">ITEM</th>
                                <th scope="col">QUANTITY</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">TAX</th>
                                <th scope="col">DISCOUNT</th>
                                <th class="status" scope="col">TOTAL</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <div class="row">

                                       <td>
                                                <select name="item_id" id="input" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
                                                    <option value="">Not Specified</option>
                                                    @foreach ($pdtproductIds as $pdtproductId)
                                                        @if($pdtproductId['id'] == old('item_id'))
                                                            <option value="{{$pdtproductId['id']}}" selected>{{$pdtproductId['product_name']}}</option>
                                                        @else
                                                            <option value="{{$pdtproductId['id']}}">{{$pdtproductId['product_name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                        </td>

                                        <td> <input type="text" name="quantity" id="quantity" class="form-control Category "
                                                placeholder="Commission (RM)" required autofocus disabled>
                                        </td>


                                        <td> <input type="text" name="Price" id="Category" class="form-control Category"
                                                placeholder="Commission (RM)" required autofocus disabled>
                                        </td>



                                        <td> <input type="text" name="Tax" id="Category" class="form-control Category"
                                                placeholder="Commission (RM)" required autofocus disabled>
                                        </td>



                                        <td> <input type="text" name="Discount" id="Category" class="form-control Category"
                                                placeholder="Commission (RM)" required autofocus disabled>



                                        <td> <input type="text" name="Total" id="Category" class="form-control Category"
                                                placeholder="Commission (RM)" required autofocus disabled>
                                        </td>

                                        <td>

                                            <img
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABBUlEQVRIid2UMU7DQBBF3xjhBtqAEq4SbuCLEEWipYOWFo7hDnIACnMKqEDBTaigAGF7aBBCjBfvLDThl6v9/8+fmV1Yd0jMpbqYngDH35in48vqyGVQF1P1VBfCeFF96mZ/Ifi/YYZcF/vnoPMUMYWzyaI6/HrWN4P7FHEAETVcYyDKXbKB2uKMQbvxiwSoKc62SCQ5wVubDyeY5LsPQJOg3+xtj+pBAynLFjAXI7D84P5sAKBpm9TL6TUQ/JukAU7gL7L7PAQRTwLN/C3qeQNBgy7zzyDU1tB37Z5B03XxCTaluwFeHfov+VZ+G20wurh+EmUG8hghvkLkYKe8enYUtEZ4B2XySeSvjJE4AAAAAElFTkSuQmCC">
                                        </td>
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <button type="submit" class="btn btn-md btn-primary" onclick="add();" id="clicked">Add New Row</button>
                    <div id='result'></div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">

                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.js"></script>


    @push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush
    <script>
        //  $(document).ready(function(){
        //      $("button").click(function(){
        //          var name = $("#name").val();
        //          var quantity = $("#quantity").val();
        //          var row = "<tr><td>" + name + "</td><td>" + quantity + "</td></tr>";
        //          $("table tbody").append(row);
        //      });
        //  });

        function add() {
            var row =
                '<tr><td><select name="item_id" id="input" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}"><option value="">Not Specified</option>@foreach ($pdtproductIds as $pdtproductId)@if($pdtproductId['id'] == old('item_id'))<option value="{{$pdtproductId['id']}}" selected>{{$pdtproductId['product_name']}}</option>@else<option value="{{$pdtproductId['id']}}">{{$pdtproductId['product_name']}}</option>@endif@endforeach</select></td> <td> <input type="text" name="quantity" id="quantity" class="form-control Category"placeholder = "Commission (RM)" required autofocus disabled ></td><td> <input type="text" name="Price" id="Category"class="form-control Category "placeholder="Commission (RM)" value="{{ old('name') }}" required autofocus disabled></td > < td > <input type="text" name="Price" id="Category"class="form-control Category"placeholder="Commission (RM)" required autofocus disabled> < /td><td><input type="text" name="Tax" id="Category" class="form-control Category" placeholder="Commission (RM)" required autofocus disabled></td > < td > <input type="text" name="Discount" id="Category" class="form-control Category" placeholder="Commission (RM)" required autofocus disabled> < /td><td><input type="text" name="Discount" id="Category" class="form-control Category" placeholder="Commission (RM)" required autofocus disabled></td><td><input type="text" name="Total" id="Category" class="form-control Category" placeholder="Commission (RM)" required autofocus disabled></td><td><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABBUlEQVRIid2UMU7DQBBF3xjhBtqAEq4SbuCLEEWipYOWFo7hDnIACnMKqEDBTaigAGF7aBBCjBfvLDThl6v9/8+fmV1Yd0jMpbqYngDH35in48vqyGVQF1P1VBfCeFF96mZ/Ifi/YYZcF/vnoPMUMYWzyaI6/HrWN4P7FHEAETVcYyDKXbKB2uKMQbvxiwSoKc62SCQ5wVubDyeY5LsPQJOg3+xtj+pBAynLFjAXI7D84P5sAKBpm9TL6TUQ/JukAU7gL7L7PAQRTwLN/C3qeQNBgy7zzyDU1tB37Z5B03XxCTaluwFeHfov+VZ+G20wurh+EmUG8hghvkLkYKe8enYUtEZ4B2XySeSvjJE4AAAAAElFTkSuQmCC"></td></tr > ';
            $('.table>tbody').append(row);
        }

    //     $(document).ready(function()
    // {
    //     var new=[
    //         "A", "B"
    //     ];
    //     $("product").select2({
    //         data:new
    //     });
    // });

    </script>

{{Form::open(array('url'=>'admin/categories/create'))}}
<p>
{{Form::label('name')}}
{{Form::text('name')}}
</p>
{{Form::submit('create category',array('class'=>'secondary-cart-btn'))}}
{{Form::close()}}
@stop




