@extends('admin.layout.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-body">

                <div class="card">
                  <div class="card-header">
                    <h4>Add Route
                    <span style="float:right"><a href="{{ route('admin.routes.index') }}" class="btn btn-primary">Back to list</a></span>
                    </h4>
                  </div>
                  <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('admin.routes.store') }}">{{ csrf_field()}}

                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <label>Select Country </label>
                                <select name="country_id"  id="country_id" class="form-control">
                                    <option selected disabled>Select</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                              <div class="form-group">
                                <label class="control-label">City Name</label>
                                <div class="controls">
                                  <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Flat Rate(NGN)</label>
                                <div class="controls">
                                  <input type="number" name="flat_rate" class="form-control" id="flat_rate" required>
                                </div>
                              </div>
                            </div>
                          <div class="col-md-12">
                            <input type="submit" value="Submit" class="btn btn-success">
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
