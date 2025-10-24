<footer class="footer bg-dark text-light d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="{{ route('index') }}" class="link-secondary">Home</a></li>
                    <li class="list-inline-item"><a href="{{ route('training.index') }}"
                            class="link-secondary">Training</a></li>
                    <li class="list-inline-item"><a href="{{ route('help') }}" class="link-secondary">Help</a></li>
                    @if (Auth::check() && Auth::user()->hasAnyRole(['Admin', 'Super Admin']))
                        <li class="list-inline-item"><a href="{{ route('admin.index') }}"
                                class="link-secondary">Admin</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; {{ date('Y') }}
                        <a href="{{ route('index') }}" class="link-secondary">PT.Dirgantara</a>.
                        All rights reserved.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
