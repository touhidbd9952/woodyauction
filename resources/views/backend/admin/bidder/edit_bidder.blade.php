@extends('layouts.admin_master')

@section('content')
<style>
    .displayblock{display: block;}
    .displaynone{display: none;}
</style>

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Member Register</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Member Edit Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Member Edit Profile Form
                        <a href="{{route('bidder.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <form action="{{route('bidder.update_profile',[$bidder->id])}}"  method="POST" onsubmit="return validation();" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="oldemail1" value="{{$bidder->email1}}"> 
                        <input type="hidden" name="oldemail2" value="{{$bidder->email2}}">

                        <input type="hidden" name="oldphone1" value="{{$bidder->phone1}}"> 
                        <input type="hidden" name="oldphone2" value="{{$bidder->phone2}}">

                        <input type="hidden" name="oldfax" value="{{$bidder->fax}}">

                        <input type="hidden" name="usercodeno" value="{{$bidder->usercodeno}}">

                    <div class="card-body">
                        

                        <div class="form-group row">
                            <label for="company_name_en"
                                class="col-sm-3 text-end control-label col-form-label">Company Name</label>
                            <div class="col-sm-6">
                                <input type="text"  name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{$bidder->company_name}}">
                                @error('company_name')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_en"
                                class="col-sm-3 text-end control-label col-form-label">President name </label>
                            <div class="col-sm-6">
                                <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" value="{{$bidder->name}}">
                                @error('name')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="person_incharge_en"
                                class="col-sm-3 text-end control-label col-form-label">Person In charge</label>
                            <div class="col-sm-6">
                                <input type="text"  name="person_incharge" class="form-control @error('person_incharge') is-invalid @enderror" value="{{$bidder->person_incharge}}">
                                @error('person_incharge')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="address"
                                class="col-sm-3 text-end control-label col-form-label">Address</label>
                            <div class="col-sm-6">
                                <textarea  name="address" autocomplete="off" class="form-control @error('address') is-invalid @enderror"
                                    >{{$bidder->address}}</textarea>
                                @error('address')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code"
                                class="col-sm-3 text-end control-label col-form-label">Post code</label>
                            <div class="col-sm-6">
                                <input type="text"  name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{$bidder->zip_code}}">
                                @error('zip_code')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country"
                                class="col-sm-3 text-end control-label col-form-label">Country</label>
                            <div class="col-sm-6">
                                <input type="text"  name="country" class="form-control @error('country') is-invalid @enderror" value="{{$bidder->country}}">
                                @error('country')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email1"
                                class="col-sm-3 text-end control-label col-form-label">Email 1</label>
                            <div class="col-sm-6">
                                <input type="email"  name="email1" class="form-control @error('email1') is-invalid @enderror" value="{{$bidder->email1}}" placeholder="enter email for account">
                                @error('email1')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email2"
                                class="col-sm-3 text-end control-label col-form-label">Email 2(optional)</label>
                            <div class="col-sm-6">
                                <input type="email"  name="email2" class="form-control @error('email2') is-invalid @enderror" value="{{$bidder->email2}}">
                                @error('email2')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="phone1"
                                class="col-sm-3 text-end control-label col-form-label">Phone 1</label>
                            <div class="col-sm-6">
                                <input type="number"  name="phone1" class="form-control @error('phone1') is-invalid @enderror" value="{{$bidder->phone1}}">
                                @error('phone1')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone2"
                                class="col-sm-3 text-end control-label col-form-label">Phone 2(optional)</label>
                            <div class="col-sm-6">
                                <input type="number"  name="phone2" class="form-control @error('phone2') is-invalid @enderror" value="{{$bidder->phone2}}">
                                @error('phone2')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fax"
                                class="col-sm-3 text-end control-label col-form-label">Fax</label>
                            <div class="col-sm-6">
                                <input type="number"  name="fax" class="form-control @error('fax') is-invalid @enderror" value="{{$bidder->fax}}">
                                @error('fax')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="membership_with_other_auctioneers"
                                class="col-sm-3 text-end control-label col-form-label">Membership with other auctioneers</label>
                            <div class="col-sm-6">
                                <input type="text"  name="membership_with_other_auctioneers" class="form-control @error('membership_with_other_auctioneers') is-invalid @enderror" value="{{$bidder->membership_with_other_auctioneers}}">
                                @error('membership_with_other_auctioneers')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="membership_with_other_auctioneers"
                                class="col-sm-3 text-end control-label col-form-label">Antique License</label>
                            <div class="col-sm-6">
                                <input type="text"  name="antique_license" id="antique_license"  class="form-control @error('antique_license') is-invalid @enderror" value="{{$bidder->antique_license}}" autocomplete="off">
                                @error('antique_license')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="status"
                                class="col-sm-3 text-end control-label col-form-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{$bidder->status =='active'?'selected':''}}>Active</option>
                                    <option value="inactive" {{$bidder->status =='inactive'?'selected':''}}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permission"
                                class="col-sm-3 text-end control-label col-form-label">Permission</label>
                            <div class="col-sm-6">
                                <select name="permission" id="permission" onchange="checkpermission()" class="form-control @error('permission') is-invalid @enderror">
                                    <option value="approve" {{$bidder->permission =='approve'?'selected':''}}>Approve</option>
                                    <option value="inapprove" {{$bidder->permission =='inapprove'?'selected':''}}>Inapprove</option>
                                    <option value="black listed" {{$bidder->permission =='black listed'?'selected':''}}>Black listed</option>
                                </select>
                                @error('permission')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                                <input type="text" name="reasonofblacklist" id="reasonofblacklist" value="{{$bidder->reasonofblacklist}}" placeholder="Reason of blacklist" class="form-control @error('reasonofblacklist') is-invalid @enderror {{$bidder->permission == 'black listed'?'displayblock':'displaynone'}}"  >
                            </div>
                        </div>

                        
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function checkpermission()
    {  //alert('paisi');
        var permission = document.getElementById('permission').value;  //alert(permission);
        if(permission == 'black listed')
        {
            document.getElementById('reasonofblacklist').style.display="block";
        }
        else
        {
            document.getElementById('reasonofblacklist').style.display="none";
        }
    }
    function validation()
    {
        var permission = document.getElementById('permission').value;
        var reasonofblacklist = document.getElementById('reasonofblacklist').value;
        if(permission == 'black listed')
        {
            if(reasonofblacklist =="")
            {
                document.getElementById('reasonofblacklist').style.border="1px solid red";
                
                return false;
            }
        }
        return true;
    }
</script>

  
@endsection


