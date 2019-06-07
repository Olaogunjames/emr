<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Staff</div>
                    <div class="card-body">
                        <form @submit.prevent=" addStaff" id="add-staff">
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
                        <input v-model="form.name" type="text" name="name" placeholder="Enter Full Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">                        
                        <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">                        
                      <select  v-model="form.role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }" name="role">
                            <option value="nul" style="font-weight:700;">Select Role</option>
                            <option value="recept">Reception</option>
                            <option value="nurse">Nurse</option>
                            <option value="doc">Doctor</option>
                            <option value="lab">Laboratory</option>
                            <option value="pharm">Pharmacy</option>
                            <option value="admin">Admin</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                        </div>                          
                        <div class="form-group">                        
                        <input v-model="form.password" type="password" name="password" placeholder="Enter Password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                        </div>                      
                        <center>
                        <button type="submit" class="addstaff btn-block btn btn-info" style="color:#fff;">Add Staff</button>
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
                form: new Form({                    
                    title: '',
                    name: '',
                    email: '',
                    role: '',
                    password: ''
                })
            }
        },
        methods:{
             addStaff(){
                $('.addstaff').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/staff').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Staff Added Successfully'
                        })   
                        $('.addstaff').html('Add Staff'); 
                        $('#add-staff').trigger('reset'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Data not correctly inputed'
                        })   
                        $('.addstaff').html('Add Staff');
                        });                                      
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
