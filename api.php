<?php
require_once './database.php';

$Con_user=['user'=>''];
$Con_pass=['pass'=>''];
if(isset($_POST['name']) && isset($_POST['Job-title']) && isset($_POST['email']) && isset($_POST['password'])){
    $sql = $database->prepare("INSERT INTO user(name,email,password,job_title,Lip_type,employee_name,employee_img) VALUES(:name,:email,:password,:job_title,:Lip_type,:employee_name,:employee_img)");
    $dir = "imge/";
    $target_file = $dir.basename($_FILES['file']['name']);
    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

    $email_s =filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);

    $pass_s = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    $Job = filter_var($_POST['Job-title'],FILTER_SANITIZE_STRING);

    $Lip = filter_var($_POST['shift-type'],FILTER_SANITIZE_STRING);

    $url_file = str_replace(' ','%20',$target_file);
    $sql->bindParam(':name',$name);
    $sql->bindParam(':email',$email_s);
    $sql->bindParam(':password',$pass_s);
    $sql->bindParam(':job_title',$Job);
    $sql->bindParam(':Lip_type',$Lip);
    $sql->bindParam(':employee_name',$url_file);
    $sql->bindParam(':employee_img',$target_file);
    $sql->execute();
    }
}

if(isset($_POST['id_user']) && isset($_POST['Date_submitting']) && isset($_POST['start_date']) && isset($_POST['expiration_date']) && isset($_POST['num_of_day']) && isset($_POST['request_type'])){
    $vacation = $database->prepare("INSERT INTO vacation(id_user,Date_submitting,start_date,expiration_date,num_of_day,type_vacation,annual_balance,comments,request_type) VALUES(:id_user,:Data_sub,:start,:end,:num_of,:type_va,:annual,:com,:req_type)");
    $vacation->bindParam(':id_user',$_POST['id_user']);
    $vacation->bindParam(':Data_sub',$_POST['Date_submitting']);
    $vacation->bindParam(':start',$_POST['start_date']);
    $vacation->bindParam(':end',$_POST['expiration_date']);
    $vacation->bindParam('num_of',$_POST['num_of_day']);
    $vacation->bindParam(':type_va',$_POST['type_vacation']);
    $vacation->bindParam(':annual',$_POST['annual_balance']);
    $vacation->bindParam(':com',$_POST['comments']);
    $vacation->bindParam(':req_type',$_POST['request_type']);
    $vacation->execute();
}

//time vacation
if(isset($_POST['id_user']) && isset($_POST['Date_sub']) && isset($_POST['hour_age']) && isset($_POST['up_tohour']) && isset($_POST['Date_time']) && isset($_POST['request_type'])){
    $vacation_time = $database->prepare("INSERT INTO time_vacation(id_user,Date_sub,hour_age,up_tohour,Date_time,type_time_vacation,reason,request_type) VALUES(:id_user,:Data_sub,:hour_age,:up_tohour,:Date_time,:type_time_vacation,:reason,:req_type)");
    $vacation_time->bindParam(':id_user',$_POST['id_user']);
    $vacation_time->bindParam(':Data_sub',$_POST['Date_sub']);
    $vacation_time->bindParam(':hour_age',$_POST['hour_age']);
    $vacation_time->bindParam(':up_tohour',$_POST['up_tohour']);
    $vacation_time->bindParam(':Date_time',$_POST['Date_time']);
    $vacation_time->bindParam(':type_time_vacation',$_POST['type_time_vacation']);
    $vacation_time->bindParam(':reason',$_POST['reason']);
    $vacation_time->bindParam(':req_type',$_POST['request_type']);
    $vacation_time->execute();
}

