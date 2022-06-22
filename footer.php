<?php
$footer = get_field('footer', 'option');
$header = get_field('header', 'option');
?>
</div>
<div class="modal" id="price-modal">
	<div class="modal-wrapper">
		<div class="modal-content">
			<span></span>
		</div>
		<div class="modal-close has-icon"></div>
	</div>
</div>
<meta name="format-detection" content="telephone=no">
<footer class="footer desktop-footer">
	<div class="row no-gutters  pb-0 pt-5 pr-0 pl-0  maxWidth mr-auto ml-auto mob-shopping-page">
		<div class="col-12 mx-auto">
			<div class="footer-row row mb-0 mb-md-5">
				<div class="d-none d-md-inline-block col-3 buy-link">
					<div class="footer-header">
						<?php echo $footer['title'] ?>
					</div>
					<ul>

						<?php
						foreach ($footer['menu-1'] as $item) {
						?>
							<li class="col-6"><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></li>
						<?php
						}
						?>

						<li class="col-6 center-fa instagram-btn">
							<a class="social" href="<?php echo $footer['instagram'] ?>"><i class="fa fa-instagram footer-fa"><span>اینستاگرام</span></i></a>
						</li>



						<li class="col-3 center-fa mob-instagram-btn">
							<a class="social" href="<?php echo $footer['instagram'] ?>"><i class="fa fa-instagram footer-fa"></i></a>
						</li>

						<li class="col-3 center-fa mob-telegram-btn">
							<a class="social" href="<?php echo $footer['telegram'] ?>"><i class="fa fa-telegram footer-fa"></i></a>
						</li>

						<li class="col-3 center-fa mob-whatsapp-btn">
							<a class="social" href="<?php echo $footer['whatsapp'] ?>"><i class="fa fa-whatsapp footer-fa">

								</i></a>
						</li>
						<li class="col-3 center-fa mob-twitter-btn">
							<a class="social" href="<?php echo $footer['twitter'] ?>"><i class="fa fa-twitter footer-fa">
								</i></a>
						</li>

					</ul>
				</div>
				<div class="d-none d-md-inline-block col-3">
					<div class="footer-header">
						دسترسی سریع
					</div>
					<ul class="row pr-4 pl-4">
						<?php
						foreach ($footer['menu-2'] as $item) {
						?>
							<li class="col-4"><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></li>
						<?php
						}
						?>

						<li class="col-12 center-fa telegram-btn">
							<a class="social" href="<?php echo $footer['telegram'] ?>"><i class="fa fa-telegram footer-fa"><span>تلگرام</span></i></a>
						</li>

					</ul>
				</div>
				<div class="d-none d-md-inline-block col-3">
					<div class="footer-header">
						پشتیبانی
					</div>
					<ul class="footer-row support row">
						<li class="col-12 center-fa">
							<i class="fa fa-phone-volume footer-fa"></i>
							<?php echo 'پشتیبانی تلفنی' . ' ' . $footer['tel'] ?>
						</li>
						<li class="col-12 center-fa">
							<i class="fa fa-envelope footer-fa"></i>
							ایمیل:<a class="social" rel="nofollow" href="mailto:<?php echo $footer['email'] ?>"><?php echo $footer['email'] ?></a>
						</li>
						<li class="col-12 center-fa">
							<i class="fa fa-telegram footer-fa"></i>
							تلگرام<a href="<?php echo $footer['telegram'] ?>" rel="nofollow" class="social"><?php echo $footer['telegram-id'] ?></a>
						</li>


						<li class="col-12 center-fa whatsapp-btn">
							<a class="social" rel="nofollow" href="<?php echo $footer['whatsapp'] ?>"><i class="fa fa-whatsapp footer-fa">
									<span>واتس اپ</span>
								</i></a>
						</li>


					</ul>
				</div>
				<div class="d-none d-md-inline-block col-3">
					<div class="row">

						<div class="col">
							<img class="mr-4" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQwIiBoZWlnaHQ9IjM2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KCTxwYXRoIGQ9Im0xMjAgMjQzbDk0LTU0IDAtMTA5IC05NCA1NCAwIDEwOSAwIDB6IiBmaWxsPSIjODA4Mjg1Ii8+Cgk8cGF0aCBkPSJtMTIwIDI1NGwtMTAzLTYwIDAtMTE5IDEwMy02MCAxMDMgNjAgMCAxMTkgLTEwMyA2MHoiIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS13aWR0aDo1O3N0cm9rZTojMDBhZWVmIi8+Cgk8cGF0aCBkPSJtMjE0IDgwbC05NC01NCAtOTQgNTQgOTQgNTQgOTQtNTR6IiBmaWxsPSIjMDBhZWVmIi8+Cgk8cGF0aCBkPSJtMjYgODBsMCAxMDkgOTQgNTQgMC0xMDkgLTk0LTU0IDAgMHoiIGZpbGw9IiM1ODU5NWIiLz4KCTxwYXRoIGQ9Im0xMjAgMTU3bDQ3LTI3IDAtMjMgLTQ3LTI3IC00NyAyNyAwIDU0IDQ3IDI3IDQ3LTI3IiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2Utd2lkdGg6MTU7c3Ryb2tlOiNmZmYiLz4KCTx0ZXh0IHg9IjE1IiB5PSIzMDAiIGZvbnQtc2l6ZT0iMjVweCIgZm9udC1mYW1pbHk9IidCIFlla2FuJyIgc3R5bGU9ImZpbGw6IzI5Mjk1Mjtmb250LXdlaWdodDpib2xkIj7Yudi22Ygg2KfYqtit2KfYr9uM2Ycg2qnYtNmI2LHbjDwvdGV4dD4KCTx0ZXh0IHg9IjgiIHk9IjM0MyIgZm9udC1zaXplPSIyNXB4IiBmb250LWZhbWlseT0iJ0IgWWVrYW4nIiBzdHlsZT0iZmlsbDojMjkyOTUyO2ZvbnQtd2VpZ2h0OmJvbGQiPtqp2LPYqCDZiCDaqdin2LHZh9in24wg2YXYrNin2LLbjDwvdGV4dD4KPC9zdmc+ " alt="" onclick="window.open('https://ecunion.ir/verify/saatchico.com?token=<?php echo $footer['logo-1'] ?>', 'Popup','toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30')" style="cursor:pointer; width: 96px;height: 144px;">
						</div>
						<div class="col pt-2">
							<a href="https://trustseal.enamad.ir/Verify.aspx?id=<?php echo $footer['logo-2']["id"] ?>&p=<?php echo $footer['logo-2']["token"] ?>" id="<?php echo $footer['logo-2']["token"] ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.aspx.png" alt="">
							</a>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 p-5 pt-0 d-none d-md-inline-block">
						<h1>
							<?php echo $footer['title-1'] ?>
						</h1>
						<p>
							<?php echo $footer['desc'] ?>
						</p>
					</div>

				</div>
				<div class="row rules p-5 pt-0 col-12">
					<p class="col-12 col-md-10 mx-auto text-center"><?php echo $footer['copy'] ?>
					</p>
				</div>

			</div>
		</div>
	</div>
</footer>

<footer class="footer mob-footer">
	<div class="row no-gutters  pb-0 pt-5 pr-0 pl-0  maxWidth mr-auto ml-auto mob-shopping-page">
		<div class="col-12 mx-auto">
			<div class="footer-row row mb-0 mb-md-5">
				<div class="d-none d-md-inline-block col-3 buy-link">
					<div class="footer-header">
						<h1 class="text-sm">
							<?php echo $footer['title'] ?>
						</h1>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="row">
								<div class="col-12">
									<ul>
										<?php
										foreach ($footer['menu-1'] as $item) {
										?>
											<li class="col-6"><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="nemad col-12">
								<img class="mr-4" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQwIiBoZWlnaHQ9IjM2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KCTxwYXRoIGQ9Im0xMjAgMjQzbDk0LTU0IDAtMTA5IC05NCA1NCAwIDEwOSAwIDB6IiBmaWxsPSIjODA4Mjg1Ii8+Cgk8cGF0aCBkPSJtMTIwIDI1NGwtMTAzLTYwIDAtMTE5IDEwMy02MCAxMDMgNjAgMCAxMTkgLTEwMyA2MHoiIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS13aWR0aDo1O3N0cm9rZTojMDBhZWVmIi8+Cgk8cGF0aCBkPSJtMjE0IDgwbC05NC01NCAtOTQgNTQgOTQgNTQgOTQtNTR6IiBmaWxsPSIjMDBhZWVmIi8+Cgk8cGF0aCBkPSJtMjYgODBsMCAxMDkgOTQgNTQgMC0xMDkgLTk0LTU0IDAgMHoiIGZpbGw9IiM1ODU5NWIiLz4KCTxwYXRoIGQ9Im0xMjAgMTU3bDQ3LTI3IDAtMjMgLTQ3LTI3IC00NyAyNyAwIDU0IDQ3IDI3IDQ3LTI3IiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2Utd2lkdGg6MTU7c3Ryb2tlOiNmZmYiLz4KCTx0ZXh0IHg9IjE1IiB5PSIzMDAiIGZvbnQtc2l6ZT0iMjVweCIgZm9udC1mYW1pbHk9IidCIFlla2FuJyIgc3R5bGU9ImZpbGw6IzI5Mjk1Mjtmb250LXdlaWdodDpib2xkIj7Yudi22Ygg2KfYqtit2KfYr9uM2Ycg2qnYtNmI2LHbjDwvdGV4dD4KCTx0ZXh0IHg9IjgiIHk9IjM0MyIgZm9udC1zaXplPSIyNXB4IiBmb250LWZhbWlseT0iJ0IgWWVrYW4nIiBzdHlsZT0iZmlsbDojMjkyOTUyO2ZvbnQtd2VpZ2h0OmJvbGQiPtqp2LPYqCDZiCDaqdin2LHZh9in24wg2YXYrNin2LLbjDwvdGV4dD4KPC9zdmc+ " alt="" onclick="window.open('https://ecunion.ir/verify/saatchico.com?token=<?php echo $footer['logo-1'] ?>', 'Popup','toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30')" style="cursor:pointer; width: 96px;height: 144px;">
								<a href="https://trustseal.enamad.ir/Verify.aspx?id=<?php echo $footer['logo-2']["id"] ?>&p=<?php echo $footer['logo-2']["token"] ?>" id="<?php echo $footer['logo-2']["token"] ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.aspx.png" alt="">
								</a>

							</div>
						</div>
						<div class="col-12 mt-5">

							<ul>



								<li class="col-3 center-fa mob-instagram-btn">
									<a class="social" href="<?php echo $footer['instagram'] ?>"><i class="fa fa-instagram footer-fa"></i></a>
								</li>

								<li class="col-3 center-fa mob-telegram-btn">
									<a class="social" href="<?php echo $footer['telegram'] ?>"><i class="fa fa-telegram footer-fa"></i></a>
								</li>

								<li class="col-3 center-fa mob-whatsapp-btn">
									<a class="social" href="<?php echo $footer['whatsapp'] ?>"><i class="fa fa-whatsapp footer-fa">

										</i></a>
								</li>
								<li class="col-3 center-fa mob-twitter-btn">
									<a class="social" href="<?php echo $footer['twitter'] ?>"><i class="fa fa-twitter footer-fa">
										</i></a>
								</li>

							</ul>

						</div>
					</div>
					<div class="row rules">
						<p class="col-12 col-md-10 mx-auto text-center"><?php echo $footer['copy'] ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</footer>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/home.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/sweetalert.all.js"></script>


</body>

</html>