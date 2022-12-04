<nav class="side-menu-area">
    <nav class="sidebar-nav" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: -15px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <ul id="sidebar-menu" class="sidebar-menu metismenu">
                                <li class="mm-active">
                                    <a href="#" class="has-arrow box-style d-flex align-items-center" aria-expanded="true">
                                        <div class="icon">
                                            <img src="/assets/images/icon/element.svg" alt="element">
                                        </div>
                                        <span class="menu-title">Dashboards</span>
                                    </a>
                                    <ul class="sidemenu-nav-second-level mm-collapse mm-show">
                                        <li>
                                            <a href="#">
                                                <span class="menu-title">Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="menu-title">Analysis Dashboard</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('states.show', 1) }}" class="box-style d-flex align-items-center">
                                        <div class="icon">
                                            <img src="/assets/images/icon/element.svg" alt="element">
                                        </div>
                                        <span class="menu-title">Locations</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('show_all_summary') }}" class="box-style d-flex align-items-center">
                                        <div class="icon">
                                            <img src="/assets/images/icon/element.svg" alt="element">
                                        </div>
                                        <span class="menu-title">Summary</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</nav>
