<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
            </span>

            <a href="{{ route('home') }}">
                <div class="text logo-text">
                    <span class="name">2CooM</span>
                    <h3>(TM)</h3>
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
                            <span class="text nav-text">New
                                <span class="badge bg-danger">
                                    {{ App\Models\CardCode::all()->count() }}</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
                            <span class="text nav-text">SAP Table</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{ route('get-import-customers') }}">
                            <span class="text nav-text">Import Excel</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('options-get') }}">
                            <span class="text nav-text">Import Radios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('history-log') }}">
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
                                    class="badge bg-danger">{{ \Illuminate\Support\Facades\DB::table('edit_histories')->distinct('cardCode')->where('isApproved', false)->count('cardCode') }}</span>
                                Newly updated Customers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('col-types-get') }}">
                            <span class="text nav-text">Column Types</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('col-ddl-get') }}">
                            <span class="text nav-text">Add Radios</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('reports-home') }}">
                            <span class="text nav-text">Reports</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('reports-home-2') }}">
                            <span class="text nav-text">Reports Sample 2</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('backup-excel') }}">
                            <i class='bx bx-objects-vertical-bottom'></i>
                            <span class="text nav-text text-white bg-success">Export/Backup Data</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->isSuperUser == 2)
                    {{-- Editor --}}
                    <li class="nav-link">
                        <a href="{{ route('new-codes-get') }}">
                            <span class="text nav-text">New
                                <span class="badge bg-danger">
                                    {{ App\Models\CardCode::all()->count() }}</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
                            <span class="text nav-text">SAP Table</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('notify-edit') }}">
                            <span class="text nav-text">Edit Notifications</span>
                            @php $y =\App\Models\EditorOnceTimeNOtification::where('editor_id', request()->user()->id)->count(); @endphp
                            <span class="badge bg-danger">{{ $y }}</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('notify-file') }}">
                            <span class="text nav-text">File Notifications</span>
                            @php $x  =\App\Models\EditorOnceTimeDocs::where('editor_id', request()->user()->id)->count(); @endphp
                            <span class="badge bg-danger">{{ $x }}</span>
                        </a>
                    </li>

                    <hr>
                    <hr>
                    <li class="nav-link">
                        <a href="{{ route('editor-approval-history') }}">
                            <span class="text nav-text">Editor History</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('editor-approval-history-files') }}">
                            <span class="text nav-text">Disapproved Files</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->isSuperUser == 3)
                    {{--   Viewer  --}}
                    <li class="nav-link">
                        <a href="{{ route('get-all-customers') }}">
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
            <br><br>
        </div>
    </div>
</nav>
