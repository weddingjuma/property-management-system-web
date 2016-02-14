@extends('master')

@section('navigation')
<li class="active"><a href="{{ URL::to( 'properties') }}">Properties</span></a></li>
<li><a href="{{ URL::to( 'devices' ) }}">Devices<span class="sr-only">(current)</a></li>
<li><a href="{{ URL::to( 'contractors' ) }}">Contractors</a></li>
<li><a href="{{ URL::to( 'notifications' ) }}">Notifications</a></li>
@stop

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Dashboard</h1>
  <h2 class="sub-header">Table Section</h2>
  <div class="table-responsive">
    <table id="devices-table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Model</th>
                <th>Manufactorer</th>
                <th>Product</th>
                <th>SDK Version</th>
                <th>Serial Number</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($devices as $device)
            <tr>
                <td>{{ $device->model }}</td>
                <td>{{ $device->manufactorer }}</td>
                <td>{{ $device->product }}</td>
                <td>{{ $device->sdk_version }}</td>
                <td>{{ $device->serial_number }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@stop


@section('scripts')
<script type="text/javascript" src="lib/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#devices-table').DataTable( {
            createdRow: function ( row ) {
                $('td', row).attr('tabindex', 0);
            }
        } );
    } );
</script>
@stop