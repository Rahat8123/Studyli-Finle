@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<div class="dashboard-container">
    <!-- Enhanced Profile Header -->
    <div class="profile-header-card mb-5">
        <div class="card-gradient-bg"></div>
        <div class="profile-content d-flex flex-wrap align-items-center justify-content-between position-relative">
            <div class="profile-info d-flex align-items-center">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar">
                        <img src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')}}"
                             alt="Profile Image" class="avatar-img">
                        <div class="avatar-status-indicator"></div>
                    </div>
                </div>
                <div class="profile-details ml-4">
                    <h2 class="profile-name mb-2">Hello, {{ $profileData->name }}</h2>
                    <div class="rating-container d-flex align-items-center">
                        <div class="stars-wrapper d-flex align-items-center">
                            <span class="rating-score">4.4</span>
                            <div class="stars ml-2">
                                <i class="fas fa-star star-filled"></i>
                                <i class="fas fa-star star-filled"></i>
                                <i class="fas fa-star star-filled"></i>
                                <i class="fas fa-star star-filled"></i>
                                <i class="far fa-star star-empty"></i>
                            </div>
                        </div>
                        <span class="rating-count ml-2">(20,230 reviews)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Title -->
    <div class="dashboard-title-section mb-4">
        <h3 class="dashboard-title">
            <i class="fas fa-chart-line mr-2"></i>
            Dashboard Overview
        </h3>
        <div class="title-underline"></div>
    </div>

    <!-- Enhanced Stats Cards -->
    <div class="stats-grid">
        <!-- Enrolled Courses Card -->
        <div class="stats-card enrolled-card">
            <div class="card-inner">
                <div class="card-icon-wrapper">
                    <div class="card-icon enrolled-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.402-.139 2.563.063 3.112.456.549-.393 1.71-.595 3.112-.456C11.846 2.06 13.115 2.46 14 2.828v9.344c-.885-.37-2.154-.769-3.388-.893-1.402-.139-2.563.063-3.112.456-.549-.393-1.71-.595-3.112-.456C3.154 11.403 1.885 11.803 1 12.172V2.828z"/>
                            <path d="M14 1.5v.634c-.96-.41-2.29-.82-3.612-.95-1.577-.156-3.004.087-3.888.787-.884-.7-2.311-.943-3.888-.787C1.29.68.96 1.09 0 1.5v12.634c0 .388.298.707.67.74 1.016.09 2.523-.25 3.806-.426 1.353-.185 2.388-.05 2.942.363.179.132.39.198.582.198.192 0 .403-.066.582-.198.554-.413 1.589-.548 2.942-.363 1.283.176 2.79.516 3.806.426.372-.033.67-.352.67-.74V1.5h-1z"/>
                        </svg>
                    </div>
                </div>
                <div class="card-content">
                    <p class="card-label">Enrolled Courses</p>
                    <h4 class="card-value">{{ $enrolledCount }}</h4>
                    <div class="card-trend">
                        <i class="fas fa-arrow-up trend-icon"></i>
                        <span class="trend-text">Total enrolled</span>
                    </div>
                </div>
            </div>
            <div class="card-glow enrolled-glow"></div>
        </div>

        <!-- Active Courses Card -->
        <div class="stats-card active-card">
            <div class="card-inner">
                <div class="card-icon-wrapper">
                    <div class="card-icon active-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.5 2.47c.653-.28 1.591-.5 2.61-.5 1.354 0 2.552.363 3.39.683v9.694c-.838-.32-2.036-.683-3.39-.683-1.02 0-1.957.22-2.61.5v-9.194z"/>
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.402-.139 2.563.063 3.112.456.549-.393 1.71-.595 3.112-.456C11.846 2.06 13.115 2.46 14 2.828v9.344c-.885-.37-2.154-.769-3.388-.893-1.402-.139-2.563.063-3.112.456-.549-.393-1.71-.595-3.112-.456C3.154 11.403 1.885 11.803 1 12.172V2.828z"/>
                        </svg>
                    </div>
                </div>
                <div class="card-content">
                    <p class="card-label">Active Courses</p>
                    <h4 class="card-value">{{ $activeCount }}</h4>
                    <div class="card-trend">
                        <i class="fas fa-play-circle trend-icon"></i>
                        <span class="trend-text">Currently active</span>
                    </div>
                </div>
            </div>
            <div class="card-glow active-glow"></div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Enhanced Profile Header */
.profile-header-card {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 30px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
}

.card-gradient-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
}

.profile-content {
    position: relative;
    z-index: 2;
}

.profile-avatar-wrapper {
    position: relative;
}

.profile-avatar {
    position: relative;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    padding: 4px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
}

.avatar-status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 20px;
    height: 20px;
    background: #4CAF50;
    border: 3px solid white;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.profile-name {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin: 0;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.rating-container {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 8px 16px;
    border: 1px solid rgba(255,255,255,0.2);
}

.rating-score {
    font-weight: 700;
    color: #FFD700;
    font-size: 1.1rem;
}

.stars {
    display: flex;
    gap: 2px;
}

.star-filled {
    color: #FFD700;
    text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

.star-empty {
    color: rgba(255,255,255,0.4);
}

.rating-count {
    color: rgba(255,255,255,0.9);
    font-size: 0.9rem;
}

/* Dashboard Title */
.dashboard-title-section {
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    display: flex;
    align-items: center;
    margin: 0;
}

.dashboard-title i {
    color: #667eea;
}

.title-underline {
    height: 3px;
    width: 60px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
    margin-top: 8px;
}

/* Enhanced Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.stats-card {
    position: relative;
    background: white;
    border-radius: 16px;
    padding: 0;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.stats-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-inner {
    padding: 2rem;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.card-icon-wrapper {
    flex-shrink: 0;
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.enrolled-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
}

.active-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    box-shadow: 0 8px 32px rgba(240, 147, 251, 0.3);
}

.card-content {
    flex: 1;
}

.card-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #64748b;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 8px 0;
    line-height: 1;
}

.card-trend {
    display: flex;
    align-items: center;
    gap: 6px;
}

.trend-icon {
    font-size: 0.75rem;
    opacity: 0.7;
}

.enrolled-card .trend-icon {
    color: #667eea;
}

.active-card .trend-icon {
    color: #f5576c;
}

.trend-text {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 500;
}

/* Card Glow Effects */
.card-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.stats-card:hover .card-glow {
    opacity: 1;
}

.enrolled-glow {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
}

.active-glow {
    background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%);
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-header-card {
        padding: 20px;
    }

    .profile-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .profile-name {
        font-size: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .card-inner {
        padding: 1.5rem;
    }

    .card-value {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .profile-avatar {
        width: 60px;
        height: 60px;
    }

    .profile-name {
        font-size: 1.25rem;
    }

    .card-inner {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
}

/* Animation Keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-card {
    animation: fadeInUp 0.6s ease forwards;
}

.stats-card:nth-child(2) {
    animation-delay: 0.1s;
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .dashboard-title {
        color: #e2e8f0;
    }

    .stats-card {
        background: #1a202c;
        border-color: rgba(255,255,255,0.1);
    }

    .card-value {
        color: #e2e8f0;
    }

    .card-label,
    .trend-text {
        color: #a0aec0;
    }
}
</style>

@endsection
