@foreach ($users as $user)
<tr>
    <td>{{ $user->FirmName }}</td>
    <td>{{ $user->FirstName }} {{ $user->LastName }}</td>
    <td>{{ date('d/m/Y h:i:s A', strtotime($user->created_at)) }}</td>
    <td>{{ $user->Title }}</td>
    <td>{{ $user->BatchNo }}</td>
    <td>{{ $user->total_image_count }}</td>
    <td>
        <div class="word-wrap">{{ $user->Remarks }}</div>
    </td>
    <td><a href="{{ route('download.file', ['user_id' => $user->UserID, 'filename' => $user->DocumentURL]) }}" class="
            waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i class="fa fa-file-pdf-o"
                aria-hidden="true"></i></a></td>
</tr>
@endforeach