header('Content-Type: application/json;charset=UTF-8');
$input = file_get_contents("php://input");
$data = json_decode($input);
if(isset($data->user) && isset($data->pass)){
    $data_user = $data->user;
    $data_user = filter_var($data_user,FILTER_VALIDATE_EMAIL);

    $data_pass = $data->pass;
    $data_pass = filter_var($data_pass,FILTER_SANITIZE_STRING);
    //con email
    $Con_user = $database->prepare("SELECT email FROM user WHERE user.email = :email");
    $Con_user->bindParam(':email', $data_user);
    $Con_user->execute();
    $Con_user = $Con_user->fetchObject();
    if(@$Con_user->email){
        $Con_user = [
            'email'=>true
        ];
    }
    else{
        $Con_user = [
            'email'=>false
        ];
    }
    //con password
    $Con_pass = $database->prepare("SELECT id,email,password FROM user WHERE user.email = :email AND user.password = :pass");
    $Con_pass->bindParam(':email', $data_user);
    $Con_pass->bindParam(':pass', $data_pass);
    $Con_pass->execute();
    $Con_pass = $Con_pass->fetchObject();
    if(@$Con_pass->password){
        $Con_user += [
            'pass'=>true,
            'id'=>$Con_pass->id
        ];
    }
    else{
        $Con_user += [
            'pass'=>false
        ];
    }
}
$id_u=['employee_img'=>''];
if(isset($data->id_user)){
$send_img = $data->id_user;
$id_u = $database->prepare("SELECT employee_name FROM user WHERE id = :id_user");
$id_u->bindParam(':id_user',$send_img);
$id_u->execute();
$id_u = $id_u->fetchAll(PDO::FETCH_ASSOC);
}
// request boss
$request=['request'=>''];$req=['req'=>''];
if(isset($data->idUser) && isset($data->idVacation) && isset($data->request) && isset($data->boss)){
    $request_boss= $database->prepare("SELECT user.email,user.name,user.Lip_type,user.job_title,user.employee_name,vacation.Date_submitting,vacation.start_date,vacation.expiration_date,vacation.num_of_day,vacation.type_vacation,vacation.annual_balance,vacation.comments,vacation.id_vacation FROM vacation JOIN user ON user.id = vacation.id_user WHERE vacation.id_user = :idUser AND vacation.id_vacation = :idVacation");
    $request_boss->bindParam(':idUser',$data->idUser);
    $request_boss->bindParam(':idVacation',$data->idVacation);
    $request_boss->execute();
    $boss = $database->prepare("SELECT employee_img FROM user WHERE user.email = :email");
    $boss->bindParam(':email',$data->boss);
    $boss->execute();
    $request = $request_boss->fetchAll(PDO::FETCH_ASSOC);
    $req =$boss->fetchAll(PDO::FETCH_ASSOC);
};
//boss
if(isset($data->imge_boss) && isset($data->boss_YN) && isset($data->name_boss) && isset($data->id_up)){
    $up = $database->prepare("UPDATE vacation SET Director_approval = :boss_YN   WHERE id_vacation = :id");
    $up->bindParam(':boss_YN',$data->boss_YN);
    $up->bindParam(':id',$data->id_up);
    $up->execute();
    $up = $database->prepare("UPDATE vacation SET Manager_name = :manager_name  WHERE id_vacation = :id");
    $up->bindParam(':manager_name',$data->name_boss);
    $up->bindParam(':id',$data->id_up);
    $up->execute();
    $up = $database->prepare("UPDATE vacation  SET signature = :imge_boss WHERE id_vacation = :id");
    $up->bindParam(':imge_boss',$data->imge_boss);
    $up->bindParam(':id',$data->id_up);
    $up->execute();
    $up = $database->prepare("UPDATE vacation  SET  Date_Manager = :Date_manager WHERE id_vacation = :id");
    $up->bindParam(':Date_manager',$data->date_new);
    $up->bindParam(':id',$data->id_up);
    $up->execute();
    //email 
    if($data->boss_YN == "غير موافق"){
        require_once './phpmailer-master/mail.php';
        $mail->setFrom("alial778810@gmail.com", "".$data->name_boss."");
        $mail->addAddress($data->you_email);
        $mail->Subject ="المدير المباشر";
        $mail->Body ='سلام عليكم استاذ  '.$data->name_user.'  المدير المباشر غير موافق على   '.$data->type_request.'  التاريخ تقديم الطلب  '.$data->data_user;
        
        $mail->send();
        
    }
   //manager
if(isset($data->name_user) && isset($data->type_request) && isset($data->boss_YN)){
    $manager = $database->prepare("INSERT INTO manager(name_user,type_request,Director_approval,date_Director,date_request) VALUES(:name,:type,:Dir,:data,:new)");
    $manager->bindParam(':name',$data->name_user);
    $manager->bindParam(':type',$data->type_request);
    $manager->bindParam(':Dir',$data->boss_YN);
    $manager->bindParam(':data',$data->data_user);
    $manager->bindParam(':new',$data->date_new);
    $manager->execute();
}
}
//time vacation boss
$request_time=['request'=>''];$req_time=['req'=>''];
if(isset($data->idUser_time) && isset($data->idVacation_time) && isset($data->request_time) && isset($data->boss_time)){
    $request_boss_time= $database->prepare("SELECT user.email,user.name,user.Lip_type,user.job_title,user.employee_name,time_vacation.Date_sub,time_vacation.hour_age,time_vacation.up_tohour,time_vacation.Date_time,time_vacation.type_time_vacation,time_vacation.reason,time_vacation.id_vacation FROM time_vacation JOIN user ON user.id = time_vacation.id_user WHERE time_vacation.id_user = :idUser AND time_vacation.id_vacation = :idVacation");
    $request_boss_time->bindParam(':idUser',$data->idUser_time);
    $request_boss_time->bindParam(':idVacation',$data->idVacation_time);
    $request_boss_time->execute();
    $boss_time = $database->prepare("SELECT employee_img FROM user WHERE user.email = :email");
    $boss_time->bindParam(':email',$data->boss_time);
    $boss_time->execute();
    $request_time = $request_boss_time->fetchAll(PDO::FETCH_ASSOC);
    $req_time =$boss_time->fetchAll(PDO::FETCH_ASSOC);
};
//boss time 
if(isset($data->imge_boss_time) && isset($data->boss_time_YN) && isset($data->name_boss_time) && isset($data->id_up_time)){
    $up = $database->prepare("UPDATE time_vacation SET Director_approval = :boss_YN   WHERE id_vacation = :id");
    $up->bindParam(':boss_YN',$data->boss_time_YN);
    $up->bindParam(':id',$data->id_up_time);
    $up->execute();
    $up = $database->prepare("UPDATE time_vacation SET name_manager = :manager_name  WHERE id_vacation = :id");
    $up->bindParam(':manager_name',$data->name_boss_time);
    $up->bindParam(':id',$data->id_up_time);
    $up->execute();
    $up = $database->prepare("UPDATE time_vacation  SET signature_manager = :imge_boss WHERE id_vacation = :id");
    $up->bindParam(':imge_boss',$data->imge_boss_time);
    $up->bindParam(':id',$data->id_up_time);
    $up->execute();
    $up = $database->prepare("UPDATE time_vacation  SET  date_manager = :Date_manager WHERE id_vacation = :id");
    $up->bindParam(':Date_manager',$data->data_new_time);
    $up->bindParam(':id',$data->id_up_time);
    $up->execute();
    //email 
    if($data->boss_time_YN == "غير موافق"){
        require_once './phpmailer-master/mail.php';
        $mail->setFrom("alial778810@gmail.com", "".$data->name_boss_time."");
        $mail->addAddress($data->you_email_time);
        $mail->Subject ="المدير المباشر";
        $mail->Body ='سلام عليكم استاذ  '.$data->name_user_time.'  المدير المباشر غير موافق على   '.$data->type_request.'  التاريخ تقديم الطلب  '.$data->data_user_time;
        
        $mail->send();
        
    }
   //manager
if(isset($data->name_user_time) && isset($data->type_request) && isset($data->boss_time_YN)){
    $manager = $database->prepare("INSERT INTO manager(name_user,type_request,Director_approval,date_Director,date_request) VALUES(:name,:type,:Dir,:data,:new)");
    $manager->bindParam(':name',$data->name_user_time);
    $manager->bindParam(':type',$data->type_request);
    $manager->bindParam(':Dir',$data->boss_time_YN);
    $manager->bindParam(':data',$data->data_user_time);
    $manager->bindParam(':new',$data->data_new_time);
    $manager->execute();
}
}
//DELETE manafer
if(isset($data->re)){
    $re = $database->prepare("DELETE FROM manager");
    $re->execute();
}
// human time  vacation
$human_time=['request'=>''];$h_time=['req'=>''];
if(isset($data->idUser_1) && isset($data->idVacation_1) && isset($data->request_1) && isset($data->boss_1)){
    $request_human_time= $database->prepare("SELECT * FROM time_vacation JOIN user ON user.id = time_vacation.id_user WHERE time_vacation.id_user = :idUser AND time_vacation.id_vacation = :idVacation");
    $request_human_time->bindParam(':idUser',$data->idUser_1);
    $request_human_time->bindParam(':idVacation',$data->idVacation_1);
    $request_human_time->execute();
    $human_h_time = $database->prepare("SELECT employee_img FROM user WHERE user.email = :email");
    $human_h_time->bindParam(':email',$data->boss_1);
    $human_h_time->execute();
    $human_time = $request_human_time->fetchAll(PDO::FETCH_ASSOC);
    $h_time =$human_h_time->fetchAll(PDO::FETCH_ASSOC);
};
// human send to time vacation 
if(isset($data->human_1_YN_time) && isset($data->data_new_1_time) && isset($data->id_up_1_time)){
    $up = $database->prepare("UPDATE time_vacation SET Human_resources = :Human_resources   WHERE id_vacation = :id");
    $up->bindParam(':Human_resources',$data->human_1_YN_time);
    $up->bindParam(':id',$data->id_up_1_time);
    $up->execute();
    $up = $database->prepare("UPDATE time_vacation  SET  time_Human = :time_Human WHERE id_vacation = :id");
    $up->bindParam(':time_Human',$data->data_new_1_time);
    $up->bindParam(':id',$data->id_up_1_time);
    $up->execute();
    //email 
    if($data->human_1_YN_time){
        require_once './phpmailer-master/mail.php';
        $mail->setFrom("alial778810@gmail.com","الموارد البشرية");
        $mail->addAddress($data->you_email_1_time);
        $mail->Subject ="الموارد البشرية";
        $mail->Body ='سلام عليكم استاذ  '.$data->name_user_1_time.'  الموارد البشرية   '.$data->human_1_YN_time.'  على  '.$data->type_request.' تاريخ تقديم الطلب   '.$data->data_user_1_time;
        
        $mail->send();
        
    }
   //human
if(isset($data->name_user_1_time) && isset($data->type_request) && isset($data->human_1_YN_time)){
    $manager = $database->prepare("INSERT INTO human(name_user,type_request,Director_Human,Date_Human_res,Date_request) VALUES(:name,:type,:Dir,:data,:new)");
    $manager->bindParam(':name',$data->name_user_1_time);
    $manager->bindParam(':type',$data->type_request);
    $manager->bindParam(':Dir',$data->human_1_YN_time);
    $manager->bindParam(':data',$data->data_new_1_time);
    $manager->bindParam(':new',$data->data_user_1_time);
    $manager->execute();
}
}
// human vacation 
$human=['request'=>''];$h=['req'=>''];
if(isset($data->idUser__1) && isset($data->idVacation__1) && isset($data->request__1) && isset($data->boss__1)){
    $request_human= $database->prepare("SELECT * FROM vacation JOIN user ON user.id = vacation.id_user WHERE vacation.id_user = :idUser AND vacation.id_vacation = :idVacation");
    $request_human->bindParam(':idUser',$data->idUser__1);
    $request_human->bindParam(':idVacation',$data->idVacation__1);
    $request_human->execute();
    $human_h = $database->prepare("SELECT employee_img FROM user WHERE user.email = :email");
    $human_h->bindParam(':email',$data->boss__1);
    $human_h->execute();
    $human = $request_human->fetchAll(PDO::FETCH_ASSOC);
    $h =$human_h->fetchAll(PDO::FETCH_ASSOC);
};
// human send to vacation 
if(isset($data->human_YN) && isset($data->date_new_1) && isset($data->id_up_1) && isset($data->Department_YN)){
    $up = $database->prepare("UPDATE vacation SET Department_manager = :Human_resources   WHERE id_vacation = :id");
    $up->bindParam(':Human_resources',$data->Department_YN);
    $up->bindParam(':id',$data->id_up_1);
    $up->execute();
    $up = $database->prepare("UPDATE vacation  SET  Date_Department = :time_Human WHERE id_vacation = :id");
    $up->bindParam(':time_Human',$data->date_new_1);
    $up->bindParam(':id',$data->id_up_1);
    $up->execute();

    $up = $database->prepare("UPDATE vacation SET Human_res = :Human_res   WHERE id_vacation = :id");
    $up->bindParam(':Human_res',$data->human_YN);
    $up->bindParam(':id',$data->id_up_1);
    $up->execute();
    $up = $database->prepare("UPDATE vacation  SET Date_Human_res = :Date_Human_res WHERE id_vacation = :id");
    $up->bindParam(':Date_Human_res',$data->date_new_1);
    $up->bindParam(':id',$data->id_up_1);
    $up->execute();
    //email 
    if($data->human_YN){
        require_once './phpmailer-master/mail.php';
        $mail->setFrom("alial778810@gmail.com","الموارد البشرية");
        $mail->addAddress($data->you_email_1);
        $mail->Subject ="الموارد البشرية";
        $mail->Body ='سلام عليكم استاذ  '.$data->name_user_1.' المدير القسم   '.$data->Department_YN.' و المدير الموارد البشرية    '.$data->human_YN.'  على  '.$data->type_request.' تاريخ تقديم الطلب   '.$data->data_user_1;
        $mail->send();
        
    }
   //human
if(isset($data->name_user_1) && isset($data->type_request) && isset($data->human_YN)){
    $manager = $database->prepare("INSERT INTO human(name_user,type_request,Director_Human,Date_Human_res,Date_request) VALUES(:name,:type,:Dir,:data,:new)");
    $manager->bindParam(':name',$data->name_user_1);
    $manager->bindParam(':type',$data->type_request);
    $manager->bindParam(':Dir',$data->human_YN);
    $manager->bindParam(':data',$data->date_new_1);
    $manager->bindParam(':new',$data->data_user_1);
    $manager->execute();
}
}
//DELETE human
if(isset($data->re_hu)){
    $re = $database->prepare("DELETE FROM human");
    $re->execute();
}

