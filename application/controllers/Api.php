<?php
class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
    $this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('email');
		$this->load->model('Api_Model');
    $this->load->helper("api_helper");
		date_default_timezone_set("Asia/Kolkata");
	}

	public function signup()
	{
		    $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $email=$input_data['email'];
        $mobile=$input_data['phone_number'];
        $mobilecheck= $this->Api_Model->selectrow('user',array('phone'=>$mobile));
        if(!empty($mobilecheck))
        {
            $sdata=array('success'=>'false','message'=>'Mobile number all ready registerd');
            echo json_encode($sdata);
        }
        else
        {
            $emailcheck= $this->Api_Model->selectrow('user',array('email'=>$email));
        if(!empty($emailcheck))
        {
            $sdata=array('success'=>'false','message'=>'Email id all ready registerd');
            echo json_encode($sdata);
        }
        else
        {
          $lati=$input_data['latitude'];
          $long=$input_data['longitude'];
          $langlat='('.$long.','.$lati.')';
            $otp=$this->otpgenrate();

            $str = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
            $str = $mobile.$str;
            $shuffled = str_shuffle($str);
            $shuffled = substr($shuffled,1,75);
            $access_token = $shuffled;

             $data = array(
            'username'=>$input_data['first_name'],
            'surname'=>$input_data['last_name'],
            'email'=>$input_data['email'],
            'phone'=>$input_data['phone_number'],
            'countrycode'=>$input_data['countrycode'],
            'latitude'=>$input_data['latitude'],
            'longitude'=>$input_data['longitude'],
            'reg_id'=>$input_data['reg_id'],
            'password_show'=>$input_data['password'],
            'password'=>sha1($input_data['password']),
            'otp'=>$otp,
            'access_token'=>$access_token,
            'langlat'=>$langlat
             );
              $condelete = array(
          'email'=>$email
        );
      $delete=$this->Api_Model->delete('userdummy',$condelete);
      $condelete = array(
          'phone'=>$mobile
        );
      $delete=$this->Api_Model->delete('userdummy',$condelete);
            $insert = $this->Api_Model->insert('userdummy',$data);

            $this->otp($mobile,$otp);

            $sdata=array('success'=>'true','message'=>'Otp has been sent successfully','otp'=>$otp,'access_token'=>$access_token);
            echo json_encode($sdata); 
        }
		    }
        die;
	 }

  public function otp($mobile,$otp)
  {
        $authKey = "309952Aq8MczyMxu5e03001fP1";
$senderId = "ADSURL";
$messageMsg = urlencode("<#> V2care: Your code is $otp tVbZIwq0taG");
$postData = array(
  'authkey' => $authKey,
  'mobiles' => $mobile,
  'message' => $messageMsg,
  'sender' => $senderId,
  'route' => 4,
  'country' => 91
);
$url = "http://api.msg91.com/api/sendhttp.php";
$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $postData
));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$output = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'error:' . curl_error($ch);
}
curl_close($ch);
    }

  public function country_get()
  {
      $country= $this->Api_Model->select('country');
      if(!empty($country))
      {
        foreach ($country as $row)
        {
          $sdata['country'][]=array('id'=>$row->id,'country'=>$row->name,'code'=>$row->phonecode);
        }
              echo json_encode($sdata);
      }

      die;
  }

  public function otpgenrate()
  {
      $random_str = '0123456789';
      $shuffle_str = str_shuffle($random_str);
      return $otp = substr($shuffle_str, 0, 4);
  }

	public function signin()
	{		
		      $input_data = json_decode(trim(file_get_contents('php://input')), true);
          $password=$input_data['password'];
          $mobile=$input_data['email'];
          $data = array(
            'email'=>$mobile,
            'password'=>sha1($password)
          );
          $userdata= $this->Api_Model->selectrow('user',$data);
          if(!empty($userdata))
          {
              $sdata=array('success'=>'true','message'=>'Login successfully');
              $sdata['user']=array('user_id'=>$userdata->user_id,'first_name'=>$userdata->username,'last_name'=>$userdata->surname,'email'=>$userdata->email,'countrycode'=>$userdata->countrycode,'mobile'=>$userdata->phone,'access_token'=>$userdata->access_token,'latitude'=>$userdata->latitude,'longitude'=>$userdata->longitude,'type'=>$userdata->type);
                echo json_encode($sdata);
          }
          else
          {
             $data = array(
            'phone'=>$mobile,
             );
            $userdataphone= $this->Api_Model->selectrow('user',$data);

            if(!empty($userdataphone))
            {
                $otp=$this->otpgenrate();
        $this->otp($mobile,$otp);
        $update = $this->Api_Model->update('user',array('otp'=>$otp),array('phone'=>$mobile));
        $userdataphone= $this->Api_Model->selectrow('user',$data);
  $sdata=array('success'=>'true','message'=>'Otp has been sent successfully');
              $sdata['user']=array('user_id'=>$userdataphone->user_id,'access_token'=>$userdataphone->access_token,'otp'=>$userdataphone->otp);
              echo json_encode($sdata);
            }
            else
            {
              $sdata=array('success'=>'false','message'=>'username and password mishmatch');
            echo json_encode($sdata);
            }
          }
          die;
	}

  public function userdetails()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
          $access_token=$input_data['access_token'];
          $userdata= $this->Api_Model->selectrow('user',array('access_token'=>$access_token));
          if(!empty($userdata))
          {
              $sdata=array('success'=>'true','message'=>'Data get successfully');
              $sdata['user']=array('user_id'=>$userdata->user_id,'first_name'=>$userdata->username,'last_name'=>$userdata->surname,'email'=>$userdata->email,'countrycode'=>$userdata->countrycode,'mobile'=>$userdata->phone,'gender'=>$userdata->gender,'dob'=>$userdata->dob,'access_token'=>$userdata->access_token,'latitude'=>$userdata->latitude,'longitude'=>$userdata->longitude,'type'=>$userdata->type);
                echo json_encode($sdata); die;
          }
          else
          {
            $sdata=array('success'=>'true','message'=>'Access token not matched');
            echo json_encode($sdata);  die;
          }
  }

  public function add_address()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
           $data = array(
            'user_id'=>$input_data['user_id'],
            'address_type'=>$input_data['address_type'],
            'name'=>$input_data['name'],
            'street'=>$input_data['street'],
            'locality'=>$input_data['locality'],
            'address'=>$input_data['address'],
            'city'=>$input_data['city'],
            'state'=>$input_data['state'],
            'pincode'=>$input_data['pincode']
             );

            $insert = $this->Api_Model->insert('address',$data);

            if(!empty($insert))
            {
                $sdata=array('success'=>'true','message'=>'Address save successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Address not save successfully');
            }
            echo json_encode($sdata);  die;
  }

  public function get_address()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
          $user_id=$input_data['user_id'];
          $addressget= $this->Api_Model->select('address',array('user_id'=>$user_id));
          if(!empty($addressget))
          {
              $sdata=array('success'=>'true','message'=>'Address get successfully');
              foreach ($addressget as $userdata)
              {
              $sdata['user'][]=array('address_id'=>$userdata->address_id,'user_id'=>$userdata->user_id,'address_type'=>$userdata->address_type,'name'=>$userdata->name,'street'=>$userdata->street,'locality'=>$userdata->locality,'address'=>$userdata->address,'city'=>$userdata->city,'state'=>$userdata->state,'pincode'=>$userdata->pincode,'created_at'=>$userdata->created_at);
              }
                echo json_encode($sdata); die;
          }
          else
          {
            $sdata=array('success'=>'true','message'=>'Data not found');
            echo json_encode($sdata);  die;
          }
  }

  public function edit_address()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $address_id=$input_data['address_id'];
           $data = array(
            'address_type'=>$input_data['address_type'],
            'name'=>$input_data['name'],
            'street'=>$input_data['street'],
            'locality'=>$input_data['locality'],
            'address'=>$input_data['address'],
            'city'=>$input_data['city'],
            'state'=>$input_data['state'],
            'pincode'=>$input_data['pincode']
             );

            $update = $this->Api_Model->update('address',$data,array('address_id'=>$address_id));

            if(!empty($update))
            {
                $sdata=array('success'=>'true','message'=>'Update successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Update not successfully');
            }
            echo json_encode($sdata);  die;
  }

  public function search_product()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $title=$input_data['title'];
      $titledata= $this->Api_Model->selectrowlike(array('title'=>$title));
      if(!empty($titledata))
           {
              foreach($titledata as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdataa[]=array('product_id'=>$row->product_id,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
              $sdata = array('success' => "true", "message" => "Success", 'data' => $sdataa);
           }
           else
           {
              $sdata = array('success' => "false", "message" => "Success", 'data' => array());
           }
echo json_encode($sdata);  die;
  }

  public function search_by_suggestion()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $title=$input_data['title'];
      $titledata= $this->Api_Model->selectrowlikesuggestion($title);
      if(!empty($titledata))
           {
              foreach($titledata as $row){
                    
                $sdataa[]=array('name'=>$row->title);
              }
              $sdata = array('success' => "true", "message" => "Success", 'data' => $sdataa);
           }
           else
           {
              $sdata = array('success' =>"false", "message" => "Success", 'data' => array());
           }
    echo json_encode($sdata);  die;
  }

  public function delete_address()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $address_id=$input_data['address_id'];
      $con = array(
          'address_id'=>$address_id
        );
      $delete=$this->Api_Model->delete('address',$con);
      if(!empty($delete))
            {
                $sdata=array('success'=>'true','message'=>'Delete successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Delete not successfully');
            }
            echo json_encode($sdata);  die;
  }

  public function banner()
  {
      $banners= $this->Api_Model->select('banner',array('place'=>'after_slider','status'=>'ok'));
      if(!empty($banners))
      {
        foreach($banners as $row)
        {
          $img= $this->crud_model->file_view('banner',$row->banner_id,'','','no','src','','',$row->image_ext);   
                $sdata[]=array('banner'=>$img);
        }
      $sdata = array('success' => "true", "message" => "Success", 'data' => $sdata);
           }
           else
           {
              $sdata = array('success' =>"false", "message" => "Success", 'data' => array());
           }
    echo json_encode($sdata);  die;
  }

  public function sociallogin()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $type=$input_data['type'];
      $email=$input_data['email'];

      if($type=='google')
      {
          $emailcheck= $this->Api_Model->selectrow('user',array('email'=>$email,'type'=>'google'));
          if(!empty($emailcheck))
          {
              $sdata=array('success'=>'true','message'=>'Login successfully');
              $sdata['user']=array('user_id'=>$emailcheck->user_id,'first_name'=>$emailcheck->username,'last_name'=>$emailcheck->surname,'email'=>$emailcheck->email,'countrycode'=>$emailcheck->countrycode,'mobile'=>$emailcheck->phone,'access_token'=>$emailcheck->access_token,'latitude'=>$emailcheck->latitude,'longitude'=>$emailcheck->longitude,'type'=>$emailcheck->type,'socialid'=>$emailcheck->socialid);
              echo json_encode($sdata);
          }
          else
          {
            $emailnormal= $this->Api_Model->selectrow('user',array('email'=>$email));
            if(empty($emailnormal))
            {
            $str = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
            $str = $mobile.$str;
            $shuffled = str_shuffle($str);
            $shuffled = substr($shuffled,1,75);
            $access_token = $shuffled;
            $lati=$input_data['latitude'];
            $long=$input_data['longitude'];
            $langlat='('.$long.','.$lati.')';

              $data = array(
            'username'=>$input_data['fullname'],
            'email'=>$input_data['email'],
            'latitude'=>$input_data['latitude'],
            'longitude'=>$input_data['longitude'],
            'access_token'=>$access_token,
            'langlat'=>$langlat,
            'type'=>$type,
            'socialid'=>$input_data['socialid']
            );

            $social = $this->Api_Model->insert('user',$data);
          }
            $emailcheck= $this->Api_Model->selectrow('user',array('email'=>$email));
            $sdata=array('success'=>'true','message'=>'Login successfully');
              $sdata['user']=array('user_id'=>$emailcheck->user_id,'first_name'=>$emailcheck->username,'last_name'=>$emailcheck->surname,'email'=>$emailcheck->email,'countrycode'=>$emailcheck->countrycode,'mobile'=>$emailcheck->phone,'access_token'=>$emailcheck->access_token,'latitude'=>$emailcheck->latitude,'longitude'=>$emailcheck->longitude,'type'=>$emailcheck->type,'socialid'=>$emailcheck->socialid);
              echo json_encode($sdata);
          }
      }
      elseif($type=='facebook')
      {
          $emailcheck= $this->Api_Model->selectrow('user',array('email'=>$email,'type'=>'facebook'));
          if(!empty($emailcheck))
          {
              $sdata=array('success'=>'true','message'=>'Login successfully');
              $sdata['user']=array('user_id'=>$emailcheck->user_id,'first_name'=>$emailcheck->username,'last_name'=>$emailcheck->surname,'email'=>$emailcheck->email,'countrycode'=>$emailcheck->countrycode,'mobile'=>$emailcheck->phone,'access_token'=>$emailcheck->access_token,'latitude'=>$emailcheck->latitude,'longitude'=>$emailcheck->longitude,'type'=>$emailcheck->type,'socialid'=>$emailcheck->socialid);
              echo json_encode($sdata);
          }
          else
          {
             $emailnormal= $this->Api_Model->selectrow('user',array('email'=>$email));
            if(empty($emailnormal))
            {
            $str = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';
            $str = $mobile.$str;
            $shuffled = str_shuffle($str);
            $shuffled = substr($shuffled,1,75);
            $access_token = $shuffled;
            $lati=$input_data['latitude'];
            $long=$input_data['longitude'];
            $langlat='('.$long.','.$lati.')';

              $data = array(
            'username'=>$input_data['fullname'],
            'email'=>$input_data['email'],
            'latitude'=>$input_data['latitude'],
            'longitude'=>$input_data['longitude'],
            'access_token'=>$access_token,
            'langlat'=>$langlat,
            'type'=>$type,
            'socialid'=>$input_data['socialid']
            );
            $social = $this->Api_Model->insert('user',$data);
          }
            $emailcheck= $this->Api_Model->selectrow('user',array('email'=>$email));
            $sdata=array('success'=>'true','message'=>'Login successfully');
              $sdata['user']=array('user_id'=>$emailcheck->user_id,'first_name'=>$emailcheck->username,'last_name'=>$emailcheck->surname,'email'=>$emailcheck->email,'countrycode'=>$emailcheck->countrycode,'mobile'=>$emailcheck->phone,'access_token'=>$emailcheck->access_token,'latitude'=>$emailcheck->latitude,'longitude'=>$emailcheck->longitude,'type'=>$emailcheck->type,'socialid'=>$emailcheck->socialid);
              echo json_encode($sdata);
          }
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'username and password mishmatch');
            echo json_encode($sdata);
      }
      die;
  }

	public function mobilelogin()
	{
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
			
						$mobile=$input_data['phone_number'];
						$otp=$input_data['otp'];
						$data = array(
            'phone'=>$mobile,
            'otp'=>$otp
          );
          $userdata= $this->Api_Model->selectrow('user',$data);
         
          if(!empty($userdata))
          {

          		$sdata=array('success'=>'true','message'=>'Login successfully');
          		$sdata['user']=array('user_id'=>$userdata->user_id,'first_name'=>$userdata->username,'last_name'=>$userdata->surname,'email'=>$userdata->email,'countrycode'=>$userdata->countrycode,'mobile'=>$userdata->phone,'access_token'=>$userdata->access_token,'latitude'=>$userdata->latitude,'longitude'=>$userdata->longitude,'type'=>$userdata->type);

          //$sdata=array('error'=>'false','status'=>1,'message'=>'Login successfully','data'=>$dbdata);
      	  echo json_encode($sdata);
      	  }
      	  else
      	  {
          	$sdata=array('success'=>'false','message'=>'username and password mishmatch');
      	  	echo json_encode($sdata);
      	  }
          die;
}
	public function signupverification()
	{
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$otp=$input_data['otp'];
		$phone_number=$input_data['phone_number'];

		$data = array(
            'phone'=>$phone_number,
            'otp'=>$otp
          );
          $userdatad= $this->Api_Model->selectrow('userdummy',$data);
          if(!empty($userdatad))
          {
          		$dataa = array(
            'username'=>$userdatad->username,
            'surname'=>$userdatad->surname,
            'email'=>$userdatad->email,
            'phone'=>$userdatad->phone,
            'password'=>$userdatad->password,
            'password_show'=>$userdatad->password_show,
            'access_token'=>$userdatad->access_token,
            'countrycode'=>$userdatad->countrycode,
            'latitude'=>$userdatad->latitude,
            'longitude'=>$userdatad->longitude,
            'langlat'=>$userdatad->langlat,
            'reg_id'=>$userdatad->reg_id
          );
          $insert = $this->Api_Model->insert('user',$dataa);
          $update = $this->Api_Model->update('userdummy',array('otp'=>0),array('phone'=>$phone_number));
          $datar = array(
            'phone'=>$userdatad->phone,
            'access_token'=>$userdatad->access_token
          );
          		$userdata= $this->Api_Model->selectrow('user',$datar);
          		$sdata=array('success'=>'true','message'=>'Verified successfully');
          		$sdata['user']=array('user_id'=>$userdata->user_id,'first_name'=>$userdata->username,'last_name'=>$userdata->surname,'email'=>$userdata->email,'countrycode'=>$userdata->countrycode,'mobile'=>$userdata->phone,'access_token'=>$userdata->access_token,'latitude'=>$userdata->latitude,'longitude'=>$userdata->longitude);

          echo json_encode($sdata);

          }
          else
          {
          	  $sdata=array('success'=>'false','message'=>'Invalid OTP');
      	  	echo json_encode($sdata);
          }
die;
	}

	public function forgotpassword()
	{
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$mobile=$input_data['phone_number'];
		$data = array(
            'phone'=>$mobile
          );
          $forgot= $this->Api_Model->selectrow('user',$data);
          if(!empty($forgot))
          {
          	  $otp=$this->otpgenrate();
			$this->otp($mobile,$otp);
      $update = $this->Api_Model->update('user',array('otp'=>$otp),array('phone'=>$mobile));

$userdata= $this->Api_Model->selectrow('user',$data);

          		$sdata=array('success'=>'true','message'=>'Otp has been sent successfully');
          		$sdata['user']=array('access_token'=>$userdata->access_token,'otp'=>$userdata->otp);

          echo json_encode($sdata);

          }
          else
          {
          	  $sdata=array('success'=>'false','status'=>0,'message'=>'Number not registerd');
      	  	echo json_encode($sdata);
          }
          die;
	}

	public function changepassword()
	{
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		
				$phone_number=$input_data['phone_number'];
        $otp=$input_data['otp'];
		$data = array(
            'phone'=>$phone_number,
            'otp'=>$otp
          );
		$passwordd=$input_data['password'];
		$password=sha1($passwordd);
          $userdata= $this->Api_Model->selectrow('user',$data);
          if(!empty($userdata))
          {
          		$update = $this->Api_Model->update('user',array('password'=>$password,'password_show'=>$passwordd),array('phone'=>$phone_number));
          		$userdata= $this->Api_Model->selectrow('user',$data);
          		$sdata=array('success'=>'true','message'=>'Password change successfully');
          		$sdata['user']=array('access_token'=>$userdata->access_token);

          echo json_encode($sdata);

          }
          else
          {
          	  $sdata=array('success'=>'false','message'=>'Invalid OTP');
      	  	echo json_encode($sdata);
          }
          die;
	}

  public function change_passwordapi()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $user_id=$input_data['user_id'];
      $old_password=$input_data['old_password'];
      $new_password=$input_data['new_password'];
      $old_password=sha1($old_password);
      $new_passwordd=sha1($new_password);
      $data = array(
            'user_id'=>$user_id,
            'password'=>$old_password
          );
          $userdata= $this->Api_Model->selectrow('user',$data);
          if(!empty($userdata))
          {
              $update = $this->Api_Model->update('user',array('password'=>$new_passwordd,'password_show'=>$new_password),array('user_id'=>$user_id));
              
              $sdata=array('success'=>'true','message'=>'Password change successfully');
          }
          else
          {
              $sdata=array('success'=>'false','message'=>'Old passwordd not mctched');
            
          }
          echo json_encode($sdata);
          die;
  }

	public function loginresendotp()
	{
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$mobile=$input_data['phone_number'];
		$data = array(
            'phone'=>$mobile
          );
          $forgot= $this->Api_Model->selectrow('user',$data);
          if(!empty($forgot))
          {
          	  $otp=$this->otpgenrate();
			        $this->otp($mobile,$otp);
              $update = $this->Api_Model->update('user',array('otp'=>$otp),array('phone'=>$mobile));

              $userdata= $this->Api_Model->selectrow('user',$data);
          		$sdata=array('success'=>'true','message'=>'Otp has been sent successfully');
          		$sdata['user']=array('access_token'=>$userdata->access_token,'otp'=>$userdata->otp);

              echo json_encode($sdata);

          }
          else
          {
          	  $sdata=array('false'=>'false','message'=>'Number not registerd');
      	  	echo json_encode($sdata);
          }
          die;
	}

	public function signupresendotp()
	{
		      $input_data = json_decode(trim(file_get_contents('php://input')), true);
		      $mobile=$input_data['phone_number'];
		      $data = array(
            'phone'=>$mobile
          );
          $forgot= $this->Api_Model->selectrow('userdummy',$data);
          if(!empty($forgot))
          {
          	  $otp=$this->otpgenrate();
			        $this->otp($mobile,$otp);
              $update = $this->Api_Model->update('userdummy',array('otp'=>$otp),array('phone'=>$mobile));

              $userdata= $this->Api_Model->selectrow('userdummy',$data);
          		$sdata=array('success'=>'true','message'=>'Otp has been sent successfully');
          		$sdata['user']=array('access_token'=>$userdata->access_token,'otp'=>$userdata->otp);

          echo json_encode($sdata);

          }
          else
          {
          	  $sdata=array('success'=>'false','message'=>'Number not registerd');
      	  	echo json_encode($sdata);
          }
          die;
	}

  public function edit_profile()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $first_name=$input_data['first_name'];
      $email=$input_data['email'];
      $mobile=$input_data['phone_number'];
      $gender=$input_data['gender'];
      $dob=$input_data['dob'];
      $access_token=$input_data['access_token'];

      $data = array(
          'phone'=>$mobile,
          'access_token'=>$access_token
        );
      $getuser= $this->Api_Model->selectrow('user',$data);
      if(!empty($getuser))
      {
          $updatedata = array(
          'username'=>$first_name,
          'phone'=>$mobile,
          'dob'=>$dob,
          'gender'=>$gender
        );
          $update = $this->Api_Model->update('user',$updatedata,array('access_token'=>$access_token));
          $sdata=array('success'=>'true','message'=>'Profile update successfully');
              echo json_encode($sdata);
      }
      else
      {
          $checkmobile= $this->Api_Model->selectrow('user',array('phone'=>$mobile));
          if(empty($checkmobile))
          {
            $otp=$this->otpgenrate();
          $this->otp($mobile,$otp);
              $updatedata = array(
          'username'=>$first_name,
          'dob'=>$dob,
          'gender'=>$gender,
          'otp'=>$otp
        );
          $update = $this->Api_Model->update('user',$updatedata,array('access_token'=>$access_token));

              $sdata=array('success'=>'true','message'=>'Otp has been sent successfully');
              $sdata['user']=array('access_token'=>$access_token,'otp'=>$otp);
              echo json_encode($sdata);
         }
         else
         {
            $sdata=array('success'=>'false','message'=>'all ready mobile number registerd.');
            echo json_encode($sdata);
         }
      }
      die;
  }
