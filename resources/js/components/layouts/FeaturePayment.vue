<template>
    <div class="container">
        <div class="row justify-content-center text-center box-payment font-weight-bold">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                      <p><i class="fas fa-money-check-alt fa-2x text-white"></i></p>
                    <p class="h3 mb-0">خيارات دفع متعددة</p>
                  </div>
                  <div class="card-header">ادفع باستخدام بطاقات مدى أو ماستر كارد وفيزا،و Appel Pay!</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                  <div class="card-body">
                       <p><i class="fa fa-shipping-fast fa-2x text-white"></i></p>
                    <p class="h3 mb-0">شحن سريع</p>
                  </div>
                  <div class="card-header">طلبك يصلك في ساعات قليلة!</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                       <p><i class="fas fa-book fa-2x text-white"></i></p>
                    <p class="h3 mb-0">أحدث الكتب دائمًا</p>
                  </div>
                  <div class="card-header">عناوين متجددة، وإصدارات من جميع أنحاء العالم.</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .box-payment {
        direction: rtl;
    }

    /* .box-payment > div{
        box-shadow: 5px 10px #888888;
    } */

    .box-payment .card{
        background-color: #00A99D;
        color: #E5F6F5;
        width: 100%;
        /* box-shadow: 0px 2px #888888;
         */
         box-shadow: 0 8px 18px 0 rgb(0 0 0 / 15%);
    }

    .box-payment .card-header{
        background-color: #00897D;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
