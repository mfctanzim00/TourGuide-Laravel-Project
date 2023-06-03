@extends('layouts.backend.app')

@push('header')
<link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endpush

@section('content')

    <div id="right-panel" class="right-panel"style="font-family: 'Gill Sans', sans-serif; color:black;">
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div cl style="font-family: 'Gill Sans', sans-serif; color:black;"ass="page-title">
                        <h1>Notifications</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">Dashboard</a></li>
                            <li>
                                <a href="#" class="active"style="font-family: 'Gill Sans', sans-serif; color:black;">Notifications</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                <span class="badge badge-pill badge-danger">Error</span> {{$error}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Notifications Table</strong>
                              
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered"style="font-family: 'Gill Sans', sans-serif; color:black;">
                                <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Post</th>
                                            <th>Comment</th>
                                            <th>Commentator</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notifications as $key => $notification)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <!-- <td>{{ $notification->post_id }}</td> -->
                                            <td> <a href="{{ route('post', $notification->post->slug) }}"> {{ $notification->post->title }} </a> </td>
                                            <td>{{ $notification->message }}</td>
                                            <td>{{ $notification->repliedUser }}</td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#deleteModal-{{$notification->id}}">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->

            <div class="animated">

                @foreach($notifications as $notification)

                <div class="modal fade" id="deleteModal-{{$notification->id}}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticModalLabel"style="font-family: 'Gill Sans', sans-serif; color:black;">Delete Notification</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="font-family: 'Gill Sans', sans-serif; color:black;">
                                    The Notification will be deleted !!
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"style="font-family: 'Gill Sans', sans-serif; color:black;">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('deletenotification-{{ $notification->id }}').submit();"style="font-family: 'Gill Sans', sans-serif; color:black;">Confirm</button>
                                <form action="{{ route('comment-notification.destroy', $notification->id) }}" style="display: none" id="deletenotification-{{ $notification->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach



            </div>

        </div><!-- .content -->


    </div><!-- /#right-panel -->


@endsection

@push('footer')
<script src="{{ asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>

<script>
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
@endpush