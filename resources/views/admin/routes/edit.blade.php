@extends('admin.layout.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">

                <div class="card">
                  <div class="card-header">
                    <h4>Edit Vehicle
                    <span style="float:right"><a href="{{ route('admin.routes.index') }}" class="btn btn-primary">Back to list</a></span>
                    </h4>
                  </div>
                  <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('admin.routes.update', $routes) }}">{{csrf_field()}} @method('put')
                      <div class="row">
                          <div class="col-md-6">

                              <div class="form-group">
                                <label class="control-label">Country Name</label>
                                <div class="controls">
                                  <input type="text" name="name" class="form-control" id="name" value="{{ $routes->name }}" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Flat Rate(NGN)</label>
                                <div class="controls">
                                  <input type="number" name="flat_rate" class="form-control" id="flat_rate" value="{{ $routes->flat_rate }}" required>
                                </div>
                              </div>

                            </div>


                          <div class="col-md-12">
                            <input type="submit" value="Update" class="btn btn-success">
                          </div>
                         </form>
                      </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@endsection
