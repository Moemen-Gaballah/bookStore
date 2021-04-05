<template>
    <div class="main-navbar">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <a class="navbar-brand" href="#">bookStore</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="fa fa-sliders-h"></i></span>
                </button>
                  <div class="category collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="#">الرئيسية -<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">روايات -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">تطوير ذات -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">الشعر -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">قصص -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">ثقافة عامة -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">دور نشر عربية -</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">كتب مترجمة</a>
                      </li>
                    </ul>
                    <div class="login ml-0">
                        <ul class="list-inline icons">
                            <li class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-globe-africa"></i></a></li>
                            <li class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-user"></i></a></li>
                            <li class="list-inline-item  mr-1"><a class="nav-link"><i class="fa fa-search"></i></a></li>
                            <li class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-cart-plus"></i>
                            <span class="cartCount"> {{counter}} </span>
                            </a></li>
                        </ul>
                    </div>
                  </div>
          </div>
        </nav>

    </div>
</template>

<style scoped>
    .main-navbar{
        background-color: #00A99D;
        direction: rtl;
        color: #FFF;
        font-size: 18px;
        margin: 0 auto;

    }
    .main-navbar .navbar{
        background-color: #00A99D;
    }

    .navbar-brand {
        color: #FFF;
        margin-right: 0px;
        font-size: 24px;
        font-weight: bold;
    }

    .navbar-toggler {
        color: #FFF;
        font-size: 24px;
        padding: 0px;
    }

    .main-navbar .login ul{
        margin-bottom: 0px;
    }

    .main-navbar a{
        color: #FFF;
    }


    .main-navbar .login .icons li{
        color: #FFF;
        cursor: pointer;
    }

    .main-navbar .login .icons li:hover a{
        background-color: #FFF;
        cursor: pointer;
        color: #00A99D;
        transition: all .5s ease-in-out;
    }

    .main-navbar .login .icons a{
        padding: 0px 6px !important;
        border: 1px solid #FFF;
        border-radius: 50%;

    }

    .main-navbar .login .icons a i {
        font-weight: 700;
        font-size: 16px;
    }

    .main-navbar .cartCount {
        position: absolute;
        top: 12px;
        padding: 2px 4px;
        border: 1px solid #00a99d;
        border-radius: 50%;
        background-color: #FFF;
        color: #00a99d;
        font-size: 12px;
    }

    @media (max-width: 992px) {
        .navbar-toggler-icon {
            padding-top: 0.32rem;
            padding-bottom: 0.32rem;
        }

        .category{
            margin-right: auto !important;
            direction: ltr !important;
            text-align: right !important;
        }

        .main-navbar .cartCount {
            top: auto;
        }
      }

</style>

<script>
    export default {
        computed:{
            counter() {
                return this.$store.state.counter
            }
        },
        data() {
            return {

            }
        },
        methods: {
            countItemCart() {
                var count = 0;
                if(JSON.parse(localStorage.getItem("carts")) != null){
                      JSON.parse(localStorage.getItem("carts")).forEach(item =>{
                         if(item !=' ' &&  item!=null){
                               count+=1;
                            }
                         })
                  }
                this.$store.state.counter = count;
            }
        },
        created() {
            this.countItemCart()
        }
    }
</script>
