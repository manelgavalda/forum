@extends('layouts.app')

@section('header')
	<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
	<div class="border p-2 rounded-md border-gray-500">
		<div class="text-xl mb-2">
			Create new Thread
		</div>
		<div class="p-2">
			<form method="POST" action="/threads">
				@csrf
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<label
						class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
						for="channel"
					>
						Channel
					</label>
					<div class="relative">
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
					</div>
				</div>

				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
				</div>

				<div class="form-group">
					<label for="body">Body</label>
					<wysiwyg name="body"></wysiwyg>
				</div>

				<div class="g-recaptcha" data-sitekey="6Lc-bXQUAAAAAHrwa9nPNNKa-w-crtNY6OmoajP5"></div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Publish</button>
				</div>

				@if(count($errors))
					<ul class="alert alert-danger">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
			</form>
		</div>
	</div>
@endsection
