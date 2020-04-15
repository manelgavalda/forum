<nav class="bg-gray-100 border py-2 fixed w-full z-10">
	<div class="flex w-5/6 m-auto">
		<div>
			<a class="mr-5 uppercase" href="/threads"><b><i>Threads</i></b></a>
			<a href="/threads/create">New Thread</a>
		</div>

		<div class="ml-auto">
			@guest
		      	<a href="{{ route('login') }}" class="text-xs font-bold py-1 px-2 border-2 rounded text-blue-600 border-blue-600 hover:border-blue-400 hover:text-blue-500">Log in</a>

		      	<a href="{{ route('register') }}" class="text-xs font-bold py-1 px-2 border-2 rounded bg-blue-600 text-white border-blue-600 hover:bg-blue-400 hover:border-blue-400 hover:text-blue-500">Sign up</a>
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
		</div>
	</div>
</nav>
