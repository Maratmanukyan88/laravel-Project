<!--<div id="nav">
<div class="navbar navbar-custom navbar-static-top">

       .btn-navbar is used as the toggle for collapsed navbar content 

      <a href="nm-dash.php" class="navbar-brand logo"><img src="img/logo.png" class="img-responsive logo"></a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
       <i class="fa fa-bars"></i>
      </a>
      <div class="navbar-collapse collapse pull-right">
        <ul class="nav navbar-nav men">
          <li ><a href="nm-search.php">Marketing</a></li>
          <li ><a href="nm-prospects.php">Prospects</a></li>
           <li><a href="nm-performance.php">Reports</a></li>
          <li><a href="#">Admin</a></li>
        </ul>
        <ul class="nav pull-right navbar-nav">
       
            <form class="navbar-form"><i class="fa fa-search " style="color:#fff;"></i>
            <input class="form-control custom-search-input" placeholder="Search" type="text">
             
            </form>
         
        
        </ul>
     
    </div>
  </div> /.navbar 
  </div>-->
<style>
@media screen and (max-width: 1080px) {
    #logo {
        display: none;
    }
     #logosmall {
        display: block;
    }
}
@media screen and (min-width: 1080px) {
  
     #logosmall {
         display: none;
         }
      #logo {
         display: block;  
    }


</style>
<div id="nav">
            <div class="navbar navbar-custom navbar-static-top">

                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->

                <a href="#page-top" class="navbar-brand logo"><img src="img/logo.png" data-src-desktop="img/logo-small.png" class="img-responsive logo" id="logo">
                                                            <img src="img/logo-small.png" data-src-desktop="img/logo-small.png" class="img-responsive logo"id="logosmall">   
                </a>
                <a  class="navbar-toggle" data-toggle="collapse" onclick="" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                    
                </a>
                <div class="navbar-collapse collapse pull-right">
                    <ul class="nav navbar-nav men">
                   <li><a class="page-scroll" href="#how_it_works">HOW IT WORKS</a></li>
                        <li ><a onclick="" class="page-scroll" href="#features">FEATURES</a></li>
                        <li ><a onclick="" class="page-scroll" href="#price">PRICING</a></li>
                        <li><a onclick="" class="page-scroll" href="#about">ABOUT</a></li>
                         <li><a  onclick="" class="page-scroll" href="#our_partners">PARTNERS</a></li>
                        <li><a  onclick="" class="page-scroll" href="#map">CONTACT</a></li>
                        </ul>



                    </ul>
                    <ul class="nav pull-right navbar-nav">

                        <a onclick="" href="{!!url('/auth/register')!!}"><button class="btn btn-danger blu">REGISTER</button></a>
                        <a onclick="" href="{!!url('/auth/login')!!}"><button class="btn btn-danger pin">LOGIN</button></a>


                    </ul>

                </div>
            </div><!-- /.navbar1 -->
        </div>
<script>
//$(document).ready(function() {
//   $(window).on( "scroll",function(){
//       var defaultlogo="img/logo.png";
//       var smollogo="img/logo-small.png";
//      $(".logo").css("margin-left","34px").attr('src',smollogo)
//      if ($(window).scrollTop()==0){
//          $(".logo").css("margin-left","30px").attr('src',defaultlogo)
//      }
//   }); 
//});
</script>


