{{-- Editing the question --}}
<div class="card" v-if="editing">
    <div class="card-header">
        <div class="level">
            <input type="text" value="{{ $thread->title }}" class="form-control">

        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <textarea class="form-control" rows="10"> {{ $thread->body }}</textarea>
        </div>
    </div>

    <div class="card-footer">
        <div class="level">
            <button class="btn btn-primary level-item" @click="">Update</button>
            <button class="btn btn-xs level-item" @click="editing = false">Cancel</button>
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

{{-- Viewing the question --}}
<div class="card" v-else>
    <div class="card-header">
        <div class="level">
            <img src="{{ asset($thread->creator->avatar_path) }}"
                alt="{{ $thread->creator->name }}"
                width="25"
                heigth="25"
                class="mr-1">

                <template v-if="editing"></template>

            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
            </span>
        </div>
    </div>
    <div class="card-body">
        <div class="body">{{ $thread->body }}</div>
    </div>

    <div class="card-footer">
        <button class="btn btn-xs" @click="editing = true">Edit</button>
    </div>
</div>
