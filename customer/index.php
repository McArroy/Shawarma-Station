<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>SHAWARMA STATION</title>
		<link rel="icon" type="image/x-icon" href="/resources/imgs/shawarma_station_logo_transparent.png">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function()
			{
				var hashVersion = 18248299128239300101;

				$("html head").append("<link rel='stylesheet' href='/resources/css/style.css?hash=" + hashVersion + "'>");
				$("html head").append("<link rel='stylesheet' href='/resources/css/style-responsive.css?hash=" + hashVersion + "'>");
				$("html body").append("<script src='/resources/js/script.js?hash=" + hashVersion + "'/>");
			});
		</script>
	</head>

	<body>
		<header>
			<a href="/" class="logo" title="Shawarma Station">
				<img src="/resources/imgs/shawarma_station_logo_transparent.png" alt="shawarma_station_logo_transparent">
			</a>
			<div class="container">
				<a href="/#home" title="Beranda">BERANDA</a>
				<a href="/#menu?query=foods" title="Menu">MENU</a>
				<a href="/#contact" title="Kontak Kami">KONTAK</a>
			</div>
			<a class="menu-icon" title="Menu">
				<svg viewBox="0 0 464.205 464.205" width="512" xmlns="http://www.w3.org/2000/svg">
					<path d="m435.192 406.18h-406.179c-16.024 0-29.013-12.99-29.013-29.013s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.99 29.013 29.013-.001 16.023-12.99 29.013-29.014 29.013z"></path>
					<path d="m435.192 261.115h-406.179c-16.024 0-29.013-12.989-29.013-29.012s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.012-29.014 29.012z"></path>
					<path d="m435.192 116.051h-406.179c-16.024 0-29.013-12.989-29.013-29.013s12.989-29.013 29.013-29.013h406.18c16.023 0 29.013 12.989 29.013 29.013s-12.99 29.013-29.014 29.013z"/>
				</svg>
			</a>
		</header>

		<div class="page-contents">
			<div class="home">
				<div class="left">
					<div class="title">
						<span>SHAWARMA<br>STATION</span>
						<span>KHAS TIMUR TENGAH</span>
					</div>
					<a href="/#menu?query=foods" class="button menu" title="Menu">
						MENU
						<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="m22.707 11.293-7-7a1 1 0 0 0 -1.414 1.414l5.293 5.293h-17.586a1 1 0 0 0 0 2h17.586l-5.293 5.293a1 1 0 1 0 1.414 1.414l7-7a1 1 0 0 0 0-1.414z"></path>
						</svg>
					</a>
					<a href="https://wa.me/6288901196963" class="button whatsapp hidden" target="_blank" title="Hubungi kami melalui WhatsApp">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
						</svg>
						HUBUNGI KAMI
					</a>
				</div>
				<div class="right">
					<img src="/resources/imgs/ellipse.png?v=1.0.0" alt="ellipse">
					<img src="/resources/imgs/default_kebab.png?v=1.0.0" alt="default_kebab">
				</div>
			</div>

			<div class="about">
				<div class="left">
					<img src="/resources/imgs/about.png?v=1.0.0" alt="about_shawarma_station">
				</div>
				<div class="right">
					<div class="title">KENAPA SHAWARMA<br>STATION?</div>
					<img src="/resources/imgs/about.png?v=1.0.0" alt="about_shawarma_station">
					<div class="description">Shawarma Station adalah sebuah usaha makanan cepat saji yang fokus pada penjualan shawarma, yang mengutamakan kualitas dan kepuasan pelanggan. Berdiri sejak 2021, Shawarma Station terus berkembang secara signifikan serta beroperasi hingga saat ini.</div>
				</div>
			</div>

			<div class="best-menu">
				<div class="title">
					<div class="text">BEST MENU SHAWARMA</div>
					<div class="line"></div>
				</div>
				<div class="contents">
					<div class="contents-cards">
						<div class="card">
							<div class="image-container">
								<img src="/resources/imgs/menus/beef_shawarma.png?v=1.0.0" alt="beef_shawarma">
							</div>
							<div class="text">Beef Shawarma</div>
						</div>
						<div class="card">
							<div class="image-container">
								<img src="/resources/imgs/menus/chicken_shawarma.png?v=1.0.0" alt="chicken_shawarma">
							</div>
							<div class="text">Chicken Shawarma</div>
						</div>
						<div class="card">
							<div class="image-container">
								<img src="/resources/imgs/menus/chicken_rice_mandhi.png?v=1.0.0" alt="chicken_rice_mandhi">
							</div>
							<div class="text">Chicken Rice Mandhi</div>
						</div>
					</div>
					<a href="/#menu?query=foods" class="button" title="Lihat menu lainnya">
						MENU LAINNYA
						<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="m22.707 11.293-7-7a1 1 0 0 0 -1.414 1.414l5.293 5.293h-17.586a1 1 0 0 0 0 2h17.586l-5.293 5.293a1 1 0 1 0 1.414 1.414l7-7a1 1 0 0 0 0-1.414z"></path>
						</svg>
					</a>
				</div>
			</div>

			<div class="page-menu hidden">
				<div class="title">MENU</div>
				<div class="selections">
					<a href="/#menu?query=foods" class="button button-foods button-selected" title="Makanan">
						Makanan
						<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
							<path d="m29.6043 10.528-12.0735 12.8281c-.83.8819-2.2315.8819-3.0615 0l-12.0736-12.8281c-.9071-.9639-.2238-2.5455 1.0998-2.5455h25.0089c1.3237 0 2.007 1.5816 1.0999 2.5455z"></path>
						</svg>
					</a>
					<a href="/#menu?query=drinks" class="button button-drinks button-unselected" title="Minuman">Minuman</a>
				</div>
				<div class="container">
					<div class="sub-selections hidden">
						<a href="/#menu?query=foods&subtype=1" id="foods-subtype-button-1" class="button button-foods button-unselected" title="Package">Package</a>
						<a href="/#menu?query=foods&subtype=2" id="foods-subtype-button-2" class="button button-foods button-unselected" title="Sandwich">Sandwich</a>
						<a href="/#menu?query=foods&subtype=3" id="foods-subtype-button-3" class="button button-foods button-unselected" title="Side Orders">Side Orders</a>
						<a href="/#menu?query=foods&subtype=4" id="foods-subtype-button-4" class="button button-foods button-unselected" title="Burger & Hotdog">Burger & Hotdog</a>
					</div>
				</div>

				<div class="contents-card">
					<div class="class-foods">
					</div>

					<div class="class-drinks">
					</div>
				</div>
			</div>
		</div>

		<footer>
			<div class="contents">
				<div class="about">
					<p class="title">SHAWARMA STATION</p>
					<p>Jln. Achmad Adnawijaya, No.87, RT.02/RW.16, Tegal Gundil, Bogor Utara, Kota Bogor, Jawa Barat, 16152</p>
					<a href="https://wa.me/6288901196963" class="button" target="_blank" title="Hubungi kami melalui WhatsApp">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
						</svg>
						0889-0119-6963
					</a>
					<a href="https://www.instagram.com/shawarmastationbogor/" class="button" target="_blank" title="Hubungi kami melalui Instagram">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
						</svg>
						@shawarmastationbogor
					</a>
					<a href="mailto:yunishameer@gmail.com" class="button" target="_blank" title="Hubungi kami melalui Email">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path d="M64 112c-8.8 0-16 7.2-16 16l0 22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1l0-22.1c0-8.8-7.2-16-16-16L64 112zM48 212.2L48 384c0 8.8 7.2 16 16 16l384 0c8.8 0 16-7.2 16-16l0-171.8L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64l384 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128z"></path>
						</svg>
						yunishameer@gmail.com
					</a>
				</div>
				<div class="menu">
					<p class="title">INFORMASI</p>
					<a href="/#home" class="button" title="Beranda">Beranda</a>
					<a href="/#menu?query=foods" class="button" title="Menu">Menu</a>
					<a href="/#contact" class="button" title="Kontak Kami">Kontak</a>
				</div>
				<div class="online-order">
					<p class="title">PEMESANAN ONLINE</p>
					<a href="https://r.grab.com/g/6-20241020_074706_f2a1a56ce5297a0c_MEXMPS-6-C3CKGP6BNENGEE" class="button" target="_blank" title="Pesan melalui GrabFood">
						<img src="/resources/imgs/grabfood_logo.png?v=1.0.0" alt="grabfood_logo">
					</a>
					<a href="https://gofood.link/a/Bxx6r8W" class="button" target="_blank" title="Pesan melalui GoFood">
						<img src="/resources/imgs/gofood_logo.png?v=1.0.0" alt="gofood_logo">
					</a>
				</div>
			</div>
		</footer>

		<script>
			$(document).ready(function()
			{
				$.ajax(
				{
					url: "ajax.php",
					type: "GET",
					data:
					{
						method: "ajax_request"
					},
					success: function(data)
					{
						data.forEach(function(product)
						{
							var productClass = product.product_type === 1 ? ".class-foods" : ".class-drinks";
							
							var subtypeClass = "";

							// Determine the subtype class based on product_subtype
							if (product.product_subtype === 1)
								subtypeClass = "foods-subtypes-package";
							else if (product.product_subtype === 2)
								subtypeClass = "foods-subtypes-sandwich";
							else if (product.product_subtype === 3)
								subtypeClass = "foods-subtypes-sideorders";
							else if (product.product_subtype === 4)
								subtypeClass = "foods-subtypes-burgers";

							// Check if description exists, and create HTML if available
							var descriptionHTML = product.product_description ? `<div class="description">${product.product_description}</div>` : "";

							// Construct the HTML for each product
							var productHTML = `
								<div class="card ${subtypeClass}">
									<div class="image-container">
										<img src="https://shawarma-station-admin.rf.gd/imgs/menus/${product.product_img}" alt="${product.product_name}">
									</div>
									<div class="text">
										${product.product_name}
										${descriptionHTML}
										<div class="line"></div>
										<div class="price">Rp${product.product_price.toLocaleString()}</div>
									</div>
								</div>
							`;

							// Append the product HTML to the correct category
							$(`body .page-contents .page-menu .contents-card ${productClass}`).append(productHTML);
						});
					}
				});
			});
		</script>
	</body>
</html>