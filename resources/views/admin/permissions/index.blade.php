@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div id="loader"></div>
    <div class="content-wrapper">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h3 class="page-title">Permissions</h3>
                    </div>
                    <div class="pull-right">
                        @can('permission_create')
                        <!-- <a href="{{ route('admin.permissions.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5">Add New Permission</a> -->
                        <a href="{{ route('admin.permissions.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                                                <th class="text-center">ID</th>
                                                <th>Name</th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($permissions as $permission)
                                            <tr>
                                                <td class="text-center">{{$permission->id}}</td>
                                                <td>{{$permission->name}}</td>
                                                <td>
                                                    @can('permission_edit')
                                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    @endcan
                                                    @can('permission_delete')
                                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" class="d-inline-block" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="100%" class="text-center text-muted py-3">No Permissions Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <!-- @if($permissions->total() > $permissions->perPage())
                                <br><br>
                                {{$permissions->links()}}
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