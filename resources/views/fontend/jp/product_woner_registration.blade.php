@extends('layouts.fontend_master2')

@section('content')
 <!-- Swiper -->
 <!-- Breadcrumbs-->

<!--=============================  ======================================-->
<style>
    input.submit {
    padding-left: 56px;
    background: url(/fontend/images/icon_check.png) no-repeat 0 0 #f5a63f;
        background-size: auto;
    -webkit-background-size: 48px;
    -moz-background-size: 48px;
    -ms-background-size: 48px;
    background-size: 48px;
    height: 48px;
    font-weight: bold;
}
.headerstyle{color: #f5a63f;}
.red{padding-left: 10px;color:red;}
</style>
<script>
    
</script>



<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
        <div class="container">
            <div class="row">
                <div>
                    
                    <div class="card">
                        <div class="card-body">
                            
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                            @endif
        
        
                            

                            <form action="{{route('product_owner.product_owner_request_store')}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">
        
                                @csrf
        
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <div class="col-sm-9">        
                                <h4 class="headerstyle">Auction Product Owner Registration</h4>
                                <p>
                                    In below form, provide all the fields value as properly as you can and then click on "Confirm" button. Please provide your address accurately.
                                </p>
                                <p>
                                    We will report your UserID and Password later by e-mail.
                                    Be careful about "Money Transfer. Without inform us, please don't send money, when required we will inform you."
                                </p>
                                <p>
                                 When you get UserID and Password from us, please properly handle it, don't give it to other.
                                </p>
                            </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <span style="float: right;width:100px;display: block;text-align: center;color:rgb(37, 4, 247);cursor: pointer;text-decoration: underline;" onclick="cleardata()">Clear Data</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company_name_en"
                                        class="col-sm-3 text-end control-label col-form-label">Company Name (English)<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="company_name_en" id="company_name_en" onkeyup='saveValue(this);' class="form-control @error('company_name') is-invalid @enderror" value="{{old('company_name')}}" autocomplete="off">
                                        @error('company_name')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="company_name_en"
                                        class="col-sm-3 text-end control-label col-form-label">Company Name (Japanese)<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="company_name_jp" id="company_name_jp" onkeyup='saveValue(this);' class="form-control @error('company_name') is-invalid @enderror" value="{{old('company_name')}}" autocomplete="off">
                                        @error('company_name')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name_en"
                                        class="col-sm-3 text-end control-label col-form-label">President Name (English)<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="name_en" id="name_en" onkeyup='saveValue(this);' class="form-control @error('name_en') is-invalid @enderror" value="{{old('name_en')}}" autocomplete="off">
                                        @error('name_en')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name_en"
                                        class="col-sm-3 text-end control-label col-form-label">President Name (Japanese)<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="name_jp" id="name_jp" onkeyup='saveValue(this);' class="form-control @error('name_jp') is-invalid @enderror" value="{{old('name_jp')}}" autocomplete="off">
                                        @error('name_jp')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="person_incharge_en"
                                        class="col-sm-3 text-end control-label col-form-label">Person In Charge (English) <span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="person_incharge_en" onkeyup='saveValue(this);' id="person_incharge_en" class="form-control @error('person_incharge_en') is-invalid @enderror" value="{{old('person_incharge_en')}}" autocomplete="off">
                                        @error('person_incharge_en')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="person_incharge_en"
                                        class="col-sm-3 text-end control-label col-form-label">Person In Charge (Japanese) <span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="person_incharge_jp" onkeyup='saveValue(this);' id="person_incharge_jp" class="form-control @error('person_incharge_jp') is-invalid @enderror" value="{{old('person_incharge_jp')}}" autocomplete="off">
                                        @error('person_incharge_jp')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
        
                                <div class="form-group row">
                                    <label for="address"
                                        class="col-sm-3 text-end control-label col-form-label">Address<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <textarea  name="address" id="address" onkeyup='saveValue(this);' autocomplete="off" class="form-control @error('address') is-invalid @enderror"
                                        autocomplete="off">{{old('address')}}</textarea>
                                        @error('address')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="zip_code"
                                        class="col-sm-3 text-end control-label col-form-label">Post code<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="postcode" id="postcode" onkeyup='saveValue(this);' class="form-control @error('postcode') is-invalid @enderror" value="{{old('postcode')}}" autocomplete="off">
                                        @error('postcode')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="country"
                                        class="col-sm-3 text-end control-label col-form-label">Country<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="country" id="country" onkeyup='saveValue(this);' class="form-control @error('country') is-invalid @enderror" value="{{old('country')}}" autocomplete="off">
                                        @error('country')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email1"
                                        class="col-sm-3 text-end control-label col-form-label">Email 1<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="email"  name="email1" id="email1" onkeyup='saveValue(this);' class="form-control @error('email1') is-invalid @enderror" value="{{old('email1')}}"  autocomplete="off">
                                        @error('email1')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email2"
                                        class="col-sm-3 text-end control-label col-form-label">Email 2(optional)</label>
                                    <div class="col-sm-6">
                                        <input type="email"  name="email2" id="email2" onkeyup='saveValue(this);' class="form-control @error('email2') is-invalid @enderror" value="{{old('email2')}}" autocomplete="off">
                                        @error('email2')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                
        
                                <div class="form-group row">
                                    <label for="phone1"
                                        class="col-sm-3 text-end control-label col-form-label">Phone 1<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number"  name="phone1" id="phone1" onkeyup='saveValue(this);' class="form-control @error('phone1') is-invalid @enderror" value="{{old('phone1')}}" autocomplete="off">
                                        @error('phone1')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="phone2"
                                        class="col-sm-3 text-end control-label col-form-label">Phone 2(optional)</label>
                                    <div class="col-sm-6">
                                        <input type="number"  name="phone2" id="phone2" onkeyup='saveValue(this);' class="form-control @error('phone2') is-invalid @enderror" value="{{old('phone2')}}" autocomplete="off">
                                        @error('phone2')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="fax"
                                        class="col-sm-3 text-end control-label col-form-label">Fax <span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number"  name="fax" id="fax" onkeyup='saveValue(this);' class="form-control @error('fax') is-invalid @enderror" value="{{old('fax')}}" autocomplete="off">
                                        @error('fax')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <input type="submit" class="btn btn-primary submit" value="Confirm" style="float: right;">
                                </div>
                            </div>
                        </form>
        
                        </div>
                    </div>
        
                </div>

                
            </div>
        </div>
      </section>
      </section>
  </div>
  </div>
</section>


<script type="text/javascript">
    document.getElementById("company_name_en").value = getSavedValue("company_name_en");    // set the value to this input
    document.getElementById("company_name_jp").value = getSavedValue("company_name_jp");    // set the value to this input
    document.getElementById("name_en").value = getSavedValue("name_en");   // set the value to this input
    document.getElementById("name_jp").value = getSavedValue("name_jp");   // set the value to this input
    document.getElementById("person_incharge_en").value = getSavedValue("person_incharge_en"); 
    document.getElementById("person_incharge_jp").value = getSavedValue("person_incharge_jp");
    document.getElementById("address").value = getSavedValue("address"); 
    document.getElementById("postcode").value = getSavedValue("postcode"); 
    document.getElementById("country").value = getSavedValue("country"); 
    document.getElementById("email1").value = getSavedValue("email1"); 
    document.getElementById("email2").value = getSavedValue("email2"); 
    document.getElementById("phone1").value = getSavedValue("phone1"); 
    document.getElementById("phone2").value = getSavedValue("phone2"); 
    document.getElementById("fax").value = getSavedValue("fax"); 
     

    //Save the value function - save it to localStorage as (ID, VALUE)
    function saveValue(e){
        var id = e.id;  // get the sender's id to save it . 
        var val = e.value; // get the value. 
        localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
    }

    //get the saved value function - return the value of "v" from localStorage. 
    function getSavedValue  (v){
        if (!localStorage.getItem(v)) {
            return "";// You can change this to your defualt value. 
        }
        return localStorage.getItem(v);
    }
</script>

<script>
    function cleardata()
    { 
        document.getElementById("company_name_en").value = "";   
        document.getElementById("company_name_jp").value = ""; 
        document.getElementById("name_en").value = "";   
        document.getElementById("name_jp").value = ""; 
        document.getElementById("person_incharge_en").value = "";  
        document.getElementById("person_incharge_jp").value = ""; 
        document.getElementById("address").value = ""; 
        document.getElementById("postcode").value = "";  
        document.getElementById("country").value = "";  
        document.getElementById("email1").value = ""; 
        document.getElementById("email2").value = ""; 
        document.getElementById("phone1").value = ""; 
        document.getElementById("phone2").value = "";  
        document.getElementById("fax").value = "";  
        
        localStorage.cleardata;
        localStorage.setItem("company_name_en", "");
        localStorage.setItem("company_name_jp", "");
        localStorage.setItem("name_en", "");
        localStorage.setItem("name_jp", "");
        localStorage.setItem("person_incharge_en", "");
        localStorage.setItem("person_incharge_jp", "");
        localStorage.setItem("address", "");
        localStorage.setItem("postcode", "");
        localStorage.setItem("country", "");
        localStorage.setItem("email1", "");
        localStorage.setItem("email2", "");
        localStorage.setItem("phone1", "");
        localStorage.setItem("phone2", "");
        localStorage.setItem("fax", "");
        
    }
</script>



  @endsection