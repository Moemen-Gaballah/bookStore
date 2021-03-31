<template>
    <div class="testimonials">
        <div class="container">
            <h3 class="heading mt-5 text-center">آراء العملاء</h3>
            <div class="container">
                <div class="main">
                    <div class="row">
                        <div class="col">
                            <div class="owl-carousel owl-theme slider_testimonial">
                                <div class="owl-item">
                                    <div class="main_item img d-flex flex-column">
                                        <i class="quote fas fa-quote-right fa-3x"></i>
                                        <p class="comment text-center">جميل جدا</p>
                                        <div class="main_content">
                                            <div class="userInfo">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            <p>
                                                مؤمن
                                            </p>
                                            </div>
                                            <div class="city">تلا</div>
                                        </div>
                                        <ul class="userImg">
                                            <li class="inline-block"><img src='img/user/user.png'></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    <div class="main_item img d-flex flex-column">
                                        <i class="quote fas fa-quote-right fa-3x"></i>
                                        <p class="comment text-center">ممتاز جدا</p>
                                        <div class="main_content">
                                            <div class="userInfo">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            <p>
                                                اسلام
                                            </p>
                                            </div>
                                            <div class="city">اكتوبر</div>
                                        </div>
                                        <ul class="userImg">
                                            <li class="inline-block"><img src='img/user/user.png'></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    <div class="main_item img d-flex flex-column">
                                        <i class="quote fas fa-quote-right fa-3x"></i>
                                        <p class="comment text-center">رائع تم التوصيل قبل المعاد المتوقع التغليف ممتاز والسعر معقول شكرا على سرعة التوصيل</p>
                                        <div class="main_content">
                                            <div class="userInfo">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            <p>
                                                محسن
                                            </p>
                                            </div>
                                            <div class="city">السويس</div>
                                        </div>
                                        <ul class="userImg">
                                            <li class="inline-block"><img src='img/user/user.png'></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900|Rubik:300,400,500,700,900');

.heading {
    color: #505050c7;
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 0;
}

.main {
    padding-top: 30px;
    padding-bottom: 60px;
    /* background: #eff6fa */
}

.main_title_container {
    border-bottom: solid 1px #dadada
}

.main_title {
    margin-bottom: 16px;
    margin-top: 8px
}

.main_nav_container {
    position: absolute;
    right: -5px;
    bottom: 14px
}

.main_nav {
    display: inline-block;
    cursor: pointer
}

.main_nav i {
    color: #dadada;
    font-size: 18px;
    padding: 5px;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.main_nav:hover i {
    color: #606264
}

.main_prev {
    margin-right: 15px
}

.main_item {
    padding-top: 25px;
    padding-bottom: 25px;
    padding-left: 30px;
    padding-right: 30px
}

.main_image {
    width: 150px;
    height: 150px
}

.main_image img {
    display: block;
    max-width: 100%
}

.main_content {
    width: 88%;
    text-align: right;
    /* margin-right: 20px; */
}

.city {
    width: 100%;
    text-align: right;
    font-size: 18px;
    color: #403b3ba1;
}

.userInfo {
    font-size: 22px;
    color: #403b3ba1;
    font-weight: 600;
    height: 30px;
    margin-top: 5px;
    padding-top: 1px;
}

.userInfo i{
    padding-top: 0px;
    font-size: 14px;
    color: #FCD34C;
}

.userInfo p{
    display: inline-block;
    padding-top: 1px;
}


.userInfo span {
    position: relative;
    font-size: 12px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.6);
    margin-left: 8px
}

.userInfo span::after {
    display: block;
    position: absolute;
    top: 6px;
    left: -2px;
    width: calc(100% + 4px);
    height: 1px;
    background: #8d8d8d;
    content: ''
}


.userImg {
    position: absolute;
    bottom: 24px;
    right: 18px
}

.userImg li {
    display: none;
    width: 55px;
    height: 40px;
    border-radius: 50%;
    color: #FFFFFF;
    font-size: 10px;
    font-weight: 500;
    line-height: 36px;
    text-align: center
}


.main_item.img .inline-block {
    display: inline-block
}

.main_item.is_new .item_new {
    display: inline-block
}

.testimonials .owl-carousel .owl-item {
    float: right;
    width: 100%;
    border: 1px solid #DDD;
    height: 160px;
    border-radius: 10px;
}

.testimonials i.quote {
    color: #EDEDED;
    position: absolute;
    top: 10px;
    right: 20px;
}


.testimonials .comment {
    font-size: 18px;
    margin-top: 15px;
    margin-bottom: 0;
    color: #9a9999;
}

@media (max-width: 576px) {
    /* .owl-item {
        width: 490px !important;
    }
    .active {
        width: 490px !important;
    } */

 }

</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