public function best_seller()
  {
    $start = $this->uri->segment(3);

        if (!isset($start)) {
            $start = 0;
        }
    $box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 60))->row()->value;
          $limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 61))->row()->value;
                    $todays_deal=$this->crud_model->product_list_set('deal',$start);
                    foreach($todays_deal as $row){
                    $img=$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one');
                $sdata[]=array('product_id'=>$row['product_id'],'category_id'=>$row['category'],'name'=>$row['title'],'purchase_price'=>$row['purchase_price'],'sale_price'=>$row['sale_price'],'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'product data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function trending()
  {
    $start = $this->uri->segment(3);

        if (!isset($start)) {
            $start = 0;
        }
    $box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 42))->row()->value;
        $limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 41))->row()->value;
        $product_bundle=$this->crud_model->product_list_set('bundle',$start);
        foreach($product_bundle as $row){
        $img=$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one');
        $sdata[]=array('product_id'=>$row['product_id'],'category_id'=>$row['category'],'name'=>$row['title'],'purchase_price'=>$row['purchase_price'],'sale_price'=>$row['sale_price'],'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'product data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function mobile()
  {
    $start = $this->uri->segment(3);

        if (!isset($start)) {
            $start = 0;
        }
    $box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
          $limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$start);
                    foreach($featured as $row){
                    $img=$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one');
                $sdata[]=array('product_id'=>$row['product_id'],'category_id'=>$row['category'],'name'=>$row['title'],'purchase_price'=>$row['purchase_price'],'sale_price'=>$row['sale_price'],'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'product data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function computer()
  {
    $start = $this->uri->segment(3);

        if (!isset($start)) {
            $start = 0;
        }
    $latest=$this->crud_model->product_list_set('latest',$start);
                                    foreach($latest as $row){
                 $img=$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one');   
                $sdata[]=array('product_id'=>$row['product_id'],'category_id'=>$row['category'],'name'=>$row['title'],'purchase_price'=>$row['purchase_price'],'sale_price'=>$row['sale_price'],'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'product data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function electronics()
  {
    $start = $this->uri->segment(3);

        if (!isset($start)) {
            $start = 0;
        }
    $recently_viewed=$this->crud_model->product_list_set('recently_viewed',$start);
                    foreach($recently_viewed as $row){
                $img=$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one');    
                $sdata[]=array('product_id'=>$row['product_id'],'category_id'=>$row['category'],'name'=>$row['title'],'purchase_price'=>$row['purchase_price'],'sale_price'=>$row['sale_price'],'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'product data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function update_verification()
  {
    $input_data = json_decode(trim(file_get_contents('php://input')), true);
    $otp=$input_data['otp'];
    $phone_number=$input_data['phone_number'];
    $access_token=$input_data['access_token'];

    $data = array(
            'otp'=>$otp,
            'access_token'=>$access_token
          );
          $userdatad= $this->Api_Model->selectrow('user',array('phone'=>$phone_number));
          if(empty($userdatad))
          {
              $checkdata= $this->Api_Model->selectrow('user',$data);
              if(!empty($checkdata))
              {
    
          $update = $this->Api_Model->update('user',array('phone'=>$phone_number),array('access_token'=>$access_token));
         
              $sdata=array('success'=>'true','message'=>'Profile update successfully');

          echo json_encode($sdata);
          }
          else
          {
            $sdata=array('success'=>'false','message'=>'Invalid OTP');
            echo json_encode($sdata);
          }
          }
          else
          {
              $sdata=array('success'=>'false','message'=>'Invalid OTP');
            echo json_encode($sdata);
          }
die;
  }

  public function slider()
  {
            $slides= $this->Api_Model->selectslider('slides',array('uploaded_by'=>'admin','status'=>'ok'));
            $i=1;
            foreach ($slides as $row)
            {
              $img=$this->crud_model->file_view('slides',$row->slides_id,'100','','no','src','','','.jpg');
              $sdata[]=array('id'=>$row->slides_id,'slider'=>$img,'category_id'=>$row->category);    
            }
            if(!empty($sdata))
            {
              $sdata=array('success'=>'true','message'=>'slider data', 'category'=>$sdata);
            }
            else
            {
              $sdata=array('success'=>'true','message'=>'slider data not found');
            }

      echo json_encode($sdata);
      die;
  }

public function getProductList()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $category=$input_data['category'];
        $start_price=$input_data['start_price'];
        $end_price=$input_data['end_price'];
        $brand=$input_data['brand'];
        $size=$input_data['size'];
        $discount=$input_data['discount'];
        $color=$input_data['color'];
        $tag=$input_data['tag'];

$get_filter_producs = $this->Api_Model->get_filter_producs('product',$category,$start_price,$end_price,$brand,$discount,$color,$tag);
           if(!empty($get_filter_producs))
           {
              foreach($get_filter_producs as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdataa[]=array('product_id'=>$row->product_id,'category_id'=>$row->category,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
              $sdata = array('success' => 'true', "message" => "Success", 'data' => $sdataa);
           }
           else
           {
              $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
           }

      echo json_encode($sdata);
      die;
  }

  public function slider_by_product()
  {
    $category_id = $this->uri->segment(3);
    $start = $this->uri->segment(4);

        if (!isset($start)) {
            $start = 0;
        }
        
      //       ))->result_array();
    $slider= $this->Api_Model->selectproduct('product',array('category'=>$category_id),$start);
      foreach($slider as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdata[]=array('product_id'=>$row->product_id,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'category data', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'category data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function categories()
  {
      $selected =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
      $this->db->where_in('category_id',$selected);
      $categories=$this->db->get('category')->result_array();
      // echo '<br>'.count($categories).'<br>';
      $count = 1;
      foreach($categories as $row)
      {
         if ($count <= 10) 
         {
            if($this->crud_model->if_publishable_category($row['category_id']))
            {
                $sdata[]=array('category_id'=>$row['category_id'],'category_name'=>$row['category_name'],'banner'=>base_url().'/uploads/category_image/'.$row['banner']);
            }
        }
    }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'category', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'category data not found');
      }

      echo json_encode($sdata);
      die;
  }

  public function brand()
    {
        $brand= $this->Api_Model->select('brand');
        if(!empty($brand))
        {
            $sdata=array('success'=>'true','message'=>'brand', 'brand'=>$brand);
        }
        else
        {
            $sdata=array('success'=>'true','message'=>'brand data not found');
        }

        echo json_encode($sdata);
      die;
    }

    public function price()
    {
        $product_price= $this->Api_Model->select_price_min_max('product');
        if(!empty($product_price))
        {
            $sdata=array('success'=>'true','message'=>'price', 'max'=>$product_price->max_fare, 'min'=>$product_price->min_fare);
        }
        else
        {
            $sdata=array('success'=>'false','message'=>'price data not found');
        }

        echo json_encode($sdata);
      die;
    }

    public function color()
    {
        $product_color= $this->Api_Model->select_color('product');
        if(!empty($product_color))
        {
            foreach ($product_color as $row)
            {
              $row->color = json_decode($row->color);
            }
            $sdata=array('success'=>'true','message'=>'color', 'color'=>$product_color);
        }
        else
        {
            $sdata=array('success'=>'false','message'=>'color data not found');
        }

        echo json_encode($sdata);
      die;
    }

  public function categories_by_id()
  {
      $category_id = $this->uri->segment(3);
    $start = $this->uri->segment(4);

        if (!isset($start)) {
            $start = 0;
        }
        
      //       ))->result_array();
    $categories= $this->Api_Model->selectproduct('product',array('category'=>$category_id),$start);

    foreach($categories as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdata[]=array('product_id'=>$row->product_id,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }

      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'category data', 'category'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'category data not found');
      }

      echo json_encode($sdata);
      die;
  }  

  public function product_details()
  {
      $product_id = $this->uri->segment(3);
      $sdata= $this->Api_Model->selectrowjoin('product',array('product_id'=>$product_id,'status'=>'ok'));
      foreach($sdata as $row){
        $thumbs = $this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','all');
    $mains = $this->crud_model->file_view('product',$row->product_id,'','','no','src','multi','all');
        $i=1;
     $img=array();
    foreach ($thumbs as $id=>$row1) {
                
                $img[]=$row1;
          $i++; 
          }         
      $row->main_image=$img;
      $row->color = json_decode($row->color);
      $row->options = json_decode($row->options);
      $row->additional_fields = json_decode($row->additional_fields);
      $row->tag = json_decode($row->tag);
      $row->data_brands = json_decode($row->data_brands);
      $row->data_vendors = json_decode($row->data_vendors);
      $row->data_subdets = json_decode($row->data_subdets);
      
      
         $recommends=$this->crud_model->product_list_set('related',12,$row->product_id); 
         if(!empty($recommends))
         {
         foreach ($recommends as $rec)
         {
             $imgg=$this->crud_model->file_view('product',$rec['product_id'],'','','thumb','src','multi','one');   

             $related[]=array('product_id'=>$rec['product_id'],'name'=>$rec['title'],'purchase_price'=>$rec['purchase_price'],'sale_price'=>$rec['sale_price'],'image'=>$imgg,'rating_num'=>$rec['rating_num'],'rating_total'=>$rec['rating_total']);
         }
       }
       else
       {
          $related[]=array();
       }

         $review= $this->Api_Model->selectrowjoinreview('user_rating',array('product_id'=>$product_id));  
         if(!empty($review))
         {
            foreach ($review as $rev)
            {
               $revv[]=array('rating_id'=>$rev->rating_id,'name'=>$rev->username,'product_type'=>$rev->product_type,'rating'=>$rev->rating,'title'=>$rev->title,'comment'=>$rev->comment,'image'=>base_url().'uploads/review_image/'.$rev->image,'created_at'=>$rev->created_at,'updated_at'=>$rev->updated_at);
              }
         }
         else
         {
            $revv=array();
         }
 }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'product data', 'category'=>$sdata,'similar_product'=>$related,'review'=>$revv);
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'product data not found');
      }
      echo json_encode($sdata);
      die;
  }

  public function order()
  {
      $user_id = $this->uri->segment(3);
      $sdata= $this->Api_Model->select('sale',array('buyer'=>$user_id));
     
      foreach($sdata as $row)
      {
          
          $row->product_details=json_decode($row->product_details);
          $row->shipping_address=json_decode($row->shipping_address);
          $row->payment_status=json_decode($row->payment_status);
          $row->payment_details=json_decode($row->payment_details);
          $row->delivery_status=json_decode($row->delivery_status);
          $product=array();
          foreach ($row->product_details as $prow)
          {
              $product[]=array('id'=>$prow->id,'qty'=>$prow->qty,'option'=>$prow->option,'price'=>$prow->price,'name'=>$prow->name,'shipping'=>$prow->shipping,'image'=>$prow->image,'tax'=>$prow->tax,'subtotal'=>$prow->subtotal);
          }

          foreach ($row->payment_status as $prow)
          {
              $pstatus=array('status'=>$prow->status,'admin'=>$prow->admin);
          }

          foreach ($row->delivery_status as $prow)
          {
              $delivery_status=array('admin'=>$prow->admin,'status'=>$prow->status,'comment'=>$prow->comment,'delivery_time'=>$prow->delivery_time);
          }

              $shipping_address=array('firstname'=>$row->shipping_address->firstname,'lastname'=>$row->shipping_address->lastname,'address1'=>$row->shipping_address->address1,'address2'=>$row->shipping_address->address2,'zip'=>$row->shipping_address->zip,'email'=>$row->shipping_address->email,'phone'=>$row->shipping_address->phone,'langlat'=>$row->shipping_address->langlat,'payment_type'=>$row->shipping_address->payment_type,'stripeToken'=>$row->shipping_address->stripeToken);

          $row->product_details=$product;
          $row->payment_status=$pstatus;
          $row->delivery_status=$delivery_status;
          $row->shipping_address=$shipping_address;
          if (empty($row->payment_details))
          {
            $row->payment_details=array();
          }
      }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'My order', 'order'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'My order not found');
      }
      echo json_encode($sdata);
      die;
  }

  public function order_details()
  {
      $sale_id = $this->uri->segment(3);
      $sdata= $this->Api_Model->select('sale',array('sale_id'=>$sale_id));

      foreach($sdata as $row)
      {
          
          $row->product_details=json_decode($row->product_details);
          $row->shipping_address=json_decode($row->shipping_address);
          $row->payment_status=json_decode($row->payment_status);
          $row->payment_details=json_decode($row->payment_details);
          $row->delivery_status=json_decode($row->delivery_status);

          foreach ($row->product_details as $prow)
          {
              $product[]=array('id'=>$prow->id,'qty'=>$prow->qty,'option'=>$prow->option,'price'=>$prow->price,'name'=>$prow->name,'shipping'=>$prow->shipping,'image'=>$prow->image,'tax'=>$prow->tax,'subtotal'=>$prow->subtotal);
          }

          foreach ($row->payment_status as $prow)
          {
              $pstatus=array('status'=>$prow->status,'admin'=>$prow->admin);
          }

          foreach ($row->delivery_status as $prow)
          {
              $delivery_status=array('admin'=>$prow->admin,'status'=>$prow->status,'comment'=>$prow->comment,'delivery_time'=>$prow->delivery_time);
          }

          $row->product_details=$product;
          $row->payment_status=$pstatus;
          $row->delivery_status=$delivery_status;
      }
      if(!empty($sdata))
      {
          $sdata=array('success'=>'true','message'=>'My order details', 'order'=>$sdata);
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'My order details not found');
      }
      echo json_encode($sdata);
      die;
  }

  public function cancel_order()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $buyer=$input_data['user_id'];
      $sale_id=$input_data['sale_id'];
      $sale_code=$input_data['sale_code'];

      $sale= $this->Api_Model->selectrow('sale',array('sale_id'=>$sale_id,'sale_code'=>$sale_code,'buyer'=>$buyer));
      if(!empty($sale))
      {
          if($sale->status==1)
          {
              $update = $this->Api_Model->update('sale',array('status'=>0),array('sale_id'=>$sale_id));
              $sdata=array('success'=>'true','message'=>'Your order cancel');
          }
          else
          {
            $sdata=array('success'=>'true','message'=>'Your order allready cancel');
          }
      }
      else
      {
          $sdata=array('success'=>'true','message'=>'My order details not found');
      }
      echo json_encode($sdata);
      die;
  }

public function order_create()
    {
      $razorpaykeyapi = $this->db->get_where('business_settings',array('type'=>'razorpaykey'))->row()->value;
      $razorpaysecret = $this->db->get_where('business_settings',array('type'=>'razorpaysecret'))->row()->value;
      $totalamount=$this->input->post('totalamount');
      $key=base64_encode($razorpaykeyapi.':'.$razorpaysecret);  
      
      $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.razorpay.com/v1/orders",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"amount\": ".$totalamount.",\n    \"currency\": \"INR\",\n    \"receipt\": \"rcptid_11\",\n    \"payment_capture\": 1\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic cnpwX3Rlc3RfTTlIM2Z4VDZpTmFuUjE6SGhyMDVzTXB3QTdJWmhTMmp1SUNMcmNn",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;die;
} else {
  $data =  json_decode($response);

  $data = array(
            'id'=>$data->id,
            'entity'=>$data->entity,
            'amount'=>$data->amount,
            'currency'=>$data->currency,
            'created_at'=>$data->created_at
             );

            $insert = $this->Api_Model->insert('order_details',$data);
            $response=json_decode($response);
            $sdata=array('success'=>'true','message'=>'order create','order'=>$response,'row_id'=>$insert);   
                echo json_encode($sdata);  die;
  //echo $response; die;
}

  }

  public function razorpay()
  {

    $razorpaykeyapi = $this->db->get_where('business_settings',array('type'=>'razorpaykey'))->row()->value;
      $razorpaysecret = $this->db->get_where('business_settings',array('type'=>'razorpaysecret'))->row()->value;
      $razorpay_payment_id=$this->input->post('razorpay_payment_id');
      $razorpay_order_id=$this->input->post('razorpay_order_id');
      $razorpay_signature=$this->input->post('razorpay_signature');
      $row_id=$this->input->post('row_id');

      $orderdetails= $this->Api_Model->selectrow('order_details',array('o_id'=>$row_id));
      if(!empty($orderdetails))
      {
          $sig = hash_hmac('sha256', $orderdetails->id + "|" + $razorpay_payment_id, $razorpaysecret);
          //$generated_signature = hmac_sha256($orderdetails->id + "|" + $razorpay_payment_id, $razorpaysecret);
          //echo $generated_signature;die;
          
          if($sig!=$razorpay_signature)
          {
              $sdata=array('success'=>'false','message'=>'signature not matched');   
                echo json_encode($sdata); exit(); die;
          }
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'order not matched');   
                echo json_encode($sdata); exit(); die;
      }

    $this->session->sess_destroy();
    $user_id=$this->input->post('user_id');
     $dataa = $this->db->get_where('cart', array('user_id' =>$user_id,'status'=>0))->result_array();
        if(!empty($dataa))
        {
            $this->cart->insert($dataa);
        }
        $carted = $this->cart->contents();



      $data['product_details'] = $this->input->post('product_details');

                $data['shipping_address'] = $this->input->post('shipping_address');

                $data['vat'] = $this->input->post('vat');

                $data['vat_percent'] = $this->input->post('vat_percent');

                $data['shipping'] = $this->input->post('shipping');

                $data['delivery_status'] = '[]';

                $data['payment_type'] = 'cash_on_delivery';

                $data['payment_status'] = '[]';

                $data['payment_details'] = '';

                $data['grand_total'] = $this->input->post('grand_total');

                $data['sale_datetime'] = time();

                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);

                $sale_id = $this->db->insert_id();

                    $data['buyer'] = $user_id;

                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                
                $delivery_status = array();

                $payment_status = array();

                foreach ($vendors as $p) {

                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');

                    $payment_status[] = array('vendor' => $p, 'status' => 'due');

                }

                if ($this->crud_model->is_admin_in_sale($sale_id)) {

                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');

                    $payment_status[] = array('admin' => '', 'status' => 'due');

                }

                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;

                $data['delivery_status'] = json_encode($delivery_status);

                $data['payment_status'] = json_encode($payment_status);

                $this->db->where('sale_id', $sale_id);

                $this->db->update('sale', $data);

                $this->crud_model->process_affiliation($sale_id,false);

                foreach ($carted as $value) {

                    $this->crud_model->decrease_quantity($value['id'], $value['qty']);

                    $data1['type'] = 'destroy';

                    $data1['category'] = $this->db->get_where('product', array(

                        'product_id' => $value['id']

                    ))->row()->category;

                    $data1['sub_category'] = $this->db->get_where('product', array(

                        'product_id' => $value['id']

                    ))->row()->sub_category;

                    $data1['product'] = $value['id'];

                    $data1['quantity'] = $value['qty'];

                    $data1['total'] = 0;

                    $data1['reason_note'] = 'sale';

                    $data1['sale_id'] = $sale_id;

                    $data1['datetime'] = time();
                    
                    $this->db->insert('stock', $data1);
                    $update = $this->Api_Model->update('cart',array('status'=>1),array('user_id'=>$user_id,'id'=>$value['id']));
                }

                $this->crud_model->digital_to_customer($sale_id);


                $this->email_model->email_invoice($sale_id);
                $this->cart->destroy();  
                $sdata=array('success'=>'true','message'=>'Payment successfully');   
                echo json_encode($sdata);  die;          
              }

  public function cash_on_delivery()
  {
    $this->session->sess_destroy();
    $user_id=$this->input->post('user_id');
     $dataa = $this->db->get_where('cart', array('user_id' =>$user_id,'status'=>0))->result_array();
        if(!empty($dataa))
        {
            $this->cart->insert($dataa);
        }
        $carted = $this->cart->contents();
      $data['product_details'] = $this->input->post('product_details');

                $data['shipping_address'] = $this->input->post('shipping_address');

                $data['vat'] = $this->input->post('vat');

                $data['vat_percent'] = $this->input->post('vat_percent');

                $data['shipping'] = $this->input->post('shipping');

                $data['delivery_status'] = '[]';

                $data['payment_type'] = 'cash_on_delivery';

                $data['payment_status'] = '[]';

                $data['payment_details'] = '';

                $data['grand_total'] = $this->input->post('grand_total');

                $data['sale_datetime'] = time();

                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);

                $sale_id = $this->db->insert_id();

                    $data['buyer'] = $user_id;

                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                
                $delivery_status = array();

                $payment_status = array();

                foreach ($vendors as $p) {

                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');

                    $payment_status[] = array('vendor' => $p, 'status' => 'due');

                }

                if ($this->crud_model->is_admin_in_sale($sale_id)) {

                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');

                    $payment_status[] = array('admin' => '', 'status' => 'due');

                }

                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;

                $data['delivery_status'] = json_encode($delivery_status);

                $data['payment_status'] = json_encode($payment_status);

                $this->db->where('sale_id', $sale_id);

                $this->db->update('sale', $data);

                $this->crud_model->process_affiliation($sale_id,false);

                foreach ($carted as $value) {

                    $this->crud_model->decrease_quantity($value['id'], $value['qty']);

                    $data1['type'] = 'destroy';

                    $data1['category'] = $this->db->get_where('product', array(

                        'product_id' => $value['id']

                    ))->row()->category;

                    $data1['sub_category'] = $this->db->get_where('product', array(

                        'product_id' => $value['id']

                    ))->row()->sub_category;

                    $data1['product'] = $value['id'];

                    $data1['quantity'] = $value['qty'];

                    $data1['total'] = 0;

                    $data1['reason_note'] = 'sale';

                    $data1['sale_id'] = $sale_id;

                    $data1['datetime'] = time();
                    
                    $this->db->insert('stock', $data1);
                    $update = $this->Api_Model->update('cart',array('status'=>1),array('user_id'=>$user_id,'id'=>$value['id']));
                }

                $this->crud_model->digital_to_customer($sale_id);

                $this->email_model->email_invoice($sale_id);
                $this->cart->destroy();  
                $sdata=array('success'=>'true','message'=>'Cash on delivery successfully');   
                echo json_encode($sdata);  die;          
              }

       public function report_problem()
  {
          $image='';
          $files = $_FILES['image'];
          if(!empty($_FILES['image']['name']))
          {
               $image = $this->upload_single_image_report($files);
          }
      $data = array(
            'user_id'=>$this->input->post('user_id'),
            'title'=>$this->input->post('title'),
            'image'=>$image
             );

            $insert = $this->Api_Model->insert('report_problem',$data);
            if(!empty($insert))
            {
                $sdata=array('success'=>'true','message'=>'Report added successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Report not added successfully');
            }
            echo json_encode($sdata);  die;
  }
  public function add_review()
  {
          $files = $_FILES['image'];
          if(!empty($_FILES['image']['name']))
          {
               $image = $this->upload_single_image($files);
          }
          if(!empty($image))
          {
              $data = array(
            'user_id'=>$this->input->post('user_id'),
            'product_id'=>$this->input->post('product_id'),
            'product_type'=>$this->input->post('product_type'),
            'rating'=>$this->input->post('rating'),
            'title'=>$this->input->post('title'),
            'comment'=>$this->input->post('comment'),
            'image'=>$image
             );
          }
          else
          {
              $data = array(
            'user_id'=>$this->input->post('user_id'),
            'product_id'=>$this->input->post('product_id'),
            'product_type'=>$this->input->post('product_type'),
            'rating'=>$this->input->post('rating'),
            'title'=>$this->input->post('title'),
            'comment'=>$this->input->post('comment'),
            'image'=>''
             );
          }
      

            $insert = $this->Api_Model->insert('user_rating',$data);
            if(!empty($insert))
            {
                $sdata=array('success'=>'true','message'=>'Review added successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Review not added successfully');
            }
            echo json_encode($sdata);  die;
  }

  public function edit_review()
  {
      $rating_id=$this->input->post('rating_id');
      $image='';
          $files = $_FILES['image'];
          if(!empty($_FILES['image']['name']))
          {
               $image = $this->upload_single_image($files);
          }
          if(!empty($image))
          {
              $data = array(
            'user_id'=>$this->input->post('user_id'),
            'product_id'=>$this->input->post('product_id'),
            'product_type'=>$this->input->post('product_type'),
            'rating'=>$this->input->post('rating'),
            'title'=>$this->input->post('title'),
            'comment'=>$this->input->post('comment'),
            'image'=>$image
             );
          }
          else
          {
              $data = array(
            'user_id'=>$this->input->post('user_id'),
            'product_id'=>$this->input->post('product_id'),
            'product_type'=>$this->input->post('product_type'),
            'rating'=>$this->input->post('rating'),
            'title'=>$this->input->post('title'),
            'comment'=>$this->input->post('comment')
             );
          }
      

            $update = $this->Api_Model->update('user_rating',$data,array('rating_id'=>$rating_id));
            if(!empty($update))
            {
                $sdata=array('success'=>'true','message'=>'Review updated successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Review not updated successfully');
            }
            echo json_encode($sdata);  die;
  }

  public function add_wishlist()
  {
    $i=1;
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $user_id=$input_data['user_id'];
      $product_id=$input_data['product_id'];
      $wishlistcheck= $this->Api_Model->selectrow('user',array('user_id'=>$user_id));
      if($wishlistcheck->wishlist != '[]')
      {
          $wishlistf= wishlistfindin($wishlistcheck->wishlist);
        foreach ($wishlistf as $row)
        {
            $rr='"' . $product_id . '"';
           if($row==$rr)
           {
              $i=2;
           }
           
        }
        
          $wish=$wishlistcheck->wishlist;
          $w=explode(']', $wish);
          $wishlist=$w[0].',"'.$product_id.'"]';
      }
      else
      {
          $wishlist='["'.$product_id.'"]';
      }   
        
        if($i==1)
        {
          $update = $this->Api_Model->update('user',array('wishlist'=>$wishlist),array('user_id'=>$user_id));
        }
     
      if(!empty($update))
            {
                $sdata=array('success'=>'true','message'=>'Add successfully wishlist');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Wishlist all ready added');
            }
            echo json_encode($sdata);  die;
  }

  public function get_wishlist()
  {
    $sdata=array();
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $user_id=$input_data['user_id'];
      $wishlistcheck= $this->Api_Model->selectrow('user',array('user_id'=>$user_id));
      if(!empty($wishlistcheck))
      {
        if(!empty($wishlistcheck->wishlist))
        {
          $wishlistf= wishlistfindin($wishlistcheck->wishlist);
          foreach ($wishlistf as $row)
          {
              $product_id = str_replace('"', '', $row);
              $product= $this->Api_Model->selectrowjoin('product',array('product_id'=>$product_id,'status'=>'ok'));
              foreach($product as $roww){
                $img=$this->crud_model->file_view('product',$roww->product_id,'','','thumb','src','multi','one');
                $sdata[]=array('product_id'=>$roww->product_id,'name'=>$roww->title,'purchase_price'=>$roww->purchase_price,'sale_price'=>$roww->sale_price,'image'=>$img);
              }


          }
          $sdata=array('success'=>'true','message'=>'wishlist data', 'wishlist'=>$sdata);
        }
        else
        {
          $sdata=array('success'=>'false','message'=>'wishlist data not found', 'wishlist'=>$sdata);
        }
        
      }
      else
      {
        $sdata=array('success'=>'false','message'=>'wishlist data not found', 'wishlist'=>$sdata);
      }
      echo json_encode($sdata);
      die;
  }

  public function remove_wishlist()
  {
      $i=1;
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $user_id=$input_data['user_id'];
      $product_id=$input_data['product_id'];
      $wishlistcheck= $this->Api_Model->selectrow('user',array('user_id'=>$user_id));
      $pid=array();
      if(!empty($wishlistcheck))
      {
          $wishlistf= wishlistfindin($wishlistcheck->wishlist);
        foreach ($wishlistf as $row)
        {
            $rr='"' . $product_id . '"';
           if($row==$rr)
           {
              $i=2;
           }
           else
           {
              $pid[]=$row;
           }
           
        }
        $pid=implode(',',$pid);
          $pid='[' . $pid .']';
          $update = $this->Api_Model->update('user',array('wishlist'=>$pid),array('user_id'=>$user_id));
          $sdata=array('success'=>'true','message'=>'Wishlist remove product');
      }
      else
      {
          $sdata=array('success'=>'false','message'=>'Wishlist product not add');
      }       
          echo json_encode($sdata);  die;
  }

  public function productFilter_post()
  {
      $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $start_price=$input_data['start_price'];
      $end_price=$input_data['end_price'];
      $brand=$input_data['brand'];
      $size=$input_data['size'];
      $discount=$input_data['discount'];
      $color=$input_data['color'];
  }

  public function add_to_cart()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $stock = $this->crud_model->get_type_name_by_id('product', $input_data['product_id'], 'current_stock');

        if (!$this->crud_model->is_added_to_cart($input_data['product_id'])) {
                if ($stock >= $input_data['qty'] || $this->crud_model->is_digital($input_data['product_id'])) {

        $cartmatch= $this->Api_Model->select('cart',array('user_id'=>$input_data['user_id'],'id'=>$input_data['product_id'],'status'=>0));
                if(empty($cartmatch))
                {
                  $pdetails= $this->Api_Model->selectrow('product',array('product_id'=>$input_data['product_id']));
        $datacart = array(
                'user_id'=>$input_data['user_id'],
                'id' => $input_data['product_id'],
                'qty' => $input_data['qty'],
                'price' => $pdetails->sale_price,
                'name' =>$pdetails->title,
                'shipping' => $pdetails->shipping_cost,
                'tax' => $pdetails->tax,
                'image' => $input_data['image'],
                'coupon' => 'aaa'
            );
                $insert = $this->Api_Model->insert('cart',$datacart);
                $sdata=array('success'=>'true','message'=>'Added');
              }
              else
              {
                  $sdata=array('success'=>'true','message'=>'all ready added');
              }
              } else {
                    $sdata=array('success'=>'true','message'=>'shortage');
                }
              } else {
                $sdata=array('success'=>'true','message'=>'already');
            }
            echo json_encode($sdata);  die;
    }

    public function cart_get()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $user_id=$input_data['user_id'];
        $cartget= $this->Api_Model->selectcart('cart',array('user_id'=>$user_id));
        if(!empty($cartget))
        {
            foreach ($cartget as $row)
            {
                $cart[]=array('cart_id'=>$row->cart_id,'user_id'=>$row->user_id,'id'=>$row->id,'product_id'=>$row->id,'qty'=>$row->qty,'price'=>$row->price,'name'=>$row->name,'shipping'=>$row->shipping,'image'=>$row->image,'shipping_cost'=>$row->shipping_cost,'tax'=>$row->tax,'status'=>$row->status,'created_at'=>$row->created_at);
            }

            if(!empty($cart))
            {
                $sdata=array('success'=>'true','message'=>'My cart', 'cart'=>$cart);
            }
            else
            {
                $sdata=array('success'=>'true','message'=>'My cart data not found','cart'=>array());
            }
            
        }
        else
        {
          $sdata=array('success'=>'true','message'=>'My cart data not found','cart'=>array());
        }
        echo json_encode($sdata);
          die;
    }

    public function add_to_cart_update()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $stock = $this->crud_model->get_type_name_by_id('product', $input_data['product_id'], 'current_stock');

        if (!$this->crud_model->is_added_to_cart($input_data['product_id'])) {
                if ($stock >= $input_data['qty'] || $this->crud_model->is_digital($input_data['product_id'])) {

        $cartmatch= $this->Api_Model->select('cart',array('user_id'=>$input_data['user_id'],'id'=>$input_data['product_id'],'status'=>0));
                if(!empty($cartmatch))
                {
        $datacart = array(
                'qty' => $input_data['qty']
            );
                $insert = $this->Api_Model->update('cart',$datacart,array('user_id'=>$input_data['user_id'],'id'=>$input_data['product_id'],'status'=>0));
                $sdata=array('success'=>'true','message'=>'Updated');
              }
              else
              {
                  $sdata=array('success'=>'true','message'=>'Not updated');
              }
              } else {
                    $sdata=array('success'=>'true','message'=>'shortage');
                }
              } else {
                $sdata=array('success'=>'true','message'=>'already');
            }
            echo json_encode($sdata);  die;
    }

    public function remove_cart()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
      $cart_id=$input_data['cart_id'];
      $con = array(
          'cart_id'=>$cart_id
        );
      $delete=$this->Api_Model->delete('cart',$con);
      if(!empty($delete))
            {
                $sdata=array('success'=>'true','message'=>'Delete successfully');
            }
            else
            {
                $sdata=array('success'=>'false','message'=>'Delete not successfully');
            }
            echo json_encode($sdata);  die;
    }

    public function filter()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $category=$input_data['category'];
        $start_price=$input_data['start_price'];
        $end_price=$input_data['end_price'];
        $brand=$input_data['brand'];
        $size=$input_data['size'];
        $discount=$input_data['discount'];
        $color=$input_data['color'];
        
        //$get_product_by_cat_id = $this->Api_Model->select('product',array('category'=>$category));
        
        if($category) 
        {

           $get_filter_producs = $this->Api_Model->get_filter_producs_filter('product',$category,$start_price,$end_price,$brand,$discount,$color);
           if(!empty($get_filter_producs))
           {
              foreach($get_filter_producs as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdataa[]=array('product_id'=>$row->product_id,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
              $sdata = array('success' => 'true', "message" => "Success", 'data' => $sdataa);
           }
           else
           {
              $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
           }
        } 
        else
        {
            $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
        }

           //$sdata = array('ErrorCode' => 0, "message" => "Success", 'data' => $get_product_by_cat_id);
           
           echo json_encode($sdata);  die;
    }

    public function sort_by()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $category=$input_data['category'];
        $price=$input_data['price'];
        if($category) 
        {

           $get_filter_producs = $this->Api_Model->get_sort_producs('product',$category,$price);
           if(!empty($get_filter_producs))
           {
              foreach($get_filter_producs as $row){
                 $img=$this->crud_model->file_view('product',$row->product_id,'','','thumb','src','multi','one');   
                $sdataa[]=array('product_id'=>$row->product_id,'name'=>$row->title,'purchase_price'=>$row->purchase_price,'sale_price'=>$row->sale_price,'image'=>$img,'rating_num'=>$row->rating_num,'rating_total'=>$row->rating_total);
              }
              $sdata = array('success' => 'true', "message" => "Success", 'data' => $sdataa);
           }
           else
           {
              $sdata = array('success' =>'false', "message" => "Success", 'data' => array());
           }
        } 
        else
        {
            $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
        }

           //$sdata = array('ErrorCode' => 0, "message" => "Success", 'data' => $get_product_by_cat_id);
           
           echo json_encode($sdata);  die;
    }

    public function arrivals()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $month=date("m/d/Y");
        $day=$input_data['day'];
        if($day==1)
        {
            $date2 =strtotime($month . "  -30 day");
        }
        else
        {
            $date2 =strtotime($month . "  -90 day");
        }
        $monthselect = $this->Api_Model->select_month('product',$date2);
        if(!empty($monthselect))
           {
              foreach($monthselect as $row){
                $row->add_timestamp=date("m/d/Y",$row->add_timestamp);
              }
              $sdata = array('success' => 'true', "message" => "Success", 'data' => $monthselect);
           }
           else
           {
              $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
           }
           echo json_encode($sdata);  die;
    }

    public function product_star()
    {
        $star = $this->Api_Model->select_star('product');
        if(!empty($star))
           {
              $sdata = array('success' => 'true', "message" => "Success", 'data' => $star);
           }
           else
           {
              $sdata = array('success' => 'false', "message" => "Success", 'data' => array());
           }
           echo json_encode($sdata);  die;
    }

    public function get_notification()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $user_id=$input_data['user_id'];
        $notification= $this->Api_Model->selectfindin('notification',$user_id);
        if(!empty($notification))
        {
          foreach ($notification as $row)
          {
              $row->read_by=explode(',',$row->read_by);
          }
        }
        $sdata=array('success'=>'true','message'=>'notification', 'notification'=>$notification);
        echo json_encode($sdata);  die;
    }

    public function readby_notification()
    {
        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        $user_id=$input_data['user_id'];
        $notification_id=$input_data['notification_id'];

        $notification= $this->Api_Model->selectrow('notification',array('id'=>$notification_id));
        $read_by=$notification->read_by.','.$user_id;
        $update = $this->Api_Model->update('notification',array('read_by'=>$read_by),array('id'=>$notification_id));
        $sdata=array('success'=>'true','message'=>'updated');
        echo json_encode($sdata);  die;
    }

