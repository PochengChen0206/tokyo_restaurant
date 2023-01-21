<?php  
session_start();
?>

<nav class="site-nav">
	<div class="container">
		<div class="site-navigation">
			<a href="http://localhost/pocheng/tokyo_restaurant/index.php" class="logo m-0">List Of Tokyo Restaurant<span class="text-primary"></span></a>
			<ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
				<li class="active"><a href="http://localhost/pocheng/tokyo_restaurant/index.php">Home</a></li>
				<li class="has-children">
					<a href="#">快速尋找餐廳</a>
					<ul class="dropdown">
						<li><a href="elements.html">區域</a></li>
						<li><a href="#">類別</a></li>
						<li><a href="#">預算</a></li>
						<li class="has-children">
							<a href="#">本月精選</a>
							<ul class="dropdown">
								<li><a href="#">Sub Menu One</a></li>
								<li><a href="#">Sub Menu Two</a></li>
								<li><a href="#">Sub Menu Three</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="services.html">Services</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="contact.html">快速預約</a></li>
				<!-- 之後session判斷 -->
				<li><a href="http://localhost/pocheng/tokyo_restaurant/view/login.php">LOGIN</a></li>
				<li><a href="http://localhost/pocheng/tokyo_restaurant/view/mypage.php">會員中心</a></li>
				<li><a href="http://localhost/pocheng/tokyo_restaurant/view/admin.php">管理後台</a></li>
				<!-- <li><a type=button>LOGIOUT</a></li> -->
			</ul>
			<a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
				<span></span>
			</a>
		</div>
	</div>
</nav>