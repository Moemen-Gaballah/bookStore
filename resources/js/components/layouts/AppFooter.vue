<template>
    <div class="footer" dir="rtl">
        <div class="container">
            <div class="row text-right mt-5">
                <div class="col-md-4 ">
                    <div class="about">
                        <h3>من نحن</h3>
                        <p>
                            متجر بوك استور للكتب العربية، بوابتك للقراءة والمعرفة، حيث تجد أحدث الكتب من جميع دول العالم في مكانٍ واحد.
                        </p>
                        <div class="contact-us mb-4">

                                <a href="https://wa.me/00201212283207" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                        واتساب
                                </a>

                                <a href="tel:+201212283207" target="_blank">
                                    <i class="fas fa-mobile-alt"></i>
                                    جوال
                                </a>

                                <a href="tel:+201212283207" target="_blank">
                                    <i class="fas fa-phone-alt"></i>
                                    جوال
                                </a>

                                <a href="mailto:moemengaballa@gmail.com" target="_blank">
                                    <i class="far fa-envelope"></i>
                                    بريد
                                </a>

                        </div>
                        <div class="download">
                            <a href="#" target="_blank">
                                <img src="/img/icon/appstore.png">
                            </a>
                            <a href="#" target="_blank">
                                <img src="img/icon/googleplay.png">
                            </a>
                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <div class="links">
                        <h3>روابط مهمة</h3>
                        <div class="ref-site">
                            <a href="#" target="_blank">
                                ما هو بوك استور؟
                            </a>
                            <a href="#" target="_blank">
                                اتفاقية الاستخدام
                            </a>
                            <a href="#" target="_blank">
                                سياسة الخصوصية والدفع
                            </a>
                            <a href="#" target="_blank">
                                شروط الخدمة والاسترجاع
                            </a>
                            <a href="#" target="_blank">
                                الاسئلة المتكررة
                            </a>
                            <a href="#" target="_blank">
                                انشر كتابك معنا
                            </a>
                            <a href="#" target="_blank">
                                شهادة ضريبة القيمة المضافة
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="social">
                        <h3>تابعنا على الشبكات الاجتماعية</h3>
                        <div class="social-media">
                            <a href="https://www.linkedin.com/in/MoemenGaballah" target="_blank">
                                <i class="fab fa-linkedin fa-2x "></i>
                            </a>
                            <a href="https://www.facebook.com/MoemenGaballah" target="_blank">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                            <a href="https://twitter.com/moemengaballa" target="_blank">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                            <!-- <a href="" target="_blank">
                                <i class="fab fa-youtube fa-2x"></i>
                            </a> -->
                            <a href="https://github.com/Moemen-Gaballah" target="_blank">
                                <i class="fab fa-github-square fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- End div row -->


        </div> <!-- End div container -->
        <div class="copyright text-center">
            <p>
                الحقوق محفوظة ل
                <a href="https://www.facebook.com/MoemenGaballah" target="_blank">
                    بوك استور
                </a>
                &copy; 2021
            </p>
        </div>
    </div> <!-- end div footer -->
</template>

<style scoped>
    .footer {
        border-top: 2px solid #DDD;
    }

    .footer h3{
        color: #00A99D;
        margin-bottom: 18px;
        font-weight: bold;
    }

    .footer .about p{
        font-size: 17px;
        font-weight: 600;
        line-height: 1.7;
        color: #0000009c;
        margin-bottom: 18px;
    }

    .footer .contact-us a{
        padding-left: 5px;
        color: #0000009c;
        text-decoration: none;
        font-weight: bold;
    }

    .footer .contact-us a:hover{
        color: #00A99D;
    }

    .footer .download img{
        max-width: 120px;
    }

    .footer .links .ref-site a{
        display: block;
        color: #35353594;
        margin-bottom: 6px;
        text-decoration: none;
        font-weight: bold;
        font-size: 17px;
    }

    .social .social-media a{
        padding-left: 5px;
        color: #35353594;
        text-decoration: none;
        font-weight: bold;
    }

    .social .social-media a:hover{
        color: #00A99D;
        /* transition: all .3s ease-in-out; */
    }

    .footer .copyright{
        background-color: #00A99D;
        color: #FFF;
        margin-top: 25px;
    }

    .footer .copyright p{
        padding: 12px;
        font-size: 16px;
        margin-bottom: 0;

    }

    .footer .copyright a{
        color: #FFF;
        font-size: 17px;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .links, .social {
            margin-top: 30px;
        }
     }

</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
