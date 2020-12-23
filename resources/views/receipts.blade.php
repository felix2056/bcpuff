@extends('layouts.master')

@section('title')
Receipts
@endsection

@section('content')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-10 col-lg-9 col-12">
            <div class="box">
                <div class="box-header with-border">						
                    <h4 class="box-title">Receipts List</h4>
                    <h6 class="box-subtitle">Export Receipt List to Copy, CSV, Excel, PDF &amp; Print</h6>
                </div>
                <div class="box-body">						
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="dt-buttons btn-group">          <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example"><span>Print</span></button> </div><div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label></div>
                            <table id="example" class="table table-lg invoice-archive dataTable no-footer" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 28px;">
                                            #
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Period: activate to sort column ascending" style="width: 50px;">
                                            Period
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Issued to: activate to sort column ascending" style="width: 70px;">
                                            Issued to
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 62px;">
                                            Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Issue date: activate to sort column ascending" style="width: 55px;">
                                            Issue date
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Due date: activate to sort column ascending" style="width: 113px;">
                                            Due date
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 53px;">
                                            Amount
                                        </th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 50px;">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">#0013</td>
                                        <td>November 2017</td>
                                        <td>
                                            <h6 class="mb-0">
                                                <a href="#">Liam</a>
                                                    <span class="d-block text-muted">Payment method: Wire transfer</span>
                                                </h6>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control" data-placeholder="Select status">
                                                    <option value="overdue">Overdue</option>
                                                    <option value="hold">On hold</option>
                                                    <option value="pending" selected="">Pending</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="invalid">Invalid</option>
                                                    <option value="cancel">Canceled</option>
                                                </select>
                                            </td>
                                            <td>
                                                February 25, 2018
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-success">Paid on Feb 15, 2018</span>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 font-weight-bold">$985 <span class="d-block text-muted font-weight-normal">VAT $124</span></h6>
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons d-inline-flex">
                                                    <a href="#" class="list-icons-item mr-10"><i class="fa fa-eye-slash"></i></a>
                                                    <div class="list-icons-item dropdown">
                                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#" class="dropdown-item"><i class="fa fa-download"></i> Download</a>
                                                            <a href="#" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="#" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                                            <a href="#" class="dropdown-item"><i class="fa fa-remove"></i> Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-12">
            <div class="box box-inverse box-success">
              <div class="box-body">
                <div class="flexbox">
                  <h5>Invoice</h5>
                  <div class="dropdown">
                    <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ion-android-more-vertical rotate-90"></i></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                    </div>
                  </div>
                </div>

                <div class="text-center my-2">
                  <div class="font-size-60">2,064</div>
                  <span>Total Invoice</span>
                </div>
              </div>
            </div>
            <div class="box box-inverse box-primary">
              <div class="box-body">
                <div class="flexbox">
                  <h5>Re Generate Invoice</h5>
                  <div class="dropdown">
                    <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ion-android-more-vertical rotate-90"></i></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                    </div>
                  </div>
                </div>

                <div class="text-center my-2">
                  <div class="font-size-60">1,738</div>
                  <span>Re Generate Invoice</span>
                </div>
              </div>				
            </div>
            <div class="box box-inverse box-danger">
              <div class="box-body">
                <div class="flexbox">
                  <h5>Overdue Payment Invoice</h5>
                  <div class="dropdown">
                    <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ion-android-more-vertical rotate-90"></i></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                    </div>
                  </div>
                </div>

                <div class="text-center my-2">
                  <div class="font-size-60">1100</div>
                  <span>Overdue Payment Invoice</span>
                </div>
              </div>

            </div>
            <div class="box box-inverse box-warning">
              <div class="box-body">
                <div class="flexbox">
                  <h5>Pending Invoice</h5>
                  <div class="dropdown">
                    <span class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="ion-android-more-vertical rotate-90"></i></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#"><i class="ion-android-list"></i> Details</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-add"></i> Add new</a>
                      <a class="dropdown-item" href="#"><i class="ion-android-refresh"></i> Refresh</a>
                    </div>
                  </div>
                </div>

                <div class="text-center my-2">
                  <div class="font-size-60">964</div>
                  <span>Pending</span>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection