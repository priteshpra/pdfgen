@extends('layouts.admin')

@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.cms.index') }}">
                    <h3 class="page-title">CONTENT MANAGEMENT SYSTEM</h3>
                </a>
            </div>
            <div class="pull-right">

                @can('state_create')
                <!-- <a href="{{ route('admin.cms.create') }}" class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5">Add New CMS</a> -->
                <a href="{{ route('admin.cms.create') }}"
                    class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus"
                        aria-hidden="true"></i></a>
                @endcan
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div id="alert-container"></div>
                        @if(Session::has('status-success'))
                        <div class="alert alert-success">
                            {{Session::get('status-success')}}
                        </div>
                        @endif

                        @if(Session::has('status-info'))
                        <div class="alert alert-info">
                            {{Session::get('status-info')}}
                        </div>
                        @endif

                        @if(Session::has('status-warning'))
                        <div class="alert alert-warning">
                            {{Session::get('status-warning')}}
                        </div>
                        @endif

                        @if(Session::has('status-danger'))
                        <div class="alert alert-danger">
                            {{Session::get('status-danger')}}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="cmsTable"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <!-- <th class="text-center">ID</th> -->
                                        <th>Cms Name</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <!-- <td class="text-center">{{$user->CMSID}}</td> -->
                                        <td>{{$pages[$user->PageID][0]['PageName']}}</td>
                                        <td>
                                            <div class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                <button id="toggleChang_{{$user->CMSID}}"
                                                    onclick="toggleStatus({{$user->CMSID}},{{ ($user->Status == 1) ? '0' : '1' }})"
                                                    type="button"
                                                    class="btn btn-sm btn-toggle toggleChang {{($user->Status == 1) ? 'btn-success active' : 'btn-error'}}"
                                                    data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- @can('user_show')
                                                    <a href="{{ route('admin.cms.show', $user->CMSID) }}" class="btn btn-sm btn-success">Show</a>
                                                    @endcan -->
                                            @can('user_edit')
                                            <a href="{{ route('admin.cms.edit', $user->CMSID) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            @endcan
                                            <!-- @can('user_delete')
                                                <form action="{{ route('admin.cms.destroy', $user->CMSID) }}" class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                @endcan -->
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-3">No Cms Found</td>
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
<script>
    function toggleStatus(ID, status) {
        if (status == 1) {
            statuss = 0;
            console.log('off');
            $('#toggleChang_' + ID).addClass('btn-success');
            $('#toggleChang_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleChang_' + ID).removeClass('btn-success');
            $('#toggleChang_' + ID).addClass('btn-error');
        }
        $("#toggleChang_" + ID).attr("onclick", "toggleStatus(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.cmstoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                CMSID: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-container').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${xhr.responseJSON.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            }
        });
    }
</script>
@endsection