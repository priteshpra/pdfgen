@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div id="loader"></div>
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Roles</h3>
                    </div>
                    <div class="pull-right">
                        @can('role_create')
                        <!-- <a href="{{ route('admin.roles.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5">Add New Role</a> -->
                        <a href="{{ route('admin.roles.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus" aria-hidden="true"></i></a>
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

                                    <table id="examples" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                        <thead class="bg-primary">
                                            <tr class="">
                                                <th class="text-center">ID</th>
                                                <th>Title</th>
                                                <th>Short Code</th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $role)
                                            <tr>
                                                <td class="text-center">{{$role->id}}</td>
                                                <td>{{$role->title}}</td>
                                                <td>{{$role->short_code ?? '--'}}</td>
                                                <td>
                                                    <!-- @can('role_show')
                                                    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-success">View</a>
                                                    @endcan -->
                                                    @can('role_edit')
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    @endcan
                                                    <!-- @can('role_delete')
                                                <form action="{{ route('admin.roles.destroy', $role->id) }}" class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                @endcan -->
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="100%" class="text-center text-muted py-3">No Roles Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <!-- @if($roles->total() > $roles->perPage())
                                <br><br>
                                {{$roles->links()}}
                                @endif -->
                                </div>
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