<template>
    <div class="container">       
        <!-- <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>  -->
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Labouratory Result</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Dianoses Details</th>                
                  <th>Date of  Test</th>
                  <th>Lab Result</th>
                  <th v-if="user.role == 'lab'">Action</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="labresult in labresults" :key="labresult.id">
                  <td>{{labresult.patient.unique_id}}</td>
                  <td>{{labresult.patient.title}} {{labresult.patient.full_name}}</td>
                  <td>{{labresult.diagnose.diagnosis}}</td>
                  <td>{{labresult.created_at | humanDate}}</td>
                  <td>{{labresult.type}} <br> {{labresult.comment}}</td>                                                                   
                  <td v-if="user.role == 'lab'">
                  <div class="row">
                  <div class="col-sm-6">
                    <button  @click="editModal(labresult)" class="text-primary">
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
                      <div class="modal fade" id="editlabresults" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Lab Result</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updatelabresults" id="edit-labresults">                         
                                <div class="form-group">
                                <label>Select Type of Test</label>                
                                <select v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" name="type">
                                 <option value="Full blood Count">Full blood Count</option>                                
                                 <option value="Urinalysis">Urinalysis</option> 
                                 <option value="Malaria Parasite">Malaria Parasite</option> 
                                 <option value="HIV I - II">HIV I - II</option> 
                                 <option value="Blood Group">Blood Group</option> 
                                 <option value="Genotype">Genotype</option> 
                                 <option value="Blood Sugar">Blood Sugar</option> 
                                 <option value="Pregnancy Test">Pregnancy Test</option> 
                                 <option value="Mantoux Test">Mantoux Test</option>                              
                                </select>  
                                <has-error :form="form" field="type"></has-error>
                                </div>                                
                                <div class="form-group"> 
                                  <label>Edit Comment</label>  
                                <textarea v-model="form.comment"  placeholder="Comment" name="comment" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>                       
                                <has-error :form="form" field="comment"></has-error>                       
                                </div>
                            <center>
                            <button type="submit" class="updatelabresults btn-block btn btn-info" style="color:#fff;">Update Lab Result</button>
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
                <th>Date of  Test</th>               
                <th>Lab Result</th>
                <th v-if="user.role == 'lab'">Action</th>
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
              labresults: {},
              user: {},
              form: new Form({
                id:'',
                type: '',
                comment: ''
                })              
            }
        },
        methods:{          
            LoadLabresult(){
                 axios.get('api/uploadtest').then(({data}) => (this.labresults = data));
                //  axios.get('api/loguser').then(({data}) => (this.user = data));
                 axios.get('api/user').then(response => {
                     console.log(response.data);
                     this.user = response.data
                 })                 
            },
            editModal(labresult){
              $('#editlabresults').modal('show');
              this.form.fill(labresult);              
            },        
            updatelabresults(){
                $('.updatelabresults').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/uploadtest/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editlabresults').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Lab Results Updated Successfully'
                        })   
                        $('.updatelabresults').html('Update Lab Result'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatelabresults').html('Update Lab Result');
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

