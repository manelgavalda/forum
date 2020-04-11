@extends('layouts.app')

@section('content')
	@forelse($threads as $thread)
		<div class="my-2 py-1 pl-10 rounded-sm cursor-pointer border border-blue-500 hover:border-yellow-100">
	    	<div class="text-xs text-gray-600">
	    		Posted by
		    	<a
		    		class="hover:underline"
		    		href="{{ route('profile', $thread->creator) }}"
	    		>
		    		{{ $thread->creator->name }}
		    	</a>
		    	{{ $thread->created_at->diffForHumans() }}
	    	</div>
		    <div class="font-semibold text-xl">
					<a href="{{ $thread->path() }}">
						{{ $thread->title }}
					</a>
		    </div>
		    <div class="text-sm pt-2">
		    	{{ $thread->body }}
		    </div>
		    <div class="flex pt-1 text-xs font-bold text-gray-600">
		    	<div class="hover:bg-gray-300 p-1 rounded-xs">
		    		<i class="fa fa-user-o" aria-hidden="true"></i>
					{{ $thread->replies_count }}
					{{ Illuminate\Support\Str::plural('Comment', $thread->replies_count) }}
		    	</div>
		    </div>
	  	</div>
	@empty
		<p>There are no relevant results at this time.</p>
	@endforelse

	{{ $threads->render() }}
@endsection
