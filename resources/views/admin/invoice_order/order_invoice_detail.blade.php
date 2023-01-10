@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Invoice Details
        <!--<button class="btn btn-primary btn-md float-right" onclick="PrintDiv();"><i class="fa fa-file"></i> Save As PDF</button>-->
        <button class="btn btn-info btn-md float-right" onclick="PrintDiv1();"><i class="fa fa-print"></i> Print</button>
    </h2>
    <br>
    <div class="card mb-4" id="divToPrint">
        <div class="card-body">
            <center><h2>www.giftszon.com</h2></center><br>
            <h4><u>CUSTOMER DETAIL</u></h4>
            <div class="row" style="margin-top:15px;">
                <div class="col-sm-6">
                    <p style="font-weight:500; text-transform:uppercase;">
                        Name : {{$invoice[0]->name}}<br>
                        Email : {{$invoice[0]->email}}<br>
                        Phone : {{$invoice[0]->phone}}<br>
                        Order Delivery Date : {{date('d-m-Y',strtotime($invoice[0]->del_date))}}<br>
                        Invoice Number : ORD{{$invoice[0]->invoice_order_id}}
                    </p>
                </div>
                <div class="col-sm-6">
                    <p style="font-weight:500; text-transform:uppercase;">
                        Landmark : {{$invoice[0]->landmark}}<br>
                        Address : <?= $invoice[0]->address.', '.$invoice[0]->pincode.'<br> '.$invoice[0]->city_name.', '.$invoice[0]->state_name; ?>.<br>
                        Address Type : {{$invoice[0]->address_type}}
                    </p>
                </div>
            </div>
            
            <hr>
            <h4><u>DECLARATION</u></h4>
            <p>This parcel contains a gift article being sent to the address. It is not for sale and has no commercial value.</p>
            <hr>
            
            <!--<p><b>Surprised Your Loved Once with exclusive return gifts.<br>Use Discount code & get 10% off on Giftszon.</b></p>-->
            <!--<hr>-->
            
            <?php $gs = App\Model\General_setting::first(); ?>
            
            <h4>SHIPPED BY (If undelivered, return to)</h4>
            <p><b>M/S INDIA GIFT ZONE</b></p>
            <p>Address : Plot no 150 B Santi nager gujar khi thdi jaipur.</p>
             <p>Phone : {{$gs->contact_phone}} | Email : {{$gs->contact_email}}</p>
            <p>GST No : 08EUBPM8273G1ZA</p>
            <hr>
            
            <h4><u>PRODUCT DESCRIPTION</u></h4><br>
            <div class="table" style="overflow-x:auto;">
                <table id="table" class="table-hover table-bordered" style="width:100%;">
                    <tr style="text-align:center;">
                        <th>Order Id</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Volume Weight</th>
                        <th>Product Price</th>
                        <th>Gift Packing</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php $total = 0; $total_charges=0; ?>
                    @foreach($invoice as $row)
                        <tr style="text-align:center;">
                            <td>{{$row->invoice_no}}</td>
                            <td><a href="{{asset('public/assets/product').'/'.$row->product_img}}"><img src="{{asset('public/assets/product').'/'.$row->product_img}}" height="60" weight="60"></a></td>
                            <td>{{ucwords($row->product_name)}}</td>
                            <td>{{$row->code}}</td>
                            <td>{{ucwords($row->volume_weight)}}</td>
                            <td>&#8377;{{$row->product_price}}</td>
                            <td>@if(!empty($row->gift_pack)){{$row->gift_pack}}@else{{"0"}}@endif</td>
                            <td>{{$row->quantity}}</td>
                            <?php $total += $row->quantity*$row->product_price; ?>
                            <?php $total_charges += $row->gift_pack; ?>
                            <td>&#8377;{{$row->quantity*$row->product_price}}</td>
                        </tr>
                    @endforeach
                    <tr style="text-align:center;">
                        <th colspan="2">
                            <p>Coupon Apply : @if(!empty($invoice[0]->coupon_code)){{$invoice[0]->coupon_code}}@else No @endif</p>
                        </th>
                        <th colspan="2">Coupon Amount : @if(!empty($invoice[0]->amount))-&#8377;{{$invoice[0]->amount}}@else -&#8377;0 @endif</th>
                        <th colspan="2">Extra Charges For Gift Packing</th>
                        <th colspan="1">&#8377;{{$total_charges}}</th>
                        <th colspan="1">Total Amount</th>
                        <th colspan="1">&#8377;{{$total+$total_charges-$invoice[0]->amount}}</th>
                    </tr>
                </table>
            </div>
            <hr>
            
            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#order").addClass("show");
        $("#order").addClass("active");
        $('#table').DataTable();
    });
</script>
<script type="text/javascript">     
    function PrintDiv1() {    
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();;
    }
    function PrintDiv() {
        html2canvas(document.getElementById('divToPrint'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Table.pdf");
            }
        });
    }
</script>
@endsection
