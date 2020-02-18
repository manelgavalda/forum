@extends('layouts.app')

@section('header')
	<link href="/css/vendor/jquery.atwho.css" rel="stylesheet">
@endsection

@section('content')
	<thread-view :thread="{{ $thread }}" inline-template>
		<div>
			<div>
				{{-- Editing the question --}}
				<div class="card" v-if="editing">
					<div class="card-header">
						<div class="level">
							<input type="text" class="form-control" v-model="form.title">
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<wysiwyg v-model="form.body"></wysiwyg>
						</div>
					</div>

					<div class="card-footer">
						<div class="level">
							<button class="btn btn-primary level-item" @click="update">Update</button>
							<button class="btn btn-xs level-item" @click="resetForm">Cancel</button>
							@can('update', $thread)
								<form action="{{ $thread->path() }}" method="POST" class="ml-a">
									@csrf
									{{ method_field('DELETE') }}

									<button type="submit" class="btn btn-link">Delete Thread</button>
								</form>
							@endcan
						</div>
					</div>
				</div>

				{{-- Viewing the question --}} --}}
				<div class="rounded shadow-lg mb-4 p-4" v-else>
					<div class="flex">
						<div class="flex">
							<img
								src="{{ asset($thread->creator->avatar_path) }}"
								alt="{{ $thread->creator->name }}"
								width="25"
							>
							<a
								class="font-bold underline pl-2"
								href="{{ route('profile', $thread->creator) }}"
							>
								{{ $thread->creator->name }}
							</a>
						</div>
						<div class="ml-auto text-sm text-gray-600">
							{{ $thread->created_at->diffForHumans() }}
						</div>
					</div>
					<div class="font-bold text-xl">
							<a href="{{ $thread->path() }}"> <span v-text="title"></span></a>
					</div>
					<div class="border"></div>
					<div class="flex py-3 text-xs">
						<div>
							{{ $thread->replies_count }}
							{{ Illuminate\Support\Str::plural('reply', $thread->replies_count) }}
						</div>
					</div>
					<div class="text-gray-700 text-sm" v-html="body"></div>
					<div class="card-footer" v-if="authorize('owns', thread)">
						<button class="btn btn-xs" @click="editing = true">Edit</button>
					</div>
				</div>
				<replies @added="repliesCount++" @removed="repliesCount--"></replies>
			</div>
			<p>
				<subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>

				<button class="btn btn-default"
					v-if="authorize('isAdmin')"
					@click="toogleLock"
					v-text="locked ? 'Unlock' : 'Lock'"></button>
			</p>
		</div>
	</thread-view>
@endsection
