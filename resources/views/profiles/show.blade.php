@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                    </h1>

                    @can('update', $profileUser)
                        <form method="post" action="{{ route('avatar', $profileUser) }}" enctype="multipart/form-data">
                            @csrf()

                            <input type="file" name="avatar">

                            <button type="submit" class="btn btn-primary">Add Avatar</button>
                        </form>
                    @endcan

                    <img src="{{ asset($profileUser->avatar_path) }}" width="50" heigth="200">
                </div>

                @forelse($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                        @foreach($activity as $record)
                            @includeIf("profiles.activities.{$record->type}", ['activity' => $record])
                        @endforeach
                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
