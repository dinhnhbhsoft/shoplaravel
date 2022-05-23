@extends('admin.main')

@section('head')
    <script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group">
                <label for="customer">Full Name</label>
                <input type="text" class="form-control" name="full_name"
                       value="<?= isset($customer->full_name) ? $customer->full_name : old('full_name') ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email"
                       value="<?= isset($customer->email) ? $customer->email : old('email') ?>">
            </div>

            <div class="form-group">
                <label for="customer">Birthday</label>
                <input type="date" class="form-control" name="birthday"
                       value="<?= isset($customer->birthday) ? $customer->birthday : old('birthday') ?>">
            </div>

            <div class="form-group">
                <label>Phone number</label>
                <input type="text" class="form-control" name="phone_number"
                       value="<?= isset($customer->phone_number) ? $customer->phone_number : old('phone_number') ?>">
            </div>

            <div class="form-group">
                <label>Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <?php if(isset($customer->avatar) && $customer->avatar !== ""): ?>
                    <label class="old-label">Your Avatar:</label>
                    <img class="old-avatar" src="<?= '/'.$customer->avatar ?>" style="width: 150px; padding:10px 0 0 20px">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Courses</label>
                <select class="form-control" name="courses[]" multiple>
                    <?php foreach($courses as $course): ?>
                        <option value="{{ $course->id }}"
                                <?php
                                    if(isset($customer->courses)) {
                                        foreach ($customer->courses as $old_course) {
                                            if($course->id === $old_course['id'])
                                                echo "selected";
                                        }
                                    }
                                ?> >
                            {{ $course->name }}
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
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
