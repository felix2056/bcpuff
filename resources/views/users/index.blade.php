@extends('layouts.master')

@section('title')
Users
@endsection

@section('content')
<div class="container-full">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="d-flex align-items-center">
      <div class="mr-auto">
        <h3 class="page-title">User list</h3>
        <div class="d-inline-block align-items-center">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
              <li class="breadcrumb-item" aria-current="page">Contact</li>
              <li class="breadcrumb-item active" aria-current="page">User list</li>
            </ol>
          </nav>
        </div>
      </div>

    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    @if (count($users) > 0)
    <div class="row">
      <div class="col-lg-9 col-md-8">
        <div class="box">
          <div class="media-list media-list-divided media-list-hover">
            @foreach ($users as $user)
            <div class="media align-items-center">
              <span class="badge badge-dot badge-danger"></span>
              <a class="avatar avatar-lg status-success" href="#">
                <img src="{{ $user->photo_url }}" alt="...">
              </a>

              <div class="media-body">
                <p>
                  <a href="#"><strong>{{ $user->name }}</strong></a>
                  <small class="sidetitle">Online</small>
                </p>

                <p>Designer</p>

                <nav class="nav mt-2">
                  <a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
                  <a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
                  <a class="nav-link" href="#"><i class="fa fa-github"></i></a>
                  <a class="nav-link" href="#"><i class="fa fa-linkedin"></i></a>
                </nav>
              </div>

              <div class="media-right gap-items">
                <a class="media-action lead" href="#" data-toggle="tooltip" title="" data-original-title="Orders"><i
                    class="ti-shopping-cart"></i></a>
                <a class="media-action lead" href="#" data-toggle="tooltip" title="" data-original-title="Receipts"><i
                    class="ti-receipt"></i></a>

                <div class="btn-group">
                  <a class="media-action lead" href="#" data-toggle="dropdown"><i
                      class="ion-android-more-vertical"></i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-comments"></i> Messages</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-phone"></i> Call</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-remove"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-4">
        <div class="box no-shadow">
          <div class="box-body">
            <a class="btn btn-outline btn-success mb-5 d-flex justify-content-between" href="javascript:void(0)">Online
              <span class="pull-right">103</span></a>
            <a class="btn btn-outline btn-danger mb-5 d-flex justify-content-between" href="javascript:void(0)">Offline
              <span class="pull-right">19</span></a>
            <a class="btn btn-outline btn-info mb-5 d-flex justify-content-between" href="javascript:void(0)">Available
              <span class="pull-right">623</span></a>
            <a class="btn btn-outline btn-primary mb-5 d-flex justify-content-between" href="javascript:void(0)">Private
              <span class="pull-right">53</span></a>
            <a class="btn btn-warning mt-10 d-flex justify-content-between" href="javascript:void(0)">All Contacts <span
                class="pull-right">123</span></a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"
              class="btn btn-success mt-10 d-block text-center">+ Add New Contact</a>
          </div>
        </div>
      </div>
    </div>
    @endif
  </section>
  <!-- /.content -->
</div>
@endsection