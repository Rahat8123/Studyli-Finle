@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
<style>
    /* Fix overflow and dropdown issues */
    html, body {
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    select {
        max-height: 40px;
        overflow: hidden;
    }

    .card {
        scroll-margin-top: 80px;
    }
</style>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Request for Counseling</h5>
        </div>
        <div class="card-body">
            <form id="counselingForm" method="POST" action="{{ route('counseling.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="course_id">Select Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lecture_id">Select Lecture</label>
                        <select name="lecture_id" id="lecture_id" class="form-control" required>
                            <option value="">-- Select Lecture --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="preferred_date">Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="preferred_time">Preferred Time</label>
                        <input type="time" name="preferred_time" id="preferred_time" class="form-control" step="1" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Mode</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="online" value="online" required>
                            <label class="form-check-label" for="online">Online</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="offline" value="offline" required>
                            <label class="form-check-label" for="offline">Offline</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Submit Request</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h6 class="mb-0">My Counseling Requests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Course</th>
                            <th>Lecture</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Mode</th>
                            <th>Status</th>
                            <th>Teacher Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td>{{ $req->course->course_name ?? '-' }}</td>
                                <td>{{ $req->lecture->lecture_title ?? '-' }}</td>
                                <td>{{ $req->preferred_date }}</td>
                                <td>{{ $req->preferred_time }}</td>
                                <td>{{ ucfirst($req->mode) }}</td>
                                <td>
                                    @if($req->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($req->status == 'accepted')
                                        <span class="badge bg-success">Accepted</span>
                                    @else
                                        <span class="badge bg-danger">Declined</span>
                                    @endif
                                </td>
                                <td>{{ $req->teacher_reply ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No counseling requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Load lectures dynamically by course
const courseSelect = document.getElementById('course_id');
const lectureSelect = document.getElementById('lecture_id');

courseSelect.addEventListener('change', function () {
    const courseId = this.value;
    lectureSelect.innerHTML = '<option value="">Loading...</option>';

    fetch(`/api/lectures/by-course/${courseId}`)
        .then(response => response.json())
        .then(data => {
            let options = '<option value="">-- Select Lecture --</option>';
            data.forEach(lecture => {
                options += `<option value="${lecture.id}">${lecture.lecture_title}</option>`;
            });
            lectureSelect.innerHTML = options;
        });
});
</script>

@endsection
