<template>
    <div class="container">
        <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Patients Hospital History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Date Attended</th>
                  <th>Date Admitted</th>
                  <th>Date Discharged </th>
                  <th>Discharged To</th>
                  <th>All Details</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="hospital in hospitals" :key="hospital.id">
                  <td>{{hospital.patient.unique_id}}</td>
                  <td>{{hospital.patient.title}} {{hospital.patient.full_name}}</td>
                  <td>{{hospital.date_attented | humanDate}}</td>
                  <td>{{hospital.date_admitted | humanDate}}</td>
                  <td>{{hospital.date_discharged | humanDate}}</td>
                  <td>{{hospital.discharged_to}}</td>                  
                  <td>
                     <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + hospital.modal_id">
                        All Info.
                        </button>
                      <div class="modal fade" :id="hospital.modal_id" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">More Details</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <p><b>Date Attended: </b>{{hospital.date_attented | humanDate}}</p> 
                             <p><b>Date Admitted: </b>{{hospital.date_admitted | humanDate}}</p> 
                             <p><b>Refered by: </b>{{hospital.refered_by}}</p> 
                             <p><b>Ward: </b>{{hospital.ward}}</p> 
                             <p><b>Date Discharged: </b>{{hospital.date_discharged | humanDate}}</p> 
                             <p><b>Discharged To: </b>{{hospital.discharged_to}}</p> 
                             <p><b>Outcome of Care: </b>{{hospital.outcome_of_care}}</p> 
                             <p><b>Comment: </b>{{hospital.comment_box}}</p> 
                             <p><b>Symptoms and Complains: </b>{{hospital.symptoms}}</p>                     
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </div>
                      </div>
                      </div> 
                  </td> 
                  <td>
                  <div class="row">
                  <div class="col-sm-6">
                    <button  @click="editModal(hospital)" class="text-primary">
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
                      <div class="modal fade" id="edithospital" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Patient Hospital History</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updateHospital" id="edit-hospital">                        
                        <div class="form-group"> 
                        <label>Enter Date Attented</label>                        
                        <input v-model="form.date_attented" type="date" name="date_attented" placeholder="Enter Date Attented"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('date_attented') }">
                        <has-error :form="form" field="date_attented"></has-error>
                        </div>                       
                        <div class="form-group">   
                        <label>Enter Date Admitted</label>                      
                        <input v-model="form.date_admitted" type="date" name="date_admitted" placeholder="Enter Date Admitted"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('date_admitted') }">
                        <has-error :form="form" field="date_admitted"></has-error>
                        </div>
                        <div class="form-group"> 
                        <label>Refered By</label>                       
                        <input v-model="form.refered_by" type="text" name="refered_by" placeholder="Enter Refered By"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('refered_by') }">
                        <has-error :form="form" field="refered_by"></has-error>
                        </div>
                        <div class="form-group"> 
                        <label>Physician</label>                       
                        <input v-model="form.physician" type="text" name="physician" placeholder="Enter Physician"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('physician') }">
                        <has-error :form="form" field="physician"></has-error>
                        </div>
                        <div class="form-group">  
                        <label>Ward</label>                                             
                        <input v-model="form.ward" type="text" name="ward" placeholder="Enter Ward"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('ward') }">
                        <has-error :form="form" field="ward"></has-error>
                        </div>
                        <div class="form-group">  
                        <label>Enter Date Discharge</label>                       
                        <input v-model="form.date_discharged" type="date" name="date_discharged" placeholder="Enter Date Discharged"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('date_discharged') }">
                        <has-error :form="form" field="date_discharged"></has-error>
                        </div>
                        <div class="form-group">   
                        <label>Discharge To</label>                                            
                        <input v-model="form.discharged_to" type="text" name="discharged_to" placeholder="Enter Discharged To"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('discharged_to') }">
                        <has-error :form="form" field="discharged_to"></has-error>
                        </div>
                        <div class="form-group"> 
                        <label>Outcome of Care</label>                       
                        <textarea v-model="form.outcome_of_care"  placeholder="Enter Outcome of Care" name="outcome_of_care" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('outcome_of_care') }"></textarea>                       
                        <has-error :form="form" field="outcome_of_care"></has-error>                       
                        </div>   
                        <div class="form-group"> 
                        <label>Symptoms</label>                       
                        <textarea v-model="form.symptoms"  placeholder="Enter Symptoms" name="symptoms" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('symptoms') }"></textarea>                       
                        <has-error :form="form" field="symptoms"></has-error>                       
                        </div> 
                        <div class="form-group"> 
                        <label>Comment</label>                       
                        <textarea v-model="form.comment_box"  placeholder="Enter Comment" name="comment_box" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment_box') }"></textarea>                       
                        <has-error :form="form" field="comment_box"></has-error>                       
                        </div> 
                            <center>
                            <button type="submit" class="updatehospital btn-block btn btn-info" style="color:#fff;">Update Patient Hospital History</button>
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
                  <th>Date Attended</th>
                  <th>Date Admitted</th>
                  <th>Date Discharged </th>
                  <th>Discharged To</th>
                  <th>All Details</th>
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
              hospitals: {},
              form: new Form({
                id:'',
                patient_id: '',
                date_attented: '',
                date_admitted: '',
                refered_by: '',
                physician: '',
                ward: '',
                date_discharged: '',
                discharged_to: '',
                outcome_of_care: '',
                comment_box: '',
                symptoms: '',    
                })              
            }
        },
        methods:{          
            LoadHospitals(){
                 axios.get('api/hospital').then(({data}) => (this.hospitals = data));
            },
            editModal(hospital){
              $('#edithospital').modal('show');
              this.form.fill(hospital);              
            },
            updateHospital(){
                $('.updatehospital').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/hospital/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#edithospital').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Patient Biodata Update Successfully'
                        })   
                        $('.updatehospital').html('Add Patient'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatehospital').html('Add Patient');
                        });                                      
            }
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadHospitals(); 
            Fire.$on('afterAction', () => {this.LoadHospitals()})                                   
        }
        
    }
</script>

