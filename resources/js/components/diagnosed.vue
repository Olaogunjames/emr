<template>
    <div class="container">       
        <!-- <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>  -->
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Diagonised Patient</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Dianoses Details</th>
                  <th>Doctor Comment</th>                  
                  <th>Symtoms</th>  
                  <th>Refer to Lab.</th>
                  <th>Refer to Pharm.</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="diagnose in diagnoses" :key="diagnose.id">
                  <td>{{diagnose.patient.unique_id}}</td>
                  <td>{{diagnose.patient.title}} {{diagnose.patient.full_name}}</td>
                  <td>{{diagnose.diagnosis}}</td>
                  <td>{{diagnose.comment}}</td>
                  <td>{{diagnose.hospital.symptoms}}</td>                
                  <td>
                      <p v-if="diagnose.refer_lab == 1"> Already Refered</p>
                      <button v-else type="button" class="btn btn-primary" @click="toLab(diagnose)">
                      Refer to Lab
                      </button>                      
                  </td>
                  <td>
                    <p v-if="diagnose.refer_pham == 1"> Already Refered</p>
                    <button v-else type="button" class="btn btn-primary" @click="toPham(diagnose)">
                    Refer to Pham
                    </button>  
                  </td>                                  
                  <td>
                  <div class="row">
                  <div class="col-sm-6">
                    <button  @click="editModal(diagnose)" class="text-primary">
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
                <!-- refer to lab modal          -->
                <div class="modal fade" id="tolab" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="referToLab" id="edit-diagnoses">  
                                <input v-model="form.refer_lab" 
                                  :value="1" 
                                  type="radio" 
                                  name="refer_lab" /> Confirm Action First
                            <center>
                            <button type="submit" class="tolab btn-block btn btn-info" style="color:#fff;">Refer to Labouratory</button>
                            </center>
                            </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div>

                      <!-- refer to pham modal          -->
                <div class="modal fade" id="topham" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="referToPham" id="edit-diagnoses">  
                                <input v-model="form.refer_pham" 
                                  :value="1" 
                                  type="radio" 
                                  name="refer_pham" /> Confirm Action First
                            <center>
                            <button type="submit" class="topham btn-block btn btn-info" style="color:#fff;">Refer to Pharmacy</button>
                            </center>
                            </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div>
                 <!--Biodata Modal -->
                      <div class="modal fade" id="editdiagnoses" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Patient Diagnoses</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updateDiagnoses" id="edit-diagnoses">                         
                                <div class="form-group"> 
                                <textarea v-model="form.diagnosis"  placeholder="Diagnosis" name="diagnosis" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('diagnosis') }"></textarea>                       
                                <has-error :form="form" field="diagnosis"></has-error>                       
                                </div>                                                 
                                <div class="form-group">                        
                                <input v-model="form.comment" type="text" name="comment" placeholder="Comment"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }">
                                <has-error :form="form" field="comment"></has-error>
                                </div>   
                            <center>
                            <button type="submit" class="updatediagnoses btn-block btn btn-info" style="color:#fff;">Update Patient Diagnoses</button>
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
                <th>Doctor Comment</th>  
                <th>Symtoms</th>                  
                <th>Refer to Lab.</th>
                <th>Refer to Pharm.</th>
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
              diagnoses: {},
              form: new Form({
                id:'',
                diagnosis: '',
                comment: '',    
                refer_lab: '',
                refer_pham: '',
                })              
            }
        },
        methods:{          
            LoadDiagnoses(){
                 axios.get('api/diagnose').then(({data}) => (this.diagnoses = data));
            },
            editModal(diagnose){
              $('#editdiagnoses').modal('show');
              this.form.fill(diagnose);              
            },
            toLab(diagnose){
              $('#tolab').modal('show');
              this.form.fill(diagnose);              
            },
             toPham(diagnose){
              $('#topham').modal('show');
              this.form.fill(diagnose);              
            },
            updateDiagnoses(){
                $('.updatediagnoses').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/diagnose/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editdiagnoses').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Patient Diagnoses Updated Successfully'
                        })   
                        $('.updatediagnoses').html('Update Patient Diagnoses'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatediagnoses').html('Update Patient Diagnoses');
                        });                                      
            },
             referToLab(){
                $('.tolab').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/diagnose/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#tolab').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Refered to Labouratory'
                        })   
                        $('.tolab').html('Refer to Labouratory'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Error Encontered'
                        })   
                        $('.tolab').html('Refer to Labouratory');
                        });                                      
            },            
          referToPham(){
                $('.topham').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/diagnose/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#topham').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Refered to Pharmacy'
                        })   
                        $('.topham').html('Refer to Pharmacy'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Error Encontered'
                        })   
                        $('.topham').html('Refer to Pharmacy');
                        });                                      
            }
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadDiagnoses(); 
            Fire.$on('afterAction', () => {this.LoadDiagnoses()})                                   
        }
        
    }
</script>

