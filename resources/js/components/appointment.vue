<template>
    <div class="container"> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addappointmentmodal">
        Add Appointment
        </button>
        <div class="modal fade" id="addappointmentmodal" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                       
            <div class="messages-saving"></div>
            <div class="almost_done"></div>            
            <div class="done"></div> 
            <form @submit.prevent="addAppointment" id="addappointmentform">
            <div class="form-group">
            <label>Select Patient</label>                
            <select v-model="form.patient_id" class="form-control" :class="{ 'is-invalid': form.errors.has('patient_id') }" name="patient_id">
            <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{patient.full_name}}</option>
            </select>  
            <has-error :form="form" field="patient_id"></has-error>
            </div>                           
            <div class="form-group">                        
            <input v-model="form.reason" type="text" name="reason" placeholder="Enter Reason"
                class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }">
            <has-error :form="form" field="reason"></has-error>
            </div>
            <div class="form-group"> 
            <label>Select Date and Time</label>                          
            <input v-model="form.date" type="date" name="date" placeholder="Enter Date"
                class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
            <has-error :form="form" field="date"></has-error>
            </div>                                                                                
            <center>
            <button type="submit" class="appoint btn-block btn btn-info" style="color:#fff;">Add Appointment</button>
            </center>
            </form>
            </div>
            </div>                        
        </div>
        </div>       
         <br> <br>
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <h3 class="card-title">Appoinment</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Reason</th>                
                  <th>Date</th>                  
                </tr>
                </thead>
                <tbody>              
                <tr v-for="appointment in appointments" :key="appointment.id">
                  <td>{{appointment.patient.unique_id}}</td>
                  <td>{{appointment.patient.title}} {{appointment.patient.full_name}}</td>
                  <td>{{appointment.reason}}</td>
                  <td>{{appointment.date | humanDate}}</td>    
                </tr>                   
                </tbody>
                <tfoot>
                <tr>
                <th>Unique ID</th>
                  <th>Name</th>
                  <th>Reason</th>                
                  <th>Date</th>
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
              appointments: {},
              patients: {},
              form: new Form({
                patient_id:'',
                reason: '',
                date: '',                
                })              
            }
        },
        methods:{                
            loadAppointment(){
                 axios.get('api/appointment').then(({data}) => (this.appointments = data));
                axios.get('api/patient').then(({data}) => (this.patients = data));               
            },                             
             addAppointment(){
                $('.appoint').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/appointment').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Appointment Added Successfully'
                        })   
                        $('#addappointmentform').trigger('reset');
                        $('.appoint').html('Add Appointment'); 
                        Fire.$emit('afterAction');                        
                        $('#addappointmentmodal').modal('hide');
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed <br> Or <br> Data already exist'
                        })   
                        $('.appoint').html('Add Appointment'); 
                        });                                      
            }, 
        },    
        mounted() {
            console.log('Component mounted.')            
            this.loadAppointment(); 
            Fire.$on('afterAction', () => {this.loadAppointment()}); 
            
                                                  
        }        
        
    }
</script>

