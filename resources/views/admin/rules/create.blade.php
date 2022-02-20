@extends('admin.master')
@section('body')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pricing Rules</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pricing Rules</li>
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
                Pricing Rule
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form method="post" action="{{route('rules.store')}}" enctype="multipart/form-data">
            		@csrf
            		<input type="hidden" name="id" value="{{ getValue('id', $rule) }}">

                <div class="form-group row">
                  <label class="col-md-2" for="title">Title</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="title" value="{{ getValue('title', $rule) }}">
                  </div>
                  <label class="col-md-2" for="delivery_type">Delivery Type <code>*</code></label>
                  <div class="col-md-4">
                    <select class="form-control" name="delivery_type" required>
                      <option {{ getValue('delivery_type', $rule) == 1 ? 'selected' : '' }} value="1">Regular Service</option>
                      <option {{ getValue('delivery_type', $rule) == 2 ? 'selected' : '' }} value="2">Express Service</option>
                    </select>
                    @if($errors->has('delivery_type'))
                        <span class="text-danger"> {{$errors->first('delivery_type')}}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2" for="route">Route <code>*</code></label>
                  <div class="col-md-4">
                    <select class="form-control" name="route" required>
                      <option {{ getValue('route', $rule) == 1 ? 'selected' : '' }} value="1">Inside Dhaka</option>
                      <option {{ getValue('route', $rule) == 2 ? 'selected' : '' }} value="2">Outside Dhaka</option>
                    </select>
                    @if($errors->has('route'))
                        <span class="text-danger"> {{$errors->first('route')}}</span>
                    @endif
                  </div>
                  <label class="col-md-2" for="weight">Weight (500gm-1kg) <code>*</code></label>
                  <div class="col-md-4">
                    <input onchange="check_string()" type="text" class="form-control" id="weight" name="weight" placeholder="Ex: 500gm-1kg" @if($rule) value="@if($rule->min_weight < 1000) {{ $rule->min_weight }}gm @else {{ $rule->min_weight / 1000 }}kg @endif - @if($rule->max_weight < 1000) {{$rule->max_weight }}gm @else {{ $rule->max_weight / 1000 }}kg @endif" @else value="" @endif >
                    @if($errors->has('weight'))
                        <span class="text-danger"> {{$errors->first('weight')}}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2" for="expired_date">Expire Date <code>*</code></label>
                  <div class="col-md-4">
                    @php
                      $NewDate = date('Y-m-d', strtotime('+1 days'));
                      $min = date('Y-m-d', strtotime($NewDate));
                      if(getValue('expired_date', $rule)) {
                          $time = date('Y-m-d', strtotime(getValue('expired_date', $rule)));
                      }else {
                          $time = $min;
                      }
                    @endphp
                    <input type="date" class="form-control" name="expired_date" min="{{ $min }}" value="{{ $time }}" required>
                    @if($errors->has('expired_date'))
                        <span class="text-danger"> {{$errors->first('expired_date')}}</span>
                    @endif
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
  @push('js')
    <script>
      function check_string() {
        var weight = $("#weight").val();
        var r = /^0-9gm$/;
        ; // true
        if(r.test(weight)) {
          alert("ok")
        } else {
          alert("wrong")
        }
      }
    </script>
  @endpush
@endsection 