@extends('layouts.admin')

@section('content')

<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.reportclientwiseother.index') }}">
                    <h3 class="page-title">OTHER DOCUMENTS REPORTS FOR CLIENTS WISE</h3>
                </a>
            </div>
            <div class="pull-right">
                @can('user_create')
                @endcan
            </div>

        </div>

    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group d-flex align-items-center">
                            <label for="client" class="me-3">Select Client</label>
                            <select id="client" class="form-control w-auto">
                                <option value="0,0" {{ 0==0 ? 'selected' : '' }}>ALL</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->CompanyID }},{{ $client->id }}" {{ $client->CompanyID
                                    == $selectedClientId ?
                                    'selected' : ''
                                    }}>
                                    {{ $client->FirmName }} - {{ $client->FirstName }}
                                </option>
                                @endforeach
                            </select>

                            <label for="from_date" class="me-3 ms-4">From Date</label>
                            <input type="date" id="from_date" class="form-control w-auto" value="{{ date('Y-m-d') }}">

                            <label for="to_date" class="ms-4 me-3">To Date</label>
                            <input type="date" id="to_date" class="form-control w-auto" value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="table-responsive">

                            <table id="clientTableReport"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Client Name</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded Date Time</th>
                                        <th>Title</th>
                                        <th>Batch No</th>
                                        <th>Image Count</th>
                                        <th>
                                            Remarks
                                        </th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody id="clientTableBody">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        const today = new Date();

        // Format current date as YYYY-MM-DD
        const endDate = today.toISOString().split('T')[0];

        // Get the first day of the current month
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 2)
            .toISOString()
            .split('T')[0];

        // Set default values for the input fields
        document.getElementById('from_date').value = endDate;
        document.getElementById('to_date').value = endDate;

        // Initialize the date pickers
        const startDatePicker = flatpickr('#from_date', {
            dateFormat: 'Y-m-d',
            onChange: function(selectedDates, dateStr, instance) {
                const startDate = selectedDates[0]; // The selected start date
                const endDatePicker = flatpickr('#to_date'); // Get the end date picker instance

                // Set the minDate of the end date picker to the selected start date
                endDatePicker.set('minDate', startDate);
            }
        });

        // Initialize the end date picker
        const endDatePicker = flatpickr('#to_date', {
            dateFormat: 'Y-m-d',
            minDate: "today", // Initially disable all past dates
        });
    });
    $(document).ready(function() {
        // Function to load users with the selected client and date range
        function loadUsers() {
            $("#loader").show();
            $('#loader').css('opacity', 1);
            let clientValue = $('#client').val();
            let values = clientValue.split(',');
            let clientId = values[0]; // "10"
            let clientUser = values[1]; // "20"
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();

            $.ajax({
                url: "{{ route('admin.reportclientwiseother.filter') }}",
                method: "GET",
                data: {
                    CompanyID: clientId,
                    client_user_id: clientUser,
                    from_date: fromDate,
                    to_date: toDate
                },
                success: function(response) {
                    $("#loader").hide();
                    $('#loader').css('opacity', 0);
                    $('#clientTableBody').html(response);
                },
                error: function(xhr, status, error) {
                    $("#loader").hide(); // Hide loader on error
                    $('#loader').css('opacity', 0);
                }
            });
        }

        // Load users initially with default values
        loadUsers();

        // Event listeners for the client dropdown and date range fields
        $('#client, #from_date, #to_date').change(function() {
            loadUsers();
        });
    });
</script>
@endsection
