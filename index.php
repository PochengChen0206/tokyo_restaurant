<?php
require_once('DBPDO.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">
	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="css/daterangepicker.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/style.css">
	<title>List Of Tokyo Restaurant</title>
</head>

<body>
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<?php require_once('./view/nav.php'); ?>

	<div class="hero">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-7">
					<div class="intro-wrap">
						<h1 class="mb-5"><span class="d-block">尋找東京的美食</span><span class="typed-words"></span></h1>
						<div class="row">
							<div class="col-12">
								<form class="form" action="./contral/search.php" method="post" onsubmit="return search_check();">
									<div class="row mb-2">
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-5">
                      <select name="area" id="area" class="form-control custom-select">
                        <option value="">選擇區域</option>
                          <?php 
                          $stmt=$dbpdo->prepare("SELECT * FROM `area_info`");
                          $stmt->execute();
													$result_area = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach($result_area as $k1=>$v1){
                          ?>
                            <option value="<?=$v1['area']?>"><?=$v1['area']?></option>
                          <?php 
                          } 
                          ?>
                      </select>
										</div>
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-5">
                      <select name="category" id="category" class="form-control custom-select">
                        <option value="">請選擇分類</option>
                        <?php 
                        $stmt=$dbpdo->prepare("SELECT * FROM `categories_info`");
                        $stmt->execute();
												$result_cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result_cat as $k2=>$v2){
                        ?>
                          <option value="<?=$v2['cat_name']?>"><?=$v2['cat_name']?></option>
                        <?php 
                        }
                        ?>
                      </select>
										</div>
										<div class="col-sm-12 col-md-6 mt-3 mb-3 mb-lg-0 col-lg-5">
											<select name="price_range" id="price_range" class="form-control custom-select">
                        <option value="">請選擇價格區間</option>
                        <?php 
                        $stmt=$dbpdo->prepare("SELECT * FROM `price_range`");
                        $stmt->execute();
												$result_price = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result_price as $k3=>$v3){
                        ?>
                          <option value="<?=$v3['price_range']?>"><?=$v3['price_range']?></option>
                        <?php 
                        }
                        ?>
                      </select>
										</div>
										<div class="col-sm-12 col-md-6 mt-3 mb-lg-0 col-lg-5">
											<input type="submit" class="btn btn-primary btn-block" value="Search">
										</div>
									</div>    
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="slides">
						<img src="images/slider1.jpg" alt="Image" class="img-fluid active">
						<img src="images/slider2.jpg" alt="Image" class="img-fluid">
						<img src="images/slider3.jpg" alt="Image" class="img-fluid">
						<!-- <img src="images/slider4.jpg" alt="Image" class="img-fluid">
						<img src="images/hero-slider-5.jpg" alt="Image" class="img-fluid"> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5 justify-content-center">
				<div class="col-lg-6 text-center">
					<h2 class="section-title text-center mb-3">關於List Of Tokyo Restaurant</h2>
				</div>
			</div>
			<div class="row align-items-stretch">
				<div class="col-lg-4 order-lg-1">
					<div class="h-100">
						<div class="frame h-100">
							<div class="feature-img-bg h-100" style="background-image: url('images/about.jpg');"></div>
						</div>
					</div>
				</div>

				<div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-1" >
					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-house display-4 text-primary"></span>
              <h3>最新的餐廳資訊</h3>
							<p class="mb-0">定期更新的餐廳資訊，掌握東京餐廳的最新情報</p>
						</div>
					</div>

					<div class="feature-1 ">
						<div class="align-self-center">
							<span class="flaticon-restaurant display-4 text-primary"></span>
              <h3>美食交流區</h3>
							<p class="mb-0">可以分享自己的用餐經驗並且和其他會員交流</p>
						</div>
					</div>

				</div>

				<div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-3" >

					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-mail display-4 text-primary"></span>
							<h3>個人收藏清單</h3>
							<p class="mb-0">登錄會員後可以建立自己專屬的收藏餐廳名單，下次到東京時不用花時間再查找餐廳資訊</p>
						</div>
					</div>

					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-phone-call display-4 text-primary"></span>
							<h3>合作餐廳訂位</h3>
							<p class="mb-0">可透過網站的訂位功能快速向合作的餐廳進行訂位</p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- <div class="untree_co-section count-numbers py-5">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="9313">0</span>
						</div>
						<span class="caption">餐廳名單</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="8492">0</span>
						</div>
						<span class="caption">分享文章</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="100">0</span>
						</div>
						<span class="caption">造訪人次</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="160">0</span>
						</div>
						<span class="caption">會員數</span>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="untree_co-section">
		<div class="container">
			<div class="row text-center justify-content-center mb-5">
				<div class="col-lg-7"><h2 class="section-title text-center">推薦類別</h2></div>
			</div>

			<div class="owl-carousel owl-3-slider">

				<div class="item">
					<a class="media-thumb" href="images/top-slider-1.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>咖啡廳</h3>
						</div>
						<img src="images/cafe.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>

				<div class="item">
					<a class="media-thumb" href="images/top-slider-2.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>壽司</h3>
						</div>
						<img src="images/top-slider-2.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>

				<div class="item">
					<a class="media-thumb" href="images/hero-slider-3.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>甜點</h3>
						</div>
						<img src="images/sweet.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>

				<div class="item">
					<a class="media-thumb" href="images/hero-slider-4.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>拉麵</h3>
						</div>
						<img src="images/ramen.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>

				<div class="item">
					<a class="media-thumb" href="images/hero-slider-5.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>酒吧</h3>
						</div>
						<img src="images/bar.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>

				<div class="item">
					<a class="media-thumb" href="images/hero-slider-1.jpg" data-fancybox="gallery">
						<div class="media-text">
							<h3>海鮮丼</h3>
						</div>
						<img src="images/kaisendon.jpg" alt="Image" class="img-fluid">
					</a> 
				</div>
			</div>
		</div>
	</div>

  <div class="untree_co-section testimonial-section mt-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 text-center">
					<h2 class="section-title text-center mb-5">用餐心得分享</h2>

					<div class="owl-single owl-carousel no-nav">
						<div class="testimonial mx-auto">
							<figure class="img-wrap">
								<img src="images/person_2.jpg" alt="Image" class="img-fluid">
							</figure>
							<h3 class="name">Adam Aderson</h3>
							<blockquote>
								<p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
							</blockquote>
						</div>

						<div class="testimonial mx-auto">
							<figure class="img-wrap">
								<img src="images/person_3.jpg" alt="Image" class="img-fluid">
							</figure>
							<h3 class="name">Lukas Devlin</h3>
							<blockquote>
								<p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
							</blockquote>
						</div>

            <div class="testimonial mx-auto">
							<figure class="img-wrap">
								<img src="images/person_3.jpg" alt="Image" class="img-fluid">
							</figure>
							<h3 class="name">Lukas Devlin</h3>
							<blockquote>
								<p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
							</blockquote>
						</div>

            <div class="testimonial mx-auto">
							<figure class="img-wrap">
								<img src="images/person_3.jpg" alt="Image" class="img-fluid">
							</figure>
							<h3 class="name">Lukas Devlin</h3>
							<blockquote>
								<p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
							</blockquote>
						</div>

						<div class="testimonial mx-auto">
							<figure class="img-wrap">
								<img src="images/person_4.jpg" alt="Image" class="img-fluid">
							</figure>
							<h3 class="name">Kayla Bryant</h3>
							<blockquote>
								<p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
							</blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-lg-6">
					<h2 class="section-title text-center mb-3">最新投稿</h2>
					<h4>讓您快速掌握東京最新的餐廳資訊!</h4>
				</div>
			</div>
			<div class="row">
			<?php
				$cmd = "SELECT * FROM `restaurant_info` ORDER BY `id` DESC LIMIT 8";
				$stmt=$dbpdo->prepare($cmd);
				$stmt->execute();
				$result_new = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($result_new as $k=>$v){
				?>
					<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
						<div class="media-1">
							<a href="./view/restaurant_detail.php?rID=<?=$v['id']?>" class="d-block mb-3">
								<?php 
								if($v['index_image']!=""){
								?>
									<img src="<?=$v['index_image']?>" alt="Image" class="img-fluid">
								<?php }else{ ?>
									<img src="./images/image_prepare.jpg" alt="Image" class="img-fluid">
									<img src="../images/detail/yoroniku_1.jpg" alt="Image" class="img-fluid">
								<?php } ?>
							</a>
							<span class="d-flex align-items-center loc mb-2">
								<span class="icon-room mr-3"></span>
								<span><?=$v['area']?></span>
							</span>
							<div class="d-flex align-items-center">
								<div>
									<h3><a href="./view/restaurant_detail.php?rID=<?=$v['id']?>"><?=$v['name']?></a></h3>
									<div class="price ml-auto">
										<span><?=$v['access']?></span>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center">
								<div>
									<div class="ml-auto">
										<p>
											<?php if($v['link']!=""){ ?>
												<a href="<?=$v['link']?>" target="_blank">前往餐廳網站</a>
											<?php 
											}else{
												echo "暫無網站";
											}?>
										</p>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center">
								<div>
									<div class="price ml-auto">
										<p>更新時間：<?=date("Y/m/d",strtotime($v['creat_date']))?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
			?>
			</div>
		</div>
	</div>	
	
	<div class="py-5 cta-section">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<h2 class="mb-2 text-white">歡迎探索各樣的餐廳</h2>
					<p class="mb-4 lead text-white text-white-opacity">下次去東京想要吃什麼呢?</p>
					<p class="mb-0"><a href="booking.html" class="btn btn-outline-white text-white btn-md font-weight-bold">查看更多餐廳</a></p>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('./view/footer.php'); ?>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.fancybox.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/daterangepicker.js"></script>
	<script src="js/typed.js"></script>
	<script>
		$(function() {
			var slides = $('.slides'),
			images = slides.find('img');

			images.each(function(i) {
				$(this).attr('data-id', i + 1);
			})

			var typed = new Typed('.typed-words', {
				strings: ["六本木","丸の內","表参道", "渋谷", "銀座"],
				typeSpeed: 80,
				backSpeed: 80,
				backDelay: 4000,
				startDelay: 1000,
				loop: true,
				showCursor: true,
				preStringTyped: (arrayPos, self) => {
					arrayPos++;
					// console.log(arrayPos);
					$('.slides img').removeClass('active');
					$('.slides img[data-id="'+arrayPos+'"]').addClass('active');
				}
			});
		})
	</script>
	<script src="js/custom.js"></script>
</body>
</html>
<script>
	function search_check(){
		var check_area =$('#area').val();
    var check_category = $('#category').val();
    var check_price_range = $('#price_range').val();

    if(check_area=="" && check_category=="" && check_price_range==""){
      alert("請輸入搜尋條件");
      return false;
    }
	}
</script>

<h3>最新投稿</h3>
<table width="100%" border="1" cellpadding="0" style="border-collapse: collapse;">
  <tr>
    <td width="100px" align="center">更新時間</td> 
    <td width="250px" align="center">店名</td>
    <td width="180px" align="center">區域</td>
    <td width="100px" align="center">地點</td>
    <td width="120px" align="center">分類</td>
    <td width="150px" align="center">交通</td>
    <td width="60px" align="center">網站</td>
    <td align="center">備註</td>
    <td width="80px" align="center">詳細資訊</td>
  </tr>
  <?php
  $cmd = "SELECT * FROM `restaurant_info` ORDER BY `id` DESC LIMIT 9";
  $row_new=$dbpdo->prepare($cmd);
  $row_new->execute();
  foreach($row_new as $k=>$v){
  ?>
    <tr height="50px">
      <td><?=date("Y/m/d",strtotime($v['creat_date']))?></td>
      <td><?=$v['name']?></td>
      <td align="center"><?=$v['area']?></td>
      <td align="center"><?=$v['location']?></td>
      <td align="center"><?=$v['category']?></td>
      <td align="center"><?=$v['access']?></td>
      <td align="center">
        <?php if($v['link']!=""){ ?>
        <a href="<?=$v['link']?>" target="_blank">前往</a>
        <?php 
        }else{
          echo "暫無<br>網站";
        }?>
      </td>
      <td><?=nl2br($v['memo'])?></td>
      <td align="center"><a href="./view/restaurant_detail.php?rID=<?=$v['id']?>">查看</a></td>
    </tr>
  <?php
  }
  ?>
</table>
<table width="100%">
  <tr>
    <td><a type="button" href="./view/creat_list.php">新增餐廳</a></td>
  </tr>
</table>
