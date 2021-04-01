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
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
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
                    <tr v-for="user in users">
                      <td>{{ user.id }}</td>
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
                    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" v-if="addNewUser" id="addNewLabel">Add New User</h5>
                            <h5 class="modal-title" v-else id="addNewLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                              <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" v-model="dataEditUser.name" class="form-control"  id="username" aria-describedby="emailHelp" placeholder="Enter username">
                              </div>

                              <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" v-model="dataEditUser.email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                              </div>

                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" v-model="dataEditUser.password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Enter password">
                              </div>

                              <div class="form-group">
                                  <label for="role">Role</label>
                                  <select v-model="dataEditUser.role" name="role" class="form-control" id="role">
                                      <!-- :selected= "dataEditUser.role == 'user'"
                                      :selected= "dataEditUser.role == 'admin'" -->
                                    <!-- <option value="user" v-if="addNewUser" selected>User</option> -->
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
                            <button type="button" @click="storeNewUser" v-if="addNewUser" class="btn btn-primary">Add User</button>
                            <button type="button" @click="updateUser" v-else class="btn btn-primary">Update User</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                addNewUser: true,
                dataEditUser: {}
            }
        },
        methods: {
            getUsers() {
                axios.get('/api/user')
                  .then((response) => {
                    // handle success
                    this.users = response.data.data;
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
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
                $('#addNew').modal('hide');
                axios({
                  method: 'post',
                  url: '/api/user/',
                  data: this.dataEditUser,
                });
                this.dataEditUser = '';
                this.getUsers();
            },
            editUser(user) {
                this.addNewUser = false;
                this.dataEditUser = user;
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
                $('#addNew').modal('hide');
                axios({
                  method: 'put',
                  url: '/api/user/'+this.dataEditUser.id,
                  data: this.dataEditUser,
                });
                this.dataEditUser = '';
            },
            deleteUser(id) {
                axios({
                  method: 'delete',
                  url: '/api/user/'+id,
                });
                this.getUsers()
            },
        },
        created () {
            this.getUsers()
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
