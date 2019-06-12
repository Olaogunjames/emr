<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Patient Hospital History</div>
                    <div class="card-body">
                        <form @submit.prevent="addHospital" id="add-hospital">
                        <div class="form-group">
                        <label>Select Patient</label>                
                        <select v-model="form.patient_id" class="form-control" :class="{ 'is-invalid': form.errors.has('patient_id') }" name="patient_id">
                        <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{patient.full_name}}</option>
                        </select>  
                        <has-error :form="form" field="patient_id"></has-error>
                        </div>                       
                        <div class="form-group"> 
                        <label>Enter Date Attended</label>                        
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
                        <input v-model="form.refered_by" type="text" name="refered_by" placeholder="Enter Refered By"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('refered_by') }">
                        <has-error :form="form" field="refered_by"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.physician" type="text" name="physician" placeholder="Enter Physician"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('physician') }">
                        <has-error :form="form" field="physician"></has-error>
                        </div>
                        <div class="form-group">                        
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
                        <input v-model="form.discharged_to" type="text" name="discharged_to" placeholder="Enter Discharged To"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('discharged_to') }">
                        <has-error :form="form" field="discharged_to"></has-error>
                        </div>
                        <div class="form-group"> 
                        <textarea v-model="form.outcome_of_care"  placeholder="Enter Outcome of Care" name="outcome_of_care" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('outcome_of_care') }"></textarea>                       
                        <has-error :form="form" field="outcome_of_care"></has-error>                       
                        </div>   
                        <div class="form-group"> 
                        <textarea v-model="form.symptoms"  placeholder="Enter Symptoms" name="symptoms" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('symptoms') }"></textarea>                       
                        <has-error :form="form" field="symptoms"></has-error>                       
                        </div> 
                        <div class="form-group"> 
                        <textarea v-model="form.comment_box"  placeholder="Enter Comment" name="comment_box" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('comment_box') }"></textarea>                       
                        <has-error :form="form" field="comment_box"></has-error>                       
                        </div>                                                         
                        <center>
                        <button type="submit" class="hospital btn-block btn btn-info" style="color:#fff;">Add Patient Hospital History</button>
                        </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
    export default {
        data(){
            return {
                patients: {},
                form: new Form({
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
            addHospital(){
                $('.hospital').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/hospital').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Patient Hospital History Added Successfully'
                        })   
                        $('.hospital').html('Add Patient Hospital History '); 
                        $('#add-hospital').trigger('reset'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.hospital').html('Add Patient Hospital History ');
                        });                                      
            },
            loadPatients(){                                            
                // this.loading = true;
                axios.get("api/patient")
                .then((response)  =>  {
                    setTimeout(function(){
                    NProgress.done()
                    }, 1000);
                    this.patients = response.data;
                })              
            },
        },        
        mounted() {           
            console.log('Component mounted.')            
        }
    }
</script>
