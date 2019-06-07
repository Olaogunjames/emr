<template>
    <div class="container">
        <div>
            <router-link to="/add-biodata"  type="button" class="btn btn-rounded btn-info"  style="color:#fff;">Add New</router-link>
        </div> <br><br>
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">All Patients</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <center>
                <!-- <div class="test">
                    <img src="images/Interwind-1s-100px.svg" alt="">
                </div> -->
                </center>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Occupation </th>
                  <th>Sex</th>
                  <th>All</th>
                  <th>Action</th>
                </tr>
                </thead>                
                <tbody>                                                                                         
                <tr v-for="patient in patients" :key="patient.id">
                  <td>{{patient.unique_id}}</td>
                  <td>{{patient.title}}  {{patient.full_name}}</td>
                  <td>{{patient.email}}</td>
                  <td>{{patient.phone_number}}</td>
                  <td>{{patient.occupation}}</td>
                  <td>{{patient.sex}}</td>                  
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + patient.unique_id">
                        All Info.
                        </button>
                 <!--Biodata Modal -->
                      <div class="modal fade" :id="patient.unique_id" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Patient Biodata</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <p><b>Name: </b>{{patient.title}} {{patient.full_name}}</p>
                             <p><b>Email: </b> {{patient.email}}</p>
                             <p><b>Phone Number: </b> {{patient.phone_number}}</p>
                             <p><b>Occupation: </b> {{patient.occupation}}</p>
                             <p><b>Sex: </b>{{patient.sex}}</p>
                             <p><b>Date of Birth: </b> {{patient.dob}}</p>
                             <p><b>Religion: </b>{{patient.religion}}</p>
                             <p><b>Nationality: </b>{{patient.nationality}}</p>
                             <p><b>State of Origin: </b> {{patient.state_of_origin}}</p>
                             <p><b>Home Address: </b>{{patient.home_address}}</p>
                             <p><b>Place of Birth: </b>{{patient.place_of_birth}}</p>
                             <p><b>Marital Status: </b> {{patient.marital_status}}</p>
                             <p><b>Registration Date: </b> {{patient.created_at | humanDate}}</p>
                             <p><b>Home of Next of kin: </b> {{patient.home_next_of_kin}}</p>
                             <p><b>Phone Number Next of Kin :</b>{{patient.phone_next_of_kin}}</p>
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
                    <button  @click="editModal(patient)" class="text-primary">
                      <i class="fa fa-edit"></i>
                    </button>
                    </div>
                    <div class="col-sm-6">
                    <button  @click="deletePatient(patient.id)" class="text-danger">
                      <i class="fa fa-trash"></i>
                    </button>
                    </div>
                    </div>
                </td>                            
                </tr>                  
                 <!--Biodata Modal -->
                      <div class="modal fade" id="editpatient" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Patient Biodata</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                             <form @submit.prevent="updatePatient" id="add-biodata">
                            <div class="form-group">
                            <label>Select Title</label>                
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
                            <input v-model="form.full_name" type="text" name="full_name" placeholder="Enter Full Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('full_name') }">
                            <has-error :form="form" field="full_name"></has-error>
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.phone_number" type="number" name="phone_number" placeholder="Enter Mobile Number"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                            <has-error :form="form" field="phone_number"></has-error>
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.occupation" type="text" name="occupation" placeholder="Enter Occupation"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('occupation') }">
                            <has-error :form="form" field="occupation"></has-error>
                            </div>
                            <div class="form-group">
                            <label>Select Gender</label>                
                            <select v-model="form.sex" class="form-control" :class="{ 'is-invalid': form.errors.has('sex') }" name="sex">
                            <option value="nul" style="font-weight:700;">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>     
                            </select>  
                            <has-error :form="form" field="sex"></has-error>
                            </div>
                            <div class="form-group">
                            <label>Date of Birth</label>                        
                            <input v-model="form.dob" type="date" name="dob" placeholder="Enter Date of Birth"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }">
                            <has-error :form="form" field="dob"></has-error>
                            </div>
                            <div class="form-group">
                            <label>Select Relegion</label>                
                            <select v-model="form.religion" class="form-control" :class="{ 'is-invalid': form.errors.has('religion') }" name="religion">
                            <option value="nul" style="font-weight:700;">Select Religion</option>
                            <option value="Christainity">Christainity</option>
                            <option value="Islam">Islam</option>     
                            </select>  
                            <has-error :form="form" field="religion"></has-error>
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.nationality" type="text" name="nationality" placeholder="Nationality"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('nationality') }">
                            <has-error :form="form" field="nationality"></has-error>
                            </div>
                            <div class="form-group">
                            <label>State of Origin</label>                
                            <select v-model="form.state_of_origin" class="form-control" :class="{ 'is-invalid': form.errors.has('state_of_origin') }" name="state_of_origin">
                            <option value="nul" style="font-weight:700;">State of Origin</option>
                            <option value="Niger State">Niger State</option>
                            <option value="Zamfara State">Zamfara State</option>     
                            <option value="Gombe State">Gombe State</option> 
                            </select>  
                            <has-error :form="form" field="state_of_origin"></has-error>
                            </div>
                            <div class="form-group"> 
                            <textarea v-model="form.home_address"  placeholder="Enter Home Address" name="home_address" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('home_address') }"></textarea>                       
                            <has-error :form="form" field="home_address"></has-error>                       
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.place_of_birth" type="text" name="place_of_birth" placeholder="Enter Place of Birth"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('place_of_birth') }">
                            <has-error :form="form" field="place_of_birth"></has-error>
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.marital_status" type="text" name="marital_status" placeholder="Enter Marital Status"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('marital_status') }">
                            <has-error :form="form" field="marital_status"></has-error>
                            </div>
                            <div class="form-group"> 
                            <textarea v-model="form.home_next_of_kin"  placeholder="Enter Next of Kin Home Address" name="home_next_of_kin" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('home_next_of_kin') }"></textarea>                       
                            <has-error :form="form" field="home_next_of_kin"></has-error>                       
                            </div>
                            <div class="form-group">                        
                            <input v-model="form.phone_next_of_kin" type="number" name="phone_next_of_kin" placeholder="Enter Next of Kin Phone Number"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('phone_next_of_kin') }">
                            <has-error :form="form" field="phone_next_of_kin"></has-error>
                            </div>
                            <center>
                            <button type="submit" class="updatepatient btn-block btn btn-info" style="color:#fff;">Update Patient</button>
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
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Occupation </th>
                  <th>Sex</th>
                  <th>All</th>
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
              patients: {},
              form: new Form({
                    id: '',
                    unique_id: 'EMR' + Math.floor((Math.random() * 10000000000) + 1),
                    title: '',
                    full_name: '',
                    email: '',
                    phone_number: '',
                    occupation: '',
                    sex: '',
                    dob: '',
                    religion: '',
                    nationality: '',
                    state_of_origin: '',
                    home_address: '',
                    place_of_birth: '',
                    marital_status: '',
                    home_next_of_kin: '',
                    phone_next_of_kin: ''

                })              
            }
        },
        methods:{          
            loadPatients(){                            
                 axios.get('api/patient').then(({data}) => (this.patients = data));                 
            },
            editModal(patient){
              $('#editpatient').modal('show');
              this.form.fill(patient);              
            },
            deletePatient(id){
                swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            //delete qury below
                            if (result.value) {
                                swal.fire({
                                position: 'center',
                                type: 'info',
                                title: 'Processing Delete',
                                showConfirmButton: false,
                                timer: 1000
                                })
                        this.form.delete('api/patient/'+id).then(
                            ()=>{
                                swal.fire(
                                'Deleted!',
                                'Deleted Successfully.',
                                'success'
                                )
                                Fire.$emit('afterAction');
                            }).catch(
                                ()=>{
                                swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                })  
                                }); 
                            }                       
                        })
            },
            updatePatient(){
                $('.updatepatient').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.put('api/patient/'+this.form.id).then(
                    ()=>{
                        Fire.$emit('afterAction');
                        $('#editpatient').modal('hide');
                        toast.fire({
                        type: 'success',
                        title: 'Patient Biodata Updated Successfully'
                        })   
                        $('.updatepatient').html('Update Patient'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.updatepatient').html('Update Patient');
                        });                                      
            }
        },        
        mounted() {
            console.log('Component mounted.')                        
            this.loadPatients(); 
            Fire.$on('afterAction', () => {this.loadPatients()})                                   
        }
        
    }
</script>

