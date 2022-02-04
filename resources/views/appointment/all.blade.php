@extends('layouts.master')

@section('title')
{{ __('sentence.All Patients') }}
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
   {{ session('success') }}
</div>
@endif
<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Appointments') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('appointment.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
         </div>
      </div>
   </div>
   {{-- Calendar --}}
   <div class="calendar" >
      <div id='calendar-container'>
         <div id='calendar'></div>
      </div>
   </div>
   {{-- End Calendar --}}
    </div>
   </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">

         <div class="modal_header">
            <h2>
               {{ __('sentence.Appointment') }}
            </h2>
         </div>
         <form action="{{ route('appointment.store_edit') }}" method="POST" > 
            {{-- <input type="hidden" name="rdv_status" value="1">
            <input type="hidden" name="rdv_status" value="2"> --}}

            @csrf
            @method('POST')


            <div class="modal_body">
            
               <div class="Patient_Info">
                  <div class="Patient_Info_Logo">
                     <i class="fas fa-user modal_logos" ></i>
                  </div>
                  <div  class="Patient_Info_Name d-flex " > 
                     <strong>Name :</strong>
                     <div id="Patient_Name"></div>
                  </div>
                  <div class="Patient_Info_Age d-flex">
                     <strong>Age :</strong>
                     <div  id="Patient_Age"></div>
                     {{__('sentence.year')}}
                  </div>
               </div>
               <div class="Date_info d-flex mb-3">
                  <div class="Date_Logo">
                     <i class="fas fa-calendar modal_logos" ></i>
                  </div>
                  <div class="Date "  >
                     <strong>
                        Date : 
                     </strong>
                     <input type="date" id="Appointment_Date" name="Appointment_Date"  class="form-control"  >
                  </div>
               </div>
               <div class="From_info d-flex mb-3">
                  <div class="From_Logo">
                     <i class="fas fa-hourglass-start modal_logos " ></i>
                  </div>
                  <div class="From">
                     <strong>From -> </strong>
                     <input type="text"  id="Appointment_Start" name="Appointment_Start" class="form-control" >
                  </div>
               </div>
               <div class="To_info d-flex mb-3">
                  <div class="To_Logo">
                  <i class="fas fa-hourglass-end modal_logos " ></i>
                  </div>
                  <div class="To"> 
                     <strong>To -> </strong>
                     <input type="text" id="Appointment_End" name="Appointment_End" class="form-control">
                  </div>
               </div>
               <div class="Type_info mb-3 d-flex ">
                  <div class="Type_Logo">
                     <i class="fas fa-list modal_logos" ></i>
                  </div>
                  <div class="Type d-flex">
                     <strong>
                        Type :
                     </strong>
                     <select  id="Appointment_Type" class="Appointment_Type form-control">
                        <option value="" selected >Type 1</option>
                        <option value=""  >Type 2</option>
                        <option value=""  >Type 3</option>
                     </select>
                  </div>
               </div>
               <div class="Status_info mb-3 d-flex" >
                  <div class="status_title">
                     Status
                  </div>
                  <div class="status_btn">
                     <a class="btn btn-success text-white" >{{ __('sentence.Confirm Appointment') }}</a>
                     <form id="rdv-form-confirm" action="{{ route('appointment.Status_edit') }}" method="POST" class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        @csrf
                     </form>
                     <a class="btn btn-primary text-white" >{{ __('sentence.Cancel Appointment') }}</a>
                     <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        @csrf
                     </form>
                  </div>
                  
               </div>
            </div>



            <div class="modal_footer">
               <div class="btn-left" >
                  <button class="btn btn-dark" onclick="closeMod()" > Close </button>
               </div>
                  <div class="btn-right" >
                     <form action="{{ route('appointment.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="appointment_id" id="appointment_id">
                        <button class="btn btn-danger" id='modal_btn_delete' > <i class="fas fa-trash-alt" ></i> {{ __('sentence.Delete') }} </button>
                     </form> 
                  {{-- <input type="hidden" id="rdv_id" name="rdv_id"> --}}

                  <button class="btn btn-warning" id="modal_btn_edit" > <i class="fas fa-pen"></i> {{ __('sentence.Edit') }} </button>
               </div>
            </div>
         </form>
         
      </div>
    </div>

  </div>




</div>

@endsection

@section('header')

@endsection

@section('footer')

@endsection