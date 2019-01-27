@extends('dashboard.layouts.admin-master') 
@section('title','Category')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="col-xs-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        @if(isset($category))
        <h3 class="box-title">Update Category</h3>
        @else
        <h3 class="box-title">Add Category</h3>
        @endif
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      @if(isset($category))      
      {!! Form::model($category,['method'=>'PATCH','route'=>['admin.category.update',$category->id]]) !!}
      @else
      {!! Form::open(['route'=>'admin.category.store']) !!} 
      @endif
      <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Category Name') !!} 
          {!! Form::text('name',isset($category) ? $category->name : '',['class'=>'form-control']) !!} 
          @if ($errors->has('name'))
        <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer ">
        @if(isset($category))         
        {!! link_to_route('admin.category.index', 'Cancel', [], ['class'=>'btn btn-default']) !!}
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
              <th>Category Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($categories) > 0)
            @foreach($categories as $key=>$category)
            <tr>
              <td>{{++$key}}</td>
              <td>{{$category->name}}</td>
              <td>
                  {!! Html::decode(link_to_route('admin.category.edit', '<i class="fa fa-edit"></i>', [$category->id], ['class'=>'btn btn-primary btn-xs'])) !!}
                  {!! Form::button("<i class='fa fa-trash'></i>", ['class'=>'btn btn-danger btn-xs','onClick'=>'deleteItem('.$category->id.')']) !!}       
                  {!! Form::open(['method'=>'DELETE','route'=>['admin.category.destroy',$category->id],'id'=>'delete-form-'.$category->id]) !!}                  
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