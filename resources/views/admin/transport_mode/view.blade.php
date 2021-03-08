@extends('admin.layout.app')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">

                <div class="card">
                  <div class="card-header">
                    <h4>Mode Of Transport
                      <span style="float:right"><a href="{{ route('admin.transportMode.create')}}" class="btn btn-primary">New mode</a></span>
                    </h4>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                <tr>
                  <th> ID</th>
                  <th>Name</th>
                  <th>Base Fare</th>
                  <th>Price per KG </th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($modes as $mode)
                <tr class="gradeX">
                  <td>{{ $mode->id }}</td>
                  <td>{{ $mode->name }}</td>
                  <td>{{ $mode->base_fare }}</td>
                  <td>{{ $mode->price_per_kg }}</td>

                  <td class="center"><a href="#myModal{{ $mode->id }}" data-toggle="modal" class="btn btn-success btn-sm"><i class="ti-eye"></i></a>

                    <form action="{{ route('admin.transportMode.destroy' , $mode)}}" method="post">@csrf @method('delete')
                        <a href="{{ route('admin.transportMode.edit' , $mode)}}" class="btn btn-primary btn-sm"><i class="ti-pencil"></i></a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ti-trash"></i></button>
                    </form>
                    </td>
                    <div>
                 </tr>

                 <div class="modal fade bd-example-modal-md" id="myModal{{ $mode->id }}">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $mode->mode_name }}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <p>Transport Mode ID: {{ $mode->id }}</p>
                        <p>Name: {{ $mode->name }}</p>
                        <p>Base Fare: {{ $mode->base_fare }}</p>
                        <p>Price Per KG: {{ $mode->price_per_kg }}</p>
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
