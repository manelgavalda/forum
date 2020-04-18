<nav class="bg-gray-100 border py-2 fixed w-full z-10">
	<div class="flex w-5/6 m-auto">
		<div>
			<a class="mr-5 uppercase" href="/threads"><b><i>Threads</i></b></a>
	  		<div class="mr-5 dropdown inline-block">
			    <button class="border-2 font-semibold py-2 px-4 rounded inline-flex items-center">
			      	<span class="mr-1">Channels</span>
			      	<svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
			    </button>
			    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
			    	@foreach(App\Channel::all() as $channel)
				      	<li>
				      		<a
				      			class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
				      			href="{{ route('threads', $channel)}}"
			      			>
				      			{{ $channel->name }}
				      		</a>
				      	</li>
			      	@endforeach
		    	</ul>
		  	</div>
			<a href="/threads/create">New Thread</a>
		</div>
		<div class="ml-auto my-auto">
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
