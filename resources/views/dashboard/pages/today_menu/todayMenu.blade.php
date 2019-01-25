@extends('dashboard.layouts.admin-master') 
@section('title','Today\'s Menu')
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
                  <th>S.N.</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Price (Rs.)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(Carbon\Carbon::now('GMT+5:45')->toTimeString() <= Carbon\Carbon::createFromTime(13, 0)->toTimeString())

                @if(count($food_items) > 0)
                @foreach($food_items as $key=>$item)
                <tr>
                  <td>{{++$key}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->categories()->pluck('name')->implode(', ')}}</td>         
                  <td>{{$item->price}}</td>           
                  <td>
                    
                    {!! Form::button('<i class="fa fa-eye"></i>', ['class'=>'btn btn-info btn-xs','data-toggle'=>'modal','data-target'=>'#modal-default']) !!}
                    <a href="{{route('admin.addToCart',[$item->id])}}" class= 'btn btn-warning btn-xs'><i class="fa fa-cart-plus"></i></a>
                    
                  </td>
                </tr>
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h3 class="modal-title">Menu Item Details</h3>
                        </div>
                        <div class="modal-body">
                          <h4>Item Name:</h4> 
                          <b style="font-size:15px">{{$item->name}}</b><hr>                 
                          <h4>Category:</h4> 
                          <b style="font-size:15px">{{$item->categories()->pluck('name')->implode(', ')}}</b><hr> 
                          <h4>Price:</h4> 
                          <b style="font-size:15px">{{$item->price}}</b><hr>
                          <h4>Description:</h4>
                          <b style="font-size:15px">{{$item->description}}</b>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>     
                  @endforeach 
                  @else
                    <tr>
                      <td colspan="5" style="text-align: center"><h4>Menu is not set.</h4></td>
                    </tr>
                  @endif

                  @else
                  <tr>
                      <td colspan="5" style="text-align: center"><h4>Please place order before launch time.</h4></td>
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