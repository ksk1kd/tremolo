@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="my-2 text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
