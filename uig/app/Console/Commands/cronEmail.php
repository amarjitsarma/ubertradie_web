<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Sentinel;
use DB;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email at 12:40 pm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date2=Date('Y-m-d', strtotime("-3 days"));
        $date1=Date('Y-m-d', strtotime("+5 days"));
        
        // dd($date1);
        $Expiries=[];

        $Expiries=DB::table("students")->leftjoin("packages","students.Program","=","packages.ID")->leftjoin("staffs", "students.PersonalTrainer","staffs.ID")->select("students.IDNo","students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.MobileNo",  "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "staffs.Name as PersonalTrainer", "students.ProgramFees", "students.PersonalTrainerFees", "packages.PackageName")->where("students.ExpiryDate", '=', $date1)->orWhere("students.ExpiryDate", '=', $date2)->get();
        //dd($Expiries);
        
        
        
        foreach($Expiries as $row)
        {
            //dd('yes');
            $api_key = '55B5589549F921';
            $contacts = $row->MobileNo.",8011587718";
            $from = 'UNIRGM';
            $sms_text="";
            $email_text1 = 'List of students whose package will expire on '. $date1;
            $email_text2 = 'List of students whose package is expired on '. $date2;
            $i = 1;
            if($row->ExpiryDate >= date("Y-m-d"))
            {
                $sms_text = urlencode("Dear ".$row->Name." your package will expire on ".date('d M, Y',strtotime($row->ExpiryDate)).". Contact your us for renewal of your package");
                $email_text1 .= ' '.$i.'. '.$row->Name;
            }else{
                $sms_text = urlencode("Dear ".$row->Name." your package is expired on ".date('d M, Y',strtotime($row->ExpiryDate)).". Contact your us for renewal of your package");
                $email_text2 .= ' '.$i.'. '.$row->Name;
            }
            $api_url = "http://sms.24techsoft.com/app/smsapi/index.php?key=".$api_key."&campaign=0&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
            $response = file_get_contents( $api_url);
            // "http://book.24techsoft.com/api/sendmsg.php?user=uig123&pass=123456&sender=UNIRGM&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
            
            Mail::raw($email_text1, function ($message) {
               $message->to('konwars.stu@gmail.com');
            });
            
            Mail::raw($email_text2, function ($message) {
               $message->to('konwars.stu@gmail.com');
            });
        }
    }
}
