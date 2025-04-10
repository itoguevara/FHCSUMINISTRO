@php

use App\Helpers\MenuHelper;
use App\Helpers\YearHelper;
use Illuminate\Support\Facades\Auth;
`
$idrol = Auth::user()->rol->menus()->orderBy('order')->pluck('id')->toArray();
$menuArray = MenuHelper::getMenuArray($idrol);
$menuAll = MenuHelper::buildMenu($menuArray);

$years = YearHelper::getAllYears();
$countYears = count($years);
$userDuality = Auth::user()->ano_fiscal;

@endphp

<div id="header-wrapper">
	<div class="container">
		<!-- Header -->
			<header id="header">
				<div class="inner">
					<!-- Logo -->
					<img class="imglogo" src="Back/images/LogoAAWeb.png" alt="" />
					<!-- Nav -->
						<nav id="nav">
							<ul>
								@if (empty($item['submenu']))
									<li class="nav-item">
										<a class="nav-link" href="{{ $item['ruta'] ? route($item['ruta']) : '' }}">
											<i class="material-icons">{{ $item['icono'] }}</i>
											<p>{{ $item['descripcion'] }}</p>
										</a>
									</li>
								@else
									<li class="nav-item">
										<a class="nav-link align-items-center" data-toggle="collapse" href="#{{ $item['id'] }}">
											<i class="material-icons">{{ $item['fileimg'] }}</i>
											<p>{{ $item['descripcion'] }} <b class="caret"></b></p>
										</a>
										<div class="collapse" id="{{ $item['id'] }}">
											<ul class="nav">
												@foreach ($item['submenu'] as $submenu)
													@if ($submenu['submenu'] == [])
														<li class="nav-item">
															<a class="nav-link" style="  margin-left: 40px !important;" href="{{ $submenu['pathweb'] ? route($submenu['pathweb']) : '#' }}"
																{{ $submenu['target'] }}>
																<div class="d-flex">
																	<i class="material-icons">{{ $submenu['fileimg'] }}</i>
																	<span class="sidebar-normal">{{ $submenu['descripcion'] }}</span>
																</div>
															</a>
														</li>
													@else
														@include('resource.components.headermenu', ['item' => $submenu])
													@endif
												@endforeach
											</ul>
										</div>
									</li>
								@endif								
							</ul>
						</nav>
				</div>
			</header>
	</div>
</div>