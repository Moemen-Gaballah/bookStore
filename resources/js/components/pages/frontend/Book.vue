<template>
    <div class="book">
        <div class="container">

            <p class="path">
                <!-- <p @click="increase"><i class="fas fa-plus"></i>+</p>
                <p @click="decrease"><i class="fas fa-minu"></i>-</p> -->
                <i class="fas fa-home"></i>
                <a href="/">
                    الرئيسية
                 </a>
                &gt;
                روايات
            </p>
        </div>
            <div class="info">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-8">
                            <h2 class="title">{{book.title}}</h2>
                            <p class="author">{{book.author}}</p>
                            <p class="price">{{book.price}}ج.م</p>
                            <p>السعر شامل الضريبه</p>
                            <img class="mr-auto" :src="'../img/book/'+book.image">
                            <p class="desc">{{book.description}}</p>

                            <div class="addToCart">
                                <div class="content">
                                    <div class="box">
                                        <div class="description">
                                            <div class="quantity text-center">
                                                <p>
                                                    الكمية<span class="text-danger ml-5">*</span>
                                                </p>
                                                <span @click="increaseItem" class="plus">
                                                    +
                                                </span>
                                                <span v-model="count" class="count">
                                                    {{ count }}
                                                </span>
                                                <span @click="decreaseItem" class="minus">
                                                    -
                                                </span>
                                            </div>
                                          <!--   <p class="d-inline-block float-right">السعر</p>
                                            <p class="price d-inline-block float-left">
                                                {{ book.price }}
                                                ج.م
                                            </p>
                                            <div class="clearfix"></div> -->
                                            <p class="d-inline-block float-right">السعر
                                                <br>
                                                <span>السعر شامل الضريبه</span>
                                            </p>
                                            <p class="totlePriceOneProduct d-inline-block float-left">
                                                {{ (book.price *  count).toFixed(2)}}
                                                ج.م
                                            </p>
                                            <div class="clearfix"></div>
                                            <button @click="addToCart(book.id)" class="buttonAddToCart">اضف للسلة</button>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>


                            <!-- Share on socila media -->

                            <div class="share-this text-center mt-4">
                                <div class="social">
                                    <div class="social-media">
                                        <a :href="'https://www.linkedin.com/shareArticle?mini=true&url='+host+'/book/'+book.id" target="_blank">
                                            <i class="fab fa-linkedin fa-2x "></i>
                                        </a>
                                            <a :href="'https://www.facebook.com/sharer/sharer.php?u='+host+'/book/'+book.id+'&'+'t='+book.title" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Share on Facebook">
                                            <i class="fab fa-facebook fa-2x"></i>
                                        </a>

                                        <a :href="'https://twitter.com/intent/tweet?url=http://'+host+'/book/'+book.id+'&text='+book.title" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Share on Twitter">
                                            <i class="fab fa-twitter fa-2x"></i>
                                        </a>
            
                                        <p id="p1" class="d-none">{{host + '/book/'+book.id}}</p>
                                        <input type="text" style="display:contents" :value="'http://'+host+'/book/'+book.id" id="myInput">
                                        <a @click.prevent="copyUrl('#p1')" href="" target="_blank">
                                            <i class="fas fa-link fa-2x"></i>
                                        </a>

                                    </div>
                                </div>

                            </div>


                            <!-- <div class="sharethis-inline-share-buttons"></div> -->

                            <!-- Share on socila media -->

                        </div>
                    </div> 
                </div>
            </div><!-- end div info -->


            <div class="section-comments mt-5 mb-5">
                <div class="container">

                    <div class="comments">
                        <div class="row">
                            <div class="col-12">
                                <img src="/img/user/user.png">
                                <h3 class="d-inline-block">moemen</h3>
                                <div class="rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>

                                </div>
                            </div>
                        <!--     <div class="clearfix">
                            </div> -->
                            <p class="content">
                                انصح بيه كتاب جميل جدا 
                            </p>
                            <span class="created_at"> منذ 3 اشهر</span>

                        </div>
                    </div>
                    
                </div>
            </div>

        </div><!-- end div books -->
</template>

