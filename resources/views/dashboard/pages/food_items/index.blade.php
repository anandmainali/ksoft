@extends('dashboard.layouts.admin-master') 
@section('title','Food Items') 
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      
      {!! Html::decode(link_to_route('admin.foodItem.create', '<i class="fa fa-plus"></i> Add New', [], ['class'=>'btn btn-sm btn-info'])) !!}<br><br>
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Price (Rs.)</th>
                <th>Add To Today Menu</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($food_items) > 0)
              @foreach($food_items as $key=>$food_item)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$food_item->name}}</td>
                <td>{{$food_item->categories()->pluck('name')->implode(', ')}}</td>                
                <td>{{$food_item->price}}</td>   
                <td>
                    @if($food_item->status)
                    {!! Form::open(['method'=>'GET','route'=>['admin.foodItem.show',$food_item->id]]) !!}     
                    {!! Form::button("<i class='fa fa-check'></i> Added", ['type'=>'submit','class'=>'btn btn-success btn-xs']) !!} 
                    {!! Form::close() !!}
                  @else
                  {!! Form::open(['method'=>'GET','route'=>['admin.foodItem.show',$food_item->id]]) !!}     
                  {!! Form::button("<i class='fa fa-plus'></i> Add", ['type'=>'submit','class'=>'btn btn-info btn-xs']) !!} 
                    {!! Form::close() !!}
                  @endif
                </td>             
                <td>                  
                  {!! Html::decode(link_to_route('admin.foodItem.edit', '<i class="fa fa-edit"></i>',[$food_item->id],['class'=>'btn btn-primary btn-xs'])) !!}
                    {!! Form::button("<i class='fa fa-trash'></i>", ['class'=>'btn btn-danger btn-xs','onClick'=>'deleteItem('.$food_item->id.')']) !!}       
                    {!! Form::open(['method'=>'DELETE','route'=>['admin.foodItem.destroy',$food_item->id],'id'=>'delete-form-'.$food_item->id]) !!}                  
                    {!! Form::close() !!}
          </td>
              </tr>
              @endforeach
              @else
                <tr>
                    <td colspan="100%">
                        <h4 style="text-align: center">No Data Found</h4>
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