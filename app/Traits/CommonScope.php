<?php
namespace App\Traits;

use App\Models\GuardianDetail;
use App\Models\Staff;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CommonScope{

    protected function profileImageSrc()
    {

        if(Auth::check() /*!request()->is('online*')*/){
            if(auth()->user()->hasRole('student')) {
                $id = auth()->user()->hook_id;
                $student = Student::select('student_image')->find($id);
                if($student->student_image){
                    $profileImageSrc = 'images/studentProfile/'.$student->student_image;
                }else{
                    $profileImageSrc = null;
                }

            }elseif(auth()->user()->hasRole('guardian')){
                $id = auth()->user()->hook_id;
                $guardian = GuardianDetail::select('guardian_image')->find($id);
                if($guardian->guardian_image){
                    $profileImageSrc = 'images/parents/'.$guardian->guardian_image;
                }else{
                    $profileImageSrc = null;
                }
            }elseif(auth()->user()->hasRole('staff')){
                $id = auth()->user()->hook_id;
                $staff = Staff::select('staff_image')->find($id);
                if($staff->staff_image){
                    $profileImageSrc = 'images/staff/'.$staff->staff_image;
                }else{
                    $profileImageSrc = null;
                }

            }else{
                $id = auth()->user()->id;
                $image = User::select('profile_image')->find($id);
                if($image->profile_image){
                    $profileImageSrc = 'images/user/'.$image->profile_image;
                }else{
                    $profileImageSrc = null;
                }

            }


        }else{
            $profileImageSrc = null;
        }

        return $profileImageSrc;


    }

    public function getGreeting()
    {
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date(env('APP_TIMEZONE'),"Asia/Katmandu");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greeting = "Good morning";
        } else
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $greeting = "Good afternoon";
            } else
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    $greeting = "Good evening";
                } else
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        $greeting = "Good night";
                    }


                    return $greeting ;

    }

    public function randomNum($prefix,$size) {
        /*$alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $prefix . $key. $alpha_key;*/

        /*$alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;*/

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $size; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $prefix . $key;
    }

    function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = '' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? '' . $list3[$levels] . '' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }

}