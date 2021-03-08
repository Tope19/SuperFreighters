@extends('admin.layout.app')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">

                <div class="card">
                  <div class="card-header">
                    <h4>List of Routes
                      <span style="float:right"><a href="{{ route('admin.routes.create')}}" class="btn btn-primary">New route</a></span>
                    </h4>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                <tr>
                  <th> ID</th>
                  <th>Country </th>
                  <th>Name</th>
                  <th>Flate Rate</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($routes as $route)
                <tr class="gradeX">
                  <td>{{ $route->id }}</td>
                  <td>{{ $route->country->name }}</td>
                  <td>{{ $route->name }}</td>
                  <td>{{ $route->flat_rate }}</td>

                  <td class="center"><a href="#myModal{{ $route->id }}" data-toggle="modal" class="btn btn-success btn-sm"><i class="ti-eye"></i></a>

                    <form action="{{ route('admin.routes.destroy' , $route)}}" method="post">@csrf @method('delete')
                        <a href="{{ route('admin.routes.edit' , $route)}}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ti-trash"></i></button>
                    </form>
                    </td>
                    <div>
                 </tr>

                 <div class="modal fade bd-example-modal-md" id="myModal{{ $route->id }}">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $route->route_name }}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <p>Route ID: {{ $route->id }}</p>
                        <p>Country: {{ $route->country->name }}</p>
                        <p>City Name: {{ $route->name }}</p>
                        <p>Flat rate: {{ $route->flat_rate }}</p>
                     </div>
                  </div>
                </div>
              </div>

              @endforeach
              </tbody>
            </table>
                  </div>
                </div>
              </div>

        </section>
    </div>

 <!-- JS Libraies -->
  <script src="dashboard/datatables/datatables.min.js"></script>
  <script src="dashboard/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="dashboard/jquery-ui/jquery-ui.min.js"></script>

@endsection
