<template>
    <div class="container">        
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">My Profile</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role </th>
                  <th>Date oF Registration</th>
                  <th>Action</th>
                </tr>
                </thead>                
                <tbody>                                                                                         
                <tr>
                  <td>{{staff.title}}  {{staff.name}}</td>
                  <td>{{staff.email}}</td>
                  <td>{{staff.role}}</td>
                  <td>{{staff.created_at | humanDate}}</td>                                    
                  <td>
                    <button  @click="editModal(staff)" class="text-primary">
                      <i class="fa fa-edit"></i>
                    </button>
                    </td>                            
                </tr>                  
                 <!--Biodata Modal -->
                      <div class="modal fade" id="editstaff" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Staff</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updateStaff" id="add-biodata">
                           <div class="form-group">
                        <label>Edit Title</label>                
                        <select v-model="form.title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" name="title">
                        <option value="nul" style="font-weight:700;">Select Title</option>
                        <option value="Dr">Dr</option>
                        <option value="Miss">Miss</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Mr">Mr</option>
                        </select>  
                        <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                          <label>Edit Full Name</label>  
                        <input v-model="form.name" type="text" name="name" placeholder="Enter Full Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group"> 
                          <label>Edit Email</label>                         
                        <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">       
                          <label>Edit Role</label>                 
                      <select  v-model="form.role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }" name="role">
                            <option value="nul" style="font-weight:700;">Edit Role</option>
                            <option value="recept">Reception</option>
                            <option value="nurse">Nurse</option>
                            <option value="doc">Doctor</option>
                            <option value="lab">Laboratory</option>
                            <option value="pharm">Pharmacy</option>
                            <option value="admin">Admin</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                        </div>                                                  
                            <center>
                            <button type="submit" class="updatestaff btn-block btn btn-info" style="color:#fff;">Update Staff</button>
                            </center>
                            </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div>
                              
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role </th>
                  <th>Date oF Registration</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>   
              
                                         
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
      data(){
            return {
              staff: {},
              form: new Form({
                    id: '',
                    title: '',
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                })              
            }
        },
        methods:{
          loadStaffs(){                                            
                // this.loading = true;
                axios.get("api/profile")
                .then((response)  =>  {
                    setTimeout(function(){
                    NProgress.done()
                    }, 1000);
                    this.staff = response.data;
                })              
            },           
            // loadStaffs(){                            
            //      axios.get('api/profile').then(({data}) => (this.staff = data));                 
            // },
            editModal(staff){
              $('#editstaff').modal('show');
              this.form.fill(staff);              
            },            
            updateStaff(){
                $('.updatestaff').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/staff/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editstaff').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Staff Updated Successfully'
                        })   
                        $('.updatestaff').html('Update Staff'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatestaff').html('Update Staff');
                        });                                      
            }
        },        
        mounted() {
            console.log('Component mounted.')                        
            this.loadStaffs(); 
            Fire.$on('afterAction', () => {this.loadStaffs()})                                   
        }
        
    }
</script>

