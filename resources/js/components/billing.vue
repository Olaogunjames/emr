<template>
    <div class="container"> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymodal">
        Add Payment
        </button>
        <div class="modal fade" id="paymodal" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Make Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: none;" class="paybutton">Your details are being processed, click the pay button below to continue <br> <button type="button" class="btn btn-success pay-pay" @click="payWithPaystack()"> Pay </button>   </div>         
            <div class="messages-saving"></div>
            <div class="almost_done"></div>            
            <div class="done"></div> 
            <form @submit.prevent="paymentSave" id="addpayment">
            <div class="form-group">
            <label>Select Patient</label>                
            <select v-model="form.patient_id" class="form-control" :class="{ 'is-invalid': form.errors.has('patient_id') }" name="patient_id">
            <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{patient.full_name}}</option>
            </select>  
            <has-error :form="form" field="patient_id"></has-error>
            </div> 
            <div class="form-group">
            <label>Select Type of Payment</label>                
            <select v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" name="type">
            <option value="Consultation">Consultation Fee</option>
            <option value="Observation">Observation Fee</option>
            <option value="Service">Service Fee</option>
            <option value="Medication">Medication Fee</option>
            </select>  
            <has-error :form="form" field="type"></has-error>
            </div>               
            <div class="form-group">                        
            <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
            <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group">                        
            <input v-model="form.amount" type="number" name="amount" placeholder="Enter Amount"
                class="form-control" :class="{ 'is-invalid': form.errors.has('amount') }">
            <has-error :form="form" field="amount"></has-error>
            </div>                                                                                
            <center>
            <button type="submit" class="pay btn-block btn btn-info" style="color:#fff;">Submit</button>
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
              <h3 class="card-title">Payments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Type of Payment</th>                
                  <th>Amount</th>
                  <th>Date of Payment</th>                  
                </tr>
                </thead>
                <tbody>              
                <tr v-for="payment in payments" :key="payment.id">
                  <td>{{payment.patient.unique_id}}</td>
                  <td>{{payment.patient.title}} {{payment.patient.full_name}}</td>
                  <td>{{payment.type}} Fee</td>
                  <td>{{payment.amount}}</td>
                  <td>{{payment.created_at | humanDate}}</td>    
                </tr>                   
                </tbody>
                <tfoot>
                <tr>
                <th>Unique ID</th>
                  <th>Name</th>
                  <th>Type of Payment</th>                
                  <th>Amount</th>
                  <th>Date of Payment</th> 
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
              payments: {},
              patients: {},
              form: new Form({
                patient_id:'',
                type: '',
                amount: '',
                ref: '',
                email: ''
                })              
            }
        },
        methods:{                
            loadPayment(){
                 axios.get('api/payment').then(({data}) => (this.payments = data));
                axios.get('api/patient').then(({data}) => (this.patients = data));               
            },                             
             paymentSave(){
                $('.pay').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/payment').then(
                    ()=>{                         
                        $('#addpayment').hide(); 
                        $('.paybutton').show(); 
                        //  $('.messages-saving').html('<div>Your details are being processed, click the pay button below to continue</div> <br> <button type="button" class="btn btn-success pay-pay" @click="payWithPaystack()"> Pay </button>');
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.pay').html('Pay');
                        });                                      
            },   
            payWithPaystack(){
            let emaill = this.form.email;        
            let amountt =  this.form.amount;
            var handler = PaystackPop.setup({
            key: 'pk_test_a7a3f1af9b8a244ff37b33665673db03af42f204',
            email: emaill,
            amount: amountt+'00',
            ref: 'EMR'+Math.floor((Math.random() * 100000000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you            


            callback: function(response){
                $('.paybutton').hide();     
                $('.almost_done').html(' <p><i class="fa fa-spin fa-spinner"></i> <br><b>Saving</b>.... <br> Please wait </p>');                         
                let ref =   response.reference;
                var url = 'api/paymentsave';
                var post = 'POST';                                     
                $.ajax({
                    type : post,
                    url : url,
                    data : {'ref_id' : ref},
                    dataTy : 'json',
                    success: function(data){
                        console.log(data);                
                        // $('.info_s').html();
                        $('.almost_done').hide();  
                        $('.done').html('<div>Payment Succesful, Make another payment</div>');
                        $('#addpayment').show(); 
                        $('.pay').html('Submit');                        
                                        
                    }
            
                })
                //   alert('success. transaction ref is ' + response.reference);
            },
            onClose: function(){
                alert('window closed');
            }
            });
            handler.openIframe();
        }         
        },        
        mounted() {
            console.log('Component mounted.')            
            this.loadPayment(); 
            Fire.$on('afterAction', () => {this.loadPayment()}); 
            
                                                  
        }        
        
    }
</script>

