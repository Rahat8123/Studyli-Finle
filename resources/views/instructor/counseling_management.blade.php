@extends('instructor.instructor_dashboard')

@section('instructor')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Counseling Management</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Lecture</th>
                            <th>Preferred Date</th>
                            <th>Time</th>
                            <th>Mode</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td>{{ $req->user->name }}</td>
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
                            <td>
                                <button class="btn btn-sm btn-success" onclick="openReplyModal({{ $req->id }}, 'accepted')">Accept</button>
                                <button class="btn btn-sm btn-danger" onclick="openReplyModal({{ $req->id }}, 'declined')">Decline</button>
                                <button class="btn btn-sm btn-primary" onclick="openEditModal({{ $req->id }})">Edit</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No counseling requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('counseling.reply') }}">
                @csrf
                <input type="hidden" name="request_id" id="replyRequestId">
                <input type="hidden" name="status" id="replyStatus">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Message (optional)</label>
                        <textarea name="teacher_reply" id="teacher_reply" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('counseling.update') }}">
                @csrf
                <input type="hidden" name="request_id" id="editRequestId">
                 <input type="hidden" name="status" value="accepted">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Counseling Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Date</label>
                        <input type="date" name="preferred_date" class="form-control mb-2" id="editDate">

                        <label>Time</label>
                        <input type="time" name="preferred_time" class="form-control mb-2" id="editTime">

                        <label>Mode</label>
                        <select name="mode" id="editMode" class="form-control mb-2">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>

                        <label>Reply Message (optional)</label>
                        <textarea name="teacher_reply" class="form-control" id="editReply" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script>
function openReplyModal(id, status) {
    document.getElementById('replyRequestId').value = id;
    document.getElementById('replyStatus').value = status;
    document.getElementById('teacher_reply').value = '';
    new bootstrap.Modal(document.getElementById('replyModal')).show();
}

function openEditModal(id) {
    fetch(`/api/counseling/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editRequestId').value = data.id;
            document.getElementById('editDate').value = data.preferred_date;
            document.getElementById('editTime').value = data.preferred_time;
            document.getElementById('editMode').value = data.mode;
            document.getElementById('editReply').value = data.teacher_reply || '';
            new bootstrap.Modal(document.getElementById('editModal')).show();
        });
}
</script>
@endsection
