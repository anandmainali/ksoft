@extends('dashboard.layouts.admin-master') 
@if(isset($food_item))
@section('title','Update Food Item') 
@else
@section('title','Create Food Item') 
@endif
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
           @if(isset($food_item))  
           {!! Form::model($food_item,['method'=>'PATCH','route'=>['admin.foodItem.update',$food_item->id],'files'=>true]) !!}
           @else
          {!! Form::open(['route'=>'admin.foodItem.store']) !!}
          @endif
          <div class="form-group">          
          {!! Form::label('name', 'Item Name') !!}          
          {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Enter Item name']) !!}
        </div>
        <div class="form-group">          
          {!! Form::label('price', 'Item Price') !!}          
          {!! Form::text('price', null, ['class'=>'form-control','placeholder'=>'Enter Price']) !!}
        </div>
        <div class="form-group">          
          {!! Form::label('description', 'Item Description') !!}          
          {!! Form::textarea('description', null, ['class'=>'form-control','placeholder'=>'Enter Description']) !!}
        </div>
            <div class="row">
              <div class="col-sm-8">
                  <div class="form-group">
                      {{ Form::label('category', 'Assign Category') }} <br>
                      @foreach ($categories as $category)
                      {{ Form::checkbox('categories[]',  $category->id ) }}
                      {{ Form::label($category->name, ucfirst($category->name)) }}<br>          
                      @endforeach                          
                  </div>
              </div>
            </div>
            
        <div class="box-footer">                 
            {!! link_to_route('admin.foodItem.index', 'Cancel', [], ['class'=>'btn btn-default']) !!}    
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>         
          {!! Form::close() !!}
        </div>        
      </div>
      <!-- /.box-body -->
  </div>
    </div>
  </div>
</section>
  @endsection