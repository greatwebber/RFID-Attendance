@extends('lecturer.layout')

@section('lecturer-content')
    <div class="row">
       <div class="col-md-12">
           <h2>My Assigned Courses</h2>

           @forelse($groupedCourses as $department => $levels)
               <div class="card mt-4">
                   <div class="card-header bg-primary text-white">
                       <h4>Department: {{ $department }}</h4>
                   </div>
                   <div class="card-body">
                       @foreach($levels as $level => $courses)
                           <h5 class="text-secondary">Level: {{ $level }}</h5>
                           <table class="table table-striped">
                               <thead>
                               <tr>
                                   <th>Course Name</th>
                                   <th>Course Code</th>
                                   <th>Action</th>
                               </tr>
                               </thead>
                               <tbody>
                               @foreach($courses as $course)
                                   <tr>
                                       <td>{{ $course->course_name }}</td>
                                       <td>{{ $course->course_code }}</td>
                                       <td>
                                           <a href="{{ route('lecturer.courses.students', $course->id) }}" class="btn btn-sm btn-info">
                                               View Students
                                           </a>

                                           <a href="{{ route('lecturer.attendance.view', $course->id) }}" class="btn btn-warning btn-sm">
                                               View Attendance
                                           </a>
                                       </td>
                                   </tr>

                               @endforeach
                               </tbody>
                           </table>
                       @endforeach
                   </div>
               </div>
           @empty
               <p class="text-center">No Courses Assigned</p>
           @endforelse
       </div>
    </div>
@endsection
