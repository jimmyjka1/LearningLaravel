<tr>
    <td>{{ $user -> id  }}</td>
    <td><a href="{{ route('user.show', ['user' => $user -> id]) }}">{{ $user -> first_name }} {{ $user -> last_name }}</a></td>
    <td>{{ $user -> email }}</td>
    <td>
        <a href="{{ route('user.edit', ['user' => $user -> id]) }}" class="btn btn-warning">Edit</a>



        <form class="d-inline-block" action="{{ route("user.destroy", ['user' => $user -> id ]) }}" onsubmit="return confirm('Do You really want to delete this User ?')" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>