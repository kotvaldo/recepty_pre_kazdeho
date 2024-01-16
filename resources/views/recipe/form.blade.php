<div class="form-group text-danger mb-2">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="form-group mb-2">
        <label for="name">Názov receptu <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Zadaj názov" value="{{ old('name', @$model->name) }}">
    </div>

    <div class="form-group mb-2">
        <label for="ingredients">Ingrediencie <span style="color: red">*</span></label>
        <textarea class="form-control" id="ingredients" name="ingredients" placeholder="Zadaj ingrediencie">{{ old('ingredients', @$model->ingredients) }}</textarea>
    </div>

    <div class="form-group mb-2">
        <label for="instructions">Postup <span style="color: red">*</span></label>
        <textarea class="form-control" id="instructions" name="instructions" placeholder="Zadaj postup">{{ old('instructions', @$model->instructions) }}</textarea>
    </div>

    <div class="form-group mb-2">
        <label for="image">Obrázok receptu</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <div class="form-group mb-2">
        <label for="category">Kategória<span style="color: red"> *</span></label>
        <select class="form-control" id="category_id" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', @$model->category) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="difficulty">Obtiažnosť <span style="color: red">*</span></label>
        <select class="form-control" id="difficulty" name="difficulty">
            <option value="1">Ľahká</option>
            <option value="2">Stredná</option>
            <option value="3">Ťažká</option>
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="cooking_time">Čas prípravy(minúty)<span style="color: red"> *</span></label>
        <input type="number" class="form-control" id="cooking_time" name="cooking_time" placeholder="Zadaj čas prípravy" value="{{ old('cooking_time', @$model->cooking_time) }}">
    </div>

    <a href="{{ route('user.my_recipes') }}" class="btn btn-warning">Cancel</a>
    <input type="submit" class="btn btn-success" value="Submit">
</form>
