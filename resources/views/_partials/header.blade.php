<!-- start: nav -->

    <div id="nav">
        <div class="navbar navbar-custom navbar-static-top">

            <a href="{!! url('/') !!}" class="navbar-brand logo">
                <img src="{!! URL::asset('/img/logo.png')!!}" class="img-responsive logo">
            </a>

            <a class="navbar-toggle" onclick="" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-collapse collapse pull-right">
                <ul class="nav navbar-nav men">
                    <li><a href="nm-search.php">Marketing</a></li>
                    <li><a href="nm-prospects.php">Prospects</a></li>
                    <li><a href="nm-performance.php">Reports</a></li>  
                    <li class="last"><a href="login.php">Admin</a></li>                      
                    <li>
                        <form class="navbar-form">
                            <i class="fa fa-search " style="color:#fff;"></i>
                            <input class="form-control custom-search-input" placeholder="Search" type="text">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<!-- end: nav -->