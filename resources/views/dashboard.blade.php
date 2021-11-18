<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
       
    
    <!-- Styles -->
        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

<input type="checkbox" id="check">
<!--header area start-->
<header>
  <label for="check">
    <i class="fas fa-bars" id="sidebar_btn"></i>
  </label>
  <div class="left_area">
    <h3><span><img src="images/Logo.png" alt="UKM Citra System" height="34px" width="80px"></span></h3>
  </div>
  <div class="dropdown ">
  
  Abu<span><i class="fas fa-caret-down fa-fw"></i></span>
  <div class="dropdown-content">
  <a href="#">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  </div>
</div>
  </div>
</header>
<!--header area end-->
<!--mobile navigation bar start-->
<div class="mobile_nav">
  <div class="nav_bar">
    <img src="images/profile.png" class="mobile_profile_image" alt="">
    <i class="fa fa-bars nav_btn"></i>
  </div>
  <div class="mobile_nav_items">
    <a href="#"><i class="fas fa-th-large fa-fw"></i><span>Dashboard</span></a>
    <a href="#"><i class="fas fa-file fa-sm fa-fw" ></i><span>Application</span></a>
    <a href="#"><i class="fas fa-list fa-fw"></i><span>Courses</span></a>
    <a href="#"><i class="fas fa-comment-alt fa-fw"></i><span>Feedback</span></a>
    
  </div>
</div>
<!--mobile navigation bar end-->
<!--sidebar start-->
<div class="sidebar">
  <div class="profile_info">
    <img src="images/profile.png" class="profile_image" alt="">
    <h4>Ali Bin Abu</h4>
    <h4>A174652</h4>
  </div>
  <a href="#"><i class="fas fa-th-large fa-fw"></i><span>Dashboard</span></a>
  <a href="#"><i class="fas fa-file fa-fw"></i><span>Application</span></a>
  <a href="#"><i class="fas fa-list fa-fw"></i><span>Courses</span></a>
  <a href="#"><i class="fas fa-comment-alt fa-fw"></i><span>Feedback</span></a>
  
</div>
<!--sidebar end-->

<div class="content">
  <div class="card">
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
  </div>
  
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.nav_btn').click(function(){
    $('.mobile_nav_items').toggleClass('active');
  });
});
</script>

</body>
</html>
  
