@extends('layouts.admin')

@section('content')

<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.reportclientwise.index') }}">
                    <h3 class="page-title">REPORT CLIENTS MONTHLY ({{ $currentDate }} - {{$monthEndDate}})</h3>
                </a>
            </div>
            <div class="pull-right">

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
            url: "{{ route('admin.clienttoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
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