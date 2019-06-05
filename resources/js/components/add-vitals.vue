<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Patient Vitals</div>
                    <div class="card-body">
                        <form @submit.prevent="addVital" id="add-vital">
                        <div class="form-group">
                        <label>Select Patient</label>                
                        <select v-model="form.patient_id" class="form-control" :class="{ 'is-invalid': form.errors.has('patient_id') }" name="patient_id">
                        <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{patient.full_name}}</option>
                        </select>  
                        <has-error :form="form" field="patient_id"></has-error>
                        </div>                       
                        <div class="form-group">                        
                        <input v-model="form.temperature" type="number" name="temperature" placeholder="Enter Temperature"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('temperature') }">
                        <has-error :form="form" field="temperature"></has-error>
                        </div>                       
                        <div class="form-group">                        
                        <input v-model="form.blood_pressure" type="number" name="blood_pressure" placeholder="Enter Blood Pressure"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('blood_pressure') }">
                        <has-error :form="form" field="blood_pressure"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.height" type="number" name="height" placeholder="Enter Height"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('height') }">
                        <has-error :form="form" field="height"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.weight" type="number" name="weight" placeholder="Enter Weight"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('weight') }">
                        <has-error :form="form" field="weight"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.pulse" type="number" name="pulse" placeholder="Enter Pulse"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('pulse') }">
                        <has-error :form="form" field="pulse"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.blood_group" type="text" name="blood_group" placeholder="Enter Blood Group"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('blood_group') }">
                        <has-error :form="form" field="blood_group"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.blood_type" type="text" name="blood_type" placeholder="Enter Blood Type"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('blood_type') }">
                        <has-error :form="form" field="blood_type"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Immunization Status</label> <br>               
                        <select v-model="form.immunization" class="form-control immunization" multiple :class="{ 'is-invalid': form.errors.has('immunization') }" name="immunization[]">
                        <option value="Small Pox">Small Pox</option>
                        <option value="Yellow fever">Yellow Fever</option>
                        <option value="TAB">TAB</option>
                        <option value="Tetanus">Tetanus</option>
                        <option value="Poliomyelitis">Poliomyelitis</option>
                        <option value="Dysthera">Dysthera</option>
                        </select>  
                        <has-error :form="form" field="immunization"></has-error>
                        </div>                     
                        <center>
                        <button type="submit" class="vital btn-block btn btn-info" style="color:#fff;">Add Patient Vitals</button>
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
                    temperature: '',
                    blood_pressure: '',
                    height: '',
                    weight: '',
                    pulse: '',
                    blood_group: '',
                    blood_type: '',
                    immunization: []                
                })
            }            
        },
        methods:{
            addVital(){
                $('.vital').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/vital').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Patient Vitals Added Successfully'
                        })   
                        $('.vital').html('Add Patient Vital'); 
                        $('#add-vital').trigger('reset'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.vital').html('Add Patient Vital');
                        });                                      
            },
            loadPatients(){
                 axios.get('api/patient').then(({data}) => (this.patients = data));
            },
        },        
        mounted() {
            // (function($) {
            // $(function() {
            //     $('.immunization').fSelect({
            //     placeholder: 'Immunization Status',
            //     numDisplayed: 3,
            //     overflowText: '{n} selected',
            //     noResultsText: 'No results found',
            //     searchText: 'Search',
            //     showSearch: true
            //     });
            // });
            // })(jQuery);
            console.log('Component mounted.')
            this.loadPatients(); 
        }
    }
</script>
