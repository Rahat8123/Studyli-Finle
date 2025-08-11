<style>
.hero-slider-item {
    min-height: 500px; /* 15 inch laptop perfect height */
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center; /* vertically center content */
    padding: 60px 0;
}

.hero-content .section__title {
    font-size: 48px;
    line-height: 1.3;
}

.hero-content .section__desc {
    font-size: 16px;
    line-height: 1.6;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .hero-slider-item {
        min-height: 420px;
        padding: 40px 0;
    }
    .hero-content .section__title {
        font-size: 36px;
    }
    .hero-content .section__desc {
        font-size: 15px;
    }
}
</style>

<section class="hero-area">
    <div class="hero-slider owl-action-styled">
        <!-- Slide 1 -->
        <div class="hero-slider-item" style="background-image: url('{{ asset('frontend/images/diu-bg.jpg') }}');">
            <div class="container">
                <div class="hero-content">
                    <div class="section-heading">
                        <h2 class="section__title text-white pb-3">
                            আমরা আপনাকে শেখাই <br> যা আপনি ভালোবাসেন
                        </h2>
                        <p class="section__desc text-white pb-4">
                            শিক্ষা ও দক্ষতা উন্নয়নের নতুন দিগন্ত উন্মোচনে আমরা আছি আপনার পাশে।
                            <br> সহজ ভাষায়, আধুনিক পদ্ধতিতে এবং মানসম্মত কনটেন্টের মাধ্যমে।
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1">
                        <a href="admission.html" class="btn theme-btn mr-4 mb-4">
                            আমাদের সাথে যোগ দিন <i class="la la-arrow-right icon ml-1"></i>
                        </a>
                        <a href="#" class="btn-text video-play-btn mb-4" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                            প্রিভিউ দেখুন <i class="la la-play icon-btn ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slider-item" style="background-image: url('{{ asset('frontend/images/diu-bg.jpg') }}');">
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        <h2 class="section__title text-white pb-3">
                            স্টাডিলি-তে যোগ দিন <br> এবং পান ফ্রি কোর্স!
                        </h2>
                        <p class="section__desc text-white pb-4">
                            আপনার শেখার যাত্রা শুরু করুন আজই।
                            <br> এখনই রেজিস্ট্রেশন করে পেয়ে যান বাছাইকৃত ফ্রি কোর্স।
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-center">
                        <a href="admission.html" class="btn theme-btn mr-4 mb-4">
                            শুরু করুন <i class="la la-arrow-right icon ml-1"></i>
                        </a>
                        <a href="#" class="btn-text video-play-btn mb-4" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                            প্রিভিউ দেখুন <i class="la la-play icon-btn ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slider-item" style="background-image: url('{{ asset('frontend/images/diu-bg.jpg') }}');">
            <div class="container">
                <div class="hero-content text-right">
                    <div class="section-heading">
                        <h2 class="section__title text-white pb-3">
                            শিখুন যেকোনো কিছু, <br> যেকোনো সময়, যেকোনো স্থানে
                        </h2>
                        <p class="section__desc text-white pb-4">
                            অনলাইন শিক্ষার মাধ্যমে বাড়ান জ্ঞান ও দক্ষতা।
                            <br> বিশ্বমানের কনটেন্ট, আপনার হাতের নাগালে।
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-end">
                        <a href="#" class="btn-text video-play-btn mr-4 mb-4" data-fancybox data-src="https://www.youtube.com/watch?v=i5a_NSqO0MA">
                            <i class="la la-play icon-btn mr-2"></i> প্রিভিউ দেখুন
                        </a>
                        <a href="" class="btn theme-btn mb-4">
                            <i class="la la-arrow-left icon mr-1"></i> ভর্তি হোন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
