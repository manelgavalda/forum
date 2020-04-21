@extends('layouts.app')
@section('content')
  <div class="col-md-8 col-md-offset-2">
    <div class="page-header">
      <avatar-form :user="{{ $profileUser }}"></avatar-form>
    </div>

    @forelse($activities as $date => $activity)
      <div class="border rounded mt-5 p-1">
        <div class="text-xl text-gray-800">
          {{ $date }}
        </div>
        @foreach($activity as $record)
          @includeIf("profiles.activities.{$record->type}", ['activity' => $record])
        @endforeach
      </div>
    @empty
      <p>There is no activity for this user yet.</p>
    @endforelse
  </div>
@endsection
