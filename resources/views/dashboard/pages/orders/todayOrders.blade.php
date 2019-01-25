@extends('dashboard.layouts.admin-master') 
@section('title','Today Orders') 
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Employee Name</th>
                <th>Total Price (Rs.)</th>
                <th>Order Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($orders) > 0)
              @foreach($orders as $key=>$order)
              <tr>
                
                <td>{{++$key}}</td>
                <td>{{$order->user->name}}</td>
                            
                <td>{{$order->totalPrice}}</td>  
                 
                <td>
                    @if($order->status)
                    <span class="label label-success">Complete</span>                    
                  @else
                  {!! Form::open(['method'=>'GET','route'=>['admin.orders.show',$order->id]]) !!}     
                  {!! Form::submit("Remains", ['class'=>'btn btn-danger btn-xs']) !!} 
                    {!! Form::close() !!}
                  @endif

                      
                </td> 
                <td>  
                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-default{{$order->id}}">
                        <i class="fa fa-eye"></i>
                      </button>

                      <div class="modal fade" id="modal-default{{$order->id}}" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Order Items</h4>
                              </div>
                              <div class="modal-body">
                                  <table class="table table-striped">
                                      <thead>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price (Rs.)</th>
                                        <th>Subtotal</th>
                                      </thead>
                                      <tbody>
                                        @foreach($order->order_items as $item)
                                        <tr>
                                          <td>{{$item->food_item->name}}</td>
                                          <td>{{$item->quantity}}</td>
                                          <td>{{$item->food_item->price}}</td>
                                          <td>{{$item->quantity * $item->food_item->price}}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="odd gradeX">
                                          <td class="center"></td>
                                           <td class="center"></td>
                                           <td class="center"><b>Total:-</b></td>
                                           <td class="center">Rs.{{$order->totalPrice}}</td> 
                                       </tr>
                                      </tbody>
                                    </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                </td>
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