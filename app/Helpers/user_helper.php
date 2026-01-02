<?php

use App\Models\UserProfilesModel;

if (!function_exists('user_display_name')) {
    function user_display_name()
    {
        if (!logged_in()) {
            return '';
        }

        $user = user();
        $profileModel = new UserProfilesModel();
        $profile = $profileModel->find($user->id);

        return $profile && !empty($profile['full_name'])
            ? $profile['full_name']
            : $user->username;
    }
}
