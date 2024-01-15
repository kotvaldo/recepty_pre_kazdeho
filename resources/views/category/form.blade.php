<div class="form-group text-danger mb-2">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
<form method="post" action="{{ $action }}">
    @csrf
    @method($method)

    <div class="form-group mb-2">
        <label for="name">Názov kategórie <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Zadaj názov"
               value="{{ old('name', @$model->name) }}">
    </div>

    <a href="{{ route('category.index') }}" class="btn btn-warning">Cancel</a>
    <input type="submit" class="btn btn-success" value="Submit">
</form>

