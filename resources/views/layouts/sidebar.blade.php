    <aside class="aside">
        <!-- START Sidebar (left)-->
        <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
                <!-- START sidebar nav-->
                <ul class="nav menu">
                    <!-- Iterates over all sidebar items-->
                    <li class="nav-heading ">
                        <span>MAIN NAVIGATION</span>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" title="Dashboard">
                            <em class="material-icons">school</em>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('random.name') }}" title="Acak Nama">
                            <em class="material-icons">shuffle</em>
                            <span>Acak Nama</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('random.name-roulette') }}" title="Kocak Undian Pizza">
                            <em class="material-icons">local_pizza</em>
                            <span>Kocok Nama Roulette</span>
                        </a>
                    </li>
                    @if(session()->get('role') == 'superadmin' || session()->get('role') == 'admintabel')
                    <li>
                        <a href="{{ route('random.lottery-table') }}" title="Kocok Undian Tabel">
                            <em class="material-icons">table_chart</em>
                            <span>Kocok Undian Tabel</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->get('role') == 'superadmin' || session()->get('role') == 'adminroulette')
                    <li>
                        <a href="{{ route('random.lottery-pizza') }}" title="Kocak Undian Pizza">
                            <em class="material-icons">local_pizza</em>
                            <span>Kocok Undian Roulette</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->get('role') == 'superadmin')
                    <li>
                        <a href="#layout" title="Layouts" data-toggle="collapse" class="menu-toggle">
                            <em class="material-icons">list</em>
                            <span>Lists</span>
                        </a>
                        <ul id="layout" class="nav sidebar-subnav collapse">
                            <li class="sidebar-subnav-header">Lists</li>
                            <li>
                                <a href="{{ route('lists.participants') }}" title="List Peserta">
                                    <span>List Peserta</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lists.prizes') }}" title="List Undian">
                                    <span>List Hadiah</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#setting" title="Kocak Undian Pizza" data-toggle="collapse" class="menu-toggle">
                            <em class="material-icons">settings_applications</em>
                            <span>Settings</span>
                        </a>
                        <ul id="setting" class="nav sidebar-subnav collapse">
                            <li class="sidebar-subnav-header">Settings</li>
                            <li>
                                <a href="{{ route('settings.user') }}" title="Manage Users">
                                    <span>Manage Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
                <!-- END sidebar nav-->
            </nav>
        </div>
        <!-- #END# Sidebar (left)-->
    </aside>