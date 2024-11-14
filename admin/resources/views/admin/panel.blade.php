<?php
	$isMenuOrderPage = ($_SERVER["REQUEST_URI"] === "/order");
	$isMenuHistoryPage = ($_SERVER["REQUEST_URI"] === "/history");
	$isMenuEditPage = ($_SERVER["REQUEST_URI"] === "/edit");

	use App\Http\Controllers\AdminController;
	use App\Models\Product;
	use App\Models\Customer;
	use App\Models\CustomerBills;
	use App\Models\CustomerOrder;

	$adminController = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config("app.name") }}</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('imgs/shawarma_station_logo_transparent.png') }}">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function()
			{
				var hashVersion = 3458739349211312;
				var cssUrl = "{{ asset('css/style.css') }}?hash=" + hashVersion;

				$("html head").append("<link rel='stylesheet' href='" + cssUrl + "'/>");
			});
		</script>
	</head>

	<body class="admin-panel">
		<div class="left">
			<div class="header" title="Shawarma Station - Admin Panel">
				<img src="{{ asset('imgs/shawarma_station_logo.jpg') }}" alt="{{ __('shawarma_logo') }}">
				<h1>{{ __("Shawarma Station") }}</h1>
			</div>

			<a href="{{ route('order') }}" class="button button2" title="{{ __('Pesanan') }}">
				<div class="contents">
					<img src="{{ asset('imgs/icons/menu_order.png') }}" alt="{{ __('icon_menu_order') }}">
					{{ __("Pesanan") }}
				</div>
			</a>
			<a href="{{ route('history') }}" class="button button2" title="{{ __('Riwayat pesanan') }}">
				<div class="contents">
					<img src="{{ asset('imgs/icons/menu_history.png') }}" alt="{{ __('icon_menu_history') }}">
					{{ __("Riwayat Pesanan") }}
				</div>
			</a>
			<a href="{{ route('edit') }}" class="button button2" title="{{ __('Edit menu') }}">
				<div class="contents">
					<img src="{{ asset('imgs/icons/menu_edit.png') }}" alt="{{ __('icon_menu_edit') }}">
					{{ __("Edit Menu") }}
				</div>
			</a>

			<form method="POST" action="{{ route('logout') }}">
				@csrf	

				<button type="submit" class="button2" title="{{ __('Logout') }}">
					<div class="contents">
						<img src="{{ asset('imgs/icons/logout.png') }}" alt="{{ __('icon_logout') }}">
						{{ __("Logout") }}
					</div>
				</button>
			</form>
		</div>

		<div class="right">
			<div class="header">
				<h1 class="page-address">{{ __("page__address") }}</h1>
			</div>

			<div class="contents">
				<?php
				
				if ($isMenuOrderPage)
				{
				?>
					<div class="sub-selections">
						<a href="javascript:void(0);" class="button button-unselected" title="{{ __('Package') }}" onclick="displayMenu(1);">{{ __("Package") }}</a>
						<a href="javascript:void(0);" class="button button-unselected" title="{{ __('Sandwich') }}" onclick="displayMenu(2);">{{ __("Sandwich") }}</a>
						<a href="javascript:void(0);" class="button button-unselected" title="{{ __('Side orders') }}" onclick="displayMenu(3);">{{ __("Side Orders") }}</a>
						<a href="javascript:void(0);" class="button button-unselected" title="{{ __('Burger & Hotdog') }}" onclick="displayMenu(4);">{{ __("Burger & Hotdog") }}</a>
						<a href="javascript:void(0);" class="button button-unselected" title="{{ __('Minuman') }}" onclick="displayMenu(5);">{{ __("Minuman") }}</a>
						<a href="javascript:void(0);" class="button button-selected" title="{{ __('Semua') }}" onclick="displayMenu(6);">{{ __("Semua") }}</a>
					</div>
					<div class="slider">
						@foreach ($products as $product)
						<div
						@if ($product->product_type == 1)
							@if ($product->product_subtype == 1)
								class="card foods-subtypes-package"
							@elseif ($product->product_subtype == 2)
								class="card foods-subtypes-sandwich"
							@elseif ($product->product_subtype == 3)
								class="card foods-subtypes-sideorders"
							@elseif ($product->product_subtype == 4)
								class="card foods-subtypes-burgers"
							@endif
						@else
							class="card drinks"
						@endif
						title="{{ $product->product_name }}"
						>
							<img src="{{ route('menu.get.images', '') }}/{{ $product->product_img }}" alt="{{ $product->product_name }}">
							<div class="text">
								<p>{{ $product->product_name }}</p>
								<p>Rp{{ number_format($product->product_price, 0, ",", ".") }}</p>
							</div>
							<div class="actions">
								<form method="POST" action="{{ route('order.reduce') }}">
									@csrf

									<input type="hidden" name="product_id" value="{{ $product->product_id }}">
									<button class="reduce" title="{{ __('Kurang') }}">{{ __("-") }}</button>
								</form>
								<form method="POST" action="{{ route('order.add') }}">
									@csrf

									<input type="hidden" name="product_id" value="{{ $product->product_id }}">
									<button class="add" title="{{ __('Tambah') }}">{{ __("+") }}</button>
								</form>
							</div>
						</div>
						@endforeach
					</div>

					<?php

					$order_id = session("order_id");
					$orderData = session("order_data", []);

					if (count($orderData) > 0)
					{
					?>
						<div class="order-actions">
							<button class="button" title="{{ __('Batalkan pesanan') }}" onclick="window.location.href = '{{ route('order.delete') }}';">{{ __("Batal") }}</button>
							<button class="button" title="{{ __('Detail pesanan') }}" onclick="toggleOrderPanel();">{{ __("Detail") }}</button>
						</div>

						<div class="order-panel">
							<div class="sub-selections edit-menu">
								<a href="javascript:void(0);" class="button button-selected2" title="{{ __('Kembali ke menu') }}" onclick="toggleOrderPanel();">
									<div class="contents">
										<img src="{{ asset('imgs/icons/back.png') }}" alt="{{ __('icon_back') }}">
										{{ __("Kembali") }}
									</div>	
								</a>
							</div>
							<h1>{{ __("DETAIL PESANAN") }}</h1>
							<div class="receipt">
								<img src="{{ asset('imgs/shawarma_station_logo_transparent.png') }}" alt="{{ __('shawarma_logo') }}">
								<div class="equal-sign-bar"></div>
								<div class="container">
									<p>{{ __("Tanggal\t:\t") }}<span class="bill-time">{{ date("d-m-Y") }} ({{ date("H:i") }})</span></p>
									<p>
										<label for="customer_name" title="{{ __('Nama pembeli') }}">{{ __("Nama\t:\t") }}</label>
										<input type="text" id="customer_name" name="customer_name" title="{{ __('Nama pembeli') }}" required>
									</p>
									<p>
										<label for="whatsapp_number" title="{{ __('Nomor WhatsApp pembeli') }}">{{ __("No. WhatsApp\t:\t") }}</label>
										<input type="number" id="whatsapp_number" name="whatsapp_number" title="{{ __('Nomor WhatsApp pembeli') }}" placeholder="{{ __(628123456) }}" required>
									</p>
									<p>{{ __("No. Order\t:\t") }}<span>{{ $order_id }}</span></p>
									<div class="equal-sign-bar"></div>
								</div>
							@foreach ($orderData as $product_id => $order)
								<div class="menus">
									<span>{{ $adminController->MenuGetInfo($order["product_id"], "product_name") }}</span>
									<div class="price-details">
										<p>{{ number_format($adminController->MenuGetInfo($order["product_id"], "product_price"), 0, ",", ".") }}</p>
										<p>{{ $order["quantity"] }}</p>
										<p class="price-subtotal hidden">{{ (int) $adminController->MenuGetInfo($order["product_id"], "product_price") * (int) $order["quantity"] }}</p>
										<p>{{ number_format((int) $adminController->MenuGetInfo($order["product_id"], "product_price") * (int) $order["quantity"], 0, ",", ".") }}</p>
									</div> 
								</div>
							@endforeach
								<div class="equal-sign-bar"></div>
								<div class="menus-price-total">
									<span>{{ __("TOTAL\t:\t") }}</span>
									<script type="text/javascript">
										var priceTotal = 0;

										$(".menus .price-details p.price-subtotal").each(function()
										{
											priceTotal += parseInt($(this).html(), 10);
										});

										var formattedPrice = new Intl.NumberFormat("id-ID",
										{
											style: "currency",
											currency: "IDR",
											minimumFractionDigits: 0,
											maximumFractionDigits: 0
										}).format(priceTotal);

										formattedPrice = formattedPrice.replace(/Rp[\u200B\u00A0 ]/, "Rp")
										
										$(".menus-price-total").append("<span>" + formattedPrice + "</span>");
									</script>
								</div>
							</div>

							<button class="button button-order" title="{{ __('Pesan dan kirim struk') }}" onclick="orderSave();">{{ __("Pesan") }}</button>
						</div>
					<?php
					}

					?>

					<script type="text/javascript">
						var isButtonClicked = false;

						function toggleOrderPanel()
						{
							$("body.admin-panel .right .contents .order-panel").toggleClass("active");
						}

						function orderSave()
						{
							var customerName = $("input[name='customer_name'").val();
							var whatsappNumber = $("input[name='whatsapp_number'").val();
							var billTime = $("p span.bill-time").html();
							var url = "{{ route('order.save', ['customer_name' => '__customer_name__', 'whatsapp_number' => '__whatsapp_number__', 'bill_time' => '__bill_time__']) }}";

							if (customerName === "" || whatsappNumber === "" || whatsappNumber < 4)
							{
								if (customerName === "")
									alert("Nama pembeli tidak boleh kosong!");
								else if (whatsappNumber === "")
									alert("Nomor WhatsApp pembeli tidak boleh kosong!");
								else if (whatsappNumber < 4)
									alert("Pastikan kembali nomor WhatsApp pembeli benar!");
								
								return;
							}

							if (whatsappNumber.startsWith("0"))
							{
								if (!whatsappNumber.startsWith("62"))
									$("input[name='whatsapp_number'").val("62" + whatsappNumber.slice(1));
							}

							url = url.replace("__customer_name__", customerName).replace("__whatsapp_number__", whatsappNumber).replace("__bill_time__", billTime);

							window.location.href = url;
						}

						$("body.admin-panel .right .contents .slider .card .actions form button.add").on("click", function()
						{
							event.stopPropagation();
						});

						$("body.admin-panel .right .contents .slider .card").on("click", function()
						{
							if (!isButtonClicked)
							{
								isButtonClicked = true;
								
								$(this).find(".actions form button.add").click();
								setTimeout(function()
								{
									isButtonClicked = false;
								}, 100);
							}
						});
					</script>
				<?php
				}
				else if ($isMenuHistoryPage)
				{
				?>
					<div class="slider">
						<?php
						foreach ($customerBills as $customerBill)
						{
							$customer = Customer::where("customer_id", $customerBill->customer_id)->first();
							$orders = CustomerOrder::where("order_id", $customerBill->order_id)->get();

							?>
							<div class="card" title="{{ __('Nomor pesanan: ') }}{{ $customerBill->order_id }}" onclick="toggleOrderPanel('{{ $customerBill->order_id }}', '{{ $customerBill->bill_time }}', '{{ $customer->customer_name }}', '{{ $customer->whatsapp_number }}', '{{ $orders }}');">
								<img src="{{ asset('imgs/icons/menu_order_history.png') }}" alt="{{ __('icon_menu_order_history') }}">
								<div class="text">
									<p>{{ $customerBill->order_id }}</p>
									<p>{{ $customerBill->bill_time }}</p>
								</div>
								<div class="actions">
									<svg width="60" viewBox="0 0 6.3499999 6.3500002" xmlns="http://www.w3.org/2000/svg">
										<g transform="translate(0 -290.65)">
											<path d="m2.2580394 291.96502a.26460982.26460982 0 0 0 -.1741496.46871l1.6190225 1.38699-1.6190225 1.38648a.26460982.26460982 0 1 0 .3436483.40049l1.8536335-1.58595a.26460982.26460982 0 0 0 0-.40256l-1.8536335-1.5875a.26460982.26460982 0 0 0 -.1694987-.0667z"></path>
										</g>
									</svg>
								</div>
							</div>
						<?php
						}
						?>
					</div>

					<?php

					if (count($customerBills) > 0)
					{
					?>
						<div class="order-panel order-history">
							<div class="sub-selections edit-menu">
								<a href="javascript:void(0);" class="button button-selected2" title="{{ __('Kembali ke menu') }}" onclick="toggleOrderPanel();">
									<div class="contents">
										<img src="{{ asset('imgs/icons/back.png') }}" alt="{{ __('icon_back') }}">
										{{ __("Kembali") }}
									</div>	
								</a>
							</div>
							<div class="receipt">
								<img src="{{ asset('imgs/shawarma_station_logo_transparent.png') }}" alt="{{ __('shawarma_logo') }}">
								<div class="equal-sign-bar"></div>
								<div class="container">
									<p>{{ __("Tanggal\t:\t") }}<span id="bill-time">{{ __("bill_time") }}</span></p>
									<p>{{ __("Nama\t:\t") }}<span id="customer-name">{{ __("customer_name") }}</span></p>
									<p>{{ __("No. WhatsApp\t:\t") }}<span id="whatsapp-number">{{ __("whatsapp_number") }}</span></p>
									<p>{{ __("No. Order\t:\t") }}<span id="order-id">{{ __("order_id") }}</span></p>
									<div class="equal-sign-bar"></div>
								</div>
								<?php
								foreach ($orders as $order)
								{
									$product = Product::find($order->product_id);
								?>
									<div class="menus">
										<span>{{ $product->product_name }}</span>
										<div class="price-details">
											<p>{{ number_format($product->product_price, 0, ",", ".") }}</p>
											<p>{{ $order->quantity }}</p>
											<p class="price-subtotal hidden">{{ (int) $product->product_price * (int) $order->quantity }}</p>
											<p>{{ number_format((int) $product->product_price * (int) $order->quantity, 0, ",", ".") }}</p>
										</div> 
									</div>
								<?php
								}
								?>
								<div class="equal-sign-bar"></div>
								<div class="menus-price-total">
									<span>{{ __("TOTAL\t:\t") }}</span>
									<script type="text/javascript">
										var priceTotal = 0;

										$(".menus .price-details p.price-subtotal").each(function()
										{
											priceTotal += parseInt($(this).html(), 10);
										});

										var formattedPrice = new Intl.NumberFormat("id-ID",
										{
											style: "currency",
											currency: "IDR",
											minimumFractionDigits: 0,
											maximumFractionDigits: 0
										}).format(priceTotal);

										formattedPrice = formattedPrice.replace(/Rp[\u200B\u00A0 ]/, "Rp")
										
										$(".menus-price-total").append("<span>" + formattedPrice + "</span>");
									</script>
								</div>
							</div>
						</div>

						<script type="text/javascript">
							function toggleOrderPanel(order_id = null, bill_time = null, customer_name = null, whatsapp_number = null, orders = null)
							{
								if (order_id !== null)
									$(".order-history .receipt .container span#order-id").html(order_id);
								
								if (bill_time !== null)
									$(".order-history .receipt .container span#bill-time").html(bill_time);
								
								if (customer_name !== null)
									$(".order-history .receipt .container span#customer-name").html(customer_name);
								
								if (whatsapp_number !== null)
									$(".order-history .receipt .container span#whatsapp-number").html(whatsapp_number);

								$("body.admin-panel .right .contents .order-panel").toggleClass("active");
							}
						</script>
					<?php
					}

					?>
				<?php
				}
				else if ($isMenuEditPage)
				{
				?>
					<div class="menu-slide">
						<div class="sub-selections add-menu">
							<a href="javascript:void(0);" class="button button-selected2" title="{{ __('Tambah menu baru') }}" onclick="popUpMenu(0);">{{ __("Tambah Baru") }}</a>
						</div>
						<div class="slider">
							@foreach ($products as $product)
							<div
							@if ($product->product_type == 1)
								@if ($product->product_subtype == 1)
									class="card foods-subtypes-package"
								@elseif ($product->product_subtype == 2)
									class="card foods-subtypes-sandwich"
								@elseif ($product->product_subtype == 3)
									class="card foods-subtypes-sideorders"
								@elseif ($product->product_subtype == 4)
									class="card foods-subtypes-burgers"
								@endif
							@else
								class="card drinks"
							@endif
							title="{{ $product->product_name }}"
							>
								<img src="{{ route('menu.get.images', '') }}/{{ $product->product_img }}" alt="{{ $product->product_name }}">
								<div class="text">
									<p>{{ $product->product_name }}</p>
									<p>Rp{{ number_format($product->product_price, 0, ",", ".") }}</p>
								</div>
								<div class="actions">
									<button class="edit" title="{{ __('Edit menu') }}" onclick="popUpMenu(1, {{ $product->product_id }}, '{{ $product->product_name }}', '{{ $product->product_description }}', {{ $product->product_type }}, {{ ($product->product_subtype === null || $product->product_subtype === '') ? '0' : $product->product_subtype }}, {{ $product->product_price }});">{{ __("Edit") }}</button>
								</div>
							</div>
							@endforeach
						</div>
					</div>

					<div class="menu-popup hidden">
						<div class="sub-selections edit-menu">
							<a href="javascript:void(0);" class="button button-selected2" title="{{ __('Kembali ke edit menu') }}" onclick="popUpMenu(3);">
								<div class="contents">
									<img src="{{ asset('imgs/icons/back.png') }}" alt="{{ __('icon_back') }}">
									{{ __("Kembali") }}
								</div>	
							</a>
						</div>
						<div class="card">
							<form method="POST" enctype="multipart/form-data">
								@csrf
								
								<input type="hidden" id="product_id" name="product_id">
								<div class="input-container">
									<label for="product_name" title="{{ __('Nama menu') }}">{{ __("Nama Menu") }}<span>{{ __("*") }}</span></label>
									<div class="colon">{{ __(":") }}</div>
									<input type="text" id="product_name" name="product_name" title="{{ __('Nama menu') }}" required>
								</div>
								<div class="input-container">
									<label for="product_description" title="{{ __('Deskripsi menu') }}">{{ __("Deskripsi Menu") }}</label>
									<div class="colon">{{ __(":") }}</div>
									<input type="text" id="product_description" name="product_description" title="{{ __('Deskripsi menu') }}">
								</div>
								<div class="input-container">
									<label for="product_price" title="{{ __('Harga menu') }}">{{ __("Harga") }}<span>{{ __("*") }}</span></label>
									<div class="colon">{{ __(":") }}</div>
									<input type="number" id="product_price" name="product_price" title="{{ __('Harga menu') }}" required>
								</div>
								<div class="input-container">
									<label for="product_type" title="{{ __('Tipe menu') }}">{{ __("Tipe") }}<span>{{ __("*") }}</span></label>
									<div class="colon">{{ __(":") }}</div>
									<select name="product_type" id="product_type" title="{{ __('Tipe menu') }}" required>
										<option value="" disabled selected>{{ __("Tipe Menu") }}</option>
										<option value="1">{{ __("Makanan") }}</option>
										<option value="2">{{ __("Minuman") }}</option>
									</select>
								</div>
								<div class="input-container product-type hidden">
									<label for="product_subtype" title="{{ __('Sub-tipe menu') }}">{{ __("Sub-Tipe") }}<span>{{ __("*") }}</span></label>
									<div class="colon">{{ __(":") }}</div>
									<select name="product_subtype" id="product_subtype" title="{{ __('Sub-tipe menu') }}">
										<option value="" disabled selected>{{ __("Sub-Tipe Menu") }}</option>
										<option value="1">{{ __("Package") }}</option>
										<option value="2">{{ __("Sandwich") }}</option>
										<option value="3">{{ __("Side Orders") }}</option>
										<option value="4">{{ __("Burger & Hotdog") }}</option>
									</select>
								</div>
								<div class="input-container">
									<label for="product_img" title="{{ __('Foto menu') }}">{{ __("Foto") }}<span>{{ __("*") }}</span></label>
									<div class="colon">{{ __(":") }}</div>
									<input type="file" accept="image/*" id="product_img" name="product_img" title="{{ __('Foto menu') }}" required>
								</div>
								<div class="input-container submit">
									<button type="button" class="button delete-menu" title="{{ __('Hapus menu') }}">{{ __("Hapus") }}</button>
									<button type="submit" class="button" title="{{ __('Simpan') }}">{{ __("Simpan") }}</button>
								</div>
							</form>
						</div>
					</div>

					<script type="text/javascript">
						var isButtonClicked = false;

						function popUpMenu(type, product_id = 0, product_name = "", product_description = "", product_type = 0, product_subtype = 0, product_price = 0)
						{
							if (type === 0)
							{
								$("body.admin-panel .right .contents .menu-popup").removeClass("hidden");
								$("body.admin-panel .right .contents .menu-slide").addClass("hidden");

								$("body.admin-panel .right h1.page-address").text("Edit Menu > Tambah Baru");

								$("body.admin-panel .right .contents .menu-popup .card form").attr("action", "{{ route('edit.create') }}");

								$("body.admin-panel .right .contents .menu-popup .card form input").val("");
								$("body.admin-panel .right .contents .menu-popup .card form select").val("").trigger("change");
								$("body.admin-panel .right .contents .menu-popup .card form label[for='product_img']").html("{{ __('Foto') }}<span>{{ __('*') }}</span>");
								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_img']").attr("required", true);

								$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").attr("data-id", "");
								$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").removeClass("hidden");
								$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").addClass("hidden");
							}
							else if (type === 1)
							{
								$("body.admin-panel .right .contents .menu-popup").removeClass("hidden");
								$("body.admin-panel .right .contents .menu-slide").addClass("hidden");

								$("body.admin-panel .right h1.page-address").text("Edit Menu > Edit");

								$("body.admin-panel .right .contents .menu-popup .card form").attr("action", "{{ route('edit.update') }}");

								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_id']").val(product_id);
								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_name']").val(product_name);
								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_description']").val(product_description);
								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_price']").val(product_price);
								$("body.admin-panel .right .contents .menu-popup .card form select[name='product_type']").val(product_type).trigger("change");

								if (product_type !== 0)
									$("body.admin-panel .right .contents .menu-popup .card form select[name='product_subtype']").val(product_subtype).trigger("change");

								$("body.admin-panel .right .contents .menu-popup .card form label[for='product_img']").html("{{ __('Foto') }}");
								$("body.admin-panel .right .contents .menu-popup .card form input[name='product_img']").attr("required", false);
								
								$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").attr("data-id", product_id);
								$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").removeClass("hidden");
							}
							else if (type === 3)
							{
								$("body.admin-panel .right .contents .menu-popup").addClass("hidden");
								$("body.admin-panel .right .contents .menu-slide").removeClass("hidden");

								$("body.admin-panel .right h1.page-address").text("Edit Menu");
							}
						}

						$("body.admin-panel .right .contents .slider .card .actions button.edit").on("click", function()
						{
							event.stopPropagation();
						});

						$("body.admin-panel .right .contents .slider .card").on("click", function()
						{
							if (!isButtonClicked)
							{
								isButtonClicked = true;
								
								$(this).find(".actions button.edit").click();
								setTimeout(function()
								{
									isButtonClicked = false;
								}, 100);
							}
						});

						$("body.admin-panel .right .contents .menu-popup .card form .input-container select[name='product_type']").on("change", function()
						{
							if ($(this).val() === "1")
							{
								$("body.admin-panel .right .contents .menu-popup .card form .input-container.product-type").removeClass("hidden");
								$("body.admin-panel .right .contents .menu-popup .card form .input-container.product-type select").attr("required", true);
							}
							else if ($(this).val() === "2")
							{
								$("body.admin-panel .right .contents .menu-popup .card form .input-container.product-type").addClass("hidden");
								$("body.admin-panel .right .contents .menu-popup .card form .input-container.product-type select").attr("required", false);
							}
						});

						$("body.admin-panel .right .contents .menu-popup .card form .input-container button.button.delete-menu").on("click", function()
						{
							if (confirm("Apakah Anda yakin ingin menghapus menu ini?"))
								window.location.href = "{{ route('edit.delete', '') }}" + "/" + $(this).attr("data-id");
						});

						$("body.admin-panel .right .contents .menu-popup .card form").submit(function(e)
						{
							e.preventDefault();

							var formData = new FormData(this);
							var formUrl = $(this).attr("action");

							$.ajax(
							{
								url: formUrl,
								type: $(this).attr("method"),
								data: formData,
								processData: false,
								contentType: false,
								headers:
								{
									"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
								},
								success: function(response)
								{
									// Handle the success response
									if (formUrl === "{{ route('edit.create') }}")
										alert("Menu baru berhasil ditambahkan!");
									else
										alert("Menu berhasil diedit!");
									
									window.location.href = "{{ route('edit') }}";
								},
								error: function(xhr, status, error)
								{
									// Handle the error response
									alert("An error occurred: " + error);
									console.log(xhr.responseText);
								}
							});
						});
					</script>
				<?php
				}
				
				?>
			</div>
		</div>
		
		<script type="text/javascript">
			function resetNavBarButtons()
			{
				$("body.admin-panel .left a.button2").removeClass("active");
			}

			function updateButtonState(button, selected)
			{
				button.toggleClass("button-selected", selected).toggleClass("button-unselected", !selected);
			}

			function displayMenu(type)
			{
				$("body.admin-panel .right .contents .slider .card").addClass("hidden");

				if (type === 1)
					$("body.admin-panel .right .contents .slider .card.foods-subtypes-package").removeClass("hidden");
				else if (type === 2)
					$("body.admin-panel .right .contents .slider .card.foods-subtypes-sandwich").removeClass("hidden");
				else if (type === 3)
					$("body.admin-panel .right .contents .slider .card.foods-subtypes-sideorders").removeClass("hidden");
				else if (type === 4)
					$("body.admin-panel .right .contents .slider .card.foods-subtypes-burgers").removeClass("hidden");
				else if (type === 5)
					$("body.admin-panel .right .contents .slider .card.drinks").removeClass("hidden");
				else if (type === 6)
					$("body.admin-panel .right .contents .slider .card").removeClass("hidden");
			}

			$("body.admin-panel .right .contents a.button").on("click", function()
			{
				var button = $(this);

				$("body.admin-panel .right .contents a.button").each(function()
				{
					updateButtonState($(this), false);
				});

				updateButtonState(button, true);
			});

			<?php
			
			if ($isMenuOrderPage)
			{
			?>
				resetNavBarButtons();
				$("body.admin-panel .left a[href='<?php echo route("order"); ?>']").addClass("active");
				$("body.admin-panel .right h1.page-address").text("Pesanan");
			<?php
			}
			else if ($isMenuHistoryPage)
			{
			?>
				resetNavBarButtons();
				$("body.admin-panel .left a[href='<?php echo route("history"); ?>']").addClass("active");
				$("body.admin-panel .right h1.page-address").text("Riwayat Pesanan");
			<?php
			}
			else if ($isMenuEditPage)
			{
			?>
				resetNavBarButtons();
				$("body.admin-panel .left a[href='<?php echo route("edit"); ?>']").addClass("active");
				$("body.admin-panel .right h1.page-address").text("Edit Menu");
			<?php
			}
			
			?>
		</script>
	</body>
</html>