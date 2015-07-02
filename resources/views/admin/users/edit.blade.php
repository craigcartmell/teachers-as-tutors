@extends('app')

@section('title', 'Admin - ' . $user->name)

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The user was saved successfully.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="label label-info">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Bob Smith">
                </div>

                <div class="col-md-6">
                    <label for="email" class="label label-info">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="bob@smith.co.uk">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="password" class="label label-info">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="label label-info">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="permission_id" class="label label-info">Account Type</label>
                    <select name="permission_id">
                        <option value="0" class="form-control">-- Please Select --</option>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->getKey() }}" class="form-control" {{ (int)$user->permission_id === $permission->getKey() ? 'selected' : '' }}>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection