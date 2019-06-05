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
                  <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + diagnose.modal_id" id="lap-result">
                        Give Medicine
                        </button>
                      <div class="modal fade" :id="diagnose.modal_id" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Give Prescribed Medicine</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form @submit.prevent="addDiagnosis" id="lab-test">                               
                                <input v-model="form.patient_id" 
                                :value="diagnose.patient.id" 
                                type="radio" 
                                name="patient_id" /> Confirm First

                                <input v-model="form.diagnose_id" 
                                :value="diagnose.id" 
                                type="radio" 
                                name="diagnose_id" /> Confirm First
                                                             
                                 <div class="form-group">
                                <label>Select Type of Medicine</label>                
                                <select v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" name="type">
                                <option value="hfghg">Dr</option>
                                <option value="Miuyjyss">Miss</option>
                                <option value="jhjhoijkjok">Mrs</option>
                                <option value="jgjgujuj">Mr</option>
                                </select>  
                                <has-error :form="form" field="type"></has-error>
                                </div>   
                                <div class="form-group"> 
                                <input v-model="form.unit" type="number" name="unit" placeholder="Enter Unit"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('unit') }">
                                <has-error :form="form" field="unit"></has-error>
                                </div>                           
                                <div class="form-group"> 
                                <textarea v-model="form.comment"  placeholder="Comment" name="comment" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>                       
                                <has-error :form="form" field="comment"></has-error>                       
                                </div> 
                                 <input v-model="form.nurse" 
                                :value="1" 
                                type="checkbox" 
                                name="nurse" /> Refer Patient for injection                                          
                                <center>
                                <button type="submit" class="labtestresult btn-block btn btn-info" style="color:#fff;">Give Prescription</button>
                                </center>
                                </form>                   
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div>
                </td>                            
                </tr>                              
                </tbody>
                <tfoot>
                <tr>
                <th>Unique ID</th>
                <th>Name</th>
                <th>Dianoses Details</th>
                <th>Doctor Comment</th>  
                <th>Symtoms</th>                  
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
                patient_id: '', 
                diagnose_id: '',              
                type: '',
                comment: '',
                unit: '',
                nurse: ''
                })              
            }
        },
        methods:{          
            LoadDiagnoses(){
                 axios.get('api/phamtest').then(({data}) => (this.diagnoses = data));
            },            
            addDiagnosis(){
                $('.labtestresult').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/uploadpham').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Test Result Uploaded Successfully'
                        })   
                        $('.labtestresult').html('Give Prescription'); 
                        $('#lab-test').trigger('reset'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed <br> Or <br> Data already exist'
                        })   
                        $('.labtestresult').html('Give Prescription');
                        });                                      
            },                
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadDiagnoses(); 
            Fire.$on('afterAction', () => {this.LoadDiagnoses()})                                   
        }
        
    }
</script>

