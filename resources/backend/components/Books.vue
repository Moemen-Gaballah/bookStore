<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title">Books</h3>
                <button @click="addBook" class="btn btn-primary ml-4" style="float:right">
                    <i class="fas fa-list"></i>
                    Add New Book</button>
                <div class="card-tools d-inline-block" style="margin-top: 8px;">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" @keyup="searchit" name="table_search" v-model="search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button  @click="searchit" class="btn btn-default">
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
                      <th>author</th>
                      <th>category</th>
                      <th>price</th>
                      <th>status</th>
                      <th>stock</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(book, index) in books.data">
                      <td>{{ index+1 }}</td>
                      <td>{{ book.title }}</td>
                      <td>{{ book.author }}</td>
                      <td>{{ book.category.title }}</td>
                      <td>{{ book.price }}</td>
                      <td>{{ book.status == 1 ? 'Active' : 'In active' }}</td>
                      <td>{{ book.stock }}</td>
                      <td>
                           <a href="#">
                               <i class="fa fa-edit blue" @click="editBook(book)"></i>
                           </a> /
                           <a href="#" @click="deleteBook(book.id)">
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
                        <h5 class="modal-title" v-if="addNewBook" id="addNewTitle">Add New book</h5>
                        <h5 class="modal-title" v-else id="addNewenterTitle">Edit book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="dataEditBook.title" @keydown="errors.clear('title')" class="form-control" :class="errors.has('title') ? 'border border-danger' : ''" id="title" aria-describedby="emailHelp" placeholder="Enter title">
                            <span class="help text-danger" v-if="errors.has('title')" v-text="errors.get('title')"></span>
                          </div>

                          <div class="form-group">
                            <label for="title">Author</label>
                            <input type="text" v-model="dataEditBook.author" @keydown="errors.clear('author')" class="form-control" :class="errors.has('author') ? 'border border-danger' : ''" id="author" aria-describedby="emailHelp" placeholder="Enter author">
                            <span class="help text-danger" v-if="errors.has('author')" v-text="errors.get('author')"></span>
                          </div>


                          <div class="form-group">
                            <label for="title">Price</label>
                            <input type="number" min="0.00" step="1" value="1.00" v-model="dataEditBook.price" @keydown="errors.clear('price')" :class="errors.has('price') ? 'border border-danger' : ''" id="price" class="form-control" placeholder="Enter Price">
                            <!-- <input type="integer" v-model="dataEditBook.price" @keydown="errors.clear('price')" class="form-control" :class="errors.has('price') ? 'border border-danger' : ''" id="price" aria-describedby="emailHelp" placeholder="Enter Price"> -->
                            <span class="help text-danger" v-if="errors.has('price')" v-text="errors.get('price')"></span>
                          </div>

                          <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" min="0" step="1" value="1" v-model="dataEditBook.stock" @keydown="errors.clear('stock')" :class="errors.has('stock') ? 'border border-danger' : ''" id="stock" class="form-control" placeholder="Enter Count">
                            <span class="help text-danger" v-if="errors.has('stock')" v-text="errors.get('stock')"></span>
                          </div>

                          <div class="form-group">
                            <label for="description">Description</label>
                            <!-- <input type="integer" v-model="dataEditBook.description" @keydown="errors.clear('description')" class="form-control" :class="errors.has('description') ? 'border border-danger' : ''" id="description" aria-describedby="emailHelp" placeholder="Enter description"> -->
                            <textarea v-model="dataEditBook.description" @keydown="errors.clear('description')" class="form-control" :class="errors.has('description') ? 'border border-danger' : ''" id="description" rows="3">{{ dataEditBook.description }}</textarea>
                            <span class="help text-danger" v-if="errors.has('description')" v-text="errors.get('description')"></span>
                          </div>

                          <div class="form-group">
                              <label for="category">Category</label>
                              <select :class="errors.has('category_id') ? 'border border-danger' : ''" v-model="dataEditBook.category_id" name="category_id" class="form-control" id="category">
                                <option value="" selected>choose Category</option>
                                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                                <!-- <option value="0">In Active</option> -->
                              </select>
                              <span class="help text-danger" v-if="errors.has('category_id')" v-text="errors.get('category_id')"></span>
                            </div>

                          <div class="form-group">
                              <label for="status">Stauts</label>
                              <select v-model="dataEditBook.status" name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="uploadImg">Upload img</label>
                              <input type="file" id="uploadImg" ref="inputFileImg" @change="uploadImg" class="form-control-file">
                                <span class="help text-danger" v-if="errors.has('image')" v-text="errors.get('image')"></span>
                            </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="storeNewBook"  v-if="addNewBook" class="btn btn-primary">Add Book</button>
                        <button type="button" @click="updateBook" v-else class="btn btn-primary">Update Book</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- end another model -->

              </div>
              <!-- /.card-body -->
          </div>

            <!-- Start Pagination -->
            <pagination :data="books" align="center" @pagination-change-page="getBooks"></pagination>
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
                books: {},
                categories: {},
                addNewBook: true,
                errors: new Errors(),
                dataEditBook: {},
                selectedFile: '',
                search: '',
            }
        },
        methods: {
            searchit () {
                axios.get('api/bookSearch?q='+ this.search)
                .then((data) => {
                    this.books = data.data.data ;
                })
                .catch(() => {

                })
              },
            clearInput () {
              	var input = this.$refs.inputFileImg;
                input.type = 'text';
                input.type = 'file';
                input.value = '';
              },
            uploadImg(event) {
                this.selectedFile = event.target.files[0];
            },
            getCategories() {
                this.$Progress.start()
                axios.get('/api/allcategory')
                  .then((response) => {
                    // handle success
                    this.$Progress.finish()
                    this.categories = response.data.data;
                  })
                  .catch((error) => {
                    // handle error
                    this.$Progress.fail()
                  })
            },
            getBooks(page = 1) {
                this.$Progress.start()
                axios.get('/api/book?page=' + page)
                  .then((response) => {
                    // handle success
                    this.$Progress.finish()
                    this.books = response.data.data;
                  })
                  .catch((error) => {
                    // handle error
                    this.$Progress.fail()
                  })
            },
            addBook(){
                this.addNewBook = true;
                this.dataEditBook = {};
                let status = '1'
                this.dataEditBook.status = '1';
                this.dataEditBook.category_id = '';
                $('#addNew').modal('show');
            },
            storeNewBook() {
                this.$Progress.start()
                var formData = new FormData()
                console.log(this.selectedFile.length);
                if(this.selectedFile.name.length > 1){

                    formData.append('image', this.selectedFile, this.selectedFile.name)
                }else {
                    Vue.delete(this.dataEditBook, 'image');
                }

                for ( var key in this.dataEditBook ) {
                    formData.append(key, this.dataEditBook[key]);
                }

                axios({
                  method: 'POST',
                  url: '/api/book/',
                  data: formData,
                 headers: {'Content-Type': 'multipart/form-data'}
                }).then((response) => {
                  this.$Progress.finish()
                  $('#addNew').modal('hide');
                  Toast.fire({
                   icon: 'success',
                   title: 'Book has been Added.'
                 })

                  this.dataEditBook = '';
                  this.selectedFile = '';
                  this.clearInput();
                  this.getBooks()
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                    this.$Progress.fail()
                });
            },
            editBook(book) {
                this.addNewBook = false;
                this.dataEditBook = JSON.parse(JSON.stringify(book));
                $('#addNew').modal('show');
            },

            updateBook() {
                this.$Progress.start()

                var formData = new FormData()
                if(this.selectedFile.name.length > 1){
                    formData.append('image', this.selectedFile, this.selectedFile.name)
                }else {
                    Vue.delete(this.dataEditBook, 'image');
                }

                for ( var key in this.dataEditBook ) {
                    formData.append(key, this.dataEditBook[key]);
                }

                axios({
                  method: 'post',
                  url: '/api/book/'+this.dataEditBook.id,
                  data: formData,
                  headers: {'Content-Type': 'multipart/form-data'},
                }).then((response) => {
                    this.clearInput();
                    this.getBooks()
                    $('#addNew').modal('hide');
                    this.$Progress.finish();
                     Toast.fire({
                      icon: 'success',
                      title: 'Book has been Updated.'
                    })

                  this.dataEditBook = '';
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                  this.$Progress.fail();
               });

            },
            deleteBook(id) {
                 this.$Progress.start()

                 Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't delete book!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                      this.$Progress.start()
                      axios({
                        method: 'delete',
                        url: '/api/book/'+id,
                      }).then((response) => {
                        this.$Progress.finish()
                        Toast.fire({
                         icon: 'success',
                         title: 'Book has been Deleted.'
                       })

                        this.getBooks()
                      }).catch((error) => {
                          this.$Progress.fail()
                           Toast.fire({
                            icon: 'error',
                            title: 'Faild delete book'
                          })
                      });
                  }
                })
            }
        },
        created () {
            this.getCategories()
            this.getBooks()
        }
    }
</script>
