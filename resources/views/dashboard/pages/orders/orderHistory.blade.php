@extends('dashboard.layouts.admin-master') 
@section('title','Order History') 
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
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($users) > 0)
              @foreach($users as $key=>$userArray)  
                @foreach($userArray as $key=>$user)
              <tr>
                <td>{{++$key}}</td>
                <td><img src="{{$user->image}}" alt="User Image" height="40px" width="40px"></td>
                <td>{{$user->name}}</td> 
                <td>{{$user->email}}</td>
                <td>  
                  <a href="{{route('admin.ordersHistoryItems',$user->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                    {{--  <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-default{{$order->id}}">
                        <i class="fa fa-eye"></i>
                      </button>  --}}
                </td>
              </tr>
              @endforeach
              @endforeach
              @else
                <tr>
                    <td colspan="100%">
                        <h4 style="text-align: center">No Datas Found</h4>
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