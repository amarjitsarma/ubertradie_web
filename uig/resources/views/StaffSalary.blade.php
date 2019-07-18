<html>
   <head>
      <title>Salary Slip</title>
      <style>
         .print_section td{
         text-align: center;
         border: 1px solid #000;
         margin:7px 2px 5px 24px;
         font-size: 13px;
         height:auto;
         vertical-align: middle;
         border-collapse: collapse;
         font-family: arial, sans-serif;
         text-transform: uppercase;
         }
         .print_section .head h4{
         font-size: 15px;
         }
      </style>
   </head>
   <body>
      <div class="print_section">
         <div class="container">
            <table width="450px" style="border-collapse:collapse;">
               <tbody>
                  <tr>
                     <td colspan="4" style="height:30px;">
                        <h2>REAL BUILDERS</h2>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="4" style="height:30px;"><b>Salary Slip</b></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        Staff Detail:<br/>	
                        <b>{{$Staff[0]->Name}}</b><br/>
                        {{$Staff[0]->Designation}}<br/>
                        {{$Staff[0]->Address}}<br/>
                        {{$Staff[0]->MobileNo}}<br/>
						Work Days per Month: {{$Staff[0]->WorkDays}}
                     </td>
                     <td colspan="2">
                        Date Of Print: {{date("d/m/Y")}}<br/>			
                        Salary of : @if($Salary[0]->Month==1)
                        January
                        @elseif($Salary[0]->Month==2)
                        February
                        @elseif($Salary[0]->Month==3)
                        March
                        @elseif($Salary[0]->Month==4)
                        April
                        @elseif($Salary[0]->Month==5)
                        May
                        @elseif($Salary[0]->Month==6)
                        June
                        @elseif($Salary[0]->Month==7)
                        July
                        @elseif($Salary[0]->Month==8)
                        August
                        @elseif($Salary[0]->Month==9)
                        September
                        @elseif($Salary[0]->Month==10)
                        October
                        @elseif($Salary[0]->Month==11)
                        November
                        @elseif($Salary[0]->Month==12)
                        December
                        @endif
                        , {{$Salary[0]->Year}}
                     </td>
                  </tr>
                  <tr>
                     <td style="height:30px;"><b>Serial No</b></td>
                     <td style="height:30px;"><b>Description</b></td>
                     <td style="height:30px;"><b>Amount</b></td>
                     <td style="height:30px;"><b>Type</b></td>
                  </tr>
                  <tr>
                     <td>1</td>
                     <td>Monthly Salary</td>
                     <td>{{$Staff[0]->Salary}}</td>
                     <td>Add</td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>Absent Penalty</td>
                     <td>{{$Salary[0]->AbsentPenalty}}</td>
                     <td>Deduct</td>
                  </tr>
                  <tr>
                     <td colspan="2">Total:</td>
                     <td>{{$Salary[0]->TotalSalary}}</td>
                     <td>--</td>
                  </tr>
                  <tr>
                     <td colspan="4">Present Days:</td>
                  </tr>
                  <tr>
                     <td colspan="4">
                        @foreach($Attendances as $Attendance)
                        {{date("d/m/Y",strtotime($Attendance->EntryDate))}}, 
                        @endforeach
                     </td>
                  </tr>
                  <tr>
                     <td colspan="4">Leave Applications:</td>
                  </tr>
                  <tr>
                     <td colspan="4">
                        @foreach($Leaves as $Leave)
                        {{date("d/m/Y",strtotime($Leave->LeaveDate))}}, 
                        @endforeach
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>