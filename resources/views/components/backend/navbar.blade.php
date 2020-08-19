<div>
   <!-- ============================================================== -->
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
                                <a class="nav-link active" href="{{url('dashboard/index')}}"   ><i class="fas fa-home"></i>Dashboard</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-12" aria-controls="submenu-12"> <i class="fas fa-truck"></i> E-Commerce</a>
                                <div id="submenu-12" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/products')}}">Product Add</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/productStore')}}">Store Add</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/prices')}}">Price Add</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/discounts')}}">Discount Add</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-14" aria-controls="submenu-14"> <i class="fab fa-first-order"></i> Manage Order</a>
                                <div id="submenu-14" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/orders')}}"> Order View</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-15" aria-controls="submenu-15"> <i class="fas fa-archive"></i>  Manage Catergory</a>
                                <div id="submenu-15" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/categories')}}"> Category Add</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/sub_categories')}}">Sub Category Add</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-16" aria-controls="submenu-16"> <i class="fab fa-first-order"></i>Manage Attribute</a>
                                <div id="submenu-16" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/colors')}}"> Add Color</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/sizes')}}"> Add Size</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/brands')}}"> Add Brand</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-13" aria-controls="submenu-13"> <i class="fas fa-user-circle"></i>  Manage User</a>
                                <div id="submenu-13" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('dashboard/users')}}"> User Add</a>
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
        <!-- ============================================================== -->
        <!-- ============================================================== -->
</div>