<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soe extends MY_Controller {
    
    function index() {
        $this->login();
        $this->resetpassword();
        $this->registration();
        $this->resendactivationcode();
        $this->activation();
        $this->notificationnewspromo();
        $this->notification();
        $this->notificationflag();
        $this->logout();
        $this->updateprofile();
        $this->changepassword();
        $this->updateprofilepicture();
        $this->portofolio();
        $this->portofoliodetail();
        
        $this->nusoap_server->service(file_get_contents("php://input"));
    }
    
    function login() {
        $this->nusoap_server->wsdl->addComplexType(
            'Login', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'fullName' => array('name' => 'fullName', 'type' => 'xsd:string'),
                'birthDate' => array('name' => 'birthDate', 'type' => 'xsd:string'),
                'gender' => array('name' => 'gender', 'type' => 'xsd:string'),
                'email' => array('name' => 'email', 'type' => 'xsd:string'),
                'address' => array('name' => 'address', 'type' => 'xsd:string'),
                'city' => array('name' => 'city', 'type' => 'xsd:string'),
                'province' => array('name' => 'province', 'type' => 'xsd:string'),
                'postalCode' => array('name' => 'postalCode', 'type' => 'xsd:string'),
                'phoneNumber' => array('name' => 'phoneNumber', 'type' => 'xsd:string'),
                'fax' => array('name' => 'fax', 'type' => 'xsd:string'),
                'clientID' => array('name' => 'clientID', 'type' => 'xsd:string'),
                'authkey' => array('name' => 'authkey', 'type' => 'xsd:string'),
                'userID' => array('name' => 'userID', 'type' => 'xsd:string'),
                'image' => array('name' => 'image', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('login', // Method Name
            array('userID' => 'xsd:string', 'password' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Login'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#login', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Login User' // Dokumentasi
        );

        function login($userid, $password, $lang) {
            $ci = &get_instance();
            $ci->load->helper('url');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $fullname = null;
            $birthdate = null;
            $gender = null;
            $email = null;
            $address = null;
            $city = null;
            $province = null;
            $postalcode = null;
            $phonenumber = null;
            $fax = null;
            $clientid = null;
            $authkey = null;
            $image = null;
            $filter = array('field'=>'username', 'value'=>strtolower(trim($userid)));
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['PASSWORD'] == $password) { // Jika password sama
                    if ($data['STATUS'] != '0' || $data['STATUS'] != 0) { // Jika user sudah melakukan aktivasi
                        $authkey = md5($data['FULLNAME'].time());

                        if ($ci->Muser->update_authkey($authkey, $data['USERNAME'], C_KD_APLIKASI_SOE)) { // Jika sukses memperbaharui authkey
                            $ci->Muser->update_lastlogin($data['USERNAME'], C_KD_APLIKASI_SOE);
                            $fullname = $data['FULLNAME'];
                            $birthdate = $data['BIRTHDATE'];
                            $gender = $data['SEX'];
                            $email = $data['EMAIL'];
                            $address = $data['ADDRESS'];
                            $city = $data['CITY'];
                            $province = $data['PROVINCE_ID'];
                            $postalcode = $data['ZIPCODE'];
                            $phonenumber = $data['PHONE'];
                            $fax = $data['FAX'];
                            $clientid = $data['NO_KLIEN'];
                            $image = base_url("assets/images/profile/$data[IMAGE]");

                            $status = 200;
                            $message = $ci->lang->line('success');
                        } else { // Jika gagal memperbaharui authkey
                            $status = 552;
                            $message = $ci->lang->line('error_login');
                        }
                    } else { // Jika user belum melakukan aktivasi
                        $status = 551;
                        $message = $ci->lang->line('unactivated_user');
                    }
                } else { // Jika password tidak sama
                    $status = 522;
                    $message = $ci->lang->line('error_login_password');
                }
            } else { // Jika user belum terdaftar
                $status = 522;
                $message = $ci->lang->line('error_login_userid');
            }

            return array(
                'status'=> $status,
                'message'=> $message,
                'fullName'=> $fullname,
                'birthDate'=> $birthdate,
                'gender'=> $gender,
                'email'=> $email,
                'address'=> $address,
                'city'=> $city,
                'province'=> $province,
                'postalCode'=> $postalcode,
                'phoneNumber'=> $phonenumber,
                'fax'=> $fax,
                'clientID'=> $clientid,
                'authkey'=> $authkey,
                'userID'=> $email,
                'image'=> $image
            );
        }
    }
    
    function resetpassword() {
        $this->nusoap_server->wsdl->addComplexType(
            'ResetPassword', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('resetpassword', // Method Name
            array('email' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ResetPassword'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#resetpassword', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Reset Password' // Dokumentasi
        );

        function resetpassword($email, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $email = strtolower(trim($email));
            $filter = array('field'=>'email', 'value'=>$email);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                $newpassword = strtoupper(substr(md5($data['USERNAME'].time()),3,6));

                if ($ci->Muser->update_password($filter, $newpassword, C_KD_APLIKASI_SOE)) { // Jika password berhasil diubah
                    $ci->load->library('email');
                    $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender_soe'));
                    $ci->email->to($email);
                    $ci->email->bcc('fendy@jiwasraya.co.id');
                    $ci->email->subject($ci->lang->line('subject_reset_password_soe'));
                    $ci->email->message($ci->lang->line('message_reset_password_soe')."<b>$newpassword</b>");

                    if ($ci->email->send()) { // Jika email berhasil dikirim
                        $status = 200;
                        $message = $ci->lang->line('success');
                    } else { // Jika email gagal dikirim
                        $status = 555;
                        $message = $ci->lang->line('error_reset_password');
                    }
                } else { // Jika password gagal diubah
                    $status = 555;
                    $message = $ci->lang->line('error_reset_password');
                }
            } else { // Jika user tidak ada di database
                $status = 526;
                $message = $ci->lang->line('unregistered_email');
            }

            return array(
                'status' => $status,
                'message' => $message
            );
        }
    }

    function registration() {
        $this->nusoap_server->wsdl->addComplexType(
            'Registration', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'AUTH_KEY' => array('name' => 'AUTH_KEY', 'type' => 'xsd:string'),
                'CONFIRM_ID' => array('name' => 'CONFIRM_ID', 'type' => 'xsd:string'),
                'EMAIL' => array('name' => 'EMAIL', 'type' => 'xsd:string'),
                'CLIENT_ID' => array('name' => 'CLIENT_ID', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('registration', // Method Name
            array('email' => 'xsd:string',
                'password' => 'xsd:string',
                'nik' => 'xsd:string',
                'fullname' => 'xsd:string',
                'birthdate' => 'xsd:string',
                'sex' => 'xsd:string',
                'address' => 'xsd:string',
                'city' => 'xsd:string',
                'provinceId' => 'xsd:string',
                'zipCode' => 'xsd:string',
                'phoneNumber' => 'xsd:string',
                'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Registration'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#registration', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Registration for new user' // Dokumentasi
        );

        function registration($email, $password, $nik, $fullname, $birthdate, $sex, $address, $city, $proviceid, $zipcode, $phonenumber, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->load->model('Mpolicy');
            $ci->load->model('Mmaster');
            $ci->changelanguage($lang);
            $email = strtolower(trim($email));
            $confirmid = strtoupper(substr(md5($email.time()),3,6));
            $authkey = md5($email.time());
            $filter = array('field'=>'username', 'value'=>$email);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $data2 = $ci->Mpolicy->get_peserta_by_email($email);

            if (count($data) <= 0) { // Jika username belum ada di database

                if (count($data2) > 0) { // Jika peserta ditemukan
                    
                    $i['username'] = $email;
                    $i['password'] = trim($password);
                    $i['fullname'] = trim($fullname);
                    $i['birthdate'] = trim($birthdate);
                    $i['sex'] = trim($sex);
                    $i['email'] = $email;
                    $i['address'] = trim($address);
                    $i['city'] = trim($city);
                    $i['province_id'] = trim($proviceid);
                    $i['zipcode'] = trim($zipcode);
                    $i['phone'] = trim($phonenumber);
                    $i['fax'] = null;
                    $i['status'] = 0;
                    $i['confirmid'] = $confirmid;
                    $i['no_klien'] = trim($nik);
                    $i['session_key'] = $authkey;
                    $i['auth_key'] = $authkey;
                    $i['kd_aplikasi'] = C_KD_APLIKASI_SOE;
                    
                    if ($ci->Muser->insert_user($i)) { // Jika berhasil disimpan ke database
                        // sms konfiguration
                        $message = str_replace('$pin', $confirmid, $ci->lang->line('sms_registration_soe'));
                        $sms = file_get_contents(C_URL_API_SMS."/otp.sms.php?nohp=".rawurlencode($phonenumber)."&msg=".rawurlencode($message)."&user=jiwasraya&pin=1212");

                        // email konfiguration
                        $ci->load->library('email');
                        $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender_soe'));
                        $ci->email->to($email);
                        $ci->email->bcc('fendy@jiwasraya.co.id');
                        $ci->email->subject($ci->lang->line('subject_registration_soe'));
                        $ci->email->message($ci->lang->line('message_registration_soe')."<b>$confirmid</b>");

                        if ($ci->email->send() || strpos($sms, 'SENT') !== false) { // Jika email / sms berhasil dikirim
                            $status = 200;
                            $message = $ci->lang->line('success');
                        } else {
                            $status = 200;
                            $message = $ci->lang->line('success'). " (2)";
                        }
                    } else { // Jika gagal disimpan ke database
                        $status = 500;
                        $message = $ci->lang->line('internal_server_error'). " (1)";
                    }
                } else { // Jika peserta tidak ditemukan
                    $status = 523;
                    $message = $ci->lang->line('invalid_email');
                }
            } else if (count($data) > 0) {
                if ($data['STATUS'] == '0' OR $data['STATUS'] == 0) { // Jika user belum melakukan aktivasi
                    $status = 551;
                    $message = $ci->lang->line('unactivated_user');
                } else { // Jika username sudah digunakan didatabase
                    $status = 525;
                    $message = $ci->lang->line('error_existing_user');
                }
            }

            return array(
                'status' => $status,
                'message' => $message,
                'AUTH_KEY' => $authkey,
                'CONFIRM_ID'=> $confirmid,
                'EMAIL'=> $email,
                'CLIENT_ID'=> $nik
            );

        }
    }

    function resendactivationcode() {
        $this->nusoap_server->wsdl->addComplexType(
            'ResendActivationCode', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('resendactivationcode', // Method Name
            array('email' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ResendActivationCode'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#resendactivationcode', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Resend Activation Code' // Dokumentasi
        );

        function resendactivationcode($email, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->load->model('Mmaster');
            $ci->changelanguage($lang);
            $email = strtolower(trim($email));
            $filter = array('field'=>'username', 'value'=>$email);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['EXPIRED']) {
                    $confirmid = strtoupper(substr(md5($data['USERNAME'].time()),3,6));
                } else {
                    $confirmid = $data['CONFIRMID'];
                }
 
                if ($data['STATUS'] == '0' || $data['STATUS'] == 0) { // Jika status user belum diaktivasi
                    if ($ci->Muser->update_confirmid($confirmid, $email, C_KD_APLIKASI_SOE)) { // Jika confirm id berhasil diubah
                        // sms konfiguration
                        $message = str_replace('$pin', $confirmid, $ci->lang->line('sms_registration_soe'));
                        $sms = file_get_contents(C_URL_API_SMS."/otp.sms.php?nohp=".rawurlencode($data['PHONE'])."&msg=".rawurlencode($message)."&user=jiwasraya&pin=1212");
                        
                        // email konfiguration
                        $ci->load->library('email');
                        $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender_soe'));
                        $ci->email->to($data['EMAIL']);
                        $ci->email->bcc('fendy@jiwasraya.co.id');
                        $ci->email->subject($ci->lang->line('subject_registration_soe'));
                        $ci->email->message($ci->lang->line('message_registration_soe')."<b>$confirmid</b>");
                        
                        if ($ci->email->send() || strpos($sms, 'SENT') !== false) { // Jika email / sms berhasil dikirim
                            $status = 200;
                            $message = $ci->lang->line('success');
                        } else {
                            $status = 200;
                            $message = $ci->lang->line('success'). " (2)";
                        }
                    } else { // Jika confirm id gagal diubah
                        $status = 550;
                        $message = $ci->lang->line('error_activation_reset_confirmid');
                    }
                } else { // Jika status user sudah diaktivasi
                    $status = 529;
                    $message = $ci->lang->line('error_activation_already_confirm');
                }
            } else { // Jika user tidak ada di database
                $status = 526;
                $message = $ci->lang->line('error_activation_unregistered_email_soe');
            }

            return array(
                'status'=> $status,
                'message'=> $message
            );
        }
    }
    
    function activation() {
        $this->nusoap_server->wsdl->addComplexType(
            'Activation', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('activation', // Method Name
            array('email' => 'xsd:string', 'code' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Activation'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#activation', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Registration Activation ' // Dokumentasi
        );

        function activation($email, $code, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $email = strtolower(trim($email));
            $filter = array('field'=>'username', 'value'=>$email);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['CONFIRMID'] == trim($code)) {
                    if ($data['STATUS'] == '0' || $data['STATUS'] == 0) { // Jika status user belum diaktivasi
                        if ($data['EXPIRED'] == '0' || $data['EXPIRED'] == 0) { // Jika kode aktivasi belum kadaluarsa
                            if ($ci->Muser->update_activate_user($email, C_KD_APLIKASI_SOE)) { // Jika berhasil melakukan aktivasi
                                $ci->load->library('email');
                                $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender_soe'));
                                $ci->email->to($data['EMAIL']);
                                $ci->email->bcc('fendy@jiwasraya.co.id');
                                $ci->email->subject($ci->lang->line('subject_activation_soe'));
                                $ci->email->message($ci->lang->line('message_activation_soe'));

                                if ($ci->email->send()) { // Jika email berhasil dikirim
                                    $status = 200;
                                    $message = $ci->lang->line('success');
                                } else { // Jika email gagal dikirim
                                    $status = 531;
                                    $message = $ci->lang->line('error_activation_user');
                                }
                            } else { // Jika gagal melakukan aktivasi
                                $status = 531;
                                $message = $ci->lang->line('error_activation_user');
                            }
                        } else { // Jika kode aktivasi telah kadaluarsa
                            $status = 533;
                            $message = $ci->lang->line('error_activation_expired_confirmid');
                        }
                    } else { // Jika status user sudah diaktivasi
                        $status = 529;
                        $message = $ci->lang->line('error_activation_already_confirm');
                    }
                } else {
                    $status = 532;
                    $message = $ci->lang->line('error_activation_confirmid');
                }
            } else { // Jika user tidak ada di database
                $status = 526;
                $message = $ci->lang->line('error_activation_unregistered_email_soe');
            }

            return array(
                'status'=> $status,
                'message'=> $message
            );
        }
    }
    
    function notificationnewspromo() {
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationNewsPromo', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:NotificationNewsPromoArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationNewsPromoArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:NotificationNewsPromoElement[]')
            ), // Attributes
            'tns:NotificationNewsPromoElement' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationNewsPromoElement', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'NOTIFICATION_ID' => array('name' => 'NOTIFICATION_ID', 'type' => 'xsd:string'),
                'NOTIFICATION_FROM' => array('name' => 'NOTIFICATION_FROM', 'type' => 'xsd:string'),
                'NOTIFICATION_TO' => array('name' => 'NOTIFICATION_TO', 'type' => 'xsd:string'),
                'NOTIFICATION_DATE' => array('name' => 'NOTIFICATION_DATE', 'type' => 'xsd:string'),
                'TITLE' => array('name' => 'TITLE', 'type' => 'xsd:string'),
                'MESSAGE' => array('name' => 'MESSAGE', 'type' => 'xsd:string'),
                'EXPIRED' => array('name' => 'TYPE', 'type' => 'xsd:string'),
                'TYPE' => array('name' => 'TYPE', 'type' => 'xsd:string'),
                'ISREAD' => array('name' => 'ISREAD', 'type' => 'xsd:string'),
                'CONTENT' => array('name' => 'CONTENT', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('notificationnewspromo', // Method Name
            array('langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:NotificationNewsPromo'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#notificationnewspromo', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Notification news & promo for common user' // Dokumentasi
        );

        function notificationnewspromo($lang) {
            $ci = &get_instance();
            $ci->load->model('Mmaster');
            $ci->changelanguage($lang);
            $data = $ci->Mmaster->get_list_public_notification($lang, C_KD_APLIKASI_SOE);

            return array(
                'status' => 200,
                'message' => $ci->lang->line('success'),
                'data' => $data
            );
        }
    }
    
    function notification() {
        $this->nusoap_server->wsdl->addComplexType(
            'Notification', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:NotificationArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:NotificationElement[]')
            ), // Attributes
            'tns:NotificationElement' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationElement', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'NOTIFICATION_ID' => array('name' => 'NOTIFICATION_ID', 'type' => 'xsd:string'),
                'NOTIFICATION_FROM' => array('name' => 'NOTIFICATION_FROM', 'type' => 'xsd:string'),
                'NOTIFICATION_TO' => array('name' => 'NOTIFICATION_TO', 'type' => 'xsd:string'),
                'NOTIFICATION_DATE' => array('name' => 'NOTIFICATION_DATE', 'type' => 'xsd:string'),
                'TITLE' => array('name' => 'TITLE', 'type' => 'xsd:string'),
                'MESSAGE' => array('name' => 'MESSAGE', 'type' => 'xsd:string'),
                'EXPIRED' => array('name' => 'TYPE', 'type' => 'xsd:string'),
                'TYPE' => array('name' => 'TYPE', 'type' => 'xsd:string'),
                'ISREAD' => array('name' => 'ISREAD', 'type' => 'xsd:string'),
                'CONTENT' => array('name' => 'CONTENT', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('notification', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Notification'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#notification', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Notification for login user' // Dokumentasi
        );

        function notification($clientid, $authkey, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mmaster');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2 = $ci->Mmaster->get_list_all_user_notification($lang, $clientid, C_KD_APLIKASI_SOE);

                    $status = 200;
                    $message = $ci->lang->line('success');
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_invalid_clientid');
            }

            return array(
                'status' => $status,
                'message' => $message,
                'data' => $data2
            );
        }
    }
    
    function notificationflag() {
        $this->nusoap_server->wsdl->addComplexType(
            'NotificationFlag', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('notificationflag', // Method Name
            array('clientID' => 'xsd:string', 'authkey' => 'xsd:string', 'notificationid' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:NotificationFlag'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#notificationflag', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Notification Flag' // Dokumentasi
        );

        function notificationflag($clientid, $authkey, $notificationid, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mmaster');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    if ($ci->Mmaster->update_notifikasi($clientid, $notificationid)) { // Jika berhasil menandai notifikasi
                        $status = 200;
                        $message = $ci->lang->line('success');
                    } else { // Jika gagal menandai notifikasi
                        $status = 534;
                        $message = $ci->lang->line('error_notification_mark_as_read');
                    }
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_invalid_clientid');
            }

            return array(
                'status' => $status,
                'message' => $message
            );
        }
    }
    
    function logout() {
        $this->nusoap_server->wsdl->addComplexType(
            'Logout', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('logout', // Method Name
            array('userID' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Logout'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#logout', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Logout' // Dokumentasi
        );

        function logout($userid, $lang) {
            $ci = &get_instance();
            $ci->load->helper('url');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $userid = strtolower(trim($userid));
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($ci->Muser->update_authkey('', $userid, C_KD_APLIKASI_SOE)) { // Jika sukses memperbaharui authkey
                    $status = 200;
                    $message = $ci->lang->line('success');
                } else { // Jika gagal memperbaharui authkey
                    $status = 552;
                    $message = $ci->lang->line('error_login');
                }
            } else { // Jika user belum terdaftar
                $status = 522;
                $message = $ci->lang->line('error_login_userid');
            }

            return array(
                'status' => $status,
                'message' => $message
            );
        }
    }
    
    function updateprofile() {
        $this->nusoap_server->wsdl->addComplexType(
            'UpdateProfile', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('updateprofile', // Method Name
            array('userID' => 'xsd:string', 'fullName' => 'xsd:string', 'birthDate' => 'xsd:string', 'gender' => 'xsd:string', 'address' => 'xsd:string', 'city' => 'xsd:string', 'province' => 'xsd:string', 'postalCode' => 'xsd:string', 'phoneNumber' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:UpdateProfile'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#updateprofile', // Soap Action
            'rpc', // Style
            'encoded', // User
            'UpdateProfile' // Dokumentasi
        );

        function updateprofile($userid, $fullname, $birthdate, $gender, $address, $city, $province, $postalcode, $phonenumber, $authkey, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mmaster');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $i['fullname'] = trim($fullname);
                    $i['birthdate'] = trim($birthdate);
                    $i['sex'] = $gender;
                    $i['address'] = trim($address);
                    $i['city'] = trim($city);
                    $i['province_id'] = $province;
                    $i['zipcode'] = $postalcode;
                    $i['phone'] = $phonenumber;

                    if ($ci->Muser->update_user($i, $userid, C_KD_APLIKASI_SOE)) {
                        $status = 200;
                        $message = $ci->lang->line('success');
                    } else {
                        $status = 556;
                        $message = $ci->lang->line('error_update_user');
                    }
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_invalid_clientid');
            }

            return array(
                'status' => $status,
                'message' => $message
            );
        }
    }

    function changepassword() {
        $this->nusoap_server->wsdl->addComplexType(
            'ChangePassword', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('changepassword', // Method Name
            array('password' => 'xsd:string', 'newPassword' => 'xsd:string', 'authkey' => 'xsd:string', 'userID' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ChangePassword'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#changepassword', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Change Password' // Dokumentasi
        );

        function changepassword($oldpassword, $newpassword, $authkey, $userid, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['PASSWORD'] == $oldpassword) { // Jika password database sama dengan yang diinput
                    if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                        if (strlen($newpassword) > 3) { // Jika password lebih besar dari 3 alpanumerik
                            if ($ci->Muser->update_password($filter, $newpassword, C_KD_APLIKASI_SOE)) { // Jika password berhasil diubah
                                $ci->load->library('email');
                                $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender'));
                                $ci->email->to($data['EMAIL']);
                                $ci->email->bcc('fendy@jiwasraya.co.id');
                                $ci->email->subject($ci->lang->line('subject_change_password'));
                                $ci->email->message($ci->lang->line('message_change_password')."<b>".$newpassword."</b>");

                                if ($ci->email->send()) { // Jika email berhasil dikirim
                                    $status = 200;
                                    $message = $ci->lang->line('success');
                                } else { // Jika email gagal dikirim
                                    $status = 555;
                                    $message = $ci->lang->line('error_reset_password');
                                }
                            } else { // Jika password gagal di ubah
                                $status = 555;
                                $message = $ci->lang->line('error_reset_password');
                            }
                        } else { // Jika password kurang dari sama dengan 3 alpanumerik
                            $status = 535;
                            $message = $ci->lang->line('error_change_password');
                        }
                    } else { // Jika authkey tidak sama
                        $status = 527;
                        $message = $ci->lang->line('error_invalid_authkey');
                    }
                } else { // Jika password berbeda dengan yang ada didatabase
                    $status = 522;
                    $message = $ci->lang->line('error_login_password');
                }
            } else { // Jika user tidak ada di database
                $status = 522;
                $message = $ci->lang->line('error_login_userid');
            }

            return array(
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }

    function updateprofilepicture() {
        $this->nusoap_server->wsdl->addComplexType(
            'UpdateImage', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'message', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('updateimage', // Method Name
            array('userID' => 'xsd:string', 'authkey' => 'xsd:string', 'image' => 'xsd:string', 'mime' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:UpdateImage'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#updateimage', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Update Image' // Dokumentasi
        );

        function updateimage($userid, $authkey, $image, $mime, $lang) {
            $ci = &get_instance();
            $ci->load->helper('url');
            $ci->load->model('Mmaster');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $imageurl = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $path = C_IMAGES."profile/";
                    $ext = str_replace("image/", "", $mime);
                    $namaimage = $userid."-".time().".".$ext;

                    $ifp = fopen($path.$namaimage, "wb");
                    $fwrite = fwrite($ifp, base64_decode($image));
                    fclose($ifp);

                    if ($fwrite && $ci->Muser->update_profile_picture($namaimage, $userid, C_KD_APLIKASI_SOE)) { // Jika gambar berhasil diupload dan disimpan ke database
                        if (file_exists($path.$data['IMAGE'])) { // Jika gambar lama masih ada
                            unlink($path.$data['IMAGE']);
                        }

                        $imageurl = base_url("assets/images/profile/$namaimage");
                        $status = 200;
                        $message = $ci->lang->line('success');
                    } else { // Jika gagal diupload dan disimpan ke database
                        $status = 536;
                        $message = $ci->lang->line('error_upload_profile_picture');
                    }
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_invalid_clientid');
            }

            return array(
                'status' => $status,
                'message' => $message,
                'data' => $imageurl
            );
        }
    }

    function portofolio() {
        $this->nusoap_server->wsdl->addComplexType(
            'Portofolio', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:PortofolioArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PortofolioArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:PortofolioElement[]')
            ), // Attributes
            'tns:PortofolioElement' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PortofolioElement', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'POLICY_PRODUCT' => array('name' => 'POLICY_PRODUCT', 'type' => 'xsd:string'),
                'POLICY_PRODUCT_DESCRIPTION' => array('name' => 'POLICY_PRODUCT_DESCRIPTION', 'type' => 'xsd:string'),
                'POLICY_NUMBER' => array('name' => 'POLICY_NUMBER', 'type' => 'xsd:string'),
                'POLICY_NAME' => array('name' => 'POLICY_NAME', 'type' => 'xsd:string'),
                'START_DATE' => array('name' => 'START_DATE', 'type' => 'xsd:string'),
                'END_DATE' => array('name' => 'END_DATE', 'type' => 'xsd:string'),
                'CERTIFICATE_NUMBER' => array('name' => 'CERTIFICATE_NUMBER', 'type' => 'xsd:string'),
                'CLIENT_NUMBER' => array('name' => 'CLIENT_NUMBER', 'type' => 'xsd:string'),
                'PARTICIPANT_NAME' => array('name' => 'PARTICIPANT_NAME', 'type' => 'xsd:string'),
                'CERTIFICATE_STATUS' => array('name' => 'CERTIFICATE_STATUS', 'type' => 'xsd:string'),
                'PRODUCT_CODE' => array('name' => 'PRODUCT_CODE', 'type' => 'xsd:string'),
            ) // Element
        );

        $this->nusoap_server->register('portofolio', // Method Name
            array('userID' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Portofolio'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#portofolio', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Portofolio user' // Dokumentasi
        );

        function portofolio($userid, $authkey, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2 = $ci->Mpolicy->get_list_sertifikat_soe_by_email($userid);

                    $status = 200;
                    $message = $ci->lang->line('success');
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_login_userid');
            }

            return array(
                'status' => $status,
                'message' => $message,
                'data' => $data2
            );
        }
    }
    
    function portofoliodetail() {
        $this->nusoap_server->wsdl->addComplexType(
            'PortofolioDetail', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:PortofolioDetailData')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PortofolioDetailData', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'POLICY_DETAILS' => array('name' => 'POLICY_DETAILS', 'type' => 'tns:PolicyDetails'),
                'SURRENDER_VALUE' => array('name' => 'SURRENDER_VALUE', 'type' => 'tns:SurrenderValue'),
                'PAYMENT_HISTORY' => array('name' => 'PAYMENT_HISTORY', 'type' => 'tns:PaymentHistoryArray')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PolicyDetails', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'POLICY_NUMBER' => array('name' => 'POLICY_NUMBER', 'type' => 'xsd:string'),
                'POLICY_NAME' => array('name' => 'POLICY_NAME', 'type' => 'xsd:string'),
                'PAYMENT_METHOD' => array('name' => 'PAYMENT_METHOD', 'type' => 'xsd:string'),
                'CURRENCY' => array('name' => 'CURRENCY', 'type' => 'xsd:string'),
                'POLICY_PRODUCT' => array('name' => 'POLICY_PRODUCT', 'type' => 'xsd:string'),
                'POLICY_PRODUCT_DESCRIPTION' => array('name' => 'POLICY_PRODUCT_DESCRIPTION', 'type' => 'xsd:string'),
                'CERTIFICATE_NUMBER' => array('name' => 'CERTIFICATE_NUMBER', 'type' => 'xsd:string'),
                'PARTICIPANT_NUMBER' => array('name' => 'PARTICIPANT_NUMBER', 'type' => 'xsd:string'),
                'PARTICIPANT_NAME' => array('name' => 'PARTICIPANT_NAME', 'type' => 'xsd:string'),
                'START_DATE' => array('name' => 'START_DATE', 'type' => 'xsd:string'),
                'END_DATE' => array('name' => 'END_DATE', 'type' => 'xsd:string'),
                'PARTICIPANT_STATUS' => array('name' => 'PARTICIPANT_STATUS', 'type' => 'xsd:string'),
                'BIRTHDATE' => array('name' => 'BIRTHDATE', 'type' => 'xsd:string'),
                'EMAIL' => array('name' => 'EMAIL', 'type' => 'xsd:string'),
                'EMPLOYEE_ID' => array('name' => 'EMPLOYEE_ID', 'type' => 'xsd:string'),
                'NOTATION' => array('name' => 'NOTATION', 'type' => 'xsd:string'),
                'MOBILE_NUMBER' => array('name' => 'MOBILE_NUMBER', 'type' => 'xsd:string')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'SurrenderValue', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'SUM_ASSURED' => array('name' => 'SUM_ASSURED', 'type' => 'xsd:string'),
                'SUM_SURRENDERED' => array('name' => 'SUM_SURRENDERED', 'type' => 'xsd:string')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PaymentHistoryArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:PaymentHistory[]')
            ), // Attributes
            'tns:PaymentHistory' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PaymentHistory', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'BILLING_DATE' => array('name' => 'BILLING_DATE', 'type' => 'xsd:string'),
                'PAYMENT_DATE' => array('name' => 'PAYMENT_DATE', 'type' => 'xsd:string'),
                'SEATLED_DATE' => array('name' => 'SEATLED_DATE', 'type' => 'xsd:string'),
                'PREMIUM' => array('name' => 'PREMIUM', 'type' => 'xsd:string'),
                'RECEIPT_CODE' => array('name' => 'RECEIPT_CODE', 'type' => 'xsd:string'),
                'RECEIPT_NAME' => array('name' => 'RECEIPT_NAME', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('portofoliodetail', // Method Name
            array('userID' => 'xsd:string', 'authKey' => 'xsd:string', 'productCode' => 'xsd:string', 'policyNumber' => 'xsd:string', 'clientNumber' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:PortofolioDetail'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#portofoliodetail', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Portofolio Detail' // Dokumentasi
        );

        function portofoliodetail($userid, $authkey, $productcode, $policynumber, $noklien, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $policynumber = trim($policynumber);
            $noklien = trim($noklien);
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI_SOE, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2['POLICY_DETAILS'] = $ci->Mpolicy->get_polis_soe_by_no_polis_no_klien($policynumber, $noklien, $productcode);
                    $data2['SURRENDER_VALUE'] = $ci->Mpolicy->get_ua_nt_soe_by_no_polis_no_klien($policynumber, $noklien, $productcode);
                    $data2['PAYMENT_HISTORY'] = $ci->Mpolicy->get_list_historis_soe_premi_polis($policynumber, $noklien, $productcode);

                    $status = 200;
                    $message = $ci->lang->line('success');
                } else { // Jika authkey tidak sama
                    $status = 527;
                    $message = $ci->lang->line('error_invalid_authkey');
                }
            } else { // Jika user tidak ada di database
                $status = 533;
                $message = $ci->lang->line('error_login_userid');
            }

            return array(
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }
}