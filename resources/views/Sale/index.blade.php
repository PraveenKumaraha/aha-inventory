 @extends('layouts.app', ['page' => 'List of Sale', 'pageSlug' => 'salle', 'section' => 'SaleMaster'])

 @section('content')
     <style>
         .first {
             float: left;
             width: 33%;
         }

         .middlea {
             float: left;
             width: 33%;
         }

         .middleb {
             float: left;
             width: 33%;
         }

         .middlec {
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
             Sale Management
         </div>
         <div class="card-body">

             <div class="row">
                 <div class="first col-md-2 col-sm-2 col-md-pull-2">

                     <div class="h-100 d-flex align-items-center justify-content-center">
                         <div class="SplitData activeSplitterDiv" data-value="AllData"
                             style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                             <img src="assets/img/hotel-supplier.png" alt="" style=" width: 50px;margin-top:10px;">
                             <div class="tee" style="font-size: 20px;color: #fff;">Current</div>
                         </div>
                     </div>

                 </div>

                 <div class="middlea col-md-2 col-md-push-2 col-sm-2">
                     <div class="h-100 d-flex align-items-center justify-content-center">
                         <div class="SplitData" data-value="Availability" class="activeSplitterDiv"
                             style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                             <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                             <div class="tee" style="font-size: 20px;color: #fff;">Day</div>
                             <div style=text-decoration: underline;></div>
                         </div>
                     </div>

                 </div>

                 <div class="middleb col-md-2 col-md-push-2 col-sm-2">
                     <div class="h-100 d-flex align-items-center justify-content-center">
                         <div class="SplitData" data-value="Demand" class="activeSplitterDiv"
                             style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                             <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                             <div class="tee" style="font-size: 20px;color: #fff;">Week</div>
                             <div style=text-decoration: underline;></div>
                         </div>
                     </div>

                 </div>


                 <div class="middle col-md-2 col-md-push-2 col-sm-2">
                     <div class="h-100 d-flex align-items-center justify-content-center">
                         <div class="SplitData" data-value="activeData"
                             style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                             <img src="assets/img/active.png" alt="" style="width: 50px;margin-top:10px;">
                             <div class="tee" style="font-size: 20px;color: #fff;">Month</div>
                             <div style=text-decoration: underline;></div>
                         </div>
                     </div>

                 </div>

                 <div class="last col-md-2 col-sm-2">
                     <div class="h-100 d-flex align-items-center justify-content-center">
                         <div class="SplitData" data-value="inActiveData" class="activeSplitterDiv"
                             style=" height: auto;width:130px;background-color:#265362;border-radius: 10px;
                font-size: 20px;text-align: center;">
                             <img src="assets/img/inactive.png" alt="" style="width: 50px;margin-top:10px;">
                             <div class="tee" style="font-size: 20px;color: #fff;">Year</div>
                         </div>
                     </div>

                 </div>

             </div>
         </div>
     </div>

     <div class="card">
         <div>
             <label class="" for="input-name">Customer/Company : </label>
             <input type="text" name="cname" id="cname" class="" placeholder="Enter Name">
         </div>

         <div>
             <label class="" for="input-name">Customer Number : </label>
             <input type="text" name="cnumber" id="cno" class="" placeholder="Enter Customer Name">
            </div>
             <div>
                <label class="" for="input-name">GSTIN : </label>
                <input type="text" name="gstin" id="gstin" class="" placeholder="Enter GSTIN">
            </div>

            <div>
                <label class="" for="input-name">Date : </label>
                <input type="date" name="date" id="date" class="" placeholder="Enter Name">
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

                     </div>
                 </div>
                 <div class="card-body">
                     @include('alerts.success')

                     <div class="">
                         <table class="table tablesorter " id="">
                             <thead class=" text-primary">
                                 <th scope="col">S.No</th>
                                 <th scope="col">Product Name</th>
                                 <th scope="col">Product ID</th>
                                 <th scope="col">Quantity</th>
                                 <th scope="col">Price₹</th>
                                 <th scope="col">CGST</th>
                                 <th scope="col">SGST</th>
                                 <th scope="col">Discount</th>
                                 <th scope="col">Total Price</th>

                             </thead>
                             {{-- <tbody>
                            @foreach ($models as $model)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $model->product_name }}</td>
                                <td>{{ $model->categoryName }}</td>
                                <td>{{ $model->brandName }}</td>
                                <td>{{ $model->stock }}{{ $model->unitName }}</td>
                                <td>@if ($model->limit >= $model->stock)<span class="badge badge-success">Suffiecient</span>
                                    @else<span class="badge badge-danger">In-Suffiecient</span>@endif</td>
                                <td><a href=""><span class="badge badge-primary">Order</span></a></td>
                            </tr>
                            @endforeach
                        </tbody> --}}
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

         $("#search").keyup(function() {

             var value = this.value.toLowerCase().trim();

             $("table tr").each(function(index) {
                 if (!index) return;
                 $(this).find("td").each(function() {
                     var id = $(this).text().toLowerCase().trim();
                     var not_found = (id.indexOf(value) == -1);
                     $(this).closest('tr').toggle(!not_found);
                     return not_found;
                 });
             });
         });

         var type = null;
         $('.SplitData').click(function(e) {
             $('#search').val("");
             $("body").find('.SplitData').removeClass('activeSplitterDiv');

             $(this).addClass('activeSplitterDiv');
             type = $(this).attr('data-value');
             splitData(type);
         });
     </script>
 @endsection --}}
