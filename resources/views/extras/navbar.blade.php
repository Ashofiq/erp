@if(request()->is('account*'))    
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('accounts.dashboard') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            </span>
            <span class="nav-link-title">
                Home
            </span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calculator" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="3" width="16" height="18" rx="2"></rect><rect x="8" y="7" width="8" height="3" rx="1"></rect><line x1="8" y1="14" x2="8" y2="14.01"></line><line x1="12" y1="14" x2="12" y2="14.01"></line><line x1="16" y1="14" x2="16" y2="14.01"></line><line x1="8" y1="17" x2="8" y2="17.01"></line><line x1="12" y1="17" x2="12" y2="17.01"></line><line x1="16" y1="17" x2="16" y2="17.01"></line>
                    </svg>
                </span>
                <span class="nav-link-title">
                    Accounts
                </span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('accounts.chart.of.acc.index', ['parentId' => 0]) }}" >
                    Chart Of Accounts
                </a>

                <a class="dropdown-item" href="{{ route('accounts.fiscal.year.all') }}" >
                    Financial Year
                </a>
            </div>
            
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="{{ route('accounts.acctrans.jv.create', 1) }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="5" y="3" width="14" height="18" rx="2"></rect><line x1="9" y1="7" x2="15" y2="7"></line><line x1="9" y1="11" x2="15" y2="11"></line><line x1="9" y1="15" x2="13" y2="15"></line>
                </svg>
            </span>
            <span class="nav-link-title">
                Journal 
            </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('accounts.acctrans.jv.create', 2) }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="12" y1="11" x2="12" y2="17" /><line x1="9" y1="14" x2="15" y2="14" /></svg>
            </span>
            <span class="nav-link-title">
                Contra 
            </span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2"></path></svg>
                </span>
                <span class="nav-link-title">
                    Receive
                </span>
            </a>

            <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                        <a  href="{{ route('accounts.acctrans.jv.create', 3) }}" class="dropdown-item">
                            Cash Receive
                        </a>

                        <a  href="{{ route('accounts.acctrans.jv.create', 4) }}" class="dropdown-item">
                            Bank Receive
                        </a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="7" y="9" width="14" height="10" rx="2"></rect><circle cx="14" cy="14" r="2"></circle><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path></svg>
                </span>
                <span class="nav-link-title">
                    Payment
                </span>
            </a>

            <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                        <a  href="{{ route('accounts.acctrans.jv.create', 5) }}" class="dropdown-item">
                            Cash Payment
                        </a>
                        <a  href="{{ route('accounts.acctrans.jv.create', 6) }}" class="dropdown-item">
                            Bank Payment
                        </a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="14" r="2" /><path d="M12 10.5v1.5" /><path d="M12 16v1.5" /><path d="M15.031 12.25l-1.299 .75" /><path d="M10.268 15l-1.3 .75" /><path d="M15 15.803l-1.285 -.773" /><path d="M10.285 12.97l-1.285 -.773" /><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
            </span>
            <span class="nav-link-title">
                Settings
            </span>
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('settings.company.all') }}" >
                Company
            </a>
            <a class="dropdown-item" href="{{ route('settings.user.all') }}" >
                User Information
            </a>
            <a class="dropdown-item" href="{{ route('settings.company.assign.all') }}" >
                Company Assign
            </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path><path d="M18 14v4h4"></path><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path><rect x="8" y="3" width="6" height="4" rx="2"></rect><circle cx="18" cy="18" r="4"></circle><path d="M8 11h4"></path><path d="M8 15h3"></path></svg>
                </span>
                <span class="nav-link-title">
                    Reports
                </span>
            </a>
            <div class="dropdown-menu">
            <a  href="{{ route('accounts.acctrans.voucher.list') }}" class="dropdown-item">
                        Vouvher Report
                    </a>
                    <a  href="{{ route('accounts.acctrans.cash.sheet') }}" class="dropdown-item">
                        Daily Cash Statement
                    </a>

                    <a  href="{{ route('accounts.acctrans.subsidary.ledger') }}" class="dropdown-item">
                        Subsidary Ledger
                    </a>

                    <a  href="{{ route('accounts.control.wise.ledger') }}" class="dropdown-item">
                        Control Wise Subsidary Ledger
                    </a>

                    <a  href="{{ route('accounts.trial.balance') }}" class="dropdown-item">
                        Trial Balance
                    </a>

                    <a  href="{{ route('accounts.liquid.cash') }}" class="dropdown-item">
                        Liquid Cash
                    </a>

                    <a  href="{{ route('accounts.contra.bank.to.cash') }}" class="dropdown-item">
                        Bank To Cash
                    </a>
            </div>
        </li>
       
       
       
    </ul>
@endif