<template>
    <div class="container">       
        <!-- <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>  -->
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Patients Surgery History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Operation Details</th>
                  <th>Date of Operation</th>
                  <th>Surgeon</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="surgery in surgeries" :key="surgery.id">
                  <td>{{surgery.patient.unique_id}}</td>
                  <td>{{surgery.patient.title}} {{surgery.patient.full_name}}</td>
                  <td>{{surgery.operations}}</td>
                  <td>{{surgery.date_of_operation | humanDate}}</td>
                  <td>{{surgery.surgeon}}</td>                                  
                  <td>
                  <div class="row">
                  <div class="col-sm-6">
                    <button  @click="editModal(surgery)" class="text-primary">
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
                      <div class="modal fade" id="editsurgery" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Patient Surgery History</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updateSurgery" id="edit-surgery">                         
                        <div class="form-group"> 
                        <label>Edit Operation Details</label> 
                        <textarea v-model="form.operations"  placeholder="Operation Details" name="operations" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('operations') }"></textarea>                       
                        <has-error :form="form" field="operations"></has-error>                       
                        </div>  
                        <div class="form-group"> 
                        <label>Edit Date of Operation</label>                        
                        <input v-model="form.date_of_operation" type="date" name="date_of_operation" placeholder="Enter Date Attented"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('date_of_operation') }">
                        <has-error :form="form" field="date_of_operation"></has-error>
                        </div>                         
                        <div class="form-group"> 
                        <label>Edit Surgeon</label>                        
                        <input v-model="form.surgeon" type="text" name="surgeon" placeholder="Surgeon"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('surgeon') }">
                        <has-error :form="form" field="surgeon"></has-error>
                        </div>   
                            <center>
                            <button type="submit" class="updatesurgery btn-block btn btn-info" style="color:#fff;">Update Patient Surgery History</button>
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
                  <th>Operation Details</th>
                  <th>Date of Operation</th>
                  <th>Surgeon</th>
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
              surgeries: {},
              form: new Form({
                id:'',
                patient_id: '',
                operations: '',
                date_of_operation: '',
                surgeon: '',  
                })              
            }
        },
        methods:{          
            LoadSurgeries(){
                 axios.get('api/surgery').then(({data}) => (this.surgeries = data));
            },
            editModal(surgery){
              $('#editsurgery').modal('show');
              this.form.fill(surgery);              
            },
            updateSurgery(){
                $('.updatesurgery').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/surgery/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editsurgery').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Patient Surgery History Update Successfully'
                        })   
                        $('.updatesurgery').html('Add Patient'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatesurgery').html('Add Patient');
                        });                                      
            }
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadSurgeries(); 
            Fire.$on('afterAction', () => {this.LoadSurgeriess()})                                   
        }
        
    }
</script>

