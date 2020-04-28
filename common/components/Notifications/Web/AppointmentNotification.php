<?php
namespace common\components\Notifications\Web;

use Yii;

class AppointmentNotification extends WebNotification{

    public function sendAppointmentWebNotification(\common\models\User $user){
        $this->send(
            [
                'userId' => $user->id,
                'text'   => 'New Appointment',
                'seen'   => '0',
                'url'    => 'appointments/requests',
                'icon'   => 'fa fa-bell-o',
            ]);
    }

}