header('Content-Type: text/event-stream;charset=UTF-8');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// إرسال تحديثات إلى العميل كل 30 ثوانٍ
        $stmt = $database->prepare("SELECT * FROM vacation JOIN user ON user.id = vacation.id_user");
        $stmt->execute();
        $set_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stm = $database->prepare("SELECT * FROM time_vacation JOIN user ON user.id = time_vacation.id_user");
        $stm->execute();
        $set_time = $stm->fetchAll(PDO::FETCH_ASSOC);
        $manager_1 = $database->prepare("SELECT * FROM manager");
        $manager_1->execute();
        $manager_1= $manager_1->fetchAll(PDO::FETCH_ASSOC);
        $human_1 = $database->prepare("SELECT * FROM human");
        $human_1->execute();
        $human_1= $human_1->fetchAll(PDO::FETCH_ASSOC);
       
$print = [
    'user'=>$id_u,
    'Con' =>$Con_user,
    'vacation'=>$set_data,
    'time'=>$set_time,
    'request_boss'=>$request,
    'req'=>$req,
    'request_boss_time'=>$request_time,
    'req_time'=>$req_time,
    'manager'=>$manager_1,
    'request_human_time'=>$human_time,
    'h_time'=>$h_time,
    'human'=>$human_1,
    'request_human'=>$human,
    'h'=>$h,
];
print("data: " . json_encode($print) . "\n\n");
    ob_start();
    ob_flush();
    flush();
    //sleep(5);
?>