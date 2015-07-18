<?php

namespace App\Http\Controllers;

use App\Mailgroups;
use App\MailNewsletter;
use App\Http\Requests;
use Illuminate\Http\Response;
use Mail;

class MailController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function mailGroups() {
        $mailGroups = MailGroups::getEmails();
        foreach ($mailGroups as $email) {
            if ($email->valid_status < 3) {
                $toEmail = array('email' => $email->email);
                $subject = 'Welcome!';
                $send = Mail::send('emails.groups', ['key' => 'value'], function($message)use($toEmail, $subject) {
                            $message->to($toEmail['email'], 'John Smith')->subject($subject);
                        });
                if (!$send) {
                    $data = array('valid_status' => $email->valid_status + 1);
                    $id = $email->id;
                    MailGroups::updateValidStatus($id, $data);
                }
            }

            if (count(Mail::failures()) == 500) {
                MailGroups::updateAfterSend();
                break;
            }
        }
    }

    public function mailNewsletter() {
        $mailGroups = MailNewsletter::getEmails();
        foreach ($mailGroups as $email) {
            if ($email->valid_status < 3) {
                $toEmail = array('email' => $email->email);
                $subject = 'Welcome!';
                $send = Mail::send('emails.groups', ['key' => 'value'], function($message)use($toEmail, $subject) {
                            $message->to($toEmail['email'], 'John Smith')->subject($subject);
                        });
                if (!$send) {
                    $data = array('valid_status' => $email->valid_status + 1);
                    $id = $email->id;
                    MailNewsletter::updateValidStatus($id, $data);
                }
            }

            if (count(Mail::failures()) == 500) {
                MailNewsletter::updateAfterSend();
                break;
            }
        }
    }

    public function addEmails() {
        $data = \Request::all();
        $validator = \Validator::make($data, \App\mailGroups::$edit);
        if ($validator->fails()) {
            return response()->json(array(
                        'code' => 404,
                        'message' => 'Invalid Email'
                            ), 404);
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $data['email'] = \Request::get('email');
            $data['valid_status'] = 0;
            $data['send_status'] = 0;
            $data['created_at'] = date('Y-m-d H:i:s');
            \App\mailGroups::addEmail($data);
            \App\MailNewsletter::addEmail($data);
            return response()->json(array(
                        'message' => 'New newsletter created successfully'
            ));
        }
    }

}
