<!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @if (auth()->user()->role == "admin")
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/dashboardadmin"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        @endif

                        @if (auth()->user()->role == "instructor")
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/dashboardins"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        @endif
                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>
                        @if (auth()->user()->role == "admin")
                        <li class="sidebar-item"> <a class="sidebar-link" href="/user"
                                aria-expanded="false"><i class="fas fa-chalkboard-teacher"></i><span
                                    class="hide-menu">Instructor
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-users"></i><span class="hide-menu">Member </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link">
                                <span class="hide-menu"> Teacher Training</span></a>
                            </li>
                            <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link">
                                <span class="hide-menu"> Intership Program</span></a>
                            </li>
                            <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link">
                                <span class="hide-menu"> Industry Class</span></a>
                            </li>
                        </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/lesson" aria-expanded="false"><i class="fas fa-book"></i>
                            <span class="hide-menu">Lesson</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html" aria-expanded="false"><i class="far fa-folder-open"></i>
                            <span class="hide-menu">Modul</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html" aria-expanded="false"><i class="far fa-question-circle"></i>
                            <span class="hide-menu">Quiz</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html" aria-expanded="false"><i class="fas fa-file-invoice-dollar"></i>
                            <span class="hide-menu">Billings</span></a>
                        </li>
                        </ul>
                        @endif
                         {{-- @else --}}
                        @if (auth()->user()->role == "instructor")
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-users"></i><span class="hide-menu">Member </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link">
                                <span class="hide-menu"> Teacher Training</span></a>
                            </li>
                            <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link">
                                <span class="hide-menu"> Intership Program</span></a>
                            </li>
                            <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link">
                                <span class="hide-menu"> Industry Class</span></a>
                            </li>
                        </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/lesson" aria-expanded="false"><i class="fas fa-book"></i>
                            <span class="hide-menu">Lesson</span></a>
                        </li>
                        @endif
                    </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->