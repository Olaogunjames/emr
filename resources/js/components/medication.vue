<template>
    <div class="container">       
        <!-- <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>  -->
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Patient Medications</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Dianoses Details</th>                
                  <th>Date of  Medication</th>
                  <th>Medication Details</th>
                  <th v-if="user.role == 'pharm'">Action</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="medication in medications" :key="medication.id">
                  <td>{{medication.patient.unique_id}}</td>
                  <td>{{medication.patient.title}} {{medication.patient.full_name}}</td>
                  <td>{{medication.diagnose.diagnosis}}</td>
                  <td>{{medication.created_at | humanDate}}</td>
                  <td>{{medication.type}} <br> {{medication.unit}} unit <br> {{medication.comment}}</td>                                                                  
                  <td v-if="user.role == 'pharm'">
                  <div class="row">
                  <div class="col-sm-6">
                    <button  @click="editModal(medication)" class="text-primary">
                      <i class="fa fa-edit"></i>
                    </button>
                    </div>
                    <div class="col-sm-6">
                    <a href="#" class="text-danger">
                      <i class="fa fa-trash"></i>
                    </a>
                    </div>
                    </div>
                </td>                            
                </tr>                   

                 <!--Biodata Modal -->
                      <div class="modal fade" id="editmedications" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Lab Result</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updatemedications" id="edit-medications">                         
                                <div class="form-group">
                                <label>Select Type of Medicine</label>                
                                <select v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" name="type">
                                <option value="Tablet">Tablet</option>
                                <option value="Capsule">Capsule</option>
                                <option value="Multivitamins">Multivitamins</option>
                                <option value="Syrup">Syrup</option>
                                </select>  
                                <has-error :form="form" field="type"></has-error>
                                </div>   
                                <div class="form-group"> 
                                  <label>Edit Unit</label>  
                                <input v-model="form.unit" type="number" name="unit" placeholder="Enter Unit"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('unit') }">
                                <has-error :form="form" field="unit"></has-error>
                                </div>                           
                                <div class="form-group"> 
                                  <label>Edit Comment</label>  
                                <textarea v-model="form.comment"  placeholder="Comment" name="comment" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>                       
                                <has-error :form="form" field="comment"></has-error>                       
                                </div> 
                                 <input v-model="form.nurse" 
                                :value="1" 
                                type="checkbox" 
                                name="nurse" /> Edit Refer Patient for injection
                            <center>
                            <button type="submit" class="updatemedications btn-block btn btn-info" style="color:#fff;">Update Lab Result</button>
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
                <th>Unique ID</th>
                  <th>Name</th>
                  <th>Dianoses Details</th>                
                  <th>Date of  Medication</th>
                  <th>Medication Details</th>
                <th v-if="user.role == 'pharm'">Action</th>
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
              medications: {},
              user: {},
              form: new Form({
                id:'',
                type: '',
                comment: '',
                unit: '',
                nurse: '',
                injection: ''
                })              
            }
        },
        methods:{                
            LoadLabresult(){
                 axios.get('api/uploadpham').then(({data}) => (this.medications = data));
                 axios.get('api/user').then(response => {
                     console.log(response.data);
                     this.user = response.data
                 })                 
            },             
            editModal(medication){
              $('#editmedications').modal('show');
              this.form.fill(medication);              
            },        
            updatemedications(){
                $('.updatemedications').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/uploadpham/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editmedications').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Medication Updated Successfully'
                        })   
                        $('.updatemedications').html('Update Lab Result'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatemedications').html('Update Lab Result');
                        });                                      
            },            
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadLabresult(); 
            Fire.$on('afterAction', () => {this.LoadLabresult()})                                   
        }
        
    }
</script>

