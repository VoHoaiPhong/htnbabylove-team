@extends('master')

@section('content')
<div class="container">
	<div id="content" class="content-product-link">
		<div class="row">
			<div class="col-sm-12" id="bar-prodduct">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
						<li class="breadcrumb-item"><a href="#">Quần áo bé gái</a></li>
						<li class="breadcrumb-item"><a href="#">Đồ bộ bé gái</a></li>
						<li class="breadcrumb-item active" aria-current="page">Bộ voan bé gái trễ vai họa tiết hoa xinh xắn (9 tháng - 9 tuổi)</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div id="content" >
		<div class="row" id="content-product-details">
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-4" id="show-images">
						<img src="plugin/images/product_1.jpg" style="width:100%" onclick="openModal();currentSlide(1)" alt="">
						<!-- <h2 style="text-align:center">Lightbox</h2> -->
						<div class="img-mini">
							<div class="row">
								<div class="column">
									<img src="plugin/images/img1.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
								</div>
								<div class="column">
									<img src="plugin/images/img2.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
								</div>
								<div class="column">
									<img src="plugin/images/img3.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
								</div>
								<div class="column">
									<img src="plugin/images/img4.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
								</div>
							</div>
						</div>
						<div id="modal-img-mini" class="modal-img-mini">
							<span class="close cursor" onclick="closeModal()">&times;</span>
							<div class="modal-content">
								<div class="slide-img-mini">
									<div class="numbertext">1 / 4</div>
									<img src="plugin/images/img1_wide.jpg" style="width:100%">
								</div>

								<div class="slide-img-mini">
									<div class="numbertext">2 / 4</div>
									<img src="plugin/images/img2_wide.jpg" style="width:100%">
								</div>

								<div class="slide-img-mini">
									<div class="numbertext">3 / 4</div>
									<img src="plugin/images/img3_wide.jpg" style="width:100%">
								</div>

								<div class="slide-img-mini">
									<div class="numbertext">4 / 4</div>
									<img src="plugin/images/img4_wide.jpg" style="width:100%">
								</div>

								<a style="color: #288AD6" class="prev" onclick="plusSlides(-1)">&#10094;</a>
								<a style="color: #288AD6" class="next" onclick="plusSlides(1)">&#10095;</a>

								<div class="caption-container">
									<p id="caption"></p>
								</div>

								<div class="row" id="bg-modal-product">
									<div class="column">
										<img class="demo cursor" src="plugin/images/img1_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
									</div>
									<div class="column">
										<img class="demo cursor" src="plugin/images/img2_wide.jpg" style="width:100%" onclick="currentSlide(2)" alt="Trolltunga, Norway">
									</div>
									<div class="column">
										<img class="demo cursor" src="plugin/images/img3_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
									</div>
									<div class="column">
										<img class="demo cursor" src="plugin/images/img4_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
									</div>
								</div>
							</div>
						</div>
						<!-- </div> -->

						<script>
							function openModal() {
								document.getElementById('modal-img-mini').style.display = "block";
							}

							function closeModal() {
								document.getElementById('modal-img-mini').style.display = "none";
							}

							var slideIndex = 1;
							showSlides(slideIndex);

							function plusSlides(n) {
								showSlides(slideIndex += n);
							}

							function currentSlide(n) {
								showSlides(slideIndex = n);
							}

							function showSlides(n) {
								var i;
								var slides = document.getElementsByClassName("slide-img-mini");
								var dots = document.getElementsByClassName("demo");
								var captionText = document.getElementById("caption");
								if (n > slides.length) {slideIndex = 1}
									if (n < 1) {slideIndex = slides.length}
										for (i = 0; i < slides.length; i++) {
											slides[i].style.display = "none";
										}
										for (i = 0; i < dots.length; i++) {
											dots[i].className = dots[i].className.replace(" active", "");
										}
										slides[slideIndex-1].style.display = "block";
										dots[slideIndex-1].className += " active";
										captionText.innerHTML = dots[slideIndex-1].alt;
									}
								</script>
							</div>
							<div class="col-sm-8">
								<form action="" method="POST" accept-charset="utf-8">
									<div class="single-item-body">
										<h2>Bộ voan bé gái trễ vai họa tiết hoa xinh xắn (9 tháng - 9 tuổi)</h2>
										<p class="summary-product">Bộ trễ vai cho bé gái họa tiết hoa dễ thương - Chất liệu voan cát mềm nhẹ nhàng, thoáng mát giúp bé thật thoải mái khi vui chơi hay đi học.</p><hr/>
										<p class="single-item-price">
											<span class="present-price">150.000 đ</span>
										</p>
										<div class="select-size-product">
											<label  class="choose-size">Chọn kích cỡ:&nbsp;<i class="fa fa-question-circle" id="color-icon" data-toggle="tooltip" data-placement="top" title="Chọn size quần áo cho bé"></i></label><br/>       
											<select style="float: left;" data-babi-option-type="S" data-babi-option-name="Chọn kích cỡ" name="" class="select-size">                                    
												<option value="165730" selected="">8.5 - 10.5kg 
												</option>
												<option value="1011">10 - 11.5kg 
												</option>
												<option value="1113">11.5 - 13.5kg 
												</option>
												<option value="1315">13.5 - 15kg 
												</option>
												<option value="1517">15 - 17kg 
												</option>
												<option value="1720">17 - 20kg 
												</option>
												<option value="2023">20 - 23kg 
												</option>
												<option value="2326">23 - 26kg 
												</option>
												<option value="2630">26 - 30kg 
												</option>
												<option value="3035">30 - 35kg 
												</option>
											</select>
											<div class="space30">&nbsp;</div>
											<label class="choose-qty">Chọn số lượng:&nbsp;<i class="fa fa-question-circle" id="color-icon" data-toggle="tooltip" data-placement="top" title="Chọn số lượng bạn muốn mua"></i></label><br/>
											<select class="select-qty" name="qty-product" id="qty_count">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
											
											<div class="add-cart-block">
												<div class="row">
													<div class="col-sm-5">
														<div class="add-cart-button">
															<a href=""><button class="add-to-cart">
																<span class="text"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</span>
															</button></a>
														</div>
													</div>
													<div class="col-sm-5">
														<div class="buy-now-button">
															<a href=""><button class="buy-now-item">
																<span class="text"><i class="far fa-money-bill-alt"></i> Mua Ngay</span>
															</button></a>
														</div>
													</div>	
												</div>

											</div>
											<div class="flash"></div>
											<div class="product-note">
												<h3>Thông Tin & Khuyến Mãi</h3>
												<ul>
													<li>- <span style="font-weight: 400;">KHUYẾN MÃI :</span> nhận <span style="color: #DC2684">bao lì xì may mắn</span> khi mua các sản phẩm tại cửa hàng <a href="">Xem chi tiết!</a></li>
													<li>- Mua Áo dài Tết cho bé xúng xính ngày Tết. <a href="">Xem ngay!</a></li>
												</ul>
											</div>
										</div>

										<div class="clearfix"></div>
										<!-- <div class="space20">&nbsp;</div>	 -->
									</div>
									<!-- <div class="space20">&nbsp;</div> -->
								</form>
							</div>
						</div>

						<div class="space40">&nbsp;</div>
						<div class="woocommerce-tabs">
							<div class="title-of-product">
								<h5 class="title-intro-product">Chi Tiết Sản Phẩm</h5>
							</div>

							<div class="panel" id="tab-description">
								<p class="intro-product">Bộ đồ bé gái xinh xắn này được thiết kế kiểu trễ vai hiện đại, trẻ trung chắc chắn sẽ là lựa chọn hoàn hảo cho bé yêu dịp hè thu này. Sản phẩm đã có tại Shop, ba mẹ ghé xem ngay nhé! </p>
								<div class="img-product-show">
									<img src="plugin/images/quanao1.jpg"/>
								</div>
								<div class="img-product-show">
									<img src="plugin/images/quanao2.jpg"/>
								</div>
								<div class="img-product-show">
									<img src="plugin/images/quanao3.jpg"/>
								</div>
								<div class="img-product-show">
									<img src="plugin/images/quanao4.jpg"/>
								</div>

							</div>
						</div>
						<!-- <div class="space50">&nbsp;</div> -->
						<hr>
						<div class="content-rate-product">
							<div class="title-rate">
								<div class="title">
									<h3>15 Đánh giá sản phẩm abc</h3>
								</div>
								<div class="go-to-rate">
									<!-- <a href="#text-comment">Gửi đánh giá của bạn</a> -->
									<!-- Button to Open the Modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
										Gửi đánh giá của bạn
									</button>

									<form action="#" method="post">
										<!-- The Modal -->
										<div class="modal fade" id="myModal">
											<div class="modal-dialog">
												<div class="modal-content">

													<!-- Modal Header -->
													<div class="modal-header">
														<!--                            <button type="button" class="close" data-dismiss="modal">&times;</button>-->
														<div class="check-star-feed-back">
															<h2>Đánh giá sản phẩm</h2>
															<section class='rating-widget'>
																<!-- Rating Stars Box -->
																<div class="rate-feed-back clearfix">
																	<div class='rating-stars'>
																		<ul id='stars' style="cursor: pointer">
																			<li class='star' title='Poor' data-value='1'>
																				<i class="fas fa-star"></i>
																			</li>
																			<li class='star' title='Fair' data-value='2'>
																				<i class="fas fa-star"></i>
																			</li>
																			<li class='star' title='Good' data-value='3'>
																				<i class="fas fa-star"></i>
																			</li>
																			<li class='star' title='Excellent' data-value='4'>
																				<i class="fas fa-star"></i>
																			</li>
																			<li class='star' title='WOW!!!' data-value='5'>
																				<i class="fas fa-star"></i>
																			</li>
																		</ul>
																	</div>
																	<div class='success-box'>
																		<div class="text-message"></div>
																	</div>
																</div>
															</section>
														</div>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>

													<!-- Modal body -->
													<div class="modal-body">
														<h3 id="change-feed-back">Viết đánh giá của bạn</h3>
														<div class="content-feed-back row clearfix">
															<div class="radio col-sm-12 gender-feedback">
																<label><input type="radio" name="gender" checked>Anh</label>
																<label><input type="radio" name="gender">Chị</label>
															</div>

															<div class="info-feedback col-sm-12">
																<div class="row">
																	<label class="col-md-4 col-xs-12">Họ tên:</label>
																	<input class="col-md-8 col-xs-12" type="text" placeholder="Bắt buộc" name="name">
																	<label class="col-md-4 col-xs-12">Số điện thoại:</label>
																	<input class="col-md-8 col-xs-12" type="tel" placeholder="Bắt buộc" name="phone">
																	<label class="col-md-4 col-xs-12">Email:</label>
																	<input class="col-md-8 col-xs-12" type="email" placeholder="abc@efg.xyz,..." name="email">
																	<input class="col-md-8 col-xs-12" type="hidden" name="time" value="#">
																	<br> <textarea class="col-xs-12" id="cmt" rows="5" placeholder="Điều gì làm bạn không thích?"></textarea>
																</div>

															</div>
														</div>
													</div>

													<!-- Modal footer -->
													<div class="modal-footer">
														<div class="btn-feed-back">
															<button class="send-fb" data-dismiss="modal" type="button">
																Hủy
															</button>
														</div>
														<div class="btn-feed-back">
															<input class="send-fb" type="submit" value="Gửi">
														</div>

													</div>

												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="content-rate">
								<div class="name-user">
									<span>Đỗ Thị Thu Yến</span>
								</div>
								<div class="time-post">
									<span>18:22 | 17/01/2018</span>
								</div>
								<div class="star-rate">
									<div class="start-sum">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<div class="comment">
										<p>Bộ đồ nó mới đẹp làm sao. Sẽ ủng hộ shop vì giá mềm đồ lại tốt.</p>
									</div>
								</div>
							</div>
							<div class="content-rate">
								<div class="name-user">
									<span>Đỗ Thị Thu Yến</span>
								</div>
								<div class="time-post">
									<span>18:22 | 17/01/2018</span>
								</div>
								<div class="star-rate">
									<div class="start-sum">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<div class="comment">
										<p>Bộ đồ nó mới đẹp làm sao. Sẽ ủng hộ shop vì giá mềm đồ lại tốt.</p>
									</div>
								</div>
							</div>
							<div class="content-rate">
								<div class="name-user">
									<span>Đỗ Thị Thu Yến</span>
								</div>
								<div class="time-post">
									<span>18:22 | 17/01/2018</span>
								</div>
								<div class="star-rate">
									<div class="start-sum">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="far fa-star"></i>
									</div>
									<div class="comment">
										<p>Bộ đồ nó mới đẹp làm sao. Sẽ ủng hộ shop vì giá mềm đồ lại tốt.</p>
									</div>
								</div>
							</div>
							<div class="pagination-comment">
								<div class="row" id="frame-paging">
									<nav aria-label="Page navigation example">
										<ul class="pagination">
											<li class="page-item">
												<a class="page-link" href="#" aria-label="Previous">
													<span aria-hidden="true">«</span>
													<span class="sr-only">Previous</span>
												</a>
											</li>
											<li class="page-item"><a class="page-link" href="#">1</a></li>
											<li class="page-item disabled" ><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item">
												<a class="page-link" href="#" aria-label="Next">
													<span aria-hidden="true">»</span>
													<span class="sr-only">Next</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>	
							</div>
							<hr>
							<div class="text-comment" id="text-comment">
								
							</div>
						</div>
						<div class="related-product">
							<div class="banner-related-product">
								<!-- <h4>Sản Phẩm Cùng Loại</h4> -->
								<img src="plugin/images/banner-related-product.png"/>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="plugin/images/bo-ghile-cho-be-gai-sanh-dieu.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><a href="">Bộ vest cho bé gái sành điệu</a></p>
											<p class="single-item-price">
												<span>165.000 đ</span>
											</p>
										</div>
										<div class="single-item-click-by">
											<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
										</div>
										<div class="single-item-add-to-cart">
											<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img src="plugin/images/bo-ghile-cho-be-gai-sanh-dieu.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><a href="">Bộ vest cho bé gái sành điệu</a></p>
											<p class="single-item-price">
												<span>165.000 đ</span>
											</p>
										</div>
										<div class="single-item-click-by">
											<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
										</div>
										<div class="single-item-add-to-cart">
											<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

										<div class="single-item-header">
											<a href="#"><img src="plugin/images/bo-ghile-cho-be-gai-sanh-dieu.jpg" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><a href="">Bộ vest cho bé gái sành điệu</a></p>
											<p class="single-item-price">
												<span class="flash-del">165.000 đ</span>
												<span class="flash-sale">159.000 đ</span>
											</p>
										</div>
										<div class="single-item-click-by">
											<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
										</div>
										<div class="single-item-add-to-cart">
											<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- .beta-products-list -->
						<hr>
					</div>
					<div class="col-sm-3 aside">
						<div class="widget">
							<h3 class="widget-title">Sản Phẩm Bán Chạy Nhất</h3>
							<div class="widget-body">
								<div class="beta-sales beta-lists">
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/aosomi.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo sơ mi caro cho bé từ 1-8 màu xanh rêu</a>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/aosomi.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo sơ mi caro cho bé từ 1-8 màu xanh rêu</a>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/aosomi.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo sơ mi caro cho bé từ 1-8 màu xanh rêu</a>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/aosomi.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo sơ mi caro cho bé từ 1-8 màu xanh rêu</a>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- best sellers widget -->
						<div class="widget">
							<h3 class="widget-title">Sản Phẩm Mới Nhất</h3>
							<div class="widget-body">
								<div class="beta-sales beta-lists">
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/ao_dai_rong_kem_hoa_van.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo dài rồng kèm hoa văn cho bé trai màu đỏ</a><br/>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/ao_dai_rong_kem_hoa_van.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo dài rồng kèm hoa văn cho bé trai màu đỏ</a><br/>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/ao_dai_rong_kem_hoa_van.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo dài rồng kèm hoa văn cho bé trai màu đỏ</a><br/>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
									<div class="media beta-sales-item">
										<a class="pull-left" href="product.html"><img src="plugin/images/ao_dai_rong_kem_hoa_van.jpg" alt=""></a>
										<div class="media-body">
											<a href="">Áo dài rồng kèm hoa văn cho bé trai màu đỏ</a><br/>
											<span class="beta-sales-price">142.000 đ</span>
											<div class="single-item-click-by">
												<a href="" class="click-by"><i class="far fa-money-bill-alt"></i> Mua Ngay</a>
											</div>
											<div class="single-item-add-to-cart">
												<a href="" class="ad-to-cart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- best sellers widget -->
					</div>
				</div>
			</div> <!-- #content -->
		</div> <!-- .container -->

		<script>
			function openModal() {
				document.getElementById('modal-img-mini').style.display = "block";
			}

			function closeModal() {
				document.getElementById('modal-img-mini').style.display = "none";
			}

			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
				showSlides(slideIndex += n);
			}

			function currentSlide(n) {
				showSlides(slideIndex = n);
			}

			function showSlides(n) {
				var i;
				var slides = document.getElementsByClassName("slide-img-mini");
				var dots = document.getElementsByClassName("demo");
				var captionText = document.getElementById("caption");
				if (n > slides.length) {slideIndex = 1}
					if (n < 1) {slideIndex = slides.length}
						for (i = 0; i < slides.length; i++) {
							slides[i].style.display = "none";
						}
						for (i = 0; i < dots.length; i++) {
							dots[i].className = dots[i].className.replace(" active", "");
						}
						slides[slideIndex-1].style.display = "block";
						dots[slideIndex-1].className += " active";
						captionText.innerHTML = dots[slideIndex-1].alt;
					}
				</script>


				<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
	jQuery(document).ready(function() {
		var offset = 220;
		var duration = 500;
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() > offset) {
				jQuery('.back-to-top').fadeIn(duration);
			} else {
				jQuery('.back-to-top').fadeOut(duration);
			}
		});

		jQuery('.back-to-top').click(function(event) {
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, duration);
			return false;
		})
	});
</script>
@endsection