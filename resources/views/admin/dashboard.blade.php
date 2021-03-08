@extends('admin.layout.app')
@php($user = Auth::User())
@php($T = App\TransportMode::count())
@php($R = App\Route::count())

@section('content')
 <div class="container">
        <!-- main content area start -->
        <ul class="breadcrumb">
           <li class="moreinfo"><i class="fa fa-home moreinfo"></i>Home</li> /
           <li class="moreinfo"><i class="fa fa-dashboard moreinfo"></i>Dashboard</li>
        </ul>

            <div class="main-content-inner">

                    <div class="row">

                         <div class="col-md-4 card  btn-primary ">
                                <div class="card-body">
                                    <a href="{{ route('admin.transportMode.index') }}" type="button" class="btn btn-success">
                                         <i class="ti-truck bg-icon"></i>Transport Modes<span class="badge badge-light">{{ $T }}</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4 card  btn-success ">
                                <div class="card-body">
                                    <a href="{{ route('admin.routes.index') }}" type="button" class="btn btn-info">
                                         <i class="ti-layout-list-thumb-alt bg-icon"></i>  Routes <span class="badge badge-light">{{ $R }}</span>
                                    </a>
                                </div>
                            </div>

                     </div>
                </div>
            </div>
        <!-- main content area end -->


        <!-- Vertically centered modal start -->


@endsection
