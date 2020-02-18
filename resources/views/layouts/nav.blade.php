<nav class="navbar-expand-md">
	<div class="w-4/6 m-auto">
		<div class="navbar-collapse">
			<ul class="flex">
				<li>
					<a class="text-xl" href="/threads">Threads</a>
				</li>
				<li>
					<a class="text-xl ml-5" href="/threads/create">New Thread</a>
				</li>
			</ul>

			<ul class="ml-auto">
				@guest
					<li>
						<a class="nav-link" href="{{ route('login') }}">Login</a>
					</li>
					<li>
						<a class="nav-link" href="{{ route('register') }}">Register</a>
					</li>
				@else
				<user-notifications></user-notifications>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
							{{ auth()->user()->name }}
						</a>

						<div class="dropdown-menu">
							<a class="dropdown-item" href={{ route('profile', auth()->user()) }}>
								My Profile
							</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
							  onclick="event.preventDefault();
							 	document.getElementById('logout-form').submit();"
						 	>
						 		Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
<div class="border-2 mt-4"></div>
