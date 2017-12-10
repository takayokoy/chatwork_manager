<?php

namespace App;


class ChatworkApi
{
    const BASE_URL = "https://api.chatwork.com/v2/";

    public static function getMyInfo($token)
    {
        return self::getData($token, self::BASE_URL . "me");
    }

    public static function getRooms($token)
    {
        return self::getData($token, self::BASE_URL . "rooms");
    }


    public static function addMember(array $rooms, $token, $account_id, $role)
    {
        foreach ($rooms as $room_id) {
            $members = array(
                'admin' => array(),
                'member' => array(),
                'readonly' => array(),
            );

            $results = self::getData($token, sprintf(self::BASE_URL . 'rooms/%d/members', $room_id));
            foreach ($results as $member) {
                $mrole = $member['role'];
                $members[$mrole][] = $member['account_id'];
            }


            if (in_array($account_id, $members['admin'])) {
                $joined = 'admin';
            } else if (in_array($account_id, $members['member'])) {
                $joined = 'member';
            } else if (in_array($account_id, $members['readonly'])) {
                $joined = 'readonly';
            } else {
                $joined = false;
            }

            if ($joined !== false) {
                continue;
            }

            $members[$role][] = $account_id;

            $body = array_filter(array(
                'members_admin_ids' => implode(',', $members['admin']),
                'members_member_ids' => implode(',', $members['member']),
                'members_readonly_ids' => implode(',', $members['readonly']),
            ));

            $result = self::putData($token, sprintf(self::BASE_URL . 'rooms/%d/members', $room_id), $body);
        }
    }

    public static function deleteMember(array $rooms, $token, $account_id)
    {
        foreach ($rooms as $room_id) {
            $members = array(
                'admin' => array(),
                'member' => array(),
                'readonly' => array(),
            );

            $results = self::getData($token, sprintf(self::BASE_URL . 'rooms/%d/members', $room_id));
            foreach ($results as $member) {
                $mrole = $member['role'];
                $members[$mrole][] = $member['account_id'];
            }


            if (in_array($account_id, $members['admin']) !== false) {
                unset($members['admin'][array_search($account_id, $members['admin'])]);
            } else if (in_array($account_id, $members['member']) !== false) {
                unset($members['member'][array_search($account_id, $members['member'])]);
            } else if (in_array($account_id, $members['readonly']) !== false) {
                unset($members['readonly'][array_search($account_id, $members['readonly'])]);
            } else {
                continue;
            }

            $body = array_filter(array(
                'members_admin_ids' => implode(',', $members['admin']),
                'members_member_ids' => implode(',', $members['member']),
                'members_readonly_ids' => implode(',', $members['readonly']),
            ));

            $result = self::putData($token, sprintf(self::BASE_URL . 'rooms/%d/members', $room_id), $body);
        }
    }

    private static function getData($token, $url)
    {
        header("Content-type: text/html; charset=utf-8");

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array('X-ChatWorkToken: '. $token),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private static function putData($token, $url, array $option)
    {
        header("Content-type: text/html; charset=utf-8");

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array('X-ChatWorkToken: '. $token),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query($option, '', '&'), // PUT内容
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}