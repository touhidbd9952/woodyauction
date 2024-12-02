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
                <div id="main_contents" style="width: 95%;">
                    
                    <div class="card">
                        <div class="card-body">
                            
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                            @endif
        
        
                            <form action="{{route('member.request_store')}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">
        
                                @csrf
        
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                <h4 class="headerstyle">Search Site Member</h4>
                                <p>
                                    <span style="color: #04772b;font-size:16px;">
                                    Woody Auction member can access woody auction search site by their userid/username and password. so one account is enough to 
                                    access Woody Auction as well as Woody Auction Result Search Site. 
                                    </span>
                                    <br><br>
                                    If you are not a member of woody auction, you can not access Woody Auction Result Search Site. If you interested to become a member
                                    of woody auction as well as woody auction search site, fill-up below registration form, provide all the fields value as properly 
                                    as you can and then click on "Confirm" button. Please provide your email and address accurately.
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
                                    <label for="name_en"
                                        class="col-sm-3 text-end control-label col-form-label">Person Name<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="name" id="name" onkeyup='saveValue(this);' class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" autocomplete="off">
                                        @error('name')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company_name_en"
                                        class="col-sm-3 text-end control-label col-form-label">Company Name<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="company_name" id="company_name" onkeyup='saveValue(this);' class="form-control @error('company_name') is-invalid @enderror" value="{{old('company_name')}}" autocomplete="off">
                                        @error('company_name')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
        
                                <div class="form-group row">
                                    <label for="person_incharge_en"
                                        class="col-sm-3 text-end control-label col-form-label">Person In charge<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="person_incharge" id="person_incharge" onkeyup='saveValue(this);' class="form-control @error('person_incharge') is-invalid @enderror" value="{{old('person_incharge')}}" autocomplete="off">
                                        @error('person_incharge')
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
                                        class="col-sm-3 text-end control-label col-form-label">Fax<span class="red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number"  name="fax" id="fax" onkeyup='saveValue(this);' class="form-control @error('fax') is-invalid @enderror" value="{{old('fax')}}" autocomplete="off">
                                        @error('fax')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>

                                
        
                                <div class="form-group row">
                                    <label for="membership_with_other_auctioneers"
                                        class="col-sm-3 text-end control-label col-form-label">Membership with other auctioneers</label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="other_auction" id="other_auction" onkeyup='saveValue(this);' class="form-control @error('other_auction') is-invalid @enderror" value="{{old('other_auction')}}" autocomplete="off">
                                        @error('other_auction')
                                            <span class="text-danger"> {{$message}}  </span>
                                        @enderror
                                    </div>
                                </div>
        
                                
                                
                               
                            </div>
                            <div class="border-top row">
                                <div class="card-body col-sm-9">
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
    document.getElementById("company_name").value = getSavedValue("company_name");    // set the value to this input
    document.getElementById("name").value = getSavedValue("name");   // set the value to this input
    document.getElementById("person_incharge").value = getSavedValue("person_incharge"); 
    document.getElementById("address").value = getSavedValue("address"); 
    document.getElementById("postcode").value = getSavedValue("postcode"); 
    document.getElementById("country").value = getSavedValue("country"); 
    document.getElementById("email1").value = getSavedValue("email1"); 
    document.getElementById("email2").value = getSavedValue("email2"); 
    document.getElementById("phone1").value = getSavedValue("phone1"); 
    document.getElementById("phone2").value = getSavedValue("phone2"); 
    document.getElementById("fax").value = getSavedValue("fax"); 
    document.getElementById("other_auction").value = getSavedValue("other_auction"); 

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
        document.getElementById("company_name").value = "";    
        document.getElementById("name").value = "";    
        document.getElementById("person_incharge").value = "";  
        document.getElementById("address").value = ""; 
        document.getElementById("postcode").value = "";  
        document.getElementById("country").value = "";  
        document.getElementById("email1").value = ""; 
        document.getElementById("email2").value = ""; 
        document.getElementById("phone1").value = ""; 
        document.getElementById("phone2").value = "";  
        document.getElementById("fax").value = "";  
        document.getElementById("other_auction").value = ""; 
        localStorage.cleardata;
        localStorage.setItem("company_name", "");
        localStorage.setItem("name", "");
        localStorage.setItem("person_incharge", "");
        localStorage.setItem("address", "");
        localStorage.setItem("postcode", "");
        localStorage.setItem("country", "");
        localStorage.setItem("email1", "");
        localStorage.setItem("email2", "");
        localStorage.setItem("phone1", "");
        localStorage.setItem("phone2", "");
        localStorage.setItem("fax", "");
        localStorage.setItem("other_auction", "");
    }
</script>



  @endsection