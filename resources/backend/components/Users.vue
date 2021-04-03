<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <button @click="addUser" class="btn btn-primary ml-4" style="float:right">
                    <i class="fas fa-users"></i>
                    Add New User</button>
                <div class="card-tools d-inline-block" style="margin-top: 8px;">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" @keyup="searchit" v-model="search" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button @click="searchit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>email</th>
                      <th>role</th>
                      <th>Created_at</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user, index) in users.data">
                      <td>{{ index+1 }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.role | upperCase}}</td>
                      <td>{{ user.created_at }}</td>
                      <td>
                           <a href="#">
                               <i class="fa fa-edit blue" @click="editUser(user)"></i>
                           </a> /
                           <a href="#" @click="deleteUser(user.id)">
                               <i class="fa fa-trash red"></i>
                           </a>
                       </td>
                    </tr>
                  </tbody>
                </table>





                <!-- Modal -->
                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" v-if="addNewUser" id="addNewTitle">Add New User</h5>
                        <h5 class="modal-title" v-else id="addNewenterTitle">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" v-model="dataEditUser.name" @keydown="errors.clear('name')" class="form-control" :class="errors.has('name') ? 'border border-danger' : ''" id="username" aria-describedby="emailHelp" placeholder="Enter username">
                            <span class="help text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></span>
                          </div>

                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" @keydown="errors.clear('email')" :class="errors.has('email') ? 'border border-danger' : ''" v-model="dataEditUser.email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <span class="help text-danger" v-if="errors.has('email')" v-text="errors.get('email')"></span>
                          </div>

                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" v-model="dataEditUser.password" @keydown="errors.clear('password')" class="form-control" :class="errors.has('password') ? 'border border-danger' : ''"  id="password" aria-describedby="emailHelp" placeholder="Enter password">
                            <span class="help text-danger" v-if="errors.has('password')" v-text="errors.get('password')"></span>
                          </div>

                          <div class="form-group">
                              <label for="role">Role</label>
                              <select v-model="dataEditUser.role" name="role" class="form-control" id="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="profileImg">Upload profile img</label>
                              <input type="file" @change="changeProfileImg" class="form-control-file" id="profileImg">
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="storeNewUser"  v-if="addNewUser" class="btn btn-primary">Add User</button>
                        <button type="button" @click="updateUser" v-else class="btn btn-primary">Update User</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- end another model -->

              </div>

              <!-- /.card-body -->
            </div>

                  <!-- Start Pagination -->

                  <pagination :data="users" align="center" @pagination-change-page="getUsers"></pagination>

                  <!-- End Pagination -->


            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

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
        data() {
            return {
                users: {},
                addNewUser: true,
                errors: new Errors(),
                dataEditUser: {},
                search: '',
            }
        },
        methods: {
            searchit () {
                axios.get('api/userSearch?q='+ this.search)
                .then((data) => {
                    // console.log(data)
                    this.users = data.data.data ;
                })
                .catch(() => {

                })
              },
            getUsers(page=1) {
                this.$Progress.start()
                // this.$Progress.fail()
                axios.get('/api/user?page=' + page)
                  .then((response) => {
                    // handle success
                    this.$Progress.finish()
                    this.users = response.data.data;
                  })
                  .catch((error) => {
                    // handle error
                    this.$Progress.fail()
                  })
            },
            addUser(){
                this.addNewUser = true;
                this.dataEditUser = {};
                let role = 'use'
                this.dataEditUser.role = 'user';
                $('#addNew').modal('show');
            },
            storeNewUser() {

                axios({
                  method: 'post',
                  url: '/api/user/',
                  data: this.dataEditUser,
                }).then((response) => {
                  this.$Progress.finish()
                  $('#addNew').modal('hide');
                  Toast.fire({
                   icon: 'success',
                   title: 'User has been Added.'
                 })

                  this.dataEditUser = '';
                  this.getUsers()
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                    this.$Progress.fail()
                });
            },
            editUser(user) {
                this.addNewUser = false;
                // this.dataEditUser = user
                this.dataEditUser = JSON.parse(JSON.stringify(user))
                // this.dataEditUser = JSON.parse(JSON(user.stringify(user))
                // console.log(JSON.parse(JSON.stringify(user)) );
                $('#addNew').modal('show');
            },
            changeProfileImg(event) {
                console.log(event)
                var input = event.target;
               if (input.files && input.files[0]) {
                   var reader = new FileReader();
                   reader.onload = (e) => {
                       this.dataEditUser.profileImg = e.target.result;
                   }
                   reader.readAsDataURL(input.files[0]);
               }

                // this.dataEditUser = user;
                // $('#addNew').modal('show');
            },

            updateUser() {
                this.$Progress.start()

                axios({
                  method: 'put',
                  url: '/api/user/'+this.dataEditUser.id,
                  data: this.dataEditUser,
                }).then((response) => {
                    $('#addNew').modal('hide');
                    this.getUsers()
                    this.$Progress.finish();
                     Toast.fire({
                      icon: 'success',
                      title: 'User has been Updated.'
                    })

                  this.dataEditUser = '';
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                  this.$Progress.fail();
               });

            },
            deleteUser(id) {
                 this.$Progress.start()

                 Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't delete user!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                      axios({
                        method: 'delete',
                        url: '/api/user/'+id,
                      }).then((response) => {
                        this.$Progress.finish()
                        Toast.fire({
                         icon: 'success',
                         title: 'User has been Deleted.'
                       })

                        this.getUsers()
                      }).catch((error) => {
                          this.$Progress.fail()
                           Toast.fire({
                            icon: 'error',
                            title: 'Faild delete user'
                          })
                      });


                  }
                })


                // axios({
                //   method: 'delete',
                //   url: '/api/user/'+id,
                // }).then((response) => {
                //   this.$Progress.finish()
                //   this.getUsers()
                // }).catch((error) => {
                //     this.$Progress.fail()
                // });

            }
        },
        created () {
            this.getUsers()
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
