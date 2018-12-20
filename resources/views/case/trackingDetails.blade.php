<?php use App\Http\Controllers\HomeController;?>
@extends('theme.default')
@section('content')
@foreach($casedetails as $casealllists)


<!-- /.row -->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Migrant Worker Previous Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            <td><b>Tracking No:</b> 
              @if($casealllists->applicantTrackingNo != "NULL")
                {{ $casealllists->applicantTrackingNo }}
              @endif</td>
            <td><b>Case filed date:</b> {{ date("d F Y", strtotime($casealllists->created_at)) }}</td>
          </tr>
          <tr>
            <td colspan="2"><b>Name :</b> 
              @if($casealllists->sufferer_name != "NULL")
                {{ $casealllists->sufferer_name }}
              @endif</td>
              
          </tr>
          
          <tr>
            <td><b>Mobile No:</b> 
              @if($casealllists->sufferer_mobile != "NULL")
                {{ $casealllists->sufferer_mobile }}
              @endif</td>
            <td><b>Local Mobile No:</b> 
              @if($casealllists->sufferer_local_no != "NULL")
                {{ $casealllists->sufferer_local_no }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Nationality :</b> 
              @if($casealllists->sufferer_nationality != "NULL")
                {{ $casealllists->sufferer_nationality }}
              @endif</td>
            <td><b>Passport No:</b> 
              @if($casealllists->sufferer_passport_no != "NULL")
                {{ $casealllists->sufferer_passport_no }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Country Name :</b> 
              @if($casealllists->sufferer_current_country != "NULL")
                {{ $casealllists->sufferer_current_country }}
              @endif</td>
            <td><b>Gender :</b> 
              @if($casealllists->gender != "NULL")
                {{ $casealllists->gender }}
              @endif</td>
          </tr>
          <tr>
            <td><b>District :</b> 
              @if($casealllists->sufferer_district != "NULL")
                {{ $casealllists->sufferer_district }}
              @endif</td>
            <td><b>Upazilla :</b> 
              @if($casealllists->sufferer_upazilla != "NULL")
                {{ $casealllists->sufferer_upazilla }}
              @endif</td>
          </tr>
          <tr>
            <td><b>Current Address :</b> 
              @if($casealllists->sufferer_current_address != "NULL")
                {{ $casealllists->sufferer_current_address }}
              @endif</td>
            <td><b>Local Address :</b> 
              @if($casealllists->sufferer_local_address != "NULL")
                {{ $casealllists->sufferer_local_address }}
              @endif</td>
          </tr>
        </table>
        
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">Case Information</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tr>
            @if($casealllists->application_for != "NULL")
            <td><b>Complaint is given by:</b> 
              

                 @if($casealllists->application_for != "NULL")

                  @if($casealllists->application_for == "own")
                    A person lives in abroad
                  @endif
                  @if($casealllists->application_for == "own_other")
                    A person who visit to abroad
                  @endif
                  @if($casealllists->application_for == "other")
                    On behalf of a sufferer
                  @endif

              @endif
              </td>


            @endif
              <td><b>Relation with :</b> 
              
              </td>
          </tr>

          @if($casealllists->application_for == "other")
          
          <tr>
            @if($casealllists->applicant_name != "NULL")
            <td><b>Applicant Name :</b> 
              
                {{ $casealllists->applicant_name }}
              
            </td>
            @endif
            @if($casealllists->applicant_country != "NULL")
            <td><b>Applicant Country :</b> 
              
                {{ $casealllists->applicant_country }}
              
            </td>
            @endif
          </tr>
          <tr>
            @if($casealllists->applicant_email != "NULL")
            <td><b>Applicant Email :</b> 
              
                {{ $casealllists->applicant_email }}
              
            </td>
            @endif
            @if($casealllists->applicant_mobile_no != "NULL")
            <td><b>Applicant Mobile No :</b> 
              
                {{ $casealllists->applicant_mobile_no }}
              
            </td>
            @endif
          </tr>
          <tr>
            @if($casealllists->applicant_address != "NULL")
            <td colspan="2"><b>Applicant Address :</b> 
              
                {{ $casealllists->applicant_address }}
              
            </td>
            @endif
          </tr>

          @endif
          
          <tr>
            @if($casealllists->agency_name != "NULL")
            <td><b>Agency Name :</b> 
                
                  {{ $casealllists->agency_name }}
                
              </td>
            @endif
            @if($casealllists->agency_mobile_no != "NULL")
            <td><b>Agency Mobile No:</b> 
                
                  {{ $casealllists->agency_mobile_no }}
                
            </td>
            @endif

            @if($casealllists->broker_name != "NULL")
            <td><b>Agent Name :</b> 
                
                  {{ $casealllists->broker_name }}
                
              </td>
            @endif
            @if($casealllists->broker_mobile_no != "NULL")
            <td><b>Agent Mobile No:</b> 
                
                  {{ $casealllists->broker_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->company_name != "NULL")
            <td><b>Other Name :</b> 
                
                  {{ $casealllists->company_name }}
                
              </td>
            @endif
            @if($casealllists->company_mobile_no != "NULL")
            <td><b>Other Mobile No:</b> 
                
                  {{ $casealllists->company_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->person_name != "NULL")
            <td><b>Person Name :</b> 
                
                  {{ $casealllists->person_name }}
                
              </td>
            @endif
            @if($casealllists->person_mobile_no != "NULL")
            <td><b>Person Mobile No:</b> 
                
                  {{ $casealllists->person_mobile_no }}
                
            </td>
            @endif


            @if($casealllists->recruitment_officer_name != "NULL")
            <td><b>Officer Name :</b> 
                
                  {{ $casealllists->recruitment_officer_name }}
                
              </td>
            @endif
            @if($casealllists->recruitment_officer_mobile_no != "NULL")
            <td><b>Officer Mobile No:</b> 
                
                  {{ $casealllists->recruitment_officer_mobile_no }}
                
            </td>
            @endif
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

@endforeach

  @if(isset($case_tracking))

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-success">
          <div class="panel-heading">Case Tracking</div>
          <div class="panel-body">
            <table class="table">
              @foreach($case_tracking as $case_trackings) 
                <tr>
                    <td>{{ $case_trackings->user_id }}</td>
                    <td>{{ $case_trackings->user_id }}</td>
                    <td><a href="{{ $case_trackings->application_id }}">Details</a></td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    
  @endif

  


@endsection