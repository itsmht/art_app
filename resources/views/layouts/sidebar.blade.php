<!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('adminDashboard')}}" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>    
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('categories')}}"  aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-1"><i class="fas fa-briefcase"></i>Categories</a>    
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('products')}}"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-1"><i class="fas fa-briefcase"></i>Products</a>    
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('purchases')}}"  data-target="#submenu-4" aria-controls="submenu-1"><i class="fas fa-child"></i>Purchases</a>    
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('settings')}}"  data-target="#submenu-4" aria-controls="submenu-1"><i class="fas fa-child"></i>Settings</a>    
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-1"><i class="far fa-money-bill-alt"></i>Payments</a>   
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('recharges')}}">Pending Recharges</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('withdraws')}}">Pending Withdraws</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('wallets')}}">Wallet Verification</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('transactionHistory')}}">Transaction History</a>
                                        </li>
                                    </ul>
                                </div> 
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-1"><i class="far fa-money-bill-alt"></i>Tradings</a>   
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('sells')}}">Pending Sell Requests</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('buys')}}">Buy History</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('trades')}}">Trading History</a>
                                        </li>
                                    </ul>
                                </div> 
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->