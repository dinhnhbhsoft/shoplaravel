@extends('admin.main')

@section('head')
    <script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST" >
        <div class="card-body">

            <div class="form-group">
                <label for="course">Name</label>
                <input type="text" class="form-control" name="name"
                       value="<?= isset($course->name) ? $course->name : old('name') ?>">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description">
                    <?= isset($course->description) ? $course->description : old('description') ?>
                </textarea>
            </div>

            <div class="form-group">
                <label for="course">Start</label>
                <input type="datetime-local" class="form-control" name="time_start"
                       value="<?= isset($course->time_start) ? date('Y-m-d\TH:i', strtotime($course->time_start)) : old('time_start') ?>">
            </div>

            <div class="form-group">
                <label for="course">End</label>
                <input type="datetime-local" class="form-control" name="time_end"
                       value="<?= isset($course->time_end) ? date('Y-m-d\TH:i', strtotime($course->time_end)) : old('time_end') ?>">
            </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