<style scoped>
        .book {
            direction: rtl;
            text-align: right;
            margin-top: 15px;
            margin-bottom: 15px;

        }

        .book .path {
            color: #8c8c8c;
            font-size: 16px;
        }

        .book .path a{
            direction: rtl;
            text-align: right;
            font-size: 17px;
            color: #8c8c8c;
            text-decoration: none;
        }

        .book .info {
            padding: 20px;
            background-color: #fafafa;
        }

        .book .info .title {
            font-weight: bold;
            font-size: 24px;
        }

        .book .info .author {
            font-size: 18px;
        }

        .book .info p.desc {
            color: #9C9C9C;
            margin-top: 16px;
            text-align: center;

        }

        .book .info .price {
            color:#00A99D;
            font-size: 28px;
            margin: 0;
        }

        .book .info img {
            /*max-width:300px;
            max-height:600px;*/

            width: 60%;
            max-height: 560px;
            display: block;
            margin: auto;
        }
        .book .info .content .box {
            border: 1px solid #DDD;
            padding: 20px;
            width: 60%;
            margin: auto;
            background-color: #FFF;
            border-radius: 5px 10px 10px;
        }

        .book .info .content .box .description {
            display: inline-block;
        }

        .book .info .content .box .title {
            margin: 10px 0 0 0;
            color: #a2a2a2;
        }

        .book .info .content .box p span{
            
            font-size: 12px;
        
        }

        .book .info .content .box .quantity{
            margin-bottom: 10px;
        }


        .book .info .content .box .quantity p {
            display: inline-block;
            margin-right: 5px;
            float: right;
            line-height: 2;
        }

        .book .info .content .box .quantity > span {
            border: 1px solid #d0d0d0;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #696969;
            display: inline-block;
            margin-left: 0;
            padding: 5px 10px;
        }

        .book .info .content .box .quantity span{
            width: 40px !important;
            cursor: pointer;
        }

        .book .info .content .box .quantity .count{
            width: 200px !important;
        }

        .book .info .content .box .totlePriceOneProduct{
            /*line-height: 2;*/
            font-size: 20px;
            color: #00A99D !important;
        }


        .book .info .content .box .buttonAddToCart{
            width: 100%;
            border: 2px;
            border-radius: 6px;
            background-color: #00a99d;
            color: #FFF;
            padding: 8px;
            font-size: 16px;
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


    /* Start Section comments */

    .comments {
        position: relative;

    }

    .comments .row{
        border-bottom: 1px solid #dddddd96;

    }

    .comments img{
        max-height: 46px;
        max-width: 46px;
        border-radius: 50%;
        border: 1px solid #DDD;
        padding: 2px;
    }

    .comments h3{
        margin-bottom: 0;
    }

    .comments .rate{
        margin-right: 42px;
        margin-top: 0;
    }


    .comments .content{
        margin-right: 60px;
    }

    .comments .created_at{
        position: absolute;
        left: 0px;
        color: #8b8b8b;
    }

    /* end section comments */
</style>




<script>


    export default {
        data() {
            return {
                book: {

                },
                categoryName: '',
                totalcost:0,
                count:0,
                host: window.location.host,
            }
        },
        methods: {
            getBook() {
                axios.get('/api/book/'+ this.$route.params.id)
                    .then((data) => {
                        this.book = data.data.data
                    })
                    .catch(() => {

                    })
            },
            addToCart(id){
                // this.$Progress.start()
                var carts = [];
                if(this.count > 0){    
                    if(JSON.parse(localStorage.getItem("carts")) != null){

                        JSON.parse(localStorage.getItem("carts")).forEach((item,index) =>{
                           if(item !=' ' &&  item!=null){
                                 carts[index] = item;
                              }
                           })
                    }
               
                    carts[id] = this.count;
                    localStorage.setItem("carts", JSON.stringify(carts));
                    this.countItemCart();
                       // this.$Progress.finish()
                        Toast.fire({
                            icon: 'success',
                            title: 'تمت الاضافة للعربة.'
                        })
                        $(".swal2-header").css("direction", "rtl");
                }else {
                    // this.$Progress.fail()
                    Toast.fire({
                        icon: 'error',
                        title: 'يجب اضافة الكمية.'
                    })
                    $(".swal2-header").css("direction", "rtl");
            }
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
            },
            increaseItem () {
                this.count +=1
            },

            decreaseItem () {
                if( this.count > 0){
                    this.count -=1
                }
            },
            copyUrl(element) {
               var $temp = $("<input>");
                  $("body").append($temp);
                  $temp.val($(element).text()).select();
                  document.execCommand("copy");
                  $temp.remove();
            }   
        },
        created() {


            this.countItemCart()
            this.getBook();
        }
    }
</script>
