@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
<style>
    /* Global Styles */
    html, body {
        overflow-x: hidden;
        scroll-behavior: smooth;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    /* Animated Background */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 118, 117, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.2) 0%, transparent 50%);
        z-index: -1;
        animation: backgroundShift 20s ease-in-out infinite;
    }

    @keyframes backgroundShift {
        0%, 100% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(-20px) translateY(-10px); }
        50% { transform: translateX(10px) translateY(-20px); }
        75% { transform: translateX(-10px) translateY(10px); }
    }

    /* Container */
    .container {
        position: relative;
        z-index: 1;
    }

    /* Card Animations */
    .card {
        scroll-margin-top: 80px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 15px 12px rgba(0, 0, 0, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: cardSlideUp 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    @keyframes cardSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 30px 60px rgba(0, 0, 0, 0.15),
            0 20px 20px rgba(0, 0, 0, 0.08);
    }

    /* Header Animations */
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        position: relative;
        overflow: hidden;
        padding: 20px;
        border-radius: 20px 20px 0 0;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .card-header h5, .card-header h6 {
        position: relative;
        z-index: 1;
        margin: 0;
        font-weight: 600;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        animation: titleGlow 2s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from { text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); }
        to { text-shadow: 0 2px 20px rgba(255, 255, 255, 0.3); }
    }

    /* Form Elements */
    .form-control, select {
        border: 2px solid rgba(103, 126, 234, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        font-size: 14px;
        max-height: none;
        overflow: visible;
    }

    .form-control:focus, select:focus {
        border-color: #667eea;
        box-shadow:
            0 0 0 4px rgba(103, 126, 234, 0.1),
            0 8px 25px rgba(103, 126, 234, 0.15);
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 1);
    }

    /* Animated Labels */
    label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        display: block;
        position: relative;
        transition: all 0.3s ease;
    }

    label::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transition: width 0.4s ease;
    }

    .form-group:focus-within label::after {
        width: 100%;
    }

    /* Radio Button Styling */
    .form-check-input[type="radio"] {
        width: 20px;
        height: 20px;
        border: 2px solid #667eea;
        border-radius: 50%;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-check-input[type="radio"]:checked {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-color: #667eea;
        animation: radioCheck 0.3s ease;
    }

    @keyframes radioCheck {
        0% { transform: scale(0.8); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .form-check-label {
        margin-left: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-check:hover .form-check-label {
        color: #667eea;
        transform: translateX(5px);
    }

    /* Button Styling */
    .btn-success {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
    }

    .btn-success::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transition: all 0.6s ease;
        transform: translate(-50%, -50%);
    }

    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(72, 187, 120, 0.4);
        background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    }

    .btn-success:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-success:active {
        transform: translateY(-1px);
    }

    /* Table Styling */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table {
        margin: 0;
        background: rgba(255, 255, 255, 0.95);
    }

    .table thead th {
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        position: relative;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        animation: fadeInRow 0.6s ease forwards;
        opacity: 0;
        transform: translateX(-20px);
    }

    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }

    @keyframes fadeInRow {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .table tbody tr:hover {
        background: linear-gradient(90deg, rgba(103, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        transform: translateX(5px);
    }

    .table td {
        padding: 15px;
        border-color: rgba(0, 0, 0, 0.05);
        vertical-align: middle;
    }

    /* Badge Animations */
    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        animation: badgePulse 2s ease-in-out infinite;
        position: relative;
        overflow: hidden;
    }

    .badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .badge:hover::before {
        left: 100%;
    }

    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .bg-warning {
        background: linear-gradient(135deg, #f6e05e 0%, #d69e2e 100%) !important;
        color: #744210 !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%) !important;
    }

    /* Loading Animation */
    .loading-dots {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .loading-dots div {
        position: absolute;
        top: 33px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #667eea;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .loading-dots div:nth-child(1) {
        left: 8px;
        animation: loading1 0.6s infinite;
    }

    .loading-dots div:nth-child(2) {
        left: 8px;
        animation: loading2 0.6s infinite;
    }

    .loading-dots div:nth-child(3) {
        left: 32px;
        animation: loading2 0.6s infinite;
    }

    .loading-dots div:nth-child(4) {
        left: 56px;
        animation: loading3 0.6s infinite;
    }

    @keyframes loading1 {
        0% { transform: scale(0); }
        100% { transform: scale(1); }
    }

    @keyframes loading3 {
        0% { transform: scale(1); }
        100% { transform: scale(0); }
    }

    @keyframes loading2 {
        0% { transform: translate(0, 0); }
        100% { transform: translate(24px, 0); }
    }

    /* Form Group Animation */
    .mb-3 {
        animation: formGroupSlide 0.8s ease-out;
        animation-fill-mode: both;
    }

    .mb-3:nth-child(1) { animation-delay: 0.1s; }
    .mb-3:nth-child(2) { animation-delay: 0.2s; }
    .mb-3:nth-child(3) { animation-delay: 0.3s; }
    .mb-3:nth-child(4) { animation-delay: 0.4s; }
    .mb-3:nth-child(5) { animation-delay: 0.5s; }

    @keyframes formGroupSlide {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card {
            margin: 10px;
            border-radius: 15px;
        }

        .card-header {
            padding: 15px;
        }

        .table-responsive {
            font-size: 14px;
        }
    }

    /* Floating Particles Effect */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
</style>

<div class="container mt-4">
    <!-- Floating Particles -->
    <div class="particle" style="top: 10%; left: 10%; width: 6px; height: 6px; background: #667eea; animation-delay: 0s;"></div>
    <div class="particle" style="top: 20%; left: 80%; width: 4px; height: 4px; background: #764ba2; animation-delay: 2s;"></div>
    <div class="particle" style="top: 60%; left: 20%; width: 8px; height: 8px; background: #48bb78; animation-delay: 4s;"></div>
    <div class="particle" style="top: 80%; left: 70%; width: 5px; height: 5px; background: #f6e05e; animation-delay: 1s;"></div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">✨ Request for Counseling</h5>
        </div>
        <div class="card-body">
            <form id="counselingForm" method="POST" action="{{ route('counseling.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="course_id">📚 Select Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lecture_id">🎓 Select Lecture</label>
                        <select name="lecture_id" id="lecture_id" class="form-control" required>
                            <option value="">-- Select Lecture --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="description">📝 Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required placeholder="Describe your counseling needs..."></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="preferred_date">📅 Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="preferred_time">⏰ Preferred Time</label>
                        <input type="time" name="preferred_time" id="preferred_time" class="form-control" step="1" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>💻 Mode</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="online" value="online" required>
                            <label class="form-check-label" for="online">🌐 Online</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mode" id="offline" value="offline" required>
                            <label class="form-check-label" for="offline">🏢 Offline</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    <span>Submit Request</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h6 class="mb-0">📋 My Counseling Requests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>📚 Course</th>
                            <th>🎓 Lecture</th>
                            <th>📅 Date</th>
                            <th>⏰ Time</th>
                            <th>💻 Mode</th>
                            <th>📊 Status</th>
                            <th>💬 Teacher Reply</th>
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
                                        <span class="badge bg-warning">⏳ Pending</span>
                                    @elseif($req->status == 'accepted')
                                        <span class="badge bg-success">✅ Accepted</span>
                                    @else
                                        <span class="badge bg-danger">❌ Declined</span>
                                    @endif
                                </td>
                                <td>{{ $req->teacher_reply ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">📝 No counseling requests yet.</td></tr>
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

    // Add loading animation
    lectureSelect.innerHTML = '<option value="">⏳ Loading...</option>';
    lectureSelect.style.opacity = '0.6';

    // Add loading effect
    setTimeout(() => {
        fetch(`/api/lectures/by-course/${courseId}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">-- Select Lecture --</option>';
                data.forEach(lecture => {
                    options += `<option value="${lecture.id}">${lecture.lecture_title}</option>`;
                });
                lectureSelect.innerHTML = options;
                lectureSelect.style.opacity = '1';

                // Add success animation
                lectureSelect.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    lectureSelect.style.transform = 'scale(1)';
                }, 200);
            })
            .catch(error => {
                lectureSelect.innerHTML = '<option value="">❌ Error loading lectures</option>';
                lectureSelect.style.opacity = '1';
            });
    }, 300);
});

// Add form submission animation
document.getElementById('counselingForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = '<span>⏳ Submitting...</span>';
    submitBtn.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    submitBtn.disabled = true;

    // Reset after 3 seconds if form doesn't redirect
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.style.background = 'linear-gradient(135deg, #48bb78 0%, #38a169 100%)';
        submitBtn.disabled = false;
    }, 3000);
});

// Add hover effects to form controls
document.querySelectorAll('.form-control, select').forEach(element => {
    element.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateY(-2px)';
    });

    element.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateY(0)';
    });
});

// Add ripple effect to buttons
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('div');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .btn {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>

@endsection
