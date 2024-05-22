<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



            <li class="nav-item">
                <a href="{{ route('questionnaire.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Questionnaires
                        @isset($questionnaires)
                            <span class="badge badge-info right">{{ count($questionnaires) }}</span>
                        @endisset
                            
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('use-method.index') }}" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Méthodes
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('quiz-answer.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Réponses aux quiz
                        @isset($answers)
                            <span class="badge badge-success right">{{ count($answers) }}</span>
                        @endisset
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rapport.general.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>Rapport générale </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('solution.index') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>Solutions </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('settings.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-cogs"></i>
                    <p>Configurations </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
