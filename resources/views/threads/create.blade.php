@extends('layouts.app')

@section('header')
	<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
	<div class="border p-2 rounded-md border-gray-500">
		<div class="p-2">
			<form method="POST" action="/threads">
				@csrf

				<div class="mb-4">
					<label
						class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
						for="channel"
					>
						Channel
					</label>

					<select
						name="channel_id"
						value="{{ old('channel_id') }}"
						class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="channel"
						required
					>
						<option>Chose one...</option>
						@foreach($channels as $channel)
							<option
								value="{{ $channel->id }}"
								{{old('channel_id') == $channel->id ? 'selected' : '' }}
							>
								{{ $channel->name }}
							</option>
						@endforeach
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
						<svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
					@error('channel_id')
	      		<p class="text-red-500 text-xs italic">
							<strong>{{ $message }}</strong>
						</p>
					@enderror
				</div>

				<div class="mb-4">
		      <label
		      	class="block text-gray-700 text-sm font-bold mb-2"
		      	for="title"
	      	>
		        Title
		      </label>

		      <input
		      	class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
		      	id="title"
		      	type="text"
		      	placeholder="Title"
		      	name="title"
		      	value="{{ old('title') }}"
		      	required
	      	>
					@error('title')
	      		<p class="text-red-500 text-xs italic">
							<strong>{{ $message }}</strong>
						</p>
					@enderror
		    </div>

				<div class="mb-6">
					<label for="body">Body</label>
					<wysiwyg name="body"></wysiwyg>
					@error('body')
	      		<p class="text-red-500 text-xs italic">
							<strong>{{ $message }}</strong>
						</p>
					@enderror
				</div>

				<div class="g-recaptcha mb-5" data-sitekey="6Lc-bXQUAAAAAHrwa9nPNNKa-w-crtNY6OmoajP5"></div>
					@error('g-recaptcha-response')
	      		<p class="text-red-500 text-xs italic">
							<strong>{{ $message }}</strong>
						</p>
					@enderror

				<div>
		      <button
		      	class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
		      	type="submit"
	      	>
		        Publish
		      </button>
				</div>
			</form>
		</div>
	</div>
@endsection
