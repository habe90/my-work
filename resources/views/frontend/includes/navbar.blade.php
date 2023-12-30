<!-- Start Navigation -->
<div class="header header-transparent change-logo">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand static-logo" href="/"><img src="frontend/img/logo-my-work.png" class="logo" alt="" /></a>
                        <a class="nav-brand fixed-logo" href="/"><img src="frontend/img/logo-my-work.png" class="logo" alt="" /></a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper">
                        <ul class="nav-menu">
                        
                            <li class="active"><a href="/">Home<span class="submenu-indicator"></span></a>
                            </li>
                            
                            
                            @foreach ($contentPages as $page)
                                <li><a href="{{ url('/page/' . $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach
                    
                        </ul>
                        
                        <ul class="nav-menu nav-menu-social align-to-right">
                            
                            <li>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#upload-resume">
                                    <i class="fa fa-sign-in mr-1"></i>Anmelden
                                </a>
                            </li>
                            <li class="add-listing dark-bg">
                                <a href="#" data-toggle="modal" data-target="#login">
                                     <i class="ti-user mr-1"></i> Als Handwerker anmeleden
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Navigation -->