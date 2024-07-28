@extends('admin.Master')
@section('title')
    Pedido
@endsection
@section('content')
<style>
    .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: #fff;
    border-collapse: collapse;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #343a40;
    color: #fff;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: rgba(0, 0, 0, 0.03);
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.table-hover tbody tr:hover {
    background-color: #e9ecef;
}

.table-hover tbody tr:hover td {
    color: #0056b3;
}

.table-hover tbody tr:hover a {
    color: #0056b3;
    text-decoration: none;
}

</style>
    <div class="page-body">
<br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ session::get('success') }}</p>
                            </div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                <p>{{ session::get('fail') }}</p>
                            </div>
                        @endif
                        <div class="card-header">
                            <h5> Lista de solicitudes de pedidos</h5>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                      <table id="advance-1" class="table table-striped table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Número de pedido</th>
            <th>Monto</th>
            <th>Factura</th>
        </tr>
    </thead>
    <tbody>
        @php
            $previousOrderId = null; // To keep track of the previous order ID
        @endphp

        @foreach ($transaction as $transaction)
            @php
                $products = json_decode($transaction->product_details, true);
                $orderAmount = $transaction->amount;
                $user = \App\Models\User::find($transaction->user_id); // Fetch user information
            @endphp

            @if ($transaction->order_id !== $previousOrderId)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user ? $user->name : 'Usuario desconocido' }}</td>
                    <td>
                        <!-- Order ID button that triggers modal -->
                        <button type="button" class="btn btn-link order-modal-trigger" data-toggle="modal" data-target="#orderModal" data-order-id="{{ $transaction->order_id }}">{{ $transaction->order_id }}</button>
                    </td>
                    <td>{{ 'Total : BS' . number_format($orderAmount, 2) }}</td>
                    <td class="account__table--body__cell">
                        <a href="{{ route('SkugenerateInvoice', ['id' => $transaction->order_id]) }}" class="btn btn-primary">Descargar factura</a>
                    </td>
                </tr>
                @php
                    $previousOrderId = $transaction->order_id;
                @endphp
            @endif
        @endforeach
    </tbody>
</table>

<!-- Modal Structure -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Detalles del Pedido</h5>

            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>SKU</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Color</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody id="modalOrderDetailsBody">
                        <!-- Dynamic content will be loaded here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" id="invoiceDownloadLink" class="btn btn-primary">Descargar factura</a>

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var baseUrl = "https://bikebros.net"; // Set the base URL for your application

        $('.order-modal-trigger').on('click', function() {
            var orderId = $(this).data('order-id');
            var url = baseUrl + '/admin/getOrderDetails/' + orderId;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // Clear previous modal body content
                    $('#modalOrderDetailsBody').empty();
                    console.log(data);
                    // Append new rows with order details
                    $.each(data.products, function(index, product) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + product.title + '</td>' +
                            '<td>' + (product.sku ? product.sku : 'N/A') + '</td>' +
                            '<td>' + 'BS' + parseFloat(product.price).toFixed(2) + '</td>' +
                            '<td>' + product.quantity + '</td>' +
                            '<td>' + (product.color ? product.color : 'N/A') + '</td>' +
                            '<td><img src="' + product.image + '" width="70" height="50" /></td>' +
                            '</tr>';
                        $('#modalOrderDetailsBody').append(row);
                    });

                    // Update the invoice download link
                    $('#invoiceDownloadLink').attr('href', baseUrl + '/SkugenerateInvoice/' + orderId);

                    // Show the modal
                    $('#orderModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching order details:', error);
                }
            });
        });
    });
</script>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- DOM / jQuery  Ends-->


            </div>
        </div>


        <!-- Container-fluid Ends-->
        <!-- Container-fluid Ends-->
    </div>
@endsection
