@extends('dashboard.layouts.admin-master') 
@section('title','My Orders') 
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Date</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              @if(count($orderedItems) > 0)
              @foreach($orderedItems as $key=>$item)  
                     
              <tr>
                <td>{{++$key}}</td>
                <td>{{$item->order->date}}</td>
                <td>{{$item->food_item->name}}</td>
                <td>{{$item->food_item->price}}</td> 
                <td>{{$item->quantity}}</td>
              </tr>
              
              @endforeach
              @else
                <tr>
                    <td colspan="100%">
                        <h4 style="text-align: center">No Orders Found</h4>
                      </td>
                </tr>
              @endif
            </tbody>
          </table>
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