<?php
namespace frontend\components;

use common\components\GeoHelper;
use common\components\StringHelper;
use common\models\Auth;
use common\models\User;
use common\models\UserType;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        if (strtolower($this->client->getId()) == 'google') {
            $email = !empty($attributes['emails'][0]['value']) ? $attributes['emails'][0]['value'] : null;//ArrayHelper::getValue($attributes, 'email');
            $id = ArrayHelper::getValue($attributes, 'id');
            $nickname = ArrayHelper::getValue($attributes, 'displayName');
        }else if(strtolower($this->client->getId()) == 'facebook') {
            $email = ArrayHelper::getValue($attributes, 'email');
            $id = ArrayHelper::getValue($attributes, 'id');
            $nickname = ArrayHelper::getValue($attributes, 'name');
        }else {
            $email = ArrayHelper::getValue($attributes, 'email');
            $id = ArrayHelper::getValue($attributes, 'id');
            $nickname = ArrayHelper::getValue($attributes, 'login');
        }

        if (empty($email)) {
            Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "your {client} account does not have email address please try login with other account.", ['client' => $this->client->getTitle()]),
            ]);
            //return Yii::$app->controller->redirect(['/site/login']);
            return false;
        }


        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                /* @var User $user */
                $user = $auth->user;
                $this->updateUserInfo($user);
                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
            } else { // signup
//                if ($email !== null && User::find()->where(['email' => $email])->exists()) {
//                    Yii::$app->getSession()->setFlash('error', [
//                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
//                    ]);
//                } else {
                    $password = Yii::$app->security->generateRandomString(6);

                    $first_name = 'Unknown';
                    $last_name = 'Unknown';
                    if(!empty($nickname)){
                        $name = StringHelper::splitName($nickname);
                        if(!empty($name[0])){
                            $first_name = $name[0];
                        }
                        if(!empty($name[1])){
                            $last_name = $name[1];
                        }

                    }

                    $user = User::find()->andWhere(['email' => $email])->one();
                    if(empty($user)) {
                        $user = new User([
//                        'username' => $nickname,
//                        'github' => $nickname,
                            'email' => $email,
                            'password' => $password,
                            'confirm_password' => $password,
                            'country_id' => GeoHelper::getCurrentCountryId(),
                            'user_type_id' => UserType::USER,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                        ]);
                        $user->generateAuthKey();
                        $user->generatePasswordResetToken();
                    }
                    $transaction = User::getDb()->beginTransaction();

                    if ($user->isNewRecord ? $user->save() : true) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $this->client->getId(),
                            'source_id' => (string)$id,
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                        } else {
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', 'Unable to save {client} account: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors()),
                                ]),
                            ]);
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save user: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors()),
                            ]),
                        ]);
                    }
                }
//            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    $this->updateUserInfo($user);
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->client->getUserAttributes();
//        $github = ArrayHelper::getValue($attributes, 'login');
//        if ($user->github === null && $github) {
//            $user->github = $github;
//            $user->save();
//        }
    }
}
