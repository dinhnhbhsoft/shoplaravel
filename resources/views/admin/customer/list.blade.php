@extends('admin.main')

@section('content')
    <table>
        <thead>
        <tr>
            <th>Full name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Birthday</th>
            <th>Avatar</th>
            <th>Courses</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($customers as $key => $customer): ?>
            <tr>
                <td><?= $customer->full_name ?></td>
                <td><?= $customer->email ?></td>
                <td><?= $customer->phone_number ?></td>
                <td><?= $customer->birthday ?></td>
                <td>
                    <?php if(isset($customer->avatar) && $customer->avatar !== ""): ?>
                    <img src="<?= '/'.$customer->avatar ?>" style="width: 100px">
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                        foreach ($customer->courses as $course) {
                            echo $course['name'].", ";
                        }
                    ?>
                </td>

                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/add/<?= $customer->id ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm delete-customer" data-id="<?= $customer->id ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

@endsection
