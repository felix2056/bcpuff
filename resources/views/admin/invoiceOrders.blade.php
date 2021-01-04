@extends('layouts.master')

@section('title')
Invoice #BCP-2020-{{ $invoice->id }} - Orders
@endsection

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <div class="d-inline-block align-items-center">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.invoices') }}" class="btn btn-primary"> <i class="fa fa-book"></i>
                            Invoices</a>
                    </li>

                    <li class="breadcrumb-item">
                        #BCP-2020-{{ $invoice->id }}
                    </li>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h4 class="box-title">Billing Details</h4>
                    </div>
                    <div class="box-body">
                      <table class="table table-bordered table-striped">
                          <tbody>
                            <tr>
                              <th class="text-nowrap" scope="row">First Name</th>
                              <td>{{ $invoice->first_name }}</td>
                            </tr>

                            <tr>
                              <th class="text-nowrap" scope="row">Last Name</th>
                              <td>{{ $invoice->last_name }}</td>
                            </tr>

                            <tr>
                              <th class="text-nowrap" scope="row">City</th>
                              <td colspan="5">{{ $invoice->city }}</td>
                            </tr>

                            <tr>
                              <th class="text-nowrap" scope="row">Province</th>
                              <td colspan="5">{{ $invoice->province }}</td>
                            </tr>

                            <tr>
                              <th class="text-nowrap" scope="row">Address</th>
                              <td colspan="5">{{ $invoice->address }}</td>
                            </tr>

                            <tr>
                              <th class="text-nowrap" scope="row">Postal Code</th>
                              <td colspan="5">{{ $invoice->postal_code }}</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>


            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="productorder_wrapper"
                                class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="productorder"
                                            class="table table-hover no-wrap product-order dataTable no-footer"
                                            data-page-size="10" role="grid" aria-describedby="productorder_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Customer: activate to sort column descending">
                                                        Customer</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Order ID: activate to sort column ascending">Order
                                                        ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Photo: activate to sort column ascending">Photo</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Product: activate to sort column ascending">Product
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Quantity: activate to sort column ascending">
                                                        Quantity</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Date: activate to sort column ascending">Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending">Status
                                                    </th>
                                                </tr>
                                            </thead>

                                            @if (count($orders) > 0)
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $order->user->name }}</td>
                                                    <td>#SKU-224422-{{ $order->id }}</td>
                                                    <td><img src="{{ $order->photo }}" alt="{{ $order->name }}"
                                                            width="80"></td>
                                                    <td>{{ $order->product }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('F jS, Y') }}
                                                    </td>
                                                    <td><span
                                                            class="badge badge-pill badge-success">{{ $order->status }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            @else
                                            <tbody>
                                                <h3 class="text-center">No Orders For This Invoice!</h3>
                                                <a href="{{ route('products.index') }}"
                                                    class="btn btn-primary col-md-2 offset-5"> <i
                                                        class="fa fa-shopping-cart"></i> Go to products</a>
                                            </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection