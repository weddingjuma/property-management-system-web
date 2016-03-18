@extends('master')

@section('navigation')
    @include('nav.devices')
@stop

@section('content')
<div class="row">
    <h1 class="page-header">Device Details</h1>
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <b class="pull-left">Last Updated: {{ $device->getUpdatedAt() }}</b>
        <a class="btn btn-primary pull-right" href="{{ URL::route('devices.edit', $device->id) }}">Edit</a>
      </div>
      <div class="panel-body">
        <form class="form-horizontal">
          <div class="form-group">
              <label class="col-lg-4 control-label">Model</label>
              <div class="col-lg-6">
                <input type="text" name="model" class="form-control" value="{{ $device->model }}" readonly="readonly">
              </div>
          </div>

          <div class="form-group">
              <label class="col-lg-4 control-label">manufacturer</label>
              <div class="col-lg-6">
                <input type="text" name="manufacturer" class="form-control" value="{{ $device->manufacturer }}" readonly="readonly">
              </div>
          </div>

          <div class="form-group">
              <label class="col-lg-4 control-label">Product</label>
              <div class="col-lg-6">
                <input type="text" name="product" class="form-control" value="{{ $device->product }}" readonly="readonly">
              </div>
          </div>

          <div class="form-group">
              <label class="col-lg-4 control-label">SDK Version</label>
              <div class="col-lg-6">
                <input type="text" name="sdk_version" class="form-control" value="{{ $device->sdk_version }}" readonly="readonly">
              </div>
          </div>

          <div class="form-group">
              <label class="col-lg-4 control-label">Serial Number</label>
              <div class="col-lg-6">
                <input type="text" name="serial_number" class="form-control" value="{{ $device->serial_number }}" readonly="readonly">
              </div>
          </div>
      </div>
    </form>
  </div>
</div>

<div class="row">
    <!-- Second table for displaying all notifications connected to current device -->
      <h2 class=" ">Connected Notifications</h2>
      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading clearfix">
                <b>NOTIFICATION LIST</b>
                <div class="btn-group pull-right ">
                    <button class="btn btn-primary" data-target="#addDeviceModal"  data-toggle="modal">Add Notififcation</button>
                </div>
               </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="devices-table" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th width="50%">Type</th>
                                <th width="15%">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($device->notifications as $notification)
                            <tr class="clickable-row"  href="{{ URL::route('notifications.show', [$notification->id]) }}" onmouseover="this.style.cursor='pointer'">
                                <td>{{ $notification->title }}</td>
                                <td>{{ $notification->type }}</td>
                                <td>
                                    <form method="POST" action="/devices/{{ $device->id }}/removeNotification">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="notification_id" value="{{ $notification->id }}"></input>
                                        <a class="btn btn-primary" href="{{ URL::route('notifications.edit', [$notification->id] ) }}">Edit</a>
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>
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
</div>

<!-- Modal -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Notification</h4>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/devices/{{ $device->id }}/addNotification" method="POST">
            {!! csrf_field() !!}
            <select class="form-control" name="notification_id">
            @foreach ($notifications as $notifcation)
                <option value="{{ $notifcation->id }}">{{ $notifcation->title }}</option>
            @endforeach
            </select>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
       </form>
      </div>
    </div>
  </div>
</div>
@stop

 @section('css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
 @stop

 @section('scripts')
 <script type="text/javascript" src="/lib/datatables.min.js"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         // Add links to each devices details page.
         $('.clickable-row').click(function() {
           window.document.location = $(this).attr("href");
         });

         $('#devices-table').DataTable( {
             "scrollX":true
         });
     } );
 </script>
 @stop