@php use App\Models\User; @endphp
<div class="form-group text-danger mb-2">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @method($method)

    <div class="form-group mb-2">
        <label for="name">Username <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Full name"
               value="{{ old('name', @$model->name) }}">
    </div>
    <div class="form-group mb-2">
        <label for="email">Email address <span style="color: red">*</span></label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
               placeholder="Enter email"
               value="{{ old('email', @$model->email) }}">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group mb-2">
        <label for="password">Password <span style="color: red">*</span></label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group mb-2">
        <label for="password"> Password again <span style="color: red">*</span></label>
        <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password">
    </div>
    @can('view', User::class)
        <div class="form-group mb-2">
            <label for="role">Typ používateľa</label>
            <select class="form-control" id="role" name="role">
                <option value='Admin' {{ old('role', @$model->role) == 'Admin' ? 'selected' : '' }}>Administrator
                </option>
                <option value='User' {{ old('role', @$model->role) == 'User' ? 'selected' : '' }}>Regular User</option>
            </select>
        </div>
    @endcan

    <div class="form-group mb-2">
        <label for="profile_photo">{{ __('Profile photo') }}</label>
        <input id="profile_photo" type="file" class="form-control" name="profile_photo">
    </div>
    <a href="{{ route('user.index') }}" class="btn btn-warning">Cancel</a>
    <input type="submit" class="btn btn-success" value="Send">
</form>
