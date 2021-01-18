@extends('layouts.master')

@section('title')
Invoices
@endsection

@section('content')
<div class="container-full">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xl-10 col-lg-9 col-12">
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Invoices List</h4>
            <h6 class="box-subtitle">Export Invoices List to Copy, CSV, Excel, PDF &amp; Print</h6>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                {{-- <div class="dt-buttons btn-group"><button class="btn btn-secondary buttons-copy buttons-html5"
                    tabindex="0" aria-controls="example"><span>Copy</span></button> <button
                    class="btn btn-secondary buttons-csv buttons-html5" tabindex="0"
                    aria-controls="example"><span>CSV</span></button> <button
                    class="btn btn-secondary buttons-excel buttons-html5" tabindex="0"
                    aria-controls="example"><span>Excel</span></button> <button
                    class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0"
                    aria-controls="example"><span>PDF</span></button> <button class="btn btn-secondary buttons-print"
                    tabindex="0" aria-controls="example"><span>Print</span></button> </div> --}}
                <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search"
                      class="form-control form-control-sm" placeholder="" aria-controls="example"></label></div>
                <table id="example" class="table table-lg invoice-archive dataTable no-footer" role="grid"
                  aria-describedby="example_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 28px;">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Issued to: activate to sort column ascending" style="width: 133px;">
                        Issued to
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Status: activate to sort column ascending" style="width: 62px;">
                        Status
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Issue date: activate to sort column ascending" style="width: 55px;">
                        Issue date
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Due date: activate to sort column ascending" style="width: 55px;">
                        Due date
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Amount: activate to sort column ascending" style="width: 40px;">
                        Amount
                      </th>
                      <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                        aria-label="Actions: activate to sort column ascending" style="width: 20px;">
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($invoices as $invoice)
                    <tr role="row" class="odd">
                      <td class="sorting_1">#BCP-2020-{{ $invoice->id }}</td>
                      <td>
                        <h6 class="mb-0">
                          <a href="#">{{ $invoice->user->name }}</a>
                          <span class="d-block text-muted">Payment method: E-Transfer</span>
                        </h6>
                      </td>
                      <td>
                        <select name="status" id="status" class="form-control" data-placeholder="Select status">
                          <option @if($invoice->status == 'pending') selected @endif value="pending">Pending</option>
                          <option @if($invoice->status == 'paid') selected @endif value="paid">Paid</option>
                          <option @if($invoice->status == 'delivered') selected @endif value="delivered">Delivered
                          </option>
                          <option @if($invoice->status == 'cancelled') selected @endif value="cancelled">Canceled
                          </option>
                        </select>
                      </td>
                      <td>
                        {{ Carbon\Carbon::parse($invoice->due_date)->format('F jS, Y') }}
                      </td>
                      <td>
                        @php
                        $badge_color = 'primary';

                        switch ($invoice->status) {
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
                        <span class="badge badge-pill badge-{{ $badge_color }}">{{ $invoice->status }}</span>
                      </td>
                      <td>
                        <h6 class="mb-0 font-weight-bold">${{ $invoice->total }}</h6>
                      </td>
                      <td class="text-center">
                        <div class="list-icons d-inline-flex">
                          {{-- <a href="#" class="list-icons-item mr-10"><i class="fa fa-eye-slash"></i></a> --}}
                          <div class="list-icons-item dropdown">
                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i
                                class="fa fa-file-text"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a href="{{ route('admin.invoiceOrders', ['id' => $invoice->id]) }}"
                                class="dropdown-item"><i class="fa fa-eye"></i> View Orders</a>
                              <div class="dropdown-divider"></div>
                              <a href="#" onclick="event.preventDefault(); updateInvoice({{ $invoice->id }})"
                                class="dropdown-item"><i class="fa fa-save"></i> Save</a>
                              {{-- <a href="#" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a> --}}
                              <a href="#" class="dropdown-item"><i class="fa fa-remove"></i> Remove</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-lg-3 col-12">
        <div class="box box-inverse box-primary">
          <div class="box-body">
            <div class="text-center my-2">
              <div class="font-size-60">{{ number_format($data['total_invoice']) }}</div>
              <span>Total Invoice</span>
            </div>
          </div>
        </div>

        <div class="box box-inverse box-info">
          <div class="box-body">
            <div class="text-center my-2">
              <div class="font-size-60">{{ number_format($data['paid_invoice']) }}</div>
              <span>Paid Invoice</span>
            </div>
          </div>
        </div>

        <div class="box box-inverse box-warning">
          <div class="box-body">
            <div class="text-center my-2">
              <div class="font-size-60">{{ number_format($data['pending_invoice']) }}</div>
              <span>Pending Invoice</span>
            </div>
          </div>
        </div>

        <div class="box box-inverse box-success">
          <div class="box-body">
            <div class="text-center my-2">
              <div class="font-size-60">{{ number_format($data['delivered_invoice']) }}</div>
              <span>Delivered Invoice</span>
            </div>
          </div>
        </div>

        <div class="box box-inverse box-danger">
          <div class="box-body">
            <div class="text-center my-2">
              <div class="font-size-60">{{ number_format($data['cancelled_invoice']) }}</div>
              <span>Cancelled Invoice</span>
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
  function updateInvoice(id) {
    var proceed = confirm("Are you sure you want to proceed?");
    
    if (proceed) {
      var status = $("#status").val();

    if (!status && status == null) {
      alert('Invalid');
      return;
    }

    $.ajax({
      url: '{{ route('admin.update_invoice') }}',
      method: "post",
      data: {_token: '{{ csrf_token() }}', invoice_id: id, invoice_status: status },
      success: function (response) {
        window.alert(response);
        window.location.reload();
      }
    });
    }
  }
</script>
@endsection