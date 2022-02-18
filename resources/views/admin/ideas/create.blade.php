@extends('admin.master')
@section('body')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Text Editors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Text Editors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Idea Generate
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form method="post" action="{{route('ideas.store')}}" enctype="multipart/form-data">
            		@csrf
            		<input type="hidden" name="id" value="{{ getValue('id', $data) }}">

                <div class="form-group">
                  <label>Name</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="name" required="" value="{{ getValue('name', $data) }}">
                  </div>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <input type="email" class="form-control" name="email" value="{{ getValue('email', $data) }}" required="">
                    @if($errors->has('email'))
                        <span class="text-danger"> {{$errors->first('email')}}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <div class="input-group">
                    <select class="form-control" name="status" required="">
                      <option {{ getValue('status', $data) == 1 ? 'selected' : '' }} value="1">Active</option>
                      <option {{ getValue('status', $data) == 0 ? 'selected' : '' }} value="0">Inactive</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Idea</label>
                  <div class="input-group">
                    <textarea id="summernote" class="form-control" name="idea" required="">{{ getValue('idea', $data) }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label></label>
                  <div class="input-group">
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection 