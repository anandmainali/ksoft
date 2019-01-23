@extends('dashboard.layouts.admin-master') 
@section('title','Your Cart Items')
@section('content')

<!-- Main content -->
<section class="content">

  <div class="col-xs-8 col-xs-offset-2">

    <div class="box ">
      <div class="box-header ">
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
          <table id="example" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Price (Rs.)</th>
                  <th>Quantity</th>
                  <th>SubTotal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody> 
                @if(Session::has('cart'))
                @foreach($items as $item)
                <tr>
                  <td>{{$item['item']['name']}}</td>
                  <td>{{$item['item']->categories()->pluck('name')->implode(', ')}}</td> 
                  <td>{{$item['item']['price']}}</td>        
                  <td>{{$item['qty']}}</td>  
                  <td>{{$item['price']}}</td>         
                  <td>     
                      <a href="{{ route('admin.reduceByOne', ['id' => $item['item']['id']]) }}" class="btn btn-primary btn-xs"><i class="fa fa-minus"></i></a>
                      <a href="{{ route('admin.remove', ['id' => $item['item']['id']]) }}" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></a>                                    
                     
                  </td>
                </tr>    
                  @endforeach
                  <tr>
                    <td colspan="4"><h4>Total Price:</h4>
                    </td>
                    <td><h4>Rs. {{$totalPrice}}</h4></td>
                  </tr>
                  @else
                    <tr>
                      <td colspan="100%"><h3 style="text-align:center">Add Somethig to make Order</h3></td>
                    </tr>
                  @endif
              </tbody>
            </table>       
            @if(Session::has('cart'))
            <a href="" class="btn btn-primary pull-right">Submit Order</a>
            @endif
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->




@endsection