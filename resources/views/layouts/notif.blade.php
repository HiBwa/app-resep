@if (Session::has('success'))
    <div class="pt-3">
        <div class="alert alert-success alert-simple alert-inline show-code-action">
            {{ Session::get('success') }}
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="pt-3">
        <div class="alert alert-danger alert-simple alert-inline show-code-action">
            {{ Session::get('error') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger alert-simple alert-inline show-code-action">
            <ul>
                @foreach ($errors->all() as $data)
                    <li>{{ $data }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
