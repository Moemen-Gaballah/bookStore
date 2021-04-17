<template>
    <div class="cart mb-5">
        <div class="container">
            <p class="path">
                <i class="fas fa-home"></i>
                <a href="/">
                    الرئيسية
                 </a>
                &gt;
                السلة
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="makeHr">
                        <span class="tickMark">
                            &#10004;
                        </span>
                        <hr>
                        <span class="second">
                            2
                        </span>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="content">
                        <div v-if="Object.keys(cartItems).length">
                            <div  v-for="(book,index) in cartItems" class="box mt-4">
                                <span @click="deleteItem(book,index)" class="remove">
                                    <i class="far fa-times-circle text-danger"></i>
                                </span>
                                <img :src="'img/book/'+book.image">
                                <div class="description">
                                    <h3 class="title">
                                        {{ book.title }}
                                    </h3>
                                    <p class="price">
                                        {{ book.price }}
                                        ج.م
                                    </p>
                                    <p class="totlePriceOneProduct">
                                        الاجمالى
                                        {{ (book.price *  book.count).toFixed(2)}}
                                        ج.م
                                    </p>
                                </div>
                                <div class="quantity text-center">
                                    <p>
                                        الكمية<span class="text-danger ml-5">*</span>
                                    </p>
                                    <span @click="increaseItem(index)" class="plus">
                                        +
                                    </span>
                                    <span class="count">
                                        {{ book.count }}
                                    </span>
                                    <span @click="decreaseItem(index)" class="minus">
                                        -
                                    </span>
                                </div>
                            </div>
                            <div class="completeOrder mt-5">
                                <div class="calc">
                                    المجموع
                                    35220
                                </div>
                            </div>
                        </div> <!-- end div box -->

                        <div v-else class="cartEmpty text-center">
                            <i class="fas fa-heart-broken"></i>
                            <p class="mt-2 emptyText">السلة فارغة</p>
                            <router-link to="/" class="backToStore">
                                <i class="fas fa-angle-right"></i>
                                العودة للمتجر
                            </router-link>
                        </div>
                    </div>
                </div>
            </div> <!-- End div row -->


        </div>
    </div>
</template>


<style scoped>

    .cart {
        direction: rtl;
        text-align: right;
        margin-top: 15px;
    }

    .cart .path {
        color: #8c8c8c;
        font-size: 16px;
    }

    .cart .path a{
        direction: rtl;
        text-align: right;
        font-size: 17px;
        color: #8c8c8c;
        text-decoration: none;
    }
    /* end style path */


    .cart .makeHr {
        max-width: 80%;
        margin: auto;
        text-align: center;
    }

    .cart .makeHr hr{
        background-color: #00A99D;
        height: 1px;
        display: inline-block;
        width: 74%;
        padding: 0;
        margin: 0;
    }

    .cart .makeHr .tickMark {
        background-color: #00A99D;
        padding: 6px;
        color: #FFF;
        border-radius: 50%;
        font-size: 16px;
    }

    .cart .makeHr .second {
        border: 2px solid #00A99D;
        padding: 6px;
        color: #00A99D;
        border-radius: 50%;
        font-size: 17px;
        margin-right: -4px;
    }

    .cart .content .content {
        width: 80%;

    }

    .cart .content .box {
        border: 1px solid #DDD;
        padding: 0 10px 10px 10px;
        width: 60%;
        margin: auto;
    }

    .cart .content .box .remove i {
        float: left;
        font-size: 25px;
        cursor: pointer;
        margin: 10px 4px;
    }

    .cart .content .box img{
        width: 60px;
        height: 80px;
        vertical-align: top;
        margin: 10px 10px 10px 20px;
    }

    .cart .content .box .description {
        display: inline-block;
    }

    .cart .content .box .title {
        margin: 10px 0 0 0;
        color: #a2a2a2;
    }

    .cart .content .box .price {
        color: #00A99D;
        font-size: 17px;
        margin-bottom: 0;
        font-weight: bold;
    }

    .cart .content .box .quantity p {
        display: inline-block;
        margin-right: 5px;
        float: right;
        line-height: 2;
    }

    .cart .content .box .quantity > span {
        border: 1px solid #d0d0d0;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #696969;
        display: inline-block;
        margin-left: 0;
    }

    .cart .content .box .quantity .plus, .cart .content .box .quantity .minus{
        width: 40px;
        cursor: pointer;
    }

    .cart .content .box .quantity .count{
        width: 200px;
    }

    .cart .completeOrder{
        border: 1px solid #DDD;
        width: 60%;
        margin: auto;
        font-size: 18px;
        padding: 5px;
    }

    .cartEmpty {
        color: #E1E1E1;
        margin-top: 60px;
    }

    .cartEmpty i{
        font-size: 100px;
    }

    .cartEmpty .emptyText{
        font-size: 20px;
        color: #999 !important;
    }

    .cartEmpty .backToStore{
        background-color: #00897D;
        color: #fff;
        padding: 10px 15px;
        width: 300px;
        display: inline-block;
        font-size: 18px;
        border-radius: 8px;
        font-family: inherit !important;
        text-decoration: none;
    }

    .cartEmpty .backToStore i{
        font-size: 22px;
        float: right;
        line-height: 1.3;
    }

</style>


<script>
    export default {
        data() {
          return {
            carts: {},
            token: null,
            totalcost:0,
            cartItems : {
            }
          }
        },
        methods: {
            getCart() {
                if(JSON.parse(localStorage.getItem("carts")) != null){

                    JSON.parse(localStorage.getItem("carts")).forEach((item,index) =>{
                       if(item !=' ' &&  item!=null){
                             this.carts[index] = item;
                          }
                       })


                            axios({
                                 method: 'post',
                                 url: '/api/getBookForCart/',
                                 data: this.carts,
                             }).then((response) => {
                                   console.log(response);
                                   this.cartItems = response.data.data;
                                      console.log(response.data.data);
                              }).catch((error) => {
                                this.errors.record(error.response.data.errors)
                                  this.$Progress.fail()
                              });

                       // getBookForCart
                }else {
                    this.carts = 0;
                }
                console.log('lengthobject'+Object.keys(this.cartItems).length);
            },

            increaseItem (index) {
                console.log(index)
                this.cartItems[index].count +=1
            },
            decreaseItem (index) {
                if( this.cartItems[index].count > 0){
                    this.cartItems[index].count -=1
                }
            },
            deleteItem (book, index) {
                console.log(book.id)
                    var carts = [];
                        JSON.parse(localStorage.getItem("carts")).forEach((item,index) =>{
                           if(item !=' ' &&  item!=null && index!= book.id){
                                 carts[index] = item;
                              }
                           })

                    localStorage.setItem("carts", JSON.stringify(carts));
                    this.getCart();

                // this.cartItems.splice(item.id, 1);
                // console.log(this.cartItems[index] ;
                this.$delete(this.cartItems, index);

                // this.cartItems[id].count +=1
            }

        },
        created() {
            this.getCart();
        }
    };
</script>
