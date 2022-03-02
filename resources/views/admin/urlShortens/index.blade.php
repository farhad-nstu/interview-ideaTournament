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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">URL Shortening</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SI</th>
                    <th>Link</th>
                    <th>Expire Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($urlShortens as $key => $urlShorten)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $urlShorten->link }}</td>
                        <td>{{ $urlShorten->expiry_time }}</td>
                        <td>
                          <a href="{{ route('urlShorten.edit', $urlShorten->id) }}" class="btn btn-sm btn-primary">Edit</a>&nbsp;&nbsp;

                          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $urlShorten->id }}">Delete</a>
                        </td>
                      </tr>

                      <!-- Delete Modal Start -->
                      <div class="modal fade" id="deleteModal{{ $urlShorten->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Delete URL</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('urlShorten.destroy', $urlShorten->id) }}" method="POST" style="display: none;">
                                  @csrf @method('delete')
                              <div class="modal-body">
                                <p>Are you sure want to delete this {{ $urlShorten->link }}?</p>
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