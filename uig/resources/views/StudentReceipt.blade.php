<html>
   <head>
      <title>Fees Payment Receipt</title>
      <style>
         .print_section td
		 {
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
         .print_section .head h4
		 {
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
                     <td colspan="3" style="height:30px;">
                        <h2>REAL BUILDERS</h2>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="3" style="height:30px;"><b>Fees Payment Receipt</b></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        Student Detail:<br/>	
                        <b>{{$Receipt->Name}}</b><br/>
						{{$Receipt->PackageName}}<br>
                        From Date: {{date("d/m/Y",strtotime($Receipt->StartDate))}}<br/>
						To Date: {{date("d/m/Y",strtotime($Receipt->ExpiryDate))}}<br/>
                        {{$Receipt->Address}}<br/>
                        {{$Receipt->MobileNo}}
                     </td>
                     <td>
						Date Of Payment: {{date("d/m/Y",strtotime($Receipt->PaymentDate))}}<br>
                        Date Of Print: {{date("d/m/Y")}}<br/>			
                     </td>
                  </tr>
                  <tr>
                     <td style="height:30px;"><b>Serial No</b></td>
                     <td style="height:30px;"><b>Description</b></td>
                     <td style="height:30px;"><b>Amount</b></td>
                  </tr>
                  <tr>
                     <td>1</td>
                     <td>Program Fees</td>
                     <td>{{$Receipt->ProgramFees}}</td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>Personal Trainer</td>
                     <td>{{$Receipt->PersonalTrainer}}</td>
                  </tr>
                  <tr style="font-weight: bold">
                     <td colspan="2">Paid Amount:</td>
                     <td>{{$Receipt->PaidAmount}}</td>
                  </tr>
				  <tr>
					<td colspan="3">
						Phone No: 9706052773 / 9706171072
					</td>
				  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>