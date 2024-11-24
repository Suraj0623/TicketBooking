<x-layout title="Screenings">
    <h1>Screenings</h1>
    <a href="{{ route('screenings.create') }}">Add Screening</a>
    <ul>
        @foreach ($screenings as $screening)
            <li>
                <strong>{{ $screening->movie->title }}</strong> - {{ $screening->cinema }} - {{ $screening->show_time }}
                <a href="{{ route('screenings.edit', $screening) }}">Edit</a>
                <form action="{{ route('screenings.destroy', $screening) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
