<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends MY_Controller {

    function index() {
        $this->notificationnewspromo();
        $this->netassetvalue();
        $this->resetpassword();
        $this->registration();
        $this->resendactivationcode();
        $this->activation();
        $this->login();
        $this->logout();
        $this->updateprofile();
        $this->updateprofilepicture();
        $this->changepassword();
        $this->notification();
        $this->notificationflag();
        $this->portofolio();
        $this->portofoliodetail();
        $this->restofunit();
        $this->redemption();
        $this->redemptionstatus();
        $this->product();
        $this->provider();
        $this->providertype();

        $this->nusoap_server->service(file_get_contents("php://input"));
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
            $data = $ci->Mmaster->get_list_public_notification($lang, C_KD_APLIKASI);

            return array(
                'status' => 200,
                'message' => $ci->lang->line('success'),
                'data' => $data
            );
        }
    }

    function netassetvalue() {
        $this->nusoap_server->wsdl->addComplexType(
            'Nav', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:NavData')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NavData', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'exchangeTransaction' => array('exchangeTransaction' => 'status', 'type' => 'tns:NavArray'),
                'jsFixed' => array('jsFixed' => 'status', 'type' => 'tns:NavElement'),
                'sellingRates' => array('sellingRates' => 'status', 'type' => 'tns:NavArray'),
                'buyingRates' => array('buyingRates' => 'status', 'type' => 'tns:NavArray'),
                'exchangeTransactionNew' => array('exchangeTransactionNew' => 'status', 'type' => 'tns:NavArrayNew')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NavArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:NavElement[]')
            ), // Attributes
            'tns:NavElement' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NavElement', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'TGLBERLAKU' => array('name' => 'TGLBERLAKU', 'type' => 'xsd:string'),
                'KURS' => array('name' => 'KURS', 'type' => 'xsd:string'),
                'VALUTA' => array('name' => 'VALUTA', 'type' => 'xsd:string')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NavArrayNew', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array( // Attributes
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:NavElementNew[]')
            ),
            'tns:NavElementNew' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'NavElementNew', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'TGLBERLAKU' => array('name' => 'TGLBERLAKU', 'type' => 'xsd:string'),
                'KURS' => array('name' => 'KURS', 'type' => 'xsd:string'),
                'KODE_FUND' => array('name' => 'KODE_FUND', 'type' => 'xsd:string'),
                'VALUTA' => array('name' => 'VALUTA', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('nav', // Method Name
            array('langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Nav'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#nav', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Net Asset Value / Nilai Aktiva Bersih' // Dokumentasi
        );

        function nav($lang) {
            $ci = &get_instance();
            $ci->changelanguage($lang);
            $data['exchangeTransaction'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=1"), true);
            $data['jsFixed'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=2"), true);
            $data['sellingRates'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=3"), true);
            $data['buyingRates'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=4"), true);
            $data['exchangeTransactionNew'] = json_decode(file_get_contents(C_URL_API_JAIM."/dashboard.php?r=5"), true);

            return array(
                'status' => 200,
                'message' => $ci->lang->line('success'),
                'data' => $data
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                $newpassword = strtoupper(substr(md5($data['USERNAME'].time()),3,6));

                if ($ci->Muser->update_password($filter, $newpassword, C_KD_APLIKASI)) { // Jika password berhasil diubah
                    $ci->load->library('email');
                    $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender'));
                    $ci->email->to($email);
                    $ci->email->bcc('fendy@jiwasraya.co.id');
                    $ci->email->subject($ci->lang->line('subject_reset_password'));
                    $ci->email->message($ci->lang->line('message_reset_password')."<b>$newpassword</b>");

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
                'USER_ID' => array('name' => 'USER_ID', 'type' => 'xsd:string'),
                'CLIENT_ID' => array('name' => 'CLIENT_ID', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('registration', // Method Name
            array('userID' => 'xsd:string',
                'password' => 'xsd:string',
                'email' => 'xsd:string',
                'phoneNumber' => 'xsd:string',
                'policyNumber' => 'xsd:string',
                'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Registration'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#registration', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Registration for new user' // Dokumentasi
        );

        function registration($userid, $password, $email, $phonenumber, $policynumber, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->load->model('Mpolicy');
            $ci->load->model('Mmaster');
            $ci->changelanguage($lang);
            $userid = strtolower(trim($userid));
            $confirmid = strtoupper(substr(md5($phonenumber.time()),3,6));
            $authkey = md5($phonenumber.time());
            $filter = array('field'=>'username', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $prefix = strtoupper(substr(trim($policynumber), 0, 2));
            $noper = substr(trim($policynumber), 2, 9);
            $data2 = $ci->Mpolicy->get_tertanggung_by_polis($prefix, $noper);
            $notertanggung = count($data2) > 0 ? $data2['NOTERTANGGUNG'] : null;
            $email_ = null;

            if (count($data) <= 0) { // Jika username belum ada di database

                if (count($data2) > 0) { // Jika polis ditemukan
                    $email = trim($email);
                    $email_ = $data2['EMAIL'];
                    $phonenumber = trim($phonenumber);
                    $data3 = $ci->Muser->get_user(C_KD_APLIKASI, array('field'=>'no_klien', 'value'=>$data2['NOKLIEN']));

                    if (count($data3) == 0) { // Jika no klien belum pernah digunakan pendaftaran
                        //if (strlen($data2['EMAIL']) > 0 && $data2['EMAIL'] == $email || $data2['NOHP'] == $phonenumber) {
                        if ((strlen($data2['NOHP']) > 0 && $data2['NOHP'] == $phonenumber) || $data2['EMAIL'] == $email) { // Jika nomor hp/email sama antara yang diinput dengan di database
                            $i['username'] = $userid;
                            $i['password'] = $password;
                            $i['fullname'] = $data2['NAMALENGKAP'];
                            $i['birthdate'] = $data2['TGLLAHIR'];
                            $i['sex'] = $data2['JENISKELAMIN'];
                            $i['email'] = $email;
                            $i['address'] = $data2['ALAMAT'];
                            $i['city'] = $data2['KDKOTA'];
                            $i['province_id'] = $data2['KDPROPINSI'];
                            $i['zipcode'] = $data2['KDPOS'];
                            $i['phone'] = $phonenumber;
                            $i['fax'] = $data2['FAX'];
                            $i['status'] = 0;
                            $i['confirmid'] = $confirmid;
                            $i['no_klien'] = $data2['NOTERTANGGUNG'];
                            $i['session_key'] = $authkey;
                            $i['auth_key'] = $authkey;
                            $i['kd_aplikasi'] = C_KD_APLIKASI;

                            if ($ci->Muser->insert_user($i)) { // Jika berhasil disimpan ke database
                                // sms konfiguration
                                $message = str_replace('$pin', $confirmid, $ci->lang->line('sms_registration'));
                                $sms = file_get_contents(C_URL_API_SMS."/otp.sms.php?nohp=".rawurlencode($phonenumber)."&msg=".rawurlencode($message)."&user=jiwasraya&pin=1212");
                                
                                // email konfiguration
                                $ci->load->library('email');
                                $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender'));
                                $ci->email->to($email);
                                $ci->email->bcc('fendy@jiwasraya.co.id');
                                $ci->email->subject($ci->lang->line('subject_registration'));
                                $ci->email->message($ci->lang->line('message_registration')."<b>$confirmid</b>");
                                
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
                            
                            
                        } else if (strlen($data2['NOHP']) == 0) { // Jika no handphone di jlindo kosong
                            $status = 557;
                            $message = $ci->lang->line('error_empty_hp_jlindo');
                        } else if ($data2['NOHP'] != $phonenumber) { // Jika no handphone di jlindo tidak sama dengan yang didaftarkan
                            $status = 557;
                            $message = $ci->lang->line('error_hp_not_same');
                        } else if (strlen($data2['EMAIL']) == 0) { // Jika email di jlindo kosong
                            $status = 554;
                            $message = $ci->lang->line('error_empty_email_jlindo');
                        } else { // Jika email di jlindo tidak sama dengan email yang didaftarkan
                            $status = 554;
                            $message = $ci->lang->line('error_email_not_same');
                        }
                    } else { // Jika no klien sudah pernah digunakan pendaftaran
                        $status = 558;
                        $message = $ci->lang->line('error_duplikat_client');
                    }
                } else { // Jika polis tidak ditemukan
                    $status = 523;
                    $message = $ci->lang->line('invalid_policy_number');
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
                'EMAIL'=> $email_,
                'USER_ID'=> $userid,
                'CLIENT_ID'=> $notertanggung
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
            array('userID' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ResendActivationCode'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#resendactivationcode', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Resend Activation Code' // Dokumentasi
        );

        function resendactivationcode($username, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->load->model('Mmaster');
            $ci->changelanguage($lang);
            $username = strtolower(trim($username));
            $filter = array('field'=>'username', 'value'=>$username);
            $filter2 = array('field'=>'email', 'value'=>$username);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter, $filter2);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['EXPIRED']) {
                    $confirmid = strtoupper(substr(md5($data['USERNAME'].time()),3,6));
                } else {
                    $confirmid = $data['CONFIRMID'];
                }
 
                if ($data['STATUS'] == '0' || $data['STATUS'] == 0) { // Jika status user belum diaktivasi
                    if ($ci->Muser->update_confirmid($confirmid, $username, C_KD_APLIKASI)) { // Jika confirm id berhasil diubah
                        // sms konfiguration
                        $message = str_replace('$pin', $confirmid, $ci->lang->line('sms_registration'));
                        $sms = file_get_contents(C_URL_API_SMS."/otp.sms.php?nohp=".rawurlencode($data['PHONE'])."&msg=".rawurlencode($message)."&user=jiwasraya&pin=1212");
                        
                        // email konfiguration
                        $ci->load->library('email');
                        $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender'));
                        $ci->email->to($data['EMAIL']);
                        $ci->email->bcc('fendy@jiwasraya.co.id');
                        $ci->email->subject($ci->lang->line('subject_registration'));
                        $ci->email->message($ci->lang->line('message_registration')."<b>$confirmid</b>");
                        
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
                $message = $ci->lang->line('error_activation_unregistered_username');
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
            array('userID' => 'xsd:string', 'code' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:Activation'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#activation', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Registration Activation ' // Dokumentasi
        );

        function activation($username, $confirmid, $lang) {
            $ci = &get_instance();
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $username = strtolower(trim($username));
            $filter = array('field'=>'username', 'value'=>$username);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['CONFIRMID'] == trim($confirmid)) {
                    if ($data['STATUS'] == '0' || $data['STATUS'] == 0) { // Jika status user belum diaktivasi
                        if ($data['EXPIRED'] == '0' || $data['EXPIRED'] == 0) { // Jika kode aktivasi belum kadaluarsa
                            if ($ci->Muser->update_activate_user($username, C_KD_APLIKASI)) { // Jika berhasil melakukan aktivasi
                                $ci->load->library('email');
                                $ci->email->from('member.admin@jiwasraya.co.id', $ci->lang->line('from_sender'));
                                $ci->email->to($data['EMAIL']);
                                $ci->email->bcc('fendy@jiwasraya.co.id');
                                $ci->email->subject($ci->lang->line('subject_activation'));
                                $ci->email->message($ci->lang->line('message_activation'));

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
                $message = $ci->lang->line('error_activation_unregistered_username');
            }

            return array(
                'status'=> $status,
                'message'=> $message
            );
        }
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
            $userid = strtolower(trim($userid));
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
            $filter = array('field'=>'username', 'value'=>$userid);
            $filter2 = array('field'=>'email', 'value'=>$userid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter,$filter2);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['PASSWORD'] == $password) { // Jika password sama
                    if ($data['STATUS'] != '0' || $data['STATUS'] != 0) { // Jika user sudah melakukan aktivasi
                        $authkey = md5($data['FULLNAME'].time());

                        if ($ci->Muser->update_authkey($authkey, $data['USERNAME'], C_KD_APLIKASI)) { // Jika sukses memperbaharui authkey
                            $ci->Muser->update_lastlogin($data['USERNAME'], C_KD_APLIKASI);
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
                'image'=> $image
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($ci->Muser->update_authkey('', $userid, C_KD_APLIKASI)) { // Jika sukses memperbaharui authkey
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

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

                    if ($ci->Muser->update_user($i, $userid, C_KD_APLIKASI)) {
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $imageurl = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $path = C_IMAGES."profile/";
                    $ext = str_replace("image/", "", $mime);
                    $namaimage = $userid."-".time().".".$ext;

                    $ifp = fopen($path.$namaimage, "wb");
                    $fwrite = fwrite($ifp, base64_decode($image));
                    fclose($ifp);

                    if ($fwrite && $ci->Muser->update_profile_picture($namaimage, $userid, C_KD_APLIKASI)) { // Jika gambar berhasil diupload dan disimpan ke database
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['PASSWORD'] == $oldpassword) { // Jika password database sama dengan yang diinput
                    if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                        if (strlen($newpassword) > 3) { // Jika password lebih besar dari 3 alpanumerik
                            if ($ci->Muser->update_password($filter, $newpassword, C_KD_APLIKASI)) { // Jika password berhasil diubah
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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2 = $ci->Mmaster->get_list_all_user_notification($lang, $clientid, C_KD_APLIKASI);

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
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

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

    function portofolio() {
        $this->nusoap_server->wsdl->addComplexType(
            'PolicyList', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:PolicyArray')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PolicyArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Policy[]')
            ), // Attributes
            'tns:Policy' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Policy', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'POLICY_NAME' => array('name' => 'POLICY_NAME', 'type' => 'xsd:string'),
                'POLICY_NUMBER' => array('name' => 'POLICY_NUMBER', 'type' => 'xsd:string'),
                'START_DATE' => array('name' => 'START_DATE', 'type' => 'xsd:string'),
                'DUE_DATE' => array('name' => 'DUE_DATE', 'type' => 'xsd:string'),
                'POLICY_STATUS_CODE' => array('name' => 'POLICY_STATUS_CODE', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('policylist', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:PolicyList'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#policylist', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Policy List' // Dokumentasi
        );

        function policylist($clientid, $authkey, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2 = $ci->Mpolicy->get_list_polis_by_noklien($clientid);
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
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }

    function portofoliodetail() {
        $this->nusoap_server->wsdl->addComplexType(
            'PolicyDetail', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:PolicyDetailData')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'PolicyDetailData', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'POLICY_DETAILS' => array('name' => 'POLICY_DETAILS', 'type' => 'tns:PolicyDetails'),
                'COVERAGE' => array('name' => 'COVERAGE', 'type' => 'tns:CoverageArray'),
                'SURRENDER_VALUE' => array('name' => 'SURRENDER_VALUE', 'type' => 'tns:SurrenderValueArray'),
                'BENEFICIARY' => array('name' => 'BENEFICIARY', 'type' => 'tns:BeneficiaryArray'),
                'PAYMENT_HISTORY' => array('name' => 'PAYMENT_HISTORY', 'type' => 'tns:PaymentHistoryArray'),
                'UL_TRANSACTION' => array('name' => 'UL_TRANSACTION', 'type' => 'tns:UlTransactionArray')
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
                'APPLICATION_NUMBER' => array('name' => 'APPLICATION_NUMBER', 'type' => 'xsd:string'),
                'APPLICATION_DATE' => array('name' => 'APPLICATION_DATE', 'type' => 'xsd:string'),
                'POLICY_NAME' => array('name' => 'POLICY_NAME', 'type' => 'xsd:string'),
                'ENTRY_AGE' => array('name' => 'ENTRY_AGE', 'type' => 'xsd:string'),
                'START_DATE' => array('name' => 'START_DATE', 'type' => 'xsd:string'),
                'DUE_DATE' => array('name' => 'DUE_DATE', 'type' => 'xsd:string'),
                'DURATION' => array('name' => 'DURATION', 'type' => 'xsd:string'),
                'PAYMENT_DURATION' => array('name' => 'PAYMENT_DURATION', 'type' => 'xsd:string'),
                'PAYMENT_METHOD' => array('name' => 'PAYMENT_METHOD', 'type' => 'xsd:string'),
                'AUTODEBET' => array('name' => 'AUTODEBET', 'type' => 'xsd:string'),
                'CURRENCY' => array('name' => 'CURRENCY', 'type' => 'xsd:string'),
                'INITIAL_INDEX' => array('name' => 'INITIAL_INDEX', 'type' => 'xsd:string'),
                'MEDICAL_STATUS' => array('name' => 'MEDICAL_STATUS', 'type' => 'xsd:string'),
                'SUM_ASSURED' => array('name' => 'SUM_ASSURED', 'type' => 'xsd:string'),
                'STANDARD_PREMIUM' => array('name' => 'STANDARD_PREMIUM', 'type' => 'xsd:string'),
                'PREMIUM_FIRST_5_YEARS' => array('name' => 'PREMIUM_FIRST_5_YEARS', 'type' => 'xsd:string'),
                'PREMIUM_AFTER_5_YEARS' => array('name' => 'PREMIUM_AFTER_5_YEARS', 'type' => 'xsd:string'),
                'PREMIUM_DUE_DATE' => array('name' => 'PREMIUM_DUE_DATE', 'type' => 'xsd:string'),
                'AGENT' => array('name' => 'AGENT', 'type' => 'xsd:string'),
                'BILLER' => array('name' => 'BILLER', 'type' => 'xsd:string'),
                'POLICY_STATUS' => array('name' => 'POLICY_STATUS', 'type' => 'xsd:string'),
                'POLICY_STATUS_CODE' => array('name' => 'POLICY_STATUS_CODE', 'type' => 'xsd:string'),
                'NOTATION' => array('name' => 'NOTATION', 'type' => 'xsd:string')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'CoverageArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Coverage[]')
            ), // Attributes
            'tns:Coverage' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Coverage', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array (
                'BENEFIT_NAME' => array('name' => 'BENEFIT_NAME', 'type' => 'xsd:string'),
                'AMOUNT' => array('name' => 'AMOUNT', 'type' => 'xsd:string'),
                'DUE_DATE' => array('name' => 'DUE_DATE', 'type' => 'xsd:string'),
                'PREMIUM' => array('name' => 'PREMIUM', 'type' => 'xsd:string')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'SurrenderValueArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:SurrenderValue[]')
            ), // Attributes
            'tns:SurrenderValue' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'SurrenderValue', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'NO' => array('name' => 'NO', 'type' => 'xsd:string'),
                'AMOUNT' => array('name' => 'AMOUNT', 'type' => 'xsd:string')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'BeneficiaryArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Beneficiary[]')
            ), // Attributes
            'tns:Beneficiary'// Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Beneficiary', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'BENEFICIARY_NAME' => array('name' => 'BENEFICIARY_NAME', 'type' => 'xsd:string'),
                'RELATIONSHIP' => array('name' => 'RELATIONSHIP', 'type' => 'xsd:string')
            ) // Element
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
                'BOOKED_DATE' => array('name' => 'BOOKED_DATE', 'type' => 'xsd:string'),
                'SEATLED_DATE' => array('name' => 'SEATLED_DATE', 'type' => 'xsd:string'),
                'PAYMENT_DATE' => array('name' => 'PAYMENT_DATE', 'type' => 'xsd:string'),
                'PREMIUM' => array('name' => 'PREMIUM', 'type' => 'xsd:string'),
                'CURRENCY' => array('name' => 'CURRENCY', 'type' => 'xsd:string')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'UlTransactionArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:UlTransaction[]')
            ), // Attributes
            'tns:UlTransaction' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'UlTransaction', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'NOMOR_POLIS' => array('name' => 'NOMOR_POLIS', 'type' => 'xsd:string'),
                'KDFUND' => array('name' => 'KDFUND', 'type' => 'xsd:string'),
                'FUND_ALLOCATION' => array('name' => 'FUND_ALLOCATION', 'type' => 'xsd:string'),
                'BALANCE' => array('name' => 'BALANCE', 'type' => 'xsd:string'),
                'NAVSELL' => array('name' => 'NAVSELL', 'type' => 'xsd:string'),
                'AMOUNT' => array('name' => 'AMOUNT', 'type' => 'xsd:string'),
                'DATA' => array('name' => 'DATA', 'type' => 'tns:TransactionDataArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'TransactionDataArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:TransactionData[]')
            ), // Attributes
            'tns:TransactionData' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'TransactionData', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'TRANSACTION_DATE' => array('name' => 'TRANSACTION_DATE', 'type' => 'xsd:string'),
                'TRX_TYPE' => array('name' => 'TRX_TYPE', 'type' => 'xsd:string'),
                'AMOUNT' => array('name' => 'AMOUNT', 'type' => 'xsd:string'),
                'NET_ASSET_VALUE' => array('name' => 'NET_ASSET_VALUE', 'type' => 'xsd:string'),
                'UNIT' => array('name' => 'UNIT', 'type' => 'xsd:string'),
                'STATUS' => array('name' => 'STATUS', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('policydetail', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'policyNumber' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:PolicyDetail'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#plandetail', // Soap Action
            'rpc', // Style
            'encoded', // User
            'PlanDetail' // Dokumentasi
        );

        function policydetail($clientid, $authkey, $policynumber, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $prefix = strtoupper(substr(trim($policynumber), 0, 2));
            $noper = substr(trim($policynumber), 2, 9);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $dataul = $ci->Mpolicy->get_list_transaksi_jslink($prefix, $noper);

                    $data2['POLICY_DETAILS'] = $ci->Mpolicy->get_polis_by_no_polis($prefix, $noper);
                    $data2['COVERAGE'] = $ci->Mpolicy->get_list_benefit_polis($prefix, $noper);
                    $data2['SURRENDER_VALUE'] = $ci->Mpolicy->get_list_nilai_tebus_polis($prefix, $noper);
                    $data2['BENEFICIARY'] = $ci->Mpolicy->get_list_ahliwaris_polis($prefix, $noper);
                    $data2['PAYMENT_HISTORY'] = $ci->Mpolicy->get_list_historis_premi_polis($prefix, $noper);
                    $data2['UL_TRANSACTION'] = count($dataul) > 0 ? $dataul : json_decode(file_get_contents(C_URL_API_JSMOBILE."/unitlink.php?r=1&p2=$prefix&p3=$noper&p=".C_DBL), true);

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
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }

    function restofunit() {
        $this->nusoap_server->wsdl->addComplexType(
            'RestofUnit', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:RestUnitArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'RestUnitArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:RestUnit[]')
            ), // Attributes
            'tns:RestUnit' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'RestUnit', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'NOMOR_POLIS' => array('name' => 'NOMOR_POLIS', 'type' => 'xsd:string'),
                'SALDO' => array('name' => 'SALDO', 'type' => 'xsd:string'),
                'FUND' => array('name' => 'FUND', 'type' => 'xsd:string'),
                'NAMAFUND' => array('name' => 'NAMAFUND', 'type' => 'xsd:string'),
                'NAB_JUAL' => array('name' => 'NAB_JUAL', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('restofunit', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'policyNumber' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:RestofUnit'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#restofunit', // Soap Action
            'rpc', // Style
            'encoded', // User
            'The rest of the unit link product' // Dokumentasi
        );

        function restofunit($clientid, $authkey, $policynumber, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $unit = $ci->Mpolicy->get_list_sisa_unit_jslink($policynumber);
                        if (count($unit) > 0) { // Jika user memiliki unit
                            $data2 = $unit;
                            $status = 200;
                            $message = $ci->lang->line('success');
                        } else {
                            $status = 537;
                            $message = $ci->lang->line('error_no_available_unit');
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
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }

    function redemption() {
        $this->nusoap_server->wsdl->addComplexType(
            'RedemptionUnitRupiah', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array (
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('redemptionunitrupiah', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string', 'policyNumber' => 'xsd:string', 'kodeRedemption' => 'xsd:string', 'jumlah' => 'xsd:string', 'namaPemilikRekening' => 'xsd:string', 'nomorRekening' => 'xsd:string', 'namaBank' => 'xsd:string', 'cabangBank' => 'xsd:string', 'kodeFund' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:RedemptionUnitRupiah'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#redemptionunitrupiah', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Send Notification' // Dokumentasi
        );

        function redemptionunitrupiah($clientid, $authkey, $lang, $policynumber, $kdredemption, $jumlah, $namapemilikrekening, $norekening, $namabank, $cabangbank, $kdfund) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $confirmid = strtoupper(substr(md5($policynumber.time()),3,6));
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $i['prefixpertanggungan'] = substr($policynumber, 0, 2);
                    $i['nopertanggungan'] = substr($policynumber, 2);
                    $i['kode_jenis'] = $kdredemption;
                    $i['jumlah'] = $jumlah;
                    $i['penerima'] = trim($namapemilikrekening);
                    $i['rekening'] = $norekening;
                    $i['bank'] = trim($namabank);
                    $i['cabang'] = trim($cabangbank);
                    $i['confirmid'] = $confirmid;
                    $i['kode_fund'] = $kdfund;
                    $i['clientid'] = $clientid;

                    if ($ci->Mpolicy->insert_redemption($i)) { // Jika berhasil disimpan ke database
                        $status = 200;
                        $message = $ci->lang->line('success');
                    } else { // Jika gagal disimpan ke database
                        $status = 500;
                        $message = $ci->lang->line('internal_server_error'). " (1)";
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
                'status'=> $status,
                'message'=> $message,
                'data'=> $confirmid
            );
        }
    }

    function redemptionstatus() {
        $this->nusoap_server->wsdl->addComplexType(
            'ClaimsStatus', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:ClaimStatusArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ClaimStatusArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:ClaimStatus[]')
            ), // Attributes
            'tns:ClaimStatus' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ClaimStatus', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'NOPOLIS' => array('name' => 'NOPOLIS', 'type' => 'xsd:string'),
                'CONFIRMID' => array('name' => 'CONFIRMID', 'type' => 'xsd:string'),
                'NAMASTATUS' => array('name' => 'NAMASTATUS', 'type' => 'xsd:string'),
                'TGLPENGAJUAN' => array('name' => 'TGLPENGAJUAN', 'type' => 'xsd:string'),
                'JUMLAH' => array('name' => 'JUMLAH', 'type' => 'xsd:string'),
                'KODE_JENIS' => array('name' => 'KODE_JENIS', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('redemptstatusproses', // Method Name
            array('clientID' => 'xsd:string', 'authKey' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ClaimsStatus'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#claimstatusproses', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Status Process Claim' // Dokumentasi
        );

        function redemptstatusproses($clientid, $authkey, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mpolicy');
            $ci->load->model('Muser');
            $ci->changelanguage($lang);
            $filter = array('field'=>'no_klien', 'value'=>$clientid);
            $data = $ci->Muser->get_user(C_KD_APLIKASI, $filter);
            $data2 = null;

            if (count($data) > 0) { // Jika user ditemukan
                if ($data['AUTH_KEY'] == $authkey) { // Jika authkey sama
                    $data2 = $ci->Mpolicy->get_list_status_redempt($clientid);
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
                'status'=> $status,
                'message'=> $message,
                'data'=> $data2
            );
        }
    }

    function product() {
        $this->nusoap_server->wsdl->addComplexType(
            'ProductList', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:ProductArray')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ProductArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Product[]')
            ), // Attributes
            'tns:Product' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Product', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'PRODUCT_TYPE' => array('name' => 'PRODUCT_TYPE', 'type' => 'xsd:string'),
                'SUB_PRODUCT1' => array('name' => 'SUB_PRODUCT1', 'type' => 'xsd:string'),
                'SUB_PRODUCT2' => array('name' => 'SUB_PRODUCT2', 'type' => 'xsd:string'),
                'SUB_PRODUCT3' => array('name' => 'SUB_PRODUCT3', 'type' => 'xsd:string'),
                'SUB_PRODUCT4' => array('name' => 'SUB_PRODUCT4', 'type' => 'xsd:string'),
                'TITLE' => array('name' => 'TITLE', 'type' => 'xsd:string'),
                'DESCRIPTION' => array('name' => 'DESCRIPTION', 'type' => 'xsd:string'),
                'SHORT_DESCRIPTION' => array('name' => 'SHORT_DESCRIPTION', 'type' => 'xsd:string'),
                'USIA_MIN' => array('name' => 'USIA_MIN', 'type' => 'xsd:string'),
                'USIA_MAKS' => array('name' => 'USIA_MAKS', 'type' => 'xsd:string'),
                'MASA_PERTANGGUNGAN' => array('name' => 'MASA_PERTANGGUNGAN', 'type' => 'xsd:string'),
                'MATA_UANG' => array('name' => 'MATA_UANG', 'type' => 'xsd:string'),
                'CARA_BAYAR' => array('name' => 'CARA_BAYAR', 'type' => 'xsd:string'),
                'GAMBAR' => array('name' => 'GAMBAR', 'type' => 'xsd:string'),
                'ENTITY_ID' => array('name' => 'ENTITY_ID', 'type' => 'xsd:string'),
                'MANFAAT' => array('name' => 'MANFAAT', 'type' => 'tns:ManfaatListArray')
            ) // Element
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ManfaatListArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Manfaat[]')
            ), // Attributes
            'tns:Manfaat' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Manfaat', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'JUDUL_MANFAAT' => array('name' => 'JUDUL_MANFAAT', 'type' => 'xsd:string'),
                'DESC_MANFAAT' => array('name' => 'DESC_MANFAAT', 'type' => 'xsd:string')
            ) // Element
        );

        $this->nusoap_server->register('productlist', // Method Name
            array('langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ProductList'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#productlist', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Product List' // Dokumentasi
        );

        function productlist($lang) {
            $ci = &get_instance();
            $ci->load->model('Mproduct');
            $data = $ci->Mproduct->get_list_product();
            $data2 = null;
            $strlen = 250;

            if (count($data) > 0) { // Jika produk ditemukan
                foreach ($data as $i => $r) {
                    $data2[$i] = $r;
                    $data2[$i]['TITLE'] = remove_tag($r['TITLE']);
                    $data2[$i]['DESCRIPTION'] = remove_tag($r['DESCRIPTION']);
                    $data2[$i]['SHORT_DESCRIPTION'] = strlen($data2[$i]['DESCRIPTION']) >= $strlen ? substr($data2[$i]['DESCRIPTION'], 0 , $strlen)."..." : $data2[$i]['DESCRIPTION'];
                    $data2[$i]['GAMBAR'] = strlen(trim($r['GAMBAR'])) > 0 ? "https://www.jiwasraya.co.id/sites/default/files/styles/brochures/public/".str_replace("public://", "", $r['GAMBAR']) : "https://www.jiwasraya.co.id/sites/default/files/styles/brochures/public/product-brochures-cover/default.png";

                    $data3 = array();
                    foreach ($ci->Mproduct->get_list_manfaat($r['ENTITY_ID']) as $j => $s) {
                        $data3[$j]['JUDUL_MANFAAT'] = remove_tag($s['JUDUL_MANFAAT']);
                        $data3[$j]['DESC_MANFAAT'] = remove_tag($s['DESC_MANFAAT']);
                    }

                    $data2[$i]['MANFAAT'] = $data3;
                }
            }

            return array(
                'status'=> 200,
                'message'=> $ci->lang->line('success'),
                'data'=> $data2
            );
        }
    }
    
    function provider() {
        $this->nusoap_server->wsdl->addComplexType(
            'ProviderList', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:ProviderArray')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ProviderArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Provider[]')
            ), // Attributes
            'tns:Provider' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Provider', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'PROVIDER_NAME' => array('name' => 'PROVIDER_NAME', 'type' => 'xsd:string'),
                'PROVIDER_ADDRESS' => array('name' => 'PROVIDER_ADDRESS', 'type' => 'xsd:string'),
                'PROVIDER_TELP' => array('name' => 'PROVIDER_TELP', 'type' => 'xsd:string'),
                'PROVIDER_FAX' => array('name' => 'PROVIDER_FAX', 'type' => 'xsd:string'),
                'PROVIDER_TYPE_CODE' => array('name' => 'PROVIDER_TYPE_CODE', 'type' => 'xsd:string'),
                'PROVIDER_TYPE' => array('name' => 'PROVIDER_TYPE', 'type' => 'xsd:string')
            ) // Element
        );
        
        $this->nusoap_server->register('providerlist', // Method Name
            array('sort' => 'xsd:string', 'typeCode' => 'xsd:string', 'filter' => 'xsd:string', 'langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ProviderList'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#providerlist', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Provider List' // Dokumentasi
        );

        function providerlist($sort, $typecode, $filter, $lang) {
            $ci = &get_instance();
            $ci->load->model('Mprovider');
            $data = $ci->Mprovider->get_list_provider($sort, $typecode, $filter);
            $data2 = null;
            
            if (count($data) > 0) { // Jika ada data provider
                foreach ($data as $i => $r) {
                    $data2[$i]['PROVIDER_NAME'] = $r['NAMA_PROVIDER'];
                    $data2[$i]['PROVIDER_ADDRESS'] = $r['ALAMAT_PROVIDER'];
                    $data2[$i]['PROVIDER_TELP'] = $r['TELP_PROVIDER'];
                    $data2[$i]['PROVIDER_FAX'] = $r['FAX_PROVIDER'];
                    $data2[$i]['PROVIDER_TYPE_CODE'] = $r['KD_TIPE_PROVIDER'];
                    $data2[$i]['PROVIDER_TYPE'] = $r['TIPE_PROVIDER'];
                }
            }

            return array(
                'status'=> 200,
                'message'=> $ci->lang->line('success'),
                'data'=> $data2
            );
        }
    }
    
    function providertype() {
        $this->nusoap_server->wsdl->addComplexType(
            'ProviderTypeList', // Name
            'complexType', // Type Class
            'struct', // Compositor
            'all', // Restricted Base
            '', // Element
            array(
                'status' => array('name' => 'status', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string'),
                'data' => array('name' => 'data', 'type' => 'tns:ProviderTypeArray')
            ) // Attributes
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ProviderTypeArray', // Name
            'complexType', // Type Class
            'array', // PHP Type
            '', // Compositor
            'SOAP-ENC:Array', // Restricted Base
            array(), // Element
            array(
                array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:ProviderType[]')
            ), // Attributes
            'tns:ProviderType' // Array Type
        );
        $this->nusoap_server->wsdl->addComplexType(
            'ProviderType', // Name
            'complexType', // Type Class
            'struct', // PHP Type
            'all', // Compositor
            '', // Restricted Base
            array(
                'PROVIDER_TYPE_CODE' => array('name' => 'PROVIDER_TYPE_CODE', 'type' => 'xsd:string'),
                'PROVIDER_TYPE' => array('name' => 'PROVIDER_TYPE', 'type' => 'xsd:string')
            ) // Element
        );
        
        $this->nusoap_server->register('providertypelist', // Method Name
            array('langID' => 'xsd:string'), // Input Parameter
            array('return' => 'tns:ProviderTypeList'), // Output Parameter
            'urn:server', // Namespace
            'urn:server#providertypelist', // Soap Action
            'rpc', // Style
            'encoded', // User
            'Provider Type List' // Dokumentasi
        );

        function providertypelist($lang) {
            $ci = &get_instance();
            $ci->load->model('Mprovider');
            $data = $ci->Mprovider->get_list_tipe_provider();
            $data2 = null;
            
            if (count($data) > 0) { // Jika ada data tipe provider
                foreach ($data as $i => $r) {
                    $data2[$i]['PROVIDER_TYPE_CODE'] = $r['KD_TIPE_PROVIDER'];
                    $data2[$i]['PROVIDER_TYPE'] = $r['TIPE_PROVIDER'];
                }
            }

            return array(
                'status'=> 200,
                'message'=> $ci->lang->line('success'),
                'data'=> $data2
            );
        }
    }
}