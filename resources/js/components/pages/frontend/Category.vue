<template>
    <div class="category">
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
            <div class="books">
                <div class="bar">
                    <span>
                        {{categoryName}}
                    </span>
                    <span class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ترتيب
                        <i class="fas fa-bars"></i>
                    </span>
                    <div class="dropdown-menu text-right dropdownSort" aria-labelledby="dropdownSortButton">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sort" checked id="default" value="default">
                          <label class="form-check-label" for="default">
                            مقترحاتنا
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sort" id="bestSeller" value="bestSeller">
                          <label class="form-check-label" for="bestSeller">
                            الاكثر مبيعا
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sort" id="highRate" value="highRate">
                          <label class="form-check-label" for="highRate">
                              الاعلى تقيما
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" @click="sortItem('highPrice')" type="radio" name="sort" id="maxPrice" value="maxPrice">
                          <label class="form-check-label" @click="sortItem('highPrice')" for="maxPrice">
                              السعر من الاعلى الى الاقل
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" @click="sortItem('lessPrice')" name="sort" id="minPrice" value="minPrice">
                          <label class="form-check-label" @click="sortItem('lessPrice')" for="minPrice">
                              السعر من الاقل الى الاعلى
                          </label>
                        </div>

                    </div>

                </div>
                <div class="row">

                    <div v-for="book in books.data" class="col-sm-6 col-md-4 col-lg-3 mb-5">
                        <div class="card">
                            <router-link :to="'/book/'+book.id">
                              <img :src="'../img/book/'+book.image" class="card-img-top" alt="...">
                              <div class="card-body" style="direction: ltr;">
                                    <h5 class="card-title">
                                        {{book.title | str_limit}}
                                    </h5>
                                    <p class="card-text">
                                        {{book.author | str_limit}}
                                    </p>
                                </div>
                            </router-link>
                            <p class="price">
                                {{book.price +  ' ج.م'}}
                            </p>
                            <a @click.prevent="addToCart(book.id)" href=""><i class="fas fa-shopping-cart fa-2x"></i>
                            </a>
                          </div>
                    </div>

                </div>
            </div> <!-- end div books -->
        </div>
    </div>
</template>

<style scoped>
        .category {
            direction: rtl;
            text-align: right;
            margin-top: 15px;

        }

        .category .path {
            color: #8c8c8c;
            font-size: 16px;
        }
        .category .path a{
            direction: rtl;
            text-align: right;
            font-size: 17px;
            color: #8c8c8c;
            text-decoration: none;
        }

        .category .books {
            padding: 15px;
            text-align: right;
            width: 100%;
            margin: 30px 2px 5px;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0,0,0,0.3)

        }


        .category .books .bar{
            margin: 20px 0 10px;
        }

            .category .books .bar span {
                background-color: #00897D;
                padding: 10px;
                font-size: 22px;
                margin: 10px -15px;
                border: 1px solid #00897D;
                border-radius: 10px 0 0 10px;
                color: #FFF;
                font-weight: bold;
            }

        .category .books .bar span:last-of-type{
            float: left;
            direction: ltr;
            font-size: 15px;
            color: #e2e2e2;
            border: 1px solid #00897D;
            border-radius: 50%;
            margin: -8px 0px;
        }

    .category .books .bar .dropdownSort {
        padding: 10px;
    }

    .category .books .bar label{
        margin-right: 22px;
        font-weight: 600;
        color: #7b7b7be6;
        cursor: pointer;
        width: 100%;

    }

    /*
    *   change color for check box
    */

    input[type='radio']:after {
            width: 16px;
            height: 16px;
            border-radius: 15px;
            top: -2px;
            padding: 1px;
            position: relative;
            background-color: #ffffff;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 1px solid #afafaf;
            cursor: pointer;
        }

        input[type='radio']:checked:after {
            width: 16px;
            height: 16px;
            border-radius: 15px;
            top: -2px;
            padding: 1px;
            position: relative;
            background-color: #00A99D;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 1px solid #afafaf;
            cursor: pointer;
        }
        /* End style color checkbox */


        .category .books .row a{
            text-decoration: none;
        }

        .category .books .parentCard{
                margin: auto;
        }

        .category .books .card{
            height: 400px;
            width: 100%;
            margin: 2px;
            overflow: hidden;
            border: 0;
            padding: 15px;
            box-shadow: 0 0 1px rgb(0 0 0 / 0%), 0 1px 3px rgb(0 0 0 / 0%);
        }

        .category .books .card:hover{
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            /* transition: all .5 ease-in-out; */
            transition: box-shadow .5s;
        }

        .category .books .card img{
            height: 280px;
            width: 200px;
            margin: auto;
            display: block;
        }


        .category .books .card .card-body{
            padding: 18px 0 0 0;
        }

        .category .books .card .card-title{
            float: right;
            color: #4c4c4c;
            font-size: 20px;
            margin-bottom: 0;
        }

        .category .books .card .card-text{
            color: #8a8a8a;
            font-size: 16px;
        }


        .category .books .card a{
            color: #8a8a8a;
        }

        .category .books .card a:hover{
            color: #00A99D;
        }

        .category .books .card i{
            position: absolute;
            bottom: 10px;
            left: 10px;
        }

        .category .books .card .price{
            color: #00A99D;
            font-size: 17px;
        }
</style>



<script>


    export default {
        data() {
            return {
                books: {},
                categoryName: '',
            }
        },
        methods: {
            sortItem(type='') {
                axios.get('/api/categories/'+ this.$route.params.id+'?q='+type)
                    .then((data) => {
                        this.books = data.data.data
                    })
                    .catch(() => {

                    })
            },
            addToCart(id){
                // var count = 0;
                // if(localStorage.getItem('cart'+id)){
                //     count = parseInt(localStorage.getItem('cart'+id))+1;
                // }else{
                //     count = 1;
                // }
                // localStorage.setItem('cart'+id, count);

                // =========================================

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
            this.countItemCart()
            axios.get('/api/categories/'+ this.$route.params.id)
                .then((data) => {
                    this.books = data.data.data
                    this.categoryName = data.data.categoryName
                })
                .catch(() => {

                })
        }
    }
</script>
