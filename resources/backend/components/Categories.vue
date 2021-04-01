<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title">Categories</h3>
                <button @click="addCategory" class="btn btn-primary ml-4" style="float:right">
                    <i class="fas fa-users"></i>
                    Add New Category</button>
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
                      <th>title</th>
                      <th>status</th>
                      <th>Created_at</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories">
                      <td>{{ category.id }}</td>
                      <td>{{ category.title }}</td>
                      <td>{{ category.status }}</td>
                      <td>{{ user.created_at }}</td>
                      <td>
                           <a href="#">
                               <i class="fa fa-edit blue" @click="editCategory(category)"></i>
                           </a> /
                           <a href="#" @click="deleteCategory(category.id)">
                               <i class="fa fa-trash red"></i>
                           </a>
                       </td>
                    </tr>
                  </tbody>
                </table>
                <!-- another model -->



                <!-- Modal -->
                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" v-if="addNewCategory" id="addNewTitle">Add New Category</h5>
                        <h5 class="modal-title" v-else id="addNewenterTitle">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="dataEditUser.name" @keydown="errors.clear('title')" class="form-control" :class="errors.has('title') ? 'border border-danger' : ''" id="title" aria-describedby="emailHelp" placeholder="Enter title">
                            <span class="help text-danger" v-if="errors.has('title')" v-text="errors.get('title')"></span>
                          </div>

                          <div class="form-group">
                              <label for="status">Stauts</label>
                              <select v-model="dataEditUser.status" name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                              </select>
                            </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="storeNewCategory"  v-if="addNewCategory" class="btn btn-primary">Add Category</button>
                        <button type="button" @click="updateCategory" v-else class="btn btn-primary">Update Category</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- end another model -->

              </div>
              <!-- /.card-body -->
            </div>
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
                categories: {},
                addNewCategory: true,
                errors: new Errors(),
                dataEditCategory: {}
            }
        },
        methods: {
            getCategories() {
                this.$Progress.start()
                // this.$Progress.fail()
                axios.get('/api/category')
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
            addCategory(){
                this.addNewCategory = true;
                this.dataEditCategory = {};
                // let status = '1'
                // this.dataEditUser.status = '1';
                $('#addNew').modal('show');
            },
            storeNewCategory() {

                axios({
                  method: 'post',
                  url: '/api/category/',
                  data: this.dataEditCategory,
                }).then((response) => {
                  this.$Progress.finish()
                  $('#addNew').modal('hide');
                  Toast.fire({
                   icon: 'success',
                   title: 'Category has been Added.'
                 })

                  this.dataEditCategory = '';
                  this.getCategories()
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                    this.$Progress.fail()
                });
            },
            editCategory(category) {
                this.addNewCategory = false;
                this.dataEditCategory = category;
                $('#addNew').modal('show');
            },

            updateUser() {
                this.$Progress.start()

                axios({
                  method: 'put',
                  url: '/api/category/'+this.dataEditCategory.id,
                  data: this.dataEditCategory,
                }).then((response) => {
                    $('#addNew').modal('hide');
                    this.$Progress.finish();
                     Toast.fire({
                      icon: 'success',
                      title: 'Category has been Updated.'
                    })

                  this.dataEditCategory = '';
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
                        url: '/api/category/'+id,
                      }).then((response) => {
                        this.$Progress.finish()
                        Toast.fire({
                         icon: 'success',
                         title: 'Category has been Deleted.'
                       })

                        this.getCategories()
                      }).catch((error) => {
                          this.$Progress.fail()
                           Toast.fire({
                            icon: 'error',
                            title: 'Faild delete category'
                          })
                      });


                  }
                })
            }
        },
        created () {
            this.getCategories()
        }
    }
</script>
