@extends('admin.master')
@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Rules</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Rules</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Rules</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SI</th>
                    <th>Title</th>
                    <th>Delivery Type</th>
                    <th>Route</th>
                    <th>Weight</th>
                    <th>Expire Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($rules as $key => $rule)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $rule->title }}</td>
                        <td>{{ $rule->delivery_type == 1 ? 'Regular Service' : 'Express Service' }}</td>
                        <td>{{ $rule->route == 1 ? 'Inside Dhaka' : 'Outside Dhaka' }}</td>
                        <td>
                          @if($rule->min_weight < 1000)
                            {{ $rule->min_weight }}gm
                          @else 
                            {{ $rule->min_weight / 1000 }}kg
                          @endif 

                          - 

                          @if($rule->max_weight < 1000)
                            {{ $rule->max_weight }}gm
                          @else 
                            {{ $rule->max_weight / 1000 }}kg
                          @endif
                        </td>
                        <td>{{ $rule->expired_date }}</td>
                        <td>
                          <a href="{{ route('rules.edit', $rule->id) }}" class="btn btn-sm btn-primary">Edit</a>&nbsp;&nbsp;

                          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $rule->id }}">Delete</a>
                        </td>
                      </tr>

                      <!-- Delete Modal Start -->
                      <div class="modal fade" id="deleteModal{{ $rule->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Delete Rule</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('rules.destroy', $rule->id) }}" method="POST" style="display: none;">
                                  @csrf @method('delete')
                              <div class="modal-body">
                                <p>Are you sure want to delete this {{ $rule->title }}?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- Delete Modal End -->
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @push('js')
    <script>
      @if(Session::has('message'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
            toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
            toastr.error("{{ session('error') }}");
        @endif

    </script>
  @endpush 
@endsection