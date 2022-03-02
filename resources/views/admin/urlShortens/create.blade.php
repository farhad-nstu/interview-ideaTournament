@extends('admin.master')
@section('body')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>URL Shortening</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">URL Shortening</li>
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
                URL Shortening
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form method="post" action="{{route('urlShorten.store')}}" enctype="multipart/form-data">
            		@csrf
            		<input type="hidden" name="id" value="{{ getValue('id', $urlShorten) }}">

                <div class="form-group row">
                  <label class="col-md-2" for="expiry_time">Expire Date <code>*</code></label>
                  <div class="col-md-4">
                    @php
                      $NewDate = date('Y-m-d');
                      $min = date('Y-m-d', strtotime($NewDate));
                      if(getValue('expiry_time', $urlShorten)) {
                          $time = date('Y-m-d', strtotime(getValue('expiry_time', $urlShorten)));
                      }else {
                          $time = $min;
                      }
                    @endphp
                    <input type="date" class="form-control" name="expiry_time" min="{{ $min }}" value="{{ $time }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2"></label>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-success">Save</button>
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