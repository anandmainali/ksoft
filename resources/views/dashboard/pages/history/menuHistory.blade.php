@extends('dashboard.layouts.admin-master') 
@section('title','Menu History') 
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($dates) > 0)
              @foreach($dates as $key=>$date)  
                       
              <tr>
                <td>{{++$key}}</td>
                <td>{{$date->date}}</td> 
                <td>  
                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-default{{$date->id}}">
                        <i class="fa fa-eye"></i>
                      </button>

                      <div class="modal fade" id="modal-default{{$date->id}}" style="display: none;">
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
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Price (Rs.)</th>
                                      </thead>
                                      <tbody>
                                        
                                       @foreach($date->food_items as $key=>$item)
                                        <tr>
                                          <td>{{++$key}}</td>
                                          <td>{{$item->name}}</td>
                                          <td>{{$item->price}}</td>
                                        </tr>
                                        @endforeach
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