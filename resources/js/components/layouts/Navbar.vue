<template>
    <div class="main-navbar">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <router-link class="navbar-brand" to="/">bookStore</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="fa fa-sliders-h"></i></span>
                </button>
                  <div class="category collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li v-for="category in allCategories.data" class="nav-item">
                        <router-link :to="'/categories/'+category.id" class="nav-link">{{category.title}}</router-link>
                      </li>
                    </ul>
                    <div class="login ml-0">
                        <ul class="list-inline icons">
                            <li class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-globe-africa"></i></a></li>
                            <li type="button" data-toggle="modal" data-target="#exampleModal"class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-user"></i></a></li>
                            <li  class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-search"></i></a></li>
                            <li class="list-inline-item mr-1"><router-link to="/cart" class="nav-link"><i class="fa fa-cart-plus"></i>
                            <span class="cartCount"> {{counter}} </span>
                            </router-link></li>
                        </ul>
                    </div>
                  </div>
          </div>
        </nav>

        <!-- Start form login -->

            <!-- Modal -->
            <div class="modal fade" style="direction:ltr; color:#6d6a6a" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="email" class="col-form-label">email:</label>
                        <input v-model="login.email" type="email" class="form-control" id="email">
                      </div>
                      <div class="form-group">
                        <label for="password" class="col-form-label">password:</label>
                        <input v-model="login.password" type="password" class="form-control" name="password" id="password">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Login</button>
                  </div>
                </div>
              </div>
            </div>

        <!-- End Form Login -->
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
                allCategories: {},
                token: '',
                login: {
                    email: '',
                    password: '',
                },
                register: {},
            }
        },
        methods: {
            login() {
                // this.$Progress.start()
              //   axios({
              //     method: 'post',
              //     url: '/api/category/',
              //     data: this.dataEditCategory,
              //   }).then((response) => {
              //     this.$Progress.finish()
              //     $('#addNew').modal('hide');
              //     Toast.fire({
              //      icon: 'success',
              //      title: 'Category has been Added.'
              //    })

              //     this.dataEditCategory = '';
              //     this.getCategories()
              // }).catch((error) => {
              //     this.errors.record(error.response.data.errors)
              //       this.$Progress.fail()
              //   });
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
            getCategories() {
                axios.get('/api/getCategories/')
                    .then((data) => {
                        this.allCategories = data.data;
                        console.log(data.data)
                    })
                    .catch(() => {

                    })
            }
        },
        created() {
            this.countItemCart()
            this.getCategories()
        }
    }
</script>
