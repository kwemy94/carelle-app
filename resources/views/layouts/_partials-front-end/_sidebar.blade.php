<div class="col-lg-3 col-md-4 col-12">
    <!-- Side navbar -->
    <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
        <!-- Menu -->
        <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
        <!-- Button -->
        <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light"
            type="button" data-bs-toggle="collapse" data-bs-target="#sidenav"
            aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fe fe-menu"></span>
        </button>
        <!-- Collapse navbar shell sidebar-left -->
        <div class="collapse navbar-collapse" id="sidenav">
            <div class="navbar-nav flex-column">
                <span class="navbar-header">Quiz disponible </span>
                <ul class="list-unstyled ms-n2 mb-4">
                    @forelse ($questionnaires as $quiz)
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('show-quiz-selected', $quiz->id) }}">
                            <i class="fe fe-calendar nav-icon"></i>
                            {{ $quiz->name }}
                        </a>
                    </li>
                    @empty
                    <li class="nav-item ">
                        <h4 class="nav-link" style="color: red !important;">
                            
                            Aucun quiz disponible !
                        </h4>
                    </li>
                    @endforelse
                </ul>
                
            </div>
        </div>
        

        {{-- {{ elixir('file') }} --}}
    </nav>
</div>