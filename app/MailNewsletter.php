<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailNewsletter extends Model {

    /**
     * The database table Mail newslette by the model.
     *
     * @var string
     */
    protected $table = 'mails_newslette';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'valid_status', 'send_status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden;

    /**
     * The attributes which using Carbon.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
    public static $edit = array(
        'email' => 'required|email'
    );

    public static function scopeDelete($id) {
        self::where('id', $id)->delete();
    }

    public static function scopeEdit($id) {

        $editUser = self::where('id', '=', $id)->first();
        return $editUser;
    }

    public static function findEmailByEmail($data) {
        return self::where('email', $data['email'])->first();
    }

    public static function getEmails() {
        return self::where('send_status', 0)->get();
    }

    public static function updateValidStatus($id, $data) {
        return self::where('id', $id)->update($data);
    }

    public static function updateAfterSend() {
        self::where('send_status', 0)->update(['send_status' => 2]);
        self::where('send_status', 1)->update(['send_status' => 0]);
        self::where('send_status', 2)->update(['send_status' => 1]);
    }

    public static function addEmail($data) {
        $email = new MailNewsletter();
        $email->create($data);
    }

}