function upload_single_image_report($files){
         
        $data = array();
        // If file upload form submitted
        if(!empty($files['name'])){

            $_FILES['file']['name']     = time().$files['name'];
                $_FILES['file']['type']     = $files['type'];
                $_FILES['file']['tmp_name'] = $files['tmp_name'];
                $_FILES['file']['error']     = $files['error'];
                $_FILES['file']['size']     = $files['size'];

                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);//get extension

                if (!file_exists ('uploads/report_image/'))
                {

                        mkdir('uploads/report_image/',0777,true);  

                }

               $uploadPath = 'report_image/';
                move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath.$_FILES['file']['name']);

                return $_FILES['file']['name'];
            
           
        }

        return false;
        
   
    }

  function upload_single_image($files){
         
        $data = array();
        // If file upload form submitted
        if(!empty($files['name'])){

            $_FILES['file']['name']     = time().$files['name'];
                $_FILES['file']['type']     = $files['type'];
                $_FILES['file']['tmp_name'] = $files['tmp_name'];
                $_FILES['file']['error']     = $files['error'];
                $_FILES['file']['size']     = $files['size'];

                $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);//get extension

                if (!file_exists ('uploads/review_image/'))
                {

                        mkdir('uploads/review_image/',0777,true);  

                }

               $uploadPath = 'review_image/';
                move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath.$_FILES['file']['name']);

                return $_FILES['file']['name'];
            
           
        }

        return false;
        
   
    }

}

?>