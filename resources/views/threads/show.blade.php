@extends('layouts.app')

@section('header')
	<link href="/css/vendor/jquery.atwho.css" rel="stylesheet">
@endsection

@section('content')
	<thread-view
		:thread="{{ $thread }}"
		inline-template
	>
		<div class="rounded border border-gray-400 px-10 py-4">
			<div>
				{{-- Editing the question --}}
				<div class="card" v-if="editing">
					<div class="card-header">
						<div class="level">
							<input
								type="text"
								class="form-control"
								v-model="form.title"
							>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<wysiwyg
								v-model="form.body"
							></wysiwyg>
						</div>
					</div>

					<div class="card-footer">
						<div class="level">
							<button
								class="btn btn-primary level-item"
								@click="update"
							>Update</button>
							<button
								class="btn btn-xs level-item"
								@click="resetForm"
							>Cancel</button>
							@can('update', $thread)
								<form
									action="{{ $thread->path() }}"
									method="POST"
									class="ml-a"
								>
									@csrf
									{{ method_field('DELETE') }}

									<button
										type="submit"
										class="btn btn-link"
									>Delete Thread</button>
								</form>
							@endcan
						</div>
					</div>
				</div>

				{{-- Viewing the question --}} --}}
				<div class="mb-8 pb-2 border-b" v-else>
					<div class="flex items-center">
						<div class="text-sm font-bold mr-1">
							<a
					    		class="hover:underline"
								href="{{ route('threads', $thread->channel)}}"
							>
								r/{{ $thread->channel->name }}
							</a>

						</div>
				    	<div class="text-xs text-gray-600">
				    		• Posted by
					    	<a
					    		class="hover:underline"
					    		href="{{ route('profile', $thread->creator) }}"
				    		>
					    		{{ $thread->creator->name }}
					    	</a>
					    	{{ $thread->created_at->diffForHumans() }}
				    	</div>
			    	</div>
					<div class="font-bold text-xl">
						<a href="{{ $thread->path() }}">
							<span v-text="title"></span>
						</a>
					</div>
					<div class="text-sm pt-2">
		    			{{ $thread->body }}
				    </div>
				    <div class="flex pt-1 text-xs font-bold text-gray-600">
				    	<div class="hover:bg-gray-300 p-1 rounded-xs">
				    		<i class="fa fa-comment" aria-hidden="true"></i>
							{{ $thread->replies_count }}
							{{ Illuminate\Support\Str::plural('Comment', $thread->replies_count) }}
				    	</div>
				    </div>
					<div
						class="card-footer"
						v-if="authorize('owns', thread)"
					>
						<button
							class="btn btn-xs"
							@click="editing = true"
						>Edit</button>
					</div>
				</div>
				<replies
					@added="repliesCount++"
					@removed="repliesCount--"
				></replies>
			</div>
			<p>
				<subscribe-button
					:active="{{ json_encode($thread->isSubscribedTo) }}"
					v-if="signedIn"
				></subscribe-button>

				<button class="btn btn-default"
					v-if="authorize('isAdmin')"
					@click="toogleLock"
					v-text="locked ? 'Unlock' : 'Lock'"
				></button>
			</p>
		</div>
	</thread-view>
@endsection
