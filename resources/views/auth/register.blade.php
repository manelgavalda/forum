@extends('layouts.app')

@section('content')
    <div class="max-w-sm">
        <form
            class="bg-white border border-gray-400 rounded px-8 pt-6 pb-8 mb-4"
            method="POST"
            action="{{ route('register') }}"
        >
            @csrf
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="name"
                >
                    Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    placeholder="Name"
                    name="name"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <p class="text-red-500 text-xs italic">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="username"
                >
                    Username
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    placeholder="Email"
                    name="email"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <p class="text-red-500 text-xs italic">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="mb-6">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password"
                >
                    Password
                </label>
                <input
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="password"
                    name="password"
                    placeholder="******************"
                >
                @error('password')
                    <p class="text-red-500 text-xs italic">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            <div class="mb-6">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password_confirmation"
                >
                    Password Confirmation
                </label>
                <input
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="password"
                    name="password_confirmation"
                    placeholder="******************"
                >
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
