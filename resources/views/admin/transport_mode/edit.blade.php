@extends('admin.layout.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">

                <div class="card">
                  <div class="card-header">
                    <h4>Edit Vehicle
                    <span style="float:right"><a href="{{ route('admin.transportMode.index') }}" class="btn btn-primary">Back to list</a></span>
                    </h4>
                  </div>
                  <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('admin.transportMode.update', $modes) }}">{{csrf_field()}} @method('put')
                      <div class="row">
                          <div class="col-md-6">

                              <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="controls">
                                  <input type="text" name="name" class="form-control" id="name" value="{{ $modes->name }}" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Base Fare(NGN)</label>
                                <div class="controls">
                                  <input type="number" name="base_fare" class="form-control" id="base_fare" value="{{ $modes->base_fare }}" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Price per Kg</label>
                                <div class="controls">
                                  <input type="number" name="price_per_kg" class="form-control" id="price_per_kg" value="{{ $modes->price_per_kg }}" required>
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
