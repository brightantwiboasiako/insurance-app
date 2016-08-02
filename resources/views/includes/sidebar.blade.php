<div id="nav-col">
    <section id="col-left" class="col-left-nano">
        <div id="col-left-inner" class="col-left-nano-content">
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                            <span class="label label-primary label-circle pull-right">28</span>
                        </a>
                    </li>
                    <li class="nav-header nav-header-first hidden-sm hidden-xs">
                        POLICIES & UNDERWRITING
                    </li>
                    <li  class="policy">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                            <span>Policies</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('/policy/funeral') }}">
                                    <i class="fa fa-umbrella" aria-hidden="true"></i> Funeral Insurance
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/policy/loanprotection') }}">
                                    <i class="fa fa-institution" aria-hidden="true"></i> Loan Protection
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/policy/childeducation') }}">
                                    <i class="fa fa-child" aria-hidden="true"></i> Child Education
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span>Premiums</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="graphs-morris.html">
                                    Single
                                </a>
                            </li>
                            <li>
                                <a href="graphs-flot.html">
                                    Bulk
                                </a>
                            </li>
                            <li>
                                <a href="graphs-dygraphs.html">
                                    Edit
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>Underwriting</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="graphs-morris.html">
                                    Single
                                </a>
                            </li>
                            <li>
                                <a href="graphs-flot.html">
                                    Bulk
                                </a>
                            </li>
                            <li>
                                <a href="graphs-dygraphs.html">
                                    Edit
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                            <span>Claims</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('/claim/register') }}">
                                    Register
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/claim/payment') }}">
                                    Pay Claim
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/claim/view') }}">
                                    View Claim
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header hidden-sm hidden-xs">
                        REPORTS & STATEMENTS
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                            <span>Reports</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="form-elements.html">
                                    Policies
                                </a>
                            </li>
                            <li>
                                <a href="x-editable.html">
                                    Premiums
                                </a>
                            </li>
                            <li>
                                <a href="form-wizard.html">
                                    Claims
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-folder" aria-hidden="true"></i>
                            <span>Statements</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="ui-elements.html">
                                    Premium Statement
                                </a>
                            </li>
                            <li>
                                <a href="notifications.html">
                                    Commission Statement
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                            <span>Claims</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="faq.html">
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header hidden-sm hidden-xs">
                        CUSTOMER MANAGEMENT
                    </li>
                    <li class="customer">
                        <a href="{{ url('/customer') }}">
                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="nav-header hidden-sm hidden-xs">
                        BRANCHES & AGENCY
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-chain" aria-hidden="true"></i>
                            <span>Agency</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-cubes" aria-hidden="true"></i>
                            <span>Branch Management</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div id="nav-col-submenu"></div>
</div>