<template>
    <div class="sliderProducts" >
        <div class="container">
            <!-- <div v-for="category in allCategories.data"> -->
            <!-- <div> -->
            <div v-for="category in allCategories.data">
                <div class="books">
                    <div class="bar">
                        <span class="float-right">
                            {{category.title}}
                        </span>
                        <span style="background-color:#FFF; border:none;"></span>
                    </div>
                    <div class="row">


                        <div class="owl-carousel owl-theme owl-carousel-products">
                            <div v-for="book in category.books" class="card">
                                <router-link :to="'/book/'+book.id">
                                  <img :src="'../img/book/'+book.image" class="card-img-top" alt="...">
                                  <div class="card-body">
                                        <h5 class="card-title">
                                            {{book.title | str_limit}}
                                        </h5>
                                        <p class="card-text">
                                            {{book.author |  str_limit}}
                                        </p>
                                    </div>
                                </router-link>
                                <p class="price">
                                    {{book.price +  ' ج.م'}}
                                </p>
                                <button class="btnAddToCart" @click.prevent="addToCart(book.id)" ><i class="fas fa-shopping-cart fa-2x"></i>
                                </button>
                            </div> <!-- End div card -->
                         </div>

                    </div>
                </div> <!-- end div books -->
            </div>

            <!-- </div> -->
        </div> <!-- End div Container -->
    </div> <!-- End Div Slider products -->
</template>

<style>
    .sliderProducts {
        /* height: 400px; */
        /* background-color: #DDD; */
        margin: 40px auto;
    }

    .owl-nav {
        position: absolute;
        top: -35px;
        background-color: #00897d;
        color:#FFF;
        overflow: hidden;

    }

    .owl-nav div{
        padding: 0 !important;
        background-color: #00897d !important;
        color:#FFF !important;
        font-size: 35px !important;
        height: 44px;
        border-radius: 50%;
    }

    .owl-carousel-products {
        padding: 15px;
        text-align: right;
        width: 100%;
        margin: 10px 2px 5px;
        overflow: hidden;
        border-radius: 5px;
        /* box-shadow: 0 0 8px rgba(0,0,0,0.3) */
    }


    .sliderProducts .books {
        padding: 15px;
        text-align: right;
        width: 100%;
        margin: 30px 2px 5px;
        overflow: hidden;
        border-radius: 5px;
        box-shadow: 0 0 8px rgba(0,0,0,0.3)

    }


    .sliderProducts .books .bar{
        margin: 20px 0 0px;
    }

        .sliderProducts .books .bar span {
            background-color: #00897D;
            padding: 10px;
            font-size: 22px;
            margin: -10px -15px 10px;
            border: 1px solid #00897D;
            border-radius: 10px 0 0 10px;
            color: #FFF;
            font-weight: bold;
        }

    .sliderProducts .books .bar span:last-of-type{
        float: left;
        direction: ltr;
        font-size: 15px;
        color: #e2e2e2;
        border: 1px solid #00897D;
        border-radius: 50%;
        margin: -8px 0px;
    }

    .sliderProducts .books .bar .dropdownSort {
    padding: 10px;
    }

    .sliderProducts .books .bar label{
    margin-right: 22px;
    font-weight: 600;
    color: #7b7b7be6;
    cursor: pointer;
    width: 100%;

    }




    .owl-carousel-products .card{
        height: 400px;
        width: 100%;
        margin: 2px;
        overflow: hidden;
        border: 0;
        padding: 15px;
        box-shadow: 0 0 1px rgb(0 0 0 / 0%), 0 1px 3px rgb(0 0 0 / 0%);
    }

    .owl-carousel-products .card a{
        text-decoration: none;
    }

    .owl-carousel-products .card:hover{
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        /* transition: all .5 ease-in-out; */
        transition: box-shadow .5s;
    }

    .owl-carousel-products .card img{
        height: 280px;
        width: 200px;
        margin: auto;
        display: block;
    }


    .owl-carousel-products .card .card-body{
        padding: 18px 0 0 0;
    }

    .owl-carousel-products .card .card-title{
        float: right;
        color: #4c4c4c;
        font-size: 20px;
        margin-bottom: 0;
    }

    .owl-carousel-products .card .card-text{
        color: #8a8a8a;
        font-size: 16px;
    }


    .owl-carousel-products .card a, .btnAddToCart{
        color: #8a8a8a;
    }

    .owl-carousel-products .card a:hover, .btnAddToCart:hover{
        color: #00A99D;
    }

    .owl-carousel-products .card i{
        position: absolute;
        bottom: 10px;
        left: 10px;
    }

    .owl-carousel-products .card .price{
        color: #00A99D;
        font-size: 17px;
    }
</style>



<script>
    // $(document).ready(function(){
    //
    // });

    export default {
        data() {
            return {
                allCategories : {},
                categoryName : 'categoryName',
                book: {
                    title: 'title',
                    id: 3,
                    author: 'moemen',
                    image: '1617376366.jpg',
                    price: 19,
                }
            }
        },
        methods: {
            getCategories() {
                axios.get('/api/home/')
                    .then((data) => {
                        this.allCategories = data.data;
                        console.log(data.data)
                    })
                    .catch(() => {

                    })
            },
            addToCart(id){
                var carts = [];
                var count = 0;
                var countForId = 0;
                if(JSON.parse(localStorage.getItem("carts")) != null){
                    JSON.parse(localStorage.getItem("carts")).forEach((item,index) =>{
                       if(item !=' ' &&  item!=null){
                             carts[index] = item;
                          }
                       })

                    if(typeof JSON.parse(localStorage.getItem("carts"))[id] !== 'undefined'){
                        countForId = JSON.parse(localStorage.getItem("carts"))[id] +1;
                    }else{
                        countForId = 1;
                    }
                }else {
                    countForId = 1;
                }

                carts[id] = countForId;
                localStorage.setItem("carts", JSON.stringify(carts));
                this.countItemCart();
            },
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
            this.getCategories();

            setTimeout(function () {

                $(".owl-carousel-products").owlCarousel({
                    items:4,
                     loop:true,
                     margin:10,
                     autoplay:true,
                     autoplayTimeout:3000,
                     autoplayHoverPause:true,
                     nav:true,
                     dots: false,
                     navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
                });
            }, 3000)

        },
        // mounted() {
        //     // this.runSlider();
        // }
    }
</script>
