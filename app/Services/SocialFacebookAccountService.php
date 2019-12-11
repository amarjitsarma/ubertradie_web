<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use App\Notification;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Sentinel;

class SocialFacebookAccountService{

    public function createOrGetUser(ProviderUser $providerUser){

        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if($account){
            return $account->user;
        }else{
            $account = new SocialFacebookAccount([
                'provider_user_id'  => $providerUser->getId(),
                'provider'          => 'facebook'
            ]);
            
            $user = User::whereEmail($providerUser->getEmail())->first();

            $password = rand(11111111, 99999999);
            if(!$user){
                $userData = array(
                        'email'         => $providerUser->getEmail(),
                        'full_name'     => $providerUser->getName(),
                        'image'         => $providerUser->getAvatar(),
                        'password'      => $password,
                        'status'        => 0,
                        'phone'         => $password
                        );
                $user = Sentinel::registerAndActivate($userData);

                $role = Sentinel::findRoleBySlug('user');
                $role->users()->attach($user);

                Sentinel::login($user,true);
            }
            return $user;
        }
    }
}