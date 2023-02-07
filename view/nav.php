<?php if(stripos($_SERVER['PHP_SELF'],'index')){ ?>
	<nav class="site-nav">
		<div class="container">
			<div class="site-navigation">
				<a href="index.php" class="logo m-0">List Of Tokyo Restaurant<span class="text-primary"></span></a>
				<ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
					<li class="active"><a href="index.php">Home</a></li>
					<!-- <li class="has-children">
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
					</li> -->
					<li><a href="./view/restaurant_search.php?&area=all&category=all&price_range=all&page=1">搜尋餐廳</a></li>
					<!-- <li><a href="contact.html">快速預約</a></li> -->
					<?php if(isset($_SESSION['name'])){ ?>
						<?php if($_SESSION['name'] != "admindemo"){ ?>
							<li><a href="./view/mypage.php?cate=userinfo">會員中心</a></li>
						<?php }?>
					<?php }else{ ?>
						<li><a href="./view/login.php">LOGIN</a></li>
					<?php } ?>
					<!-- //管理者帳號 -->
					<?php if(isset($_SESSION['level']) && $_SESSION['level'] == "1"){ ?>
						<li><a href="./view/admin.php?cate=edit&page=1">管理後台</a></li>
					<?php } ?>
					<?php if(isset($_SESSION['name'])){ ?>
						<li><a href="./contral/logout.php">LOGOUT</a></li>
					<?php } ?>
				</ul>
				<a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
			</div>
		</div>
	</nav>
<?php }else{ ?>
	<nav class="site-nav">
		<div class="container">
			<div class="site-navigation">
				<a href="../index.php" class="logo m-0">List Of Tokyo Restaurant<span class="text-primary"></span></a>
				<ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
					<li class="active"><a href="../index.php">Home</a></li>
					<!-- <li class="has-children">
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
					</li> -->
					<li><a href="../view/restaurant_search.php?&area=all&category=all&price_range=all&page=1">搜尋餐廳</a></li>
					<!-- <li><a href="contact.html">快速預約</a></li> -->
					
					<?php if(isset($_SESSION['name'])){ ?>
						<?php if($_SESSION['name'] != "admindemo"){ ?>
							<li><a href="../view/mypage.php?cate=userinfo">會員中心</a></li>
						<?php }?>
					<?php }else{ ?>
						<li><a href="../view/login.php">LOGIN</a></li>
					<?php } ?>

					<!-- //管理者帳號 -->
					<?php if(isset($_SESSION['level']) && $_SESSION['level'] == "1"){ ?>
						<li><a href="../view/admin.php?cate=edit&page=1">管理後台</a></li>
					<?php } ?>

					<?php if(isset($_SESSION['name'])){ ?>
						<li><a href="../contral/logout.php">LOGOUT</a></li>
					<?php } ?>
				</ul>
				<a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
			</div>
		</div>
	</nav>
<?php } ?>