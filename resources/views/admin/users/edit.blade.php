@extends('app')

@section('title')
    {{ $user->exists ? 'Edit ' . $user->name : 'New User' }}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit-user', $user) !!}
@endsection


@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            @if(session('is_new'))
                <div class="alert alert-success">The user was created successfully and a notifcation email has been sent to {{ $user->email }}.</div>
            @else
                <div class="alert alert-success">The user was saved successfully.</div>
            @endif
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Bob Smith">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="bob@smith.co.uk">
                </div>

                <div class="col-md-6">
                    <label for="email_confirmation">Confirm Email</label>
                    <input type="email" name="email_confirmation" value="{{ old('email_confirmation', $user->email) }}" class="form-control" placeholder="bob@smith.co.uk">
                </div>
            </div>

            <br>

            @if($user->exists)
                <div class="row">
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                    </div>
                </div>

                <br>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <label for="permission_id">Account Type</label>
                    <select name="permission_id">
                        <option value="0" class="form-control">-- Please Select --</option>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->getKey() }}" class="form-control" {{ (int)$user->permission_id === $permission->getKey() ? 'selected' : '' }}>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="is_enabled">Enabled</label>
                    <input type="checkbox" name="is_enabled" value="1" {{ $user->is_enabled ? 'checked' : '' }}>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection