@extends('layouts.master')

@section('title')
Coupons
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
                            Coupons</a>
                    </li>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Create A Coupon</h4>
                    </div>
                    <!-- /.box-header -->

                    @if(Session::has('success'))
                        <div class="badge badge-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif

                    <form action="{{ route('coupons.store') }}" method="post" class="form">
                        @csrf
                        <div class="box-body">
                            <hr class="my-15">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount %</label>
                                        <input type="number" name="discount" class="form-control" placeholder="Discount Percentage" value="{{ old('discount') }}">
                                    </div>
                                    
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Limit</label>
                                        <input type="number" name="limit" class="form-control" placeholder="Amount Of Times To Be Used" value="{{ old('limit') }}">
                                    </div>

                                    @if ($errors->has('limit'))
                                        <span class="text-danger">{{ $errors->first('limit') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-rounded btn-success">
                                <i class="ti-upload"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
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
                                                        Code</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Invoice ID: activate to sort column ascending">
                                                        Discount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Photo: activate to sort column ascending">Uses/Limit</th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending">Status
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="productorder"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending">Action
                                                    </th>
                                                </tr>
                                            </thead>

                                            @if (count($coupons) > 0)
                                            <tbody>
                                                @foreach ($coupons as $coupon)
                                                @php
                                                $badge_color = 'primary';

                                                switch ($coupon->status) {
                                                    case '1':
                                                    $badge_text = 'Active';
                                                    $badge_color = 'success';
                                                    break;

                                                    case '0':
                                                    $badge_text = 'Expired';
                                                    $badge_color = 'danger';
                                                    break;

                                                    default:
                                                    $badge_text = 'Active';
                                                    $badge_color = 'primary';
                                                    break;
                                                }
                                                @endphp
                                                
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $coupon->code }}</td>
                                                    <td>{{ $coupon->discount }}</td>
                                                    <td>{{ $coupon->uses }} / {{ $coupon->limit }}</td>
                                                    <td>
                                                        <span class="badge badge-pill badge-{{ $badge_color }}">{{ $badge_text }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" onclick="event.preventDefault(); deleteCoupon({{ $coupon->id }})"
                                                            class="btn btn-rounded btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                            @else
                                            <tbody>
                                                <h3 class="text-center">There are no Coupons!</h3>
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

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  function deleteCoupon(id) {
    var proceed = confirm("Are you sure you want to delete?");
    
    if (proceed) {
        $.ajax({
        url: '{{ route('coupons.destroy') }}',
        method: "post",
        data: {_token: '{{ csrf_token() }}', coupon_id: id},
        success: function (response) {
            window.alert(response);
            window.location.reload();
        }
        });
    }
  }
</script>
@endsection