@extends('frontend.master')
@section('home')
<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">All Courses</h5>
            <h2 class="section__title">Browse All Courses</h2>
            <span class="section-divider"></span>
        </div>
        <div class="row">
            @foreach ($courses as $course)
            <div class="col-lg-4 responsive-column-half mb-4">
                <div class="card card-item card-preview">
                    <div class="card-image">
                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                            <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" alt="Card image cap">
                        </a>
                        @php
                            $amount = $course->selling_price - $course->discount_price;
                            $discount = ($amount/$course->selling_price) * 100;
                        @endphp
                        <div class="course-badge-labels">
                            @if ($course->bestseller == 1)
                                <div class="course-badge">Bestseller</div>
                            @endif
                            @if ($course->highestrated == 1)
                                <div class="course-badge sky-blue">Highest Rated</div>
                            @endif
                            @if ($course->discount_price == NULL)
                                <div class="course-badge blue">New</div>
                            @else
                                <div class="course-badge blue">{{ round($discount) }}%</div>
                            @endif
                        </div>
                    </div>
                    @php
                        $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
                    @endphp
                    <div class="card-body">
                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                        <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                        <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                        <div class="rating-wrap d-flex align-items-center py-2">
                            <div class="review-stars">
                                <span class="rating-number">{{ round($avarage,1) }}</span>
                                @if ($avarage == 0)
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                @elseif ($avarage == 1 || $avarage < 2)
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                @elseif ($avarage == 2 || $avarage < 3)
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                @elseif ($avarage == 3 || $avarage < 4)
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                    <span class="la la-star-o"></span>
                                @elseif ($avarage == 4 || $avarage < 5)
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                @elseif ($avarage == 5 || $avarage < 5)
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                @endif
                            </div>
                            <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($course->discount_price == NULL)
                                <p class="card-price text-black font-weight-bold">${{ $course->selling_price }}</p>
                            @else
                                <p class="card-price text-black font-weight-bold">${{ $course->discount_price }} <span class="before-price font-weight-medium">${{ $course->selling_price }}</span></p>
                            @endif
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist" id="{{ $course->id }}" onclick="addToWishList(this.id)"><i class="la la-heart-o"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</section>
@endsection
