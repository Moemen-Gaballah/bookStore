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
                        <div class="box">
                            <span class="remove">
                                <i class="far fa-times-circle text-danger"></i>
                            </span>
                            <img src="img/book/01.png">
                            <div class="description">
                                <h3 class="title">
                                    شكل الافكار
                                </h3>
                                <p class="price">
                                    216.83
                                    ج.م
                                </p>
                                <p class="totlePriceOneProduct">
                                    الاجمالى
                                    433
                                    ج.م
                                </p>
                            </div>
                            <div class="quantity text-center">
                                <p>
                                    الكمية<span class="text-danger ml-5">*</span>
                                </p>
                                <span class="plus">
                                    +
                                </span>
                                <span class="count">
                                    4
                                </span>
                                <span class="minus">
                                    -
                                </span>
                            </div>
                        </div>
                    </div>
                </div>



            </div>


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
        margin: auto 10%;
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

</style>


<script>
    export default {
      data() {
        return {
          carts: null,
          token: null,
          len:0,
          totalcost:0,
          cartItem : [],
          Id:-1
        }
      },
      name: 'Cart',
      props: ["baseURL"],
      methods:
      addProduct(){
        if(localStorage.getItem('cartItem')){
            cartItem = JSON.parse(localStorage.getItem('cartItem'))
        }
        cartItem.push({'productId' : productId + 1})
        localStorage.setItem('cartItem', JSON.stringify(cartItem))
    },
    removeProduct(productId){

        // Your logic for your app.

        // strore products in local storage

        let storageCartItem = JSON.parse(localStorage.getItem('cartItem'));
        let cartItem = storageCartItem.filter(product => product.productId !== productId );
        localStorage.setItem('cartItem', JSON.stringify(cartItem));
    },

      {
         isDisabled(){
           if(this.len === 0){
             return true;
           }
           return false;
         },
         showDetails(itr){
          this.$router.push({ name: 'ShowDetails', params: { id : this.cartItem[itr].pId } })
         },
         checkout(){
          this.$router.push({ name: 'Checkout',params:{id:this.len}})
         },
         listCartItems(){
          axios.get(`${this.baseURL}cart/?token=${this.token}`).then((response) => {
            if(response.status==200){
              this.carts=response.data;
              this.len = Object.keys(this.carts.cartItems).length
              this.totalcost = this.carts.totalCost
              let i;
              for(i=0;i<this.len;i++){
                this.cartItem.push({
                  imgUrl:this.carts.cartItems[i].product.imageURL,
                  pName:this.carts.cartItems[i].product.name,
                  pDescription:this.carts.cartItems[i].product.description,
                  pPrice:this.carts.cartItems[i].product.price,
                  pQuantity:this.carts.cartItems[i].quantity ,
                  id:this.carts.cartItems[i].id,
                  pId:this.carts.cartItems[i].product.id,
                  userId:this.carts.cartItems[i].userId
                })
              }
            }
          },
          (error)=>{
            console.log(error)
          });
        },
        deleteItem(productId){
          // axios.delete(`${this.baseURL}cart/delete/${itemId}/?token=${this.token} `)
          //   .then((response)=>{
          //     if(response.status==200){
          //       this.$router.go(0);
          //     }
          //   },(error)=>{
          //     console.log(error)
          //   })
          // Your logic for your app.

          // strore products in local storage

          let storageCartItem = JSON.parse(localStorage.getItem('cartItem'));
          let cartItem = storageCartItem.filter(product => product.productId !== productId );
          localStorage.setItem('cartItem', JSON.stringify(cartItem));
        },
        updateItem(itemId,quantity){
          // let i
          // for(i=0;i<this.len;i++){
          //   if(this.cartItem[i].id === itemId){
          //     break
          //   }
          // }
          // this.cartItem[i].pQuantity = quantity
          // let userId = this.cartItem[i].userId
          // let productId = this.cartItem[i].pId
          // axios.put(`${this.baseURL}cart/update/${itemId}/?token=${this.token}`,{
          //   id:itemId,
          //   userId,
          //   productId,
          //   quantity
          // })

          if(localStorage.getItem('cartItem')){
              cartItem = JSON.parse(localStorage.getItem('cartItem'));
          }
          cartItem.push({'productId' : productId + 1});
          localStorage.setItem('cartItem', JSON.stringify(cartItem));

        }
      },
      mounted() {
        this.token = localStorage.getItem("token");
        this.listCartItems();
      },
    };
</script>
