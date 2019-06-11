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
                        Upload Lab. Result
                        </button>
                      <div class="modal fade" :id="diagnose.modal_id" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Upload Labouratory Test Result</h5>
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
                                <label>Select Type of Test</label>                
                                <select v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" name="type">
                                 <option value="Type Test 1">Type Test 1</option>
                                <option value="Type Test 2">Type Test 2</option>
                                <option value="Type Test 3">Type Test 3</option>
                                <option value="Type Test 4">Type Test 4</option>
                                <option value="Type Test 5">Type Test 5</option>
                                </select>  
                                <has-error :form="form" field="type"></has-error>
                                </div>
                                <!-- <div class="form-group">
                                  <label for="image">Image file</label>
                                  <input type="file" name="image" @change="imageFunction" class="form-control">                                
                                </div> -->
                                <div class="form-group"> 
                                <textarea v-model="form.comment"  placeholder="Comment" name="comment" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>                       
                                <has-error :form="form" field="comment"></has-error>                       
                                </div>                                                                   
                                <center>
                                <button type="submit" class="labtestresult btn-block btn btn-info" style="color:#fff;">Upload Test Result</button>
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
                comment: ''
                })              
            }
        },
        methods:{          
            LoadDiagnoses(){
                 axios.get('api/labtest').then(({data}) => (this.diagnoses = data));
            },  
            // imageFunction(e){
            //   let file = e.target.files[0];
            //   let reader = new FileReader();
            //   reader.onloadend = (file) => {
            //     this.form.image = reader.result;
            //   }
            //   reader.readAsDataURL(file);
            // },
            addDiagnosis(){
                $('.labtestresult').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/uploadtest').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Test Result Uploaded Successfully'
                        })   
                        $('.labtestresult').html('Upload Test Result'); 
                        $('#lap-result').modal('hide');
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed <br> Or <br> Data already exist'
                        })   
                        $('.labtestresult').html('Upload Test Result ');
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

