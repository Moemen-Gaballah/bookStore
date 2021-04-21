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
           <!--              <router-link :to="{ path: '/categories', params: {id: {category.id}} }"  class="nav-link">{{category.title}}</router-link> -->





                        <!-- <router-link :to="{ path: 'categories', params: { userId: 123 }}">Home</router-link> -->

                        
                        <router-link :to="'/categories/'+category.id" :key="$route.path" class="nav-link">{{category.title}}</router-link>
                      </li>
                    </ul>
                    <div class="login ml-0">
                        <ul class="list-inline icons">
                            <li class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-globe-africa"></i></a></li>


                            <li v-if="storeToken.length < 1" type="button" data-toggle="modal" data-target="#authentication"class="list-inline-item mr-1"><a class="nav-link"><i class="fa fa-user"></i></a></li>

                          <li v-else @click="logout" class="list-inline-item mr-1"><a class="nav-link"><i class="fas fa-sign-out-alt"></i></a></li>


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
            <div class="modal fade" style="direction:ltr; color:#6d6a6a" id="authentication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 v-if="login" class="modal-title" id="exampleModalLabel">Login</h5>
                    <h5 v-else class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div v-if="!login" class="form-group">
                        <label for="name" class="col-form-label">name:</label>
                        <input v-model="user.name" type="text" class="form-control" id="name"  @keydown="errors.clear('name')" :class="errors.has('name') ? 'border border-danger' : ''">
                        <span class="help text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></span>
                      </div>

                       <div v-if="emailOrPasswordWrong" class="form-group">
                            <div class="alert alert-danger" role="alert">
                               Something wrong email or password!
                            </div>                        
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-form-label">email:</label>
                        <input v-model="user.email" type="email" class="form-control" id="email"  @keydown="errors.clear('email')" :class="errors.has('email') ? 'border border-danger' : ''">
                        <span class="help text-danger" v-if="errors.has('email')" v-text="errors.get('email')"></span>
                      </div>

                      <div class="form-group">
                        <label for="password" class="col-form-label">password:</label>
                        <input v-model="user.password" type="password" class="form-control" name="password" id="password"  @keydown="errors.clear('password')" :class="errors.has('password') ? 'border border-danger' : ''">
                        <span class="help text-danger" v-if="errors.has('password')" v-text="errors.get('password')"></span>
                      </div>

                      <div v-if="!login" class="form-group">
                        <label for="password_confirmation" class="col-form-label">confirm password:</label>
                        <input v-model="user.password_confirmation" type="password" class="form-control" name="password_confirmation" id="password_confirmation"  @keydown="errors.clear('password_confirmation')" :class="errors.has('password_confirmation') ? 'border border-danger' : ''">
                        <span class="help text-danger" v-if="errors.has('password_confirmation')" v-text="errors.get('password_confirmation')"></span>
                      </div>

                    </form>
                  </div>
                  <div class="modal-footer">
                    <div style="width: 100%; text-align:right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click.prevent="authentication" v-if="login" type="button" class="btn btn-primary">Login</button>
                        <button @click.prevent="authentication" v-else type="button" class="btn btn-primary">Register</button>
                    </div>
                    <div style="width: 100%; text-align:left">
                        <p v-if="login">Create New Account    <button @click="changeLogin"  type="button" class="btn btn-primary">Go To Register</button></p>
                        <p v-else>Are you have Account    <button @click="changeLogin"  type="button" class="btn btn-primary">Go To Login</button></p>
                    </div>
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
    // class Error To Show errors
    class Errors {
        constructor() {
            this.errors = {};
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        any(field) {
            return object.key(this.errors).length > 0;
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        record(errors) {
            this.errors = errors;
        }

        clear(field) {
            delete this.errors[field];
        }

    }



    export default {
        computed:{
            counter() {
                return this.$store.state.counter
            },
            storeToken() {
                return this.$store.state.storeToken
            }
        },
        data() {
            return {
                errors: new Errors(),
                allCategories: {},
                emailOrPasswordWrong: false,
                token: '',
                login: true,
                user: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                // register: {},
            }
        },
        methods: {
            changeLogin() {
                if(this.login == true){
                    console.log(this.login)
                    this.login = false
                }else {
                    this.login = true
                }
            },
            authentication() {
                // this.$Progress.start()
                var url = "/api/login/";
                if(this.login != true)
                    url = "/api/register/";
                axios({
                  method: 'post',
                  url: url,
                  data: this.user,
                }).then((response) => {
                    this.emailOrPasswordWrong = false;
                    localStorage.setItem("storeToken", response.data.token)
                    this.$store.state.storeToken = response.data.token;
                    this.token = response.data.token;
                  // this.$Progress.finish()
                  $('#authentication').modal('hide');
                  Toast.fire({
                   icon: 'success',
                   title: 'Login Successful.'
                 })
                  this.user = {};
                  // this.getCategories()   
              }).catch((error) => {
                if(error.response.data.message == "Password mismatch") {
                   this.emailOrPasswordWrong = true;
                }else if(error.response.data.message == "User does not exist"){
                    this.emailOrPasswordWrong = true
                }else {
                    this.errors.record(error.response.data.errors)
                }
                    // this.$Progress.fail()
                });
            },
            logout() {
                // this.$Progress.start()
                axios({
                  method: 'post',
                  url: '/api/logout',
                  headers: {
                    'Authorization': `Bearer ${this.$store.state.storeToken}` 
                  }
                }).then((response) => {
                    localStorage.removeItem('storeToken');
                    this.$store.state.storeToken = '';
                  $('#authentication').modal('hide');
                  Toast.fire({
                   icon: 'success',
                   title: 'Logout Successfully.'
                 })
                  // this.getCategories()   
              }).catch((error) => {
               
                    this.errors.record(error.response.data.errors)
                    // this.$Progress.fail()
                });
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
            this.getCategories(this.$store.state.storeToken)

            if("storeToken" in localStorage){
               this.$store.state.storeToken = localStorage.getItem("storeToken")
            } else {
               this.$store.state.storeToken = '';
            }
               // alert(this.$store.state.storeToken);    
        }
    }
</script>
