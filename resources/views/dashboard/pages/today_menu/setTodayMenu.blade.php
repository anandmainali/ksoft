@extends('dashboard.layouts.admin-master') 
@section('title','Set Today Menu')
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
                </tr>
              </thead>
              <tbody>
                @if(count($food_items) > 0)
                {!! Form::open(['route'=>'admin.setTodayMenu']) !!} 
                @foreach($food_items as $key=>$food_item)
                <tr>
                  <input type="hidden" name="food_items[]" value="{{$food_item->id}}">
                  <input type="hidden" name="date" value="{{Carbon\Carbon::now()->toDateString()}}">
                  <td>{{++$key}}</td>
                  <td>{{$food_item->name}}</td>
                  <td>{{$food_item->categories()->pluck('name')->implode(', ')}}</td>                
                  <td>{{$food_item->price}}</td>           
                  <td>
                </tr>                
                @endforeach
                {!! Form::submit('Submit', ['class'=>'btn btn-primary pull-right']) !!}
                  {!! Form::close() !!}
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