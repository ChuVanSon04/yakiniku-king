@extends('fontend.layouts.app')

@section('title', 'Trang chủ')

@push('styles')
	<style>
		.home-hero {
			min-height: min(760px, calc(100svh - 80px));
			position: relative;
			display: grid;
			align-items: end;
			overflow: hidden;
			color: #fff;
			background: #171612 url('{{ asset('yakiniku-king/usina.jpg') }}') center / cover;
		}

		.home-hero::after {
			position: absolute;
			inset: 0;
			content: '';
			background: linear-gradient(90deg, rgb(15 14 12 / 78%), rgb(15 14 12 / 8%) 78%), linear-gradient(0deg, rgb(15 14 12 / 56%), transparent 66%);
		}

		.home-hero video {
			position: absolute;
			inset: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.home-hero-content {
			position: relative;
			z-index: 1;
			width: 100%;
			padding-block: clamp(5rem, 12vw, 9rem);
		}

		.home-eyebrow {
			color: #ff0000;
			font-size: .75rem;
			font-weight: 700;
			letter-spacing: .18em;
			text-transform: uppercase;
		}

		.home-display {
			max-width: 760px;
			margin: 1rem 0 1.5rem;
			font-family: Georgia, 'Times New Roman', serif;
			font-size: clamp(3rem, 8vw, 6.5rem);
			font-weight: 500;
			line-height: .98;
		}

		.home-hero-copy {
			max-width: 430px;
			color: rgb(255 255 255 / 82%);
			font-size: 1.05rem;
		}

		.home-social-links {
			display: flex;
			flex-wrap: wrap;
			gap: .65rem;
			margin-top: 1.5rem;
		}

		.home-social-link {
			display: inline-flex;
			width: 52px;
			height: 52px;
			align-items: center;
			justify-content: center;
			padding: 6px;
			border: 1px solid transparent;
			border-radius: 50%;
			background: #fff;
			text-decoration: none;
			transition: filter 180ms ease, transform 180ms ease;
		}

		.home-social-link:hover {
			filter: brightness(1.12);
			transform: translateY(-2px) scale(1.04);
		}

		.home-social-link:focus-visible {
			outline: 3px solid #fff;
			outline-offset: 3px;
		}

		.home-social-link img {
			display: block;
			width: 100%;
			height: 100%;
			object-fit: contain;
		}

		.home-section {
			padding-block: clamp(4rem, 8vw, 7rem);
		}

		.home-menu {
			background: #f5f2ec;
		}

		.home-section-title {
			margin: .65rem 0 0;
			color: #201e1a;
			font-family: Georgia, 'Times New Roman', serif;
			font-size: clamp(2.3rem, 5vw, 4rem);
			font-weight: 500;
		}

		.home-menu-item {
			position: relative;
			overflow: hidden;
			background: #201e1a;
			color: #fff;
		}

		.home-menu-item img {
			width: 100%;
			aspect-ratio: 4 / 3;
			object-fit: cover;
		}

		.home-menu-caption {
			position: absolute;
			inset: auto 0 0;
			padding: 3.5rem 1.25rem 1.15rem;
			background: linear-gradient(transparent, rgb(0 0 0 / 78%));
		}

		.home-menu-caption h3 {
			margin: 0;
			font-family: Georgia, 'Times New Roman', serif;
			font-size: 1.5rem;
			font-weight: 500;
		}

		.home-restaurant {
			background: #623E2A;
		}

		.home-restaurant-image {
			display: block;
			width: 100%;
			height: auto;
		}

		.home-restaurant-copy {
			max-width: 480px;
		}

		.home-restaurant-copy .home-section-title,
		.home-restaurant-address {
			color: #fff;
		}

		.home-restaurant-copy .btn {
			color: #000;
		}

	</style>
@endpush

@section('content')
	<section class="home-hero" aria-label="Yakiniku King">
		<video autoplay muted loop playsinline poster="{{ asset('yakiniku-king/usina.jpg') }}" aria-hidden="true">
			<source src="{{ asset('yakiniku-king/1.mp4') }}" type="video/mp4">
		</video>
		<div class="container home-hero-content">
			<p class="home-eyebrow mb-0">Japanese barbecue</p>
			<h1 class="home-display">Yakiniku<br>King</h1>
			<p class="home-hero-copy">Thưởng thức vị ngon nướng Nhật trong từng lát thịt tuyển chọn.</p>
			<a class="btn btn-light rounded-0 px-4 py-3 fw-semibold" href="{{ route('booking.create') }}">Book now</a>
			<div class="home-social-links" aria-label="Mạng xã hội">
				<a class="home-social-link" href="{{ setting('zalo_url', 'https://zalo.me/1592268671052817128') }}" target="_blank" rel="noopener noreferrer" aria-label="Zalo OA" title="Zalo OA">
					<img src="{{ asset('yakiniku-king/logo-zalo.png') }}" alt="">
				</a>
				<a class="home-social-link" href="{{ setting('facebook_url', 'https://www.facebook.com/yakiniku.king.official') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook">
					<img src="{{ asset('yakiniku-king/logo-facebook-blue.png') }}" alt="">
				</a>
				<a class="home-social-link" href="{{ setting('youtube_url', 'https://www.youtube.com/results?search_query=ussina+sky+77+-+landmark+81') }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube" title="YouTube">
					<img src="{{ asset('yakiniku-king/logo-youtube.png') }}" alt="">
				</a>
			</div>
		</div>
	</section>

	<section class="home-section home-menu" id="thuc-don">
		<div class="container">
			<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4 mb-lg-5">
				<div>
					<p class="home-eyebrow mb-0">Tuyển chọn tại Yakiniku King</p>
					<h2 class="home-section-title">Thực đơn</h2>
				</div>
				<a class="link-dark fw-semibold text-decoration-none" href="{{ route('menu.index') }}">Xem toàn bộ thực đơn <span aria-hidden="true">&rarr;</span></a>
			</div>

			<div class="row g-3 g-lg-4">
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/snow-aging-wagyu-set.jpg') }}" alt="Set Snow Aging Wagyu" loading="lazy">
						<div class="home-menu-caption"><h3>Snow Aging Wagyu Set</h3></div>
					</article>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/snow-aging-wagyu.jpg') }}" alt="Thịt bò Snow Aging Wagyu" loading="lazy">
						<div class="home-menu-caption"><h3>Snow Aging Wagyu</h3></div>
					</article>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/aging-beef.jpg') }}" alt="Thịt bò ủ lạnh" loading="lazy">
						<div class="home-menu-caption"><h3>Aging Beef</h3></div>
					</article>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/salad.jpg') }}" alt="Salad tươi" loading="lazy">
						<div class="home-menu-caption"><h3>Salad</h3></div>
					</article>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/hot-dish.jpg') }}" alt="Món nóng tại Yakiniku King" loading="lazy">
						<div class="home-menu-caption"><h3>Hot Dish</h3></div>
					</article>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<article class="home-menu-item">
						<img src="{{ asset('yakiniku-king/pasta-rice.jpg') }}" alt="Món cơm và mì" loading="lazy">
						<div class="home-menu-caption"><h3>Pasta &amp; Rice</h3></div>
					</article>
				</div>
			</div>
		</div>
	</section>

	<section class="home-section home-restaurant" id="nha-hang">
		<div class="container">
			<div class="row align-items-center g-4 g-lg-5">
				<div class="col-12 col-lg-7">
					<img class="home-restaurant-image" src="{{ asset('yakiniku-king/gg-map.jpg') }}" alt="Không gian nhà hàng Yakiniku King" loading="lazy">
				</div>
				<div class="col-12 col-lg-5">
					<div class="home-restaurant-copy">
						<p class="home-eyebrow mb-0">Gặp gỡ tại Yakiniku King</p>
						<h2 class="home-section-title mb-3">Nhà hàng</h2>
						<p class="home-restaurant-address mb-4">12 Phố Hàng Gai, Quận Hoàn Kiếm, Hà Nội</p>
						<a class="btn btn-light rounded-0 px-4 py-3 fw-semibold" href="{{ route('booking.create') }}">Book now</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection