@extends('admin.main')

@section('content')
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Start</th>
            <th>End</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $key => $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->time_start }}</td>
                <td>{{ $course->time_end }}</td>
                <td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/courses/add/{{ $course->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm delete-course" data-id="{{ $course->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
