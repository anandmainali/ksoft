@extends('dashboard.layouts.admin-master') 
@section('title','All Users') 
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      
      {!! Html::decode(link_to_route('admin.users.create', '<i class="fa fa-plus"></i> Add New', [], ['class'=>'btn btn-sm btn-info'])) !!}<br><br>
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($users) > 0)
              @foreach($users as $key=>$user)
              <tr>
                <td>{{++$key}}</td>
                <td><img src="{{$user->image}}" alt="Avatar" height="40px" width="40px" class="img-responsive img-circle"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roles->name}} </td>
                <td>
                  @if($user->status)
                    {!! Form::open(['method'=>'GET','route'=>['admin.users.show',$user->id]]) !!}     
                    {!! Form::submit("Active", ['class'=>'btn btn-success btn-xs']) !!} 
                    {!! Form::close() !!}
                  @else
                  {!! Form::open(['method'=>'GET','route'=>['admin.users.show',$user->id]]) !!}     
                  {!! Form::submit("Inactive", ['class'=>'btn btn-danger btn-xs']) !!} 
                    {!! Form::close() !!}
                  @endif
                </td>
                
                <td>                  
                  {!! Html::decode(link_to_route('admin.users.edit', '<i class="fa fa-edit"></i>',[$user->id],['class'=>'btn btn-primary btn-xs'])) !!}
                    {!! Form::button("<i class='fa fa-trash'></i>", ['class'=>'btn btn-danger btn-xs','onClick'=>'deleteItem('.$user->id.')']) !!}       
                    {!! Form::open(['method'=>'DELETE','route'=>['admin.users.destroy',$user->id],'id'=>'delete-form-'.$user->id]) !!}                  
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