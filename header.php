<?php session_start();
include('db.php');

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	$template = $settings['template'];
	
	$MediaOpen = $settings['open_posts'];
	
	$squ->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

//User Info

if(!isset($_SESSION['username'])){
	
	$Uid = 0;

}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);
	
	$UsName = strtolower($UserRow['username']);

	$Uid = $UserRow['uid'];
	
	$UserEmail = $UserRow['email'];
	
	$Uavatar = $UserRow['avatar'];

    $UserSql->close();
	
}else{
     
	 printf("Error: %s\n", $mysqli->error);
	 
}

}

//Page titles

$urlTitle = parse_url($_SERVER['REQUEST_URI']);

$pageName = $urlTitle['path'];
if($pageName == '/about_us.html'){
	$pageTitle = 'About Us | ';
} else if($pageName ==  '/contact_us.html'){
	$pageTitle = 'Contact Us | ';
} else if($pageName ==  '/privacy_policy.html'){
	$pageTitle = 'Privacy Policy | ';
} else if($pageName ==  '/tos.html'){
	$pageTitle = 'Terms of Use | ';
} else if($pageName ==  '/settings.html'){
	$pageTitle = 'Settings | ';
} else if($pageName ==  '/hot.html'){
	$pageTitle = 'Hot | ';
} else if($pageName ==  '/trending.html'){
$pageTitle = 'Thịnh hành | ';
} else if($pageName ==  '/fresh.html'){
$pageTitle = 'Fresh | ';		
} else {
	$pageTitle = '';
}

//Ads

if($AdsSql = $mysqli->query("SELECT * FROM siteads WHERE id='1'")){

    $AdsRow = mysqli_fetch_array($AdsSql);
	
	$Ad1 = stripslashes($AdsRow['ad1']);
	$Ad2 = stripslashes($AdsRow['ad2']);
	$Ad3 = stripslashes($AdsRow['ad3']);

    $AdsSql->close();

}else{
	
     printf("Error: %s\n", $mysqli->error);
}

$UpdateSiteViews = $mysqli->query("UPDATE settings SET site_hits=site_hits+1 WHERE id=1");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $pageTitle;?><?php echo $settings['name']; ?></title>
<meta name="description" content="<?php echo $settings['descrp']; ?>" />
<meta name="keywords" content="<?php echo $settings['keywords']; ?>" />

<!--Facebook Meta Tags-->
<meta property="fb:app_id"          content="<?php echo $settings['fbapp']; ?>" /> 
<meta property="og:url"             content="http://<?php echo $settings['siteurl']; ?>" /> 
<meta property="og:title"           content="<?php echo $settings['name'];?>" />
<meta property="og:description" 	content="<?php echo $settings['descrp'];?>" /> 
<meta property="og:image"           content="http://<?php echo $settings['siteurl']; ?>/images/logo.png" /> 
<!--End Facebook Meta Tags-->

<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="templates/<?php echo $settings['template'];?>/css/style.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.freeow.min.js"></script>
<script src="js/jquery.timeago.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(".login-links").colorbox();
	$(".pop-uplink").colorbox();
})
jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});

$(document).ready(function() {
    var s = $("#ads-two");
    var pos = s.position();                   
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
       
        if (windowpos+55 >= pos.top) {
            s.addClass("ads-two");
        } else {
            s.removeClass("ads-two");
        }
    });
});

</script>

<script type="text/javascript">
function popup(e){var t=700;var n=400;var r=(screen.width-t)/2;var i=(screen.height-n)/2;var s="width="+t+", height="+n;s+=", top="+i+", left="+r;s+=", directories=no";s+=", location=no";s+=", menubar=no";s+=", resizable=no";s+=", scrollbars=no";s+=", status=no";s+=", toolbar=no";newwin=window.open(e,"windowname5",s);if(window.focus){newwin.focus()}return false}
</script>
<script>
$(document).ready(function(){
$(".thumb").click( function(){
	
	$(this).parent().find('div.gif-img').removeClass('gif-img').addClass('gif-img-off'); 
	 
    $(this).attr("src", $(this).attr("gif")); 
});

$(".gif-img").click( function(){
	
	$(this).removeClass('gif-img').addClass('gif-img-off'); 
	 
    $(this).parent().find('img.thumb').attr("src", $(this).parent().find('img.thumb').attr("gif"));
});


});

$(document).ready(function(){

	// hide #back-top first
	$("#top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#top').fadeIn();
			} else {
				$('#top').fadeOut();
			}
		});
		
$('#top').click(function (e) {
     $(window.opera ? 'html' : 'html, body').animate({
        scrollTop: 0
    }, 'slow');
});

	});

});

</script>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=196505667225847&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header id="main-header">

<div id="top-header">
<div class="center-header">
<div class="header-left">
<div id="logo"><a href="index.html"><img src="images/logo.png" width="159" height="47" alt="<?php echo $settings['name'];?>"></a></div><!--logo-->

<nav id="main-menu">
<ul>
   <li><a href="new.html"><span>Mới</span></a></li>
   <li><a href="hot.html"><span>Nổi bật</span></a></li>
   <li><a href="trending.html"><span>Thịnh Hành</span></a></li>
   <li class="has-sub"><a href="#"><span>Xem thêm</span></a>
      <ul>
         <li><a href="gif.html"><span>GIF</span></a></li>
         <?php
if($CatSql = $mysqli->query("SELECT id, cname FROM categories")){

    while($CatRow = mysqli_fetch_array($CatSql)){
		
		$CatName = $CatRow['cname'];
		$CatUrl = preg_replace("![^a-z0-9]+!i", "-", $CatName);
		$CatURl = urlencode($CatUrl);
		$CatUrl = strtolower($CatUrl);
		
		$CatDisplayName = str_replace('&','&amp;',$CatName);
		
?>
    <li><a href="category-<?php echo $CatRow['id'];?>-<?php echo $CatUrl;?>-1.html"><span><?php echo $CatDisplayName;?></span></a></li>
<?php

}

	$CatSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?>  
      </ul>
   </li>
</ul>
</nav><!--main-menu-->
</div><!--header-left-->
<div class="header-right">

</div><!--header-right-->
</div><!--center-header-->
</div><!--top-header-->
<div id="bottom-header">
<div class="center-header">
<div class="header-bottom-left"><div id="slogan"><?php echo $settings['name'];?></div>
<div id="social-love">
<div id="fb-button-div">
<div class="fb-like" data-href="<?php echo $settings['fbpage'];?>" data-width="50px" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>        
</div>
<div id="twitter-button-div">
<a href="https://twitter.com/hayvl" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @hayvl</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div><!--twitter-button-div-->

<div id="google-button-div">
<!-- Đặt thẻ này vào nơi bạn muốn Nút +1 kết xuất. -->
<div class="g-plusone" data-size="medium"></div>

<!-- Đặt thẻ này sau thẻ Nút +1 cuối cùng. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'vi'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

</div><!--google-button-div-->

</div><!--social-love-->

</div><!--header-bottom-left-->

<div id="search-box">
<form name="search" id="search" method="get" action="search.php">
<input type="text" tabindex="1" class="input" id="term" name="term" placeholder="Nhập từ khóa.."/>
<button type="submit" tabindex="2" class="search-button" id="submit">Tìm kiếm</button>
</form>
</div>

</div><!--center-header-->
</div><!--bottom-header-->

</header><!--main-header-->

<div id="container">