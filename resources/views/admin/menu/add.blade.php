@extends('admin.main')

@section('head')
    <script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST" >
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" class="form-control" name="name"
                       placeholder="Enter name" value="<?= isset($menu->name) ? $menu->name : old('name') ?>">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>
                    <?php foreach($menus as $item): ?>
                        <option value="<?= $item->id ?>"  <?= isset($menu->parent_id)&&$menu->parent_id==$item->id ? 'selected': "" ?> >
                            <?= $item->name ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" name="description"><?= isset($menu->description) ? $menu->description : old('description') ?></textarea>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea class="form-control" id="content" name="content"><?= isset($menu->content) ? $menu->content : old('content') ?></textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>

                <?php if(isset($menu->active)): ?>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                            {{ $menu->active == 1 ? 'checked' : '' }}>
                        <label for="active" class="custom-control-label">Có</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                            {{ $menu->active == 0 ? 'checked' : '' }}>
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                <?php endif; ?>
                <?php if(!(isset($menu->active))): ?>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" checked="">
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
