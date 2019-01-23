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
          <table id="example1" class="table table-bordered table-striped">
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
                @foreach($food_items as $key=>$item)
                <tr>
                  <td>{{++$key}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->categories()->pluck('name')->implode(', ')}}</td>         
                  <td>{{$item->price}}</td>           
                  <td>
                    
                    {!! Form::button('<i class="fa fa-eye"></i>', ['class'=>'btn btn-info btn-xs','data-toggle'=>'modal','data-target'=>'#modal-default']) !!}
                    {{-- {!! Html::decode(link_to_action('TodayMenuController@getAddToCart', '<i class="fa fa-cart-plus"></i>',[$item->id],['class'=>'btn btn-warning btn-xs'])) !!}  --}}
                    {{-- <form action="{{route('admin.addToCart',$item->id)}}" method="get">
                      @csrf
                      <button type="submit" class= 'btn btn-warning btn-xs'><i class="fa fa-cart-plus"></i></button>
                    </form> --}}
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