<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title">Comments</h3>
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
                      <th>username</th>
                      <th>comment</th>
                      <th>status</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="comment in comments">
                      <td>{{ comment.id }}</td>
                      <td>{{ comment.user.name }}</td>
                      <td>{{ comment.body }}</td>
                      <td>{{ comment.status == 1 ? 'Active' : 'In active' }}</td>
                      <td>
                           <a href="#">
                               <i class="fa fa-edit blue" @click="editComment(comment)"></i>
                           </a> /
                           <a href="#" @click="deleteComment(comment.id)">
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
                        <h5 class="modal-title" id="addNewenterTitle">Edit Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="title">comment</label>
                            <textarea v-model="dataEditComment.body" @keydown="errors.clear('body')" class="form-control" :class="errors.has('body') ? 'border border-danger' : ''" id="body" rows="3"></textarea>
                            <span class="help text-danger" v-if="errors.has('body')" v-text="errors.get('body')"></span>
                          </div>

                          <div class="form-group">
                              <label for="status">Stauts</label>
                              <select v-model="dataEditComment.status" name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                              </select>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateComment" class="btn btn-primary">Update Comment</button>
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
                comments: {},
                errors: new Errors(),
                dataEditComment: {}
            }
        },
        methods: {
            getComments() {
                this.$Progress.start()
                // this.$Progress.fail()
                axios.get('/api/comment')
                  .then((response) => {
                    // handle success
                    this.$Progress.finish()
                    this.comments = response.data.data;
                  })
                  .catch((error) => {
                    // handle error
                    this.$Progress.fail()
                  })
            },
            editComment(comment) {
                this.addNewComment = false;
                this.dataEditComment = JSON.parse(JSON.stringify(comment));
                $('#addNew').modal('show');
            },

            updateComment() {
                this.$Progress.start()

                axios({
                  method: 'put',
                  url: '/api/comment/'+this.dataEditComment.id,
                  data: this.dataEditComment,
                }).then((response) => {
                    this.getComments()
                    $('#addNew').modal('hide');
                    this.$Progress.finish();
                     Toast.fire({
                      icon: 'success',
                      title: 'Comment has been Updated.'
                    })

                  this.dataEditComments = '';
              }).catch((error) => {
                  this.errors.record(error.response.data.errors)
                  this.$Progress.fail();
               });

            },
            deleteComment(id) {
                 this.$Progress.start()

                 Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't delete comment!",
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
                        url: '/api/comment/'+id,
                      }).then((response) => {
                        this.$Progress.finish()
                        Toast.fire({
                         icon: 'success',
                         title: 'comment has been Deleted.'
                       })

                        this.getComments()
                      }).catch((error) => {
                          this.$Progress.fail()
                           Toast.fire({
                            icon: 'error',
                            title: 'Faild delete comment'
                          })
                      });


                  }
                })
            }
        },
        created () {
            this.getComments()
        }
    }
</script>
