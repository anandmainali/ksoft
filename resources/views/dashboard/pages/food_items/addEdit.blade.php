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
          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">          
          {!! Form::label('name', 'Item Name') !!}          
          {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Enter Item name']) !!}
          @if ($errors->has('name'))
        <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
        </div>
        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">          
          {!! Form::label('price', 'Item Price') !!}          
          {!! Form::text('price', null, ['class'=>'form-control','placeholder'=>'Enter Price']) !!}
          @if ($errors->has('price'))
        <span class="help-block">{{ $errors->first('price') }}</span>
        @endif
        </div>
        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">          
          {!! Form::label('description', 'Item Description') !!}          
          {!! Form::textarea('description', null, ['class'=>'form-control','placeholder'=>'Enter Description']) !!}
          @if ($errors->has('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
        @endif
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