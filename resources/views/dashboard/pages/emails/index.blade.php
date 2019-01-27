@extends('dashboard.layouts.admin-master') 
@section('title','Private Emails')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="col-xs-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        @if(isset($email))
        <h3 class="box-title">Update Private Email</h3>
        @else
        <h3 class="box-title">Add Private Email</h3>
        @endif
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      @if(isset($email))      
      {!! Form::model($email,['method'=>'PATCH','route'=>['admin.companyEmail.update',$email->id]]) !!}
      @else
      {!! Form::open(['route'=>'admin.companyEmail.store']) !!} 
      @endif
      <div class="box-body">
        <div class="form-group has-feedback {{ $errors->has('company_private_email') ? ' has-error' : '' }}">
          {!! Form::label('company_private_email', 'Email') !!} 
          {!! Form::text('company_private_email',isset($email) ? $email->name : '', ['placeholder'=>'Enter email','class'=>'form-control']) !!} 
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span> 
          @if ($errors->has('company_private_email'))
            <span class="help-block">{{ $errors->first('company_private_email') }}</span>
          @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer ">
        @if(isset($email))         
        {!! link_to_route('admin.companyEmail.index', 'Cancel', [], ['class'=>'btn btn-default']) !!}
        @endif
        {!! Form::submit('Submit', ['class'=>'btn btn-primary pull-right']) !!}
      </div>

      {!! Form::close() !!}

    </div>
  </div>
  <div class="col-xs-8 ">

    <div class="box ">
      <div class="box-header ">
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <table id="example1 " class="table table-bordered table-striped ">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Private Emails</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($emails) > 0)
            @foreach($emails as $key=>$email)
            <tr>
              <td>{{++$key}}</td>
              <td>{{$email->company_private_email}}</td>
              <td>
                  {!! Html::decode(link_to_route('admin.companyEmail.edit', '<i class="fa fa-edit"></i>', [$email->id], ['class'=>'btn btn-primary btn-xs'])) !!}
                  {!! Form::button("<i class='fa fa-trash'></i>", ['class'=>'btn btn-danger btn-xs','onClick'=>'deleteItem('.$email->id.')']) !!}       
                  {!! Form::open(['method'=>'DELETE','route'=>['admin.companyEmail.destroy',$email->id],'id'=>'delete-form-'.$email->id]) !!}                  
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