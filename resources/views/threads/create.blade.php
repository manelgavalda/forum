@extends('layouts.app')

@section('header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Thread</div>
                <div class="card-body">
                    <form method="POST" action="/threads">
                        @csrf
                        <div class="form-group">
                            <label for="channel_id">Chose a Channel</label>
                            <select name="channel_id" value="{{ old('channel_id') }}" class="form-control" required>
                                <option value="">Chose One...</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                                <wysiwyg name="body"></wysiwyg>
                            {{-- <textarea id="body" class="form-control" name="body" value="{{ old('body') }}" rows="8" required></textarea> --}}
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
        </div>
    </div>
</div>
@endsection
