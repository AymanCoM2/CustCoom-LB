<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
            </span>

            <a href="{{ route('home') }}">
                <div class="text logo-text">
                    <span class="name">2CooM</span>
                    <h3>(LB)</h3>
                    @if (Auth::user())
                        <span class="profession">Welcome : {{ Auth::user()->name }}</span>
                    @endif
                </div>
            </a>
        </div>

        <i class="bx bx-chevron-right toggle mt-5"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                @if (Auth::user()->isSuperUser == 1)
                    <li class="nav-link">
                        <a href="{{ route('new-codes-get') }}">
                            <i class='bx bx-message-rounded-add icon'></i>
                            <span class="text nav-text">New
                                <span class="badge bg-danger">
                                    {{ App\Models\CardCode::all()->count() }}</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="text nav-text">SAP Table</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{ route('get-import-customers') }}">
                            <i class="bx bx-import icon"></i>
                            <span class="text nav-text">Import Excel</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('options-get') }}">
                            <i class="bx bx-import icon"></i>
                            <span class="text nav-text">Import Radios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('history-log') }}">
                            <i class="bx bx-history icon"></i>
                            <span class="text nav-text">Edit History</span>
                        </a>
                    </li>

                    <hr>

                    <li class="nav-link">
                        <a href="{{ route('files-upload-log') }}">
                            <span class="text nav-text">
                                <span
                                    class="badge bg-danger">{{ \App\Models\Documents::where('isApproved', 0)->count() }}</span>
                                Newly uploaded Files</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="{{ route('customer-edit-log') }}">
                            <span class="text nav-text">
                                <span
                                    class="badge bg-danger">{{ $counts = \App\Models\EditHistory::where('isApproved', 0)->groupBy('cardCode')->count() }}</span>
                                Newly updated Customers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('col-types-get') }}">
                            <i class="bx bx-history icon"></i>
                            <span class="text nav-text">Column Types</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('col-ddl-get') }}">
                            <i class="bx bx-history icon"></i>
                            <span class="text nav-text">Add Radios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('bbb-get') }}">
                            <i class='bx bx-vertical-center icon'></i>
                            <span class="text nav-text">Insert[CODE]</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('reports-home') }}">
                            <i class="bx bx-search-alt icon"></i>
                            <span class="text nav-text">Reports</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('reports-home-2') }}">
                            <i class="bx bx-search-alt icon"></i>
                            <span class="text nav-text">Reports Sample 2</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->isSuperUser == 2)
                    {{-- Editor    --}}

                    <li class="nav-link">
                        <a href="{{ route('new-codes-get') }}">
                            <i class='bx bx-message-rounded-add icon'></i>
                            <span class="text nav-text">New
                                <span class="badge bg-danger">
                                    {{ App\Models\CardCode::all()->count() }}</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="text nav-text">SAP Table</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="{{ route('bbb-get') }}">
                            <i class='bx bx-vertical-center icon'></i>
                            <span class="text nav-text">Insert[CODE]</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('editor-approval-history') }}">
                            <i class='bx bx-vertical-center icon'></i>
                            <span class="text nav-text">Editor History</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('editor-approval-history-files') }}">
                            <i class='bx bx-vertical-center icon'></i>
                            <span class="text nav-text">Disapproved Files</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->isSuperUser == 3)
                    {{--   Viewer  --}}
                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="text nav-text">SAP Table</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text nav-text">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>
