@extends('layouts.master')

@section('title')
Orders
@endsection

@section('content')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
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
                                                        aria-label="Invoice ID: activate to sort column ascending">Invoice
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
                                                
                                                @php
                                                $badge_color = 'primary';

                                                switch ($order->status) {
                                                    case 'pending':
                                                    $badge_color = 'warning';
                                                    break;

                                                    case 'paid':
                                                    $badge_color = 'info';
                                                    break;

                                                    case 'delivered':
                                                    $badge_color = 'success';
                                                    break;

                                                    case 'cancelled':
                                                    $badge_color = 'danger';
                                                    break;

                                                    default:
                                                    $badge_color = 'primary';
                                                    break;
                                                }
                                                @endphp
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $order->user->name }}</td>
                                                    <td>#{{ $order->invoice->invoice_id }}</td>
                                                    <td><img src="{{ $order->photo }}" alt="{{ $order->name }}"
                                                            width="80"></td>
                                                    <td>{{ $order->product }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('F jS, Y') }}</td>
                                                    <td><span class="badge badge-pill badge-{{ $badge_color }}">{{ $order->status }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            @else
                                            <tbody>
                                                <h3 class="text-center">You have no orders!</h3>
                                                <a href="{{ route('products.index') }}" class="btn btn-primary col-md-2 offset-5"> <i class="fa fa-shopping-cart"></i> Go to products</a>
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