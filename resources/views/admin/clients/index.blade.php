@extends('layouts.admin')

@section('content')

<div class="wrapper">
    <div id="loader"></div>
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Clients</h3>
                    </div>
                    <div class="pull-right">
                        @can('user_create')
                        <!-- <a href="{{ route('admin.client.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5">Add New Clients</a> -->
                        <a href="{{ route('admin.client.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        @endcan
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">

                                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                        <thead class="bg-primary">
                                            <tr class="">
                                                <th>Client Name</th>
                                                <th>Firm Name</th>
                                                <th>MobileNo</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Aadhar Number</th>
                                                <th>GST Number</th>
                                                <th>PAN Number</th>
                                                <th>Firm Type</th>
                                                <th>Status</th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->firm_name}}</td>
                                                <td>{{$user->mobile_no}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->address}}</td>
                                                <td>{{$user->aadhar}}</td>
                                                <td>{{$user->gst}}</td>
                                                <td>{{$user->pan}}</td>
                                                <td>{{$user->firm_type}}</td>
                                                <td>
                                                    <div class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-success {{($user->Status == 1) ? 'active' : ''}}" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                                                            <div class="handle"></div>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- @can('user_show')
                                                    <a href="{{ route('admin.client.show', $user->id) }}" class="btn btn-sm btn-success">Show</a>
                                                    @endcan -->
                                                    @can('user_edit')
                                                    <a href="{{ route('admin.client.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    @endcan
                                                    <!-- @can('user_delete')
                                                <form action="{{ route('admin.client.destroy', $user->id) }}" class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                @endcan -->
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="100%" class="text-center text-muted py-3">No Users Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- @if($users->total() > $users->perPage())
                            <br><br>
                            {{$users->links()}}
                            @endif -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @section('scripts')
    <script src="{{ asset('admin_assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js_new/pages/data-table.js') }}"></script>
    @endsection