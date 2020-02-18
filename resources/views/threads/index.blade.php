@extends('layouts.app')

@section('content')
	<div class="w-4/6 m-auto">
		@forelse($threads as $thread)
			<div class="rounded shadow-lg my-4 p-4">
		    <div class="font-bold text-xl">
					<a href="{{ $thread->path() }}">
						{{ $thread->title }}
					</a>
		    </div>
		    <div class="border"></div>
		    <div class="flex py-3 text-xs">
		    	<div>
							{{ $thread->replies_count }}
							{{ Illuminate\Support\Str::plural('reply', $thread->replies_count) }}
					</div>
		    	<div class="ml-auto">
		    		Post by:
			    	<a
			    		class="font-bold underline"
			    		href="{{ route('profile', $thread->creator) }}"
		    		>
			    		{{ $thread->creator->name }}
			    	</a>
		    	</div>
		    </div>
		    <div class="text-gray-700 text-sm">
		    	{{ $thread->body }}
		    </div>
		  </div>
		@empty
			<p>There are no relevant results at this time.</p>
		@endforelse

		{{ $threads->render() }}
	</div>
@endsection
