<template>
  <div>

        <div class="row">
           <!-- <MenuBar/> -->
           <!-- <router-view></router-view> -->
           <div class="col-12">
               <div class="card">
                   <div class="card-header">Add New Patient</div>
                   <div class="card-body">
                       <form action="" @submit.prevent="addPatient">
                           <div class="form-group">
                             <label for="">Patient Name</label>
                             <input type="text" v-model="form.patient" class="form-control">
                           </div>
                           <div class="form-group">
                             <label for="">Contact</label>
                             <input type="text" v-model="form.contact" class="form-control"  placeholder="">
                           </div>

                           <button type="submit" class="btn btn-outline-primary">Submit</button>
                       </form>
                   </div>
               </div>

             </div>
        </div>
        <div v-if="showModal">
        <transition name="modal">
        <div class="modal-mask">
        <div class="modal-wrapper">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Queue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                  <p>
                      Patient ID : <b>{{this.id}}</b><br>
                      Patient Name:<b>{{this.name}}</b><br>
                  </p>
                      <form  method="post">
                        <div class="form-group">
                          <label for="">Department</label>
                          <select class="form-control" v-model="frm.department">
                            <option value="">Choose department</option>
                              <option v-for="d in department" v-bind:value="d.name" >{{d.name}}</option>
                          </select>
                        </div>
                      </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="addToQueue">Add to Queue</button>
                </div>
            </div>
        </div>

        </div>
        </div>
        </transition>
        </div>
            <div>
              <div class="row mt-3">
                 <div class="col-12">


                     <div class="card">
                         <div class="card-header">Patient List</div>
                         <div class="card-body">
                           <table class="table-hover table-bordered" id="example">
                               <thead>
                               <tr>
                               <th>ID</th>
                               <th>Patient name</th>
                               <th>Contact</th>
                               <th>Action</th>

                             </tr>
                             </thead>
                             <tbody>
                               <tr v-for="(p,index) in patients" @key="index">
                                 <td>{{index+1}}</td>
                                 <td>{{p.name}}</td>
                                 <td>{{p.contact}}</td>
                                 <td>
                                    <button type="button"  @click="checkIn(p.name,p.id)" class="btn btn-info btn-sm">Check in</button>
                                    <!-- <button type="button" v-else name="button" class="btn btn-warning btn-sm">Added</button> -->
                                 </td>
                               </tr>
                             </tbody>
                           </table>
                         </div>
                     </div>

                   </div>
              </div>
            </div>

        </div>


</template>

<script>
//Bootstrap and jQuery libraries
import 'bootstrap/dist/css/bootstrap.min.css';
import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import "datatables.net-buttons/js/dataTables.buttons.js"
import "datatables.net-buttons/js/buttons.colVis.js"
import "datatables.net-buttons/js/buttons.flash.js"
import "datatables.net-buttons/js/buttons.html5.js"
import "datatables.net-buttons/js/buttons.print.js"
import $ from 'jquery';
export default {

      data(){
        return{
          form:{
            patient:'',
            contact:''
          },
          frm:{
            department:''
          },
          department:[],
          patients:[],
          showModal:false,
          addedToQueue:false,
          name:'',
          id:'',
          search:'',
          showSearch:false,
          dummy:[]
        }
      },

      mounted: function() {
          this.fetchPatient();
          this.fetchDepartment();
      },

      methods:{
      searchPatient:function(){
          fetch('patient/search?q='+this.search)
          .then(response => response.json())
          .then(response =>{
            this.dummy = response
            this.search=''
            this.showSearch = true
          }).
          catch(error =>{
            console.log(error)
          });
      },
      addPatient:function(){
     let uri = '/patient/create';
      axios.post(uri, this.form).then((response) => {
       this.form.patient = '';
       this.form.contact = '';
       this.fetchPatient();
       alert('Patient added');

    });
        },
          fetchPatient:function(){
          let uri = '/patient'
          axios.get(uri).then((response)=>{
            this.patients = response.data;
              setTimeout(function(){
                      $('#example').DataTable(
                          {
                              pagingType: 'full_numbers',
                              pageLength: 5,
                              processing: true,
                              dom: 'Bfrtip',
                              buttons: ['copy', 'csv', 'print'
                              ]
                          }
                      );
                  },
                  1000
              );
          })
        },
        fetchDepartment:function(){
        let uri = '/getDepartment'
        axios.get(uri).then((response)=>{
          this.department = response.data;
        })
      },
        checkIn:function(name,id){
          this.showModal = true;
          this.name = name;
          this.id = id;
        },
        addToQueue: function() {

                    let dep = {
                        frm: this.frm   //fetches department from the form select field
                    }

                    let patient_id = {
                        patient: this.id // fetches the patient ID
                    }

                    axios.post('/queue/create', {
                        patient_id,
                        dep,

                    }).then(res => {

                        this.showModal = false;
                        this.addedToQueue = true;
                        alert("Patient added to Queue");


                    }).catch(e => {
                        console.log(e);
                    })
                },
          },


        async beforeRouteEnter (to,from,next){

                  console.log('Loading data...');
                  let url = '/department'
                  axios.get(url).then((response) => {

                      if(response.data!="reception"){
                          next('/'+response.data)
                      }
                      next();
                  }).catch((error) => {
                      console.log(error);
                  })
        }

    }
</script>
<style lang="css" scoped>
.table>tbody>tr>td, .table>tfoot>tr>td{
vertical-align: middle;
}
@media screen and (max-width: 600px) {
table#cart tbody td .form-control{
width:20%;
display: inline !important;
}
.actions .btn{
width:36%;
margin:1.5em 0;
}

.actions .btn-info{
float:left;
}
.actions .btn-danger{
float:right;
}

table#cart thead { display: none; }
table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
table#cart tbody tr td:first-child { background: #333; color: #fff; }
table#cart tbody td:before {
content: attr(data-th); font-weight: bold;
display: inline-block; width: 8rem;




}
}



table#cart tfoot td{display:block; }
table#cart tfoot td .btn{display:block;}
.messageVide {
    font-size: 25px;
    width: 100%;
    background-color: #c2dae8;
    padding: 1.5em 0;
    border-radius: 5px;
    font-weight: lighter;
    display: inline-block;
    text-align: center;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-header {
    background-color: #34373d;
}
.modal-title {
    color: #fff;
}
.close {
    color: #fff;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
#card-details {
  max-height: calc(100vh - 210px);
    overflow-y: auto;
}
#product-details {
  max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
