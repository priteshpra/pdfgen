@extends('layouts.admin')

@section('content')

<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.reportclientwise.index') }}">
                    <h3 class="page-title">REPORTS CLIENTS</h3>
                </a>
            </div>
            <div class="pull-right">
                @can('user_create')
                <!-- <a href="{{ route('admin.client.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5">Add New Clients</a> -->
                <!-- <a href="{{ route('admin.reportclientwise.create') }}" title="Create Client"
                    class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus"
                        aria-hidden="true"></i></a> -->
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

                            <table id="clientTable"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Client Name</th>
                                        <th>Firm Name</th>
                                        <th>MobileNo</th>
                                        <th>Email</th>
                                        <th>Firm Type</th>
                                        <th>Document Count</th>
                                        <th>
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <?php //$isCompanyCreate = App\Models\Company::where('ClientID', $user->id)->count(); 
                                    ?>
                                    <tr>
                                        <td>{{$user->FirstName}}</td>
                                        <td>{{$user->FirmName}}
                                        </td>
                                        <td>{{$user->MobileNo}}</td>
                                        <td>{{$user->Email}}</td>
                                        <td>{{$user->FirmType}}</td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-3">No Users Found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection