@foreach ($users as $user)
<tr>
    <td>{{ $user->FirmName }}</td>
    <td>{{ $user->FirstName }} {{ $user->LastName }}</td>
    <td>{{ date('d/m/Y h:i:s', strtotime($user->created_at)) }}</td>
    <td>{{ $user->Title }}</td>
    <td>{{ $user->BatchNo }}</td>
    <td>{{ $user->total_image_count }}</td>
    <td>{{ $user->Remarks }}</td>
</tr>
@endforeach