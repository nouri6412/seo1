<?php
class MyTmpTelegramBot
{
    const BOT_TOKEN = "5133581118:AAGKHYsRzQ5yvYUNvpf9IALuZs_Z-0UDZhA";
    const TELEGRAM_API_URL = "https://api.telegram.org/bot";

    public $url;

    public function __construct()
    {
        $this->url = SELF::TELEGRAM_API_URL . SELF::BOT_TOKEN;
    }

    private function runScript($method)
    {
        return file_get_contents($this->url . '/' . $method);
    }

    public function getUpdates($offset = 0)
    {
        $qu = "";
        if ($offset > 0) {
            $qu = "?offset=" . $offset;
        }
        return $this->runScript('getupdates' . $qu);
    }

    public function sendMessage($chatId, $text, $reply_markup = "")
    {
        $url = "sendmessage?text=$text&chat_id=$chatId" . $reply_markup;
        return $this->runScript($url);
    }
    public function get_login($chatId)
    {
        $user1 = get_user_by('login', $chatId);
        $user =  get_user_by('id', get_the_author_meta(get_the_author_meta('user_type_login', $user1->ID) . '_username', $user1->ID));
        return $user;
    }
    public function get_menu($user, $chatId)
    {
        $user1 = get_user_by('login', $chatId);
        $type =  get_the_author_meta('user_type_login', $user1->ID);
        if ($type == "user") {
            $this->user_menu($user, $chatId);
        } else {
            $this->company_menu($user, $chatId);
        }
    }
    public function message($item)
    {

        if (isset($item['message'])) {
            if (isset($item['message']["text"])) {
                $text = $item['message']["text"];
                $text = strtolower($text);
                if ($text == "start" || $text == "/start" || $text == "منو" || $text == "menu" || $text == "home") {
                    $this->start_menu($item);
                } else {
                    $chatId = $item['message']['chat']['id'];
                    $user =  $this->get_login($chatId);
                    $this->callback_input($user, $item['message']["text"], $chatId);
                }
            }
            if (isset($item['message']['contact'])) {
                $chatId = $item['message']['chat']['id'];
                $user =  $this->get_login($chatId);
                $this->callback_input($user, $item['message']["contact"]["phone_number"], $chatId);
            }
        } else if (isset($item["callback_query"]['message'])) {
            $chatId = $item["callback_query"]['message']['chat']['id'];
            $user =  $this->get_login($chatId);
            $this->callback($item, $user);
        }
    }
    public function main_menu()
    {
    }
    public function callback($item, $user)
    {
        // echo 'step 2 :'.$user->ID.'<br>';
        $chatId = $item["callback_query"]['message']['chat']['id'];
        $data = $item["callback_query"]['data'];

        if (strpos($data, 'user-request-job-') !== false) {
            $this->user_job_request(str_replace('user-request-job-', "", $data), $chatId);
            return;
        }

        if (strpos($data, 'select-company-cat-') !== false) {
            $this->company_selected_cat(str_replace('select-company-cat-', "", $data), $chatId);
            return;
        }

        if (strpos($data, 'company-job-remove-') !== false) {
            $this->company_job_delete(str_replace('company-job-remove-', "", $data), $chatId);
            return;
        }

        if (strpos($data, 'company-job-edit-') !== false) {
            $id = str_replace('company-job-edit-', "", $data);
            update_user_meta($user->ID, "create_job_id", $id);
            update_user_meta($user->ID, "bot_step", 'company-create-job-name-edit');
            $this->sendMessage($chatId, 'عنوان پروژه را وارد نمایید');
            return;
        }


        if (strpos($data, 'company-request-job-not-accept-') !== false) {
            $this->company_request_status(str_replace('company-request-job-not-accept-', "", $data), $chatId, 3);
            return;
        }

        if (strpos($data, 'company-request-job-accept-') !== false) {
            $this->company_accept_request(str_replace('company-request-job-accept-', "", $data), $chatId, 2);
            return;
        }
        if (strpos($data, 'company-request-job-complete-') !== false) {
            $this->company_complete_project(str_replace('company-request-job-complete-', "", $data), $chatId, 2);
            return;
        }
        if (strpos($data, 'company-request-job-emp-accept-') !== false) {
            $this->company_request_status(str_replace('company-request-job-emp-accept-', "", $data), $chatId, 4);
            return;
        }

        if (strpos($data, 'user-profile-view-') !== false) {
            $this->user_profile_view(str_replace('user-profile-view-', "", $data), $chatId);
            return;
        }

        if (strpos($data, 'project-requests-') !== false) {
            $this->company_request_0(str_replace('project-requests-', "", $data), $chatId);
            return;
        }

        if (strpos($data, 'chat-user-message-') !== false) {
            $this->chat_message($user, $chatId, str_replace('chat-user-message-', "", $data));
            return;
        }

        switch ($data) {
            case "menu-user-profile": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_profile($user, $chatId);
                    break;
                }
            case "menu-user-create-resume": {
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-name');
                    $this->sendMessage($chatId, urlencode("نام و نام خانوادگی را وارد نمایید"));
                    break;
                }
            case "menu-user-project-1": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_project_1($user, 1, $chatId);
                    break;
                }
            case "menu-user-project-2": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_project_2($user, 2, $chatId);
                    break;
                }
            case "menu-user-resume": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_resume($user, $chatId);
                    break;
                }
            case "menu-user-jobs": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_jobs($user, $chatId);
                    break;
                }
            case "menu-user-request": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->user_requests($user, $chatId);
                    break;
                }
            case "user-profile-name": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "نام و نام خانوادگی را وارد نمایید");
                    break;
                }
            case "user-profile-exp": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "عنوان شغل را وارد نمایید");
                    break;
                }
            case "user-profile-email": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, " ایمیل را وارد نمایید");
                    break;
                }
            case "user-profile-date": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, " سال تولد را وارد نمایید");
                    break;
                }
            case "user-profile-state": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "  استان را وارد نمایید");
                    break;
                }
            case "user-profile-city": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "  شهر را وارد نمایید");
                    break;
                }
            case "user-profile-tel": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "  تلفن را وارد نمایید");
                    break;
                }
            case "user-resume-about": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "درباره خود بنویسید");
                    $data = json_decode(get_the_author_meta('resume-about', $user->ID));
                    $about = "خالی است";
                    if (isset($data->about)) {
                        $about = $data->about;
                    }
                    $this->sendMessage($chatId, "درباره شما" . ' : ' . $about);
                    break;
                }
            case "user-resume-skills": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, "  مهارت های خود را با جدا کننده " . ' , ' . "وارد نمایید مانند:" . ' java,wordpress');
                    $data = json_decode(get_the_author_meta('resume-skills', $user->ID));
                    $skills = "خالی است";
                    if (isset($data->skills)) {
                        $skills = $data->skills;
                    }
                    $this->sendMessage($chatId, "مهارت های شما" . ' : ' . $skills);
                    break;
                }
            case "company-profile-name": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, urlencode("نام شرکت را وارد نمایید"));
                    break;
                }
            case "company-profile-email": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, urlencode("ایمیل شرکت را وارد نمایید"));
                    break;
                }
            case "company-profile-web": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, urlencode("وب سایت شرکت را وارد نمایید"));
                    break;
                }
            case "company-profile-cat": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->company_cat($user, $chatId);
                    break;
                }
            case "company-profile-tel": {

                    update_user_meta($user->ID, "bot_step", $data);
                    $this->request_phone($chatId);
                    break;
                }
            case "company-profile-about": {
                    update_user_meta($user->ID, "bot_step", $data);
                    $this->sendMessage($chatId, urlencode("توضیحاتی درباره شرکت را وارد نمایید"));
                    break;
                }
            default: {
                };
        }
    }
    public function request_phone($chatId)
    {
        $keyboard = array(
            'keyboard' => array(
                array(
                    array(
                        'text' => "تایید شماره تلفن",
                        'request_contact' => true
                    )
                )
            ),

            'one_time_keyboard' => true,
            'resize_keyboard' => true
        );
        $encodedKeyboard = json_encode($keyboard);

        $this->sendMessage($chatId, urlencode("شماره تلفن خود را تائید کنید"), "&reply_markup=" . $encodedKeyboard);
    }
    public function user_profile_view($user_id, $chatId)
    {
        $user =  $this->get_login($chatId);

        $desc = "";
        $desc .=  "نام" . " : " . get_the_author_meta('user_name', $user_id);
        $desc .= PHP_EOL . "عنوان شغلی" . " : " . get_the_author_meta('job_title', $user_id);
        // $desc .= PHP_EOL . "نرخ ساعتی خدمات به دلار" . " : " . get_the_author_meta('user_nerx', $user_id);
        $desc .= PHP_EOL . "ایمیل" . " : " . get_the_author_meta('user_e_email', $user_id);
        //  $desc .= PHP_EOL . "آدرس سکونت" . " : " . get_the_author_meta('user_country', $user_id) . ' - ' . get_the_author_meta('user_address', $user_id);
        $desc .= PHP_EOL . "کشور" . " : " . get_the_author_meta('user_country', $user_id);

        $desc .= PHP_EOL . "تلفن" . " : " . get_the_author_meta('tel', $user_id);

        $data = json_decode(get_the_author_meta('skills', $user_id));
        $skills = PHP_EOL .  "خالی است";
        if (isset($data->skills)) {
            $skills = $data->skills;
        }
        $desc .= PHP_EOL .  "-----------";
        $desc .= PHP_EOL .  "مهارت" . " : " . $skills;

        $about = PHP_EOL .  get_the_author_meta('user_desc', $user_id);
        $desc .= PHP_EOL .  "-----------";
        $desc .= PHP_EOL .  "درباره" . " : " . $about;

        /// exp
        $data = [];
        $data_1 = json_decode(get_the_author_meta('user_exp', $user_id), true);

        if (is_array($data_1)) {
            $data = $data_1;
        }

        // $desc .= PHP_EOL .  "-----------";
        // $desc .= PHP_EOL .  "سوابق پروژه" . " : ";

        // foreach ($data as $item) {
        //     $desc .= PHP_EOL .  "شرکت" . " : " . $item["company_title"];
        //     $desc .= PHP_EOL .  "عنوان شغل" . " : " . $item["job_title"];
        //     $desc .= PHP_EOL .  "از سال" . " : " . $item["start"] . ' - ' . "تا سال" . " : " . $item["end"];
        //     $desc .= PHP_EOL .  "توضیحات پروژه" . " : " . $item["job_desc"];
        // }
        // end exp


        // edu
        $data = [];
        $data_1 = json_decode(get_the_author_meta('user_edu', $user_id), true);

        if (is_array($data_1)) {
            $data = $data_1;
        }
        //  $desc .= PHP_EOL .  "-----------";
        //  $desc .= PHP_EOL .  "سوابق تحصیلی" . " : ";

        foreach ($data as $item) {
            //  $desc .= PHP_EOL .  "دانشگاه" . " : " . $item["uni_title"];
            $desc .= PHP_EOL .  "رشته" . " : " . $item["major_title"];
            //   $desc .= PHP_EOL .  "از سال" . " : " . $item["start"] . ' - ' . "تا سال" . " : " . $item["end"];
        }
        //end edu


        $this->sendMessage($chatId, urlencode($desc));
        $this->user_menu($user, $chatId);
    }

    public function callback_input($user, $text, $chatId)
    {
        global $wpdb;
        $step = get_the_author_meta('bot_step', $user->ID);

        $break = false;
        switch ($text) {
            case "ثبت نام فریلنسر": {
                    $this->register_user($chatId);
                    $break = true;
                    break;
                }
            case "ثبت نام کارفرما": {
                    $this->register_company($chatId);
                    $break = true;
                    break;
                }
            case "ورود فریلنسر": {
                    $this->login_user($chatId);
                    $break = true;
                    break;
                }
            case "ورود کارفرما": {
                    $this->login_company($chatId);
                    $break = true;
                    break;
                }
            case "مشاهده رزومه": {
                    $this->user_profile_view($user->ID, $chatId);
                    $break = true;
                    break;
                }
            case "ساخت رزومه": {
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-name');
                    $this->sendMessage($chatId, urlencode("نام و نام خانوادگی را وارد نمایید"));
                    $break = true;
                    break;
                }
            case "پروژه ها با مهارت من": {
                    update_user_meta($user->ID, "bot_step", 'menu-user-jobs');
                    $this->user_jobs($user, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های در دست انجام": {
                    update_user_meta($user->ID, "bot_step", 'menu-user-project-1');
                    $this->user_project_1($user, 1, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های تکمیل یافته": {
                    update_user_meta($user->ID, "bot_step", 'menu-user-project-2');
                    $this->user_project_2($user, 1, $chatId);
                    $break = true;
                    break;
                }
            case "ویرایش پروفایل": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-profile');
                    $this->company_profile($user, $chatId);
                    $break = true;
                    break;
                }
            case "ایجاد پروژه": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-create-job');
                    $this->company_create_job($user, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های من": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-jobs');
                    $this->company_my_jobs($user, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های باز": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-project-1');
                    $this->company_project_0($user, 1, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های در حال انجام": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-project-2');
                    $this->company_project_1($user, 2, $chatId);
                    $break = true;
                    break;
                }
            case "پروژه های تکمیل شده": {
                    update_user_meta($user->ID, "bot_step", 'menu-company-project-3');
                    $this->company_project_2($user, 2, $chatId);
                    $break = true;
                    break;
                }
            case "ویرایش نام شرکت": {
                    update_user_meta($user->ID, "bot_step", 'company-profile-edit-name');
                    $this->sendMessage($chatId, urlencode("نام شرکت را وارد نمایید"));
                    $break = true;
                    break;
                }
            case "ویرایش تلفن شرکت": {
                    update_user_meta($user->ID, "bot_step", 'company-profile-edit-tel');
                    $this->sendMessage($chatId, urlencode("تلفن شرکت را وارد نمایید"));
                    $break = true;
                    break;
                }
            case "ویرایش درباره شرکت": {
                    update_user_meta($user->ID, "bot_step", 'company-profile-edit-about');
                    $this->sendMessage($chatId, urlencode("درباره شرکت بنویسید"));
                    $break = true;
                    break;
                }
            case "کل پیام ها": {
                    update_user_meta($user->ID, "bot_step", 'my-message-0');
                    $this->my_message($user, $chatId, 0);
                    $break = true;
                    break;
                }
            case "پیام های خوانده شده": {
                    update_user_meta($user->ID, "bot_step", 'my-message-1');
                    $this->my_message($user, $chatId, 1);
                    $break = true;
                    break;
                }
            case "پیام های خوانده نشده": {
                    update_user_meta($user->ID, "bot_step", 'my-message-2');
                    $this->my_message($user, $chatId, 2);
                    $break = true;
                    break;
                }
            case "پیام ها": {
                    update_user_meta($user->ID, "bot_step", 'my-message');
                    $this->menu_message($user, $chatId);
                    $break = true;
                    break;
                }
            case "بازگشت": {
                    update_user_meta($user->ID, "bot_step", '');

                    $back_menu = get_the_author_meta('back_menu', $user->ID);

                    if ($back_menu == 'start' || strlen($back_menu) == 0) {
                        $this->run_start_menu($chatId);
                    } else {
                        $this->callback_input($user, $back_menu, $chatId);
                    }

                    $break = true;
                    break;
                }
        }

        if ($break) {
            return;
        }



        if ($step == "chat") {
            update_user_meta($user->ID, "bot_step", '');
            $message = "";

            $message = $text;
            $request_id = get_the_author_meta('chat_request_id', $user->ID);
            $chat = [];

            $str = get_post_meta($request_id, 'chat', true);
            if (strlen($str) > 0) {
                $chat = json_decode($str, true);
            }


            if (count($chat) == 0) {
                $message = get_post_meta($request_id, 'desc', true);
                if (strlen($message) > 0) {
                    $chat[] = ["user_id" => get_post_meta($request_id, 'owner_id', true), "text" => $message, "date" => get_the_time('U', $request_id)];
                }
            }

            update_post_meta($request_id, "new_message_desc", $text);
            update_post_meta($request_id, "new_message", 1);
            update_post_meta($request_id, "last_sender_message", $user->ID);
            $d = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
            $chat[] = ["user_id" => $user->ID, "text" => $text, "date" => $d];
            update_post_meta($request_id, "chat", json_encode($chat, JSON_UNESCAPED_UNICODE));
            $this->my_message($user, $chatId);
            return;
        }

        switch ($step) {
            case "company-profile-edit-name": {
                    update_user_meta($user->ID, "company_name", $text);
                    update_user_meta($user->ID, "user_name", $text);
                    $wpdb->update(
                        $wpdb->users,
                        ['display_name' => $text],
                        ['ID' => $user->ID]
                    );
                    $this->sendMessage($chatId, "نام شرکت ویرایش شد");
                    $this->company_profile($user, $chatId);
                    break;
                }
            case "company-profile-edit-tel": {
                    update_user_meta($user->ID, "tel", $text);
                    $this->sendMessage($chatId, "تلفن شرکت ویرایش شد");
                    $this->company_profile($user, $chatId);
                    break;
                }
            case "company-profile-edit-about": {
                    update_user_meta($user->ID, "desc", $text);
                    $this->sendMessage($chatId, "درباره شرکت ویرایش شد");
                    $this->company_profile($user, $chatId);
                    break;
                }
            case "user-profile-name": {
                    update_user_meta($user->ID, "user_name", $text);
                    $wpdb->update(
                        $wpdb->users,
                        ['display_name' => $text],
                        ['ID' => $user->ID]
                    );
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-register-name": {
                    $wpdb->update(
                        $wpdb->users,
                        ['display_name' => $text],
                        ['ID' => $user->ID]
                    );
                    update_user_meta($user->ID, "user_name", $text);
                    update_user_meta($user->ID, "bot_step", 'user-profile-register-email');
                    $this->sendMessage($chatId, urlencode("ایمیل را وارد نمایید"));
                    break;
                }
            case "user-profile-register-email": {
                    if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
                        update_user_meta($user->ID, "bot_step", 'user-profile-register-email');
                        $this->sendMessage($chatId, urlencode("فرمت ایمیل صحیح نمی باشد لطفا بصورت صحیح وارد نمایید"));
                    } else {
                        $user1 = get_user_by('login', $text);
                        if ($user1) {
                            update_user_meta($user->ID, "bot_step", 'user-profile-register-email');
                            $this->sendMessage($chatId, urlencode("ایمیل وارد شده در سیستم وجود دارد لطفا ایمیل دیگری وارد نمایید"));
                        } else {
                            $wpdb->update(
                                $wpdb->users,
                                ['user_login' => $text],
                                ['ID' => $user->ID]
                            );
                            $wpdb->update(
                                $wpdb->users,
                                ['user_nicename' => $text],
                                ['ID' => $user->ID]
                            );
                            update_user_meta($user->ID, "user_e_email", $text);
                            update_user_meta($user->ID, "bot_step", 'user-profile-register-pass');
                            $this->sendMessage($chatId, urlencode("برای ورود به پنل کاربری خود از طریق وبسایت کاکتوس رمز عبور دلخواه خود را وارد نمایید"));
                        }
                    }
                    break;
                }
            case "user-profile-register-pass": {
                    $uppercase = preg_match('@[A-Z]@', $text);
                    $lowercase = preg_match('@[a-z]@', $text);
                    $number    = preg_match('@[0-9]@', $text);
                    $specialChars = preg_match('@[^\w]@', $text);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($text) < 8) {
                        update_user_meta($user->ID, "bot_step", 'user-profile-register-pass');
                        $this->sendMessage($chatId, urlencode("رمز عبور وارد شده حداقل باید دارای یک حروف کوچک و بزرگ و حروف خاص مانند @  باشد و همچنین طول آن نباید کمتر از 8 کاراکتر باشد"));
                    } else {
                        update_user_meta($user->ID, "user_pass_1", $text);
                        update_user_meta($user->ID, "bot_step", 'user-profile-register-repass');
                        $this->sendMessage($chatId, urlencode("تکرار رمز عبور را وارد نمایید"));
                    }

                    break;
                }
            case "user-profile-register-repass": {
                    $pass = get_the_author_meta('user_pass_1', $user->ID);
                    if ($pass == $text) {
                        wp_set_password($text, $user->ID);
                        update_user_meta($user->ID, "bot_step", 'user-profile-register-tel');

                        $this->request_phone($chatId);
                    } else {
                        update_user_meta($user->ID, "bot_step", 'user-profile-register-pass');
                        $this->sendMessage($chatId, urlencode("تکرار رمز عبور اشتباه است لطفا رمز عبور را مجددا وارد نمایید"));
                    }

                    break;
                }
            case "user-profile-register-tel": {
                    update_user_meta($user->ID, "tel", $text);
                    update_user_meta($user->ID, "bot_step", 'user-profile-register-finish');
                    $this->sendMessage($chatId, urlencode("ثبتنام انجام شد"));
                    $pass = get_the_author_meta('user_pass_1', $user->ID);
                    $user_name = get_the_author_meta('user_e_email', $user->ID);

                    $text = "اطلاعات ورود به سایت عبارت است از";
                    $text .= PHP_EOL . "نام کاربری" . " : " . PHP_EOL . $user_name;
                    $text .= PHP_EOL . "رمز عبور" . " : " . PHP_EOL . $pass;
                    $this->sendMessage($chatId, urlencode($text));
                    $this->user_menu($user, $chatId);
                    break;
                }
            case "user-profile-exp": {
                    update_user_meta($user->ID, "user_exp", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-email": {
                    update_user_meta($user->ID, "user_e_email", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-date": {
                    update_user_meta($user->ID, "user_date_year", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-state": {
                    update_user_meta($user->ID, "user_state", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-city": {
                    update_user_meta($user->ID, "user_city", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-profile-tel": {
                    update_user_meta($user->ID, "tel", $text);
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-resume-about": {
                    $data = [];
                    $data["about"] = $text;
                    update_user_meta($user->ID, "resume-about", json_encode($data, JSON_UNESCAPED_UNICODE));
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "user-resume-skills": {
                    $data = [];
                    $data["skills"] = $text;
                    update_user_meta($user->ID, "resume-skills", json_encode($data, JSON_UNESCAPED_UNICODE));
                    $this->sendMessage($chatId, "اطلاعات ثبت شد");
                    break;
                }
            case "menu-user-create-resume-name": {
                    update_user_meta($user->ID, "user_name", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-exp');
                    $this->sendMessage($chatId, urlencode("عنوان شغل را وارد نمایید"));
                    break;
                }
            case "menu-user-create-resume-exp": {
                    update_user_meta($user->ID, "job_title", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-country');
                    $this->sendMessage($chatId, urlencode("کشور را وارد نمایید"));
                    break;
                }
            case "menu-user-create-resume-email": {
                    if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
                        update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-email');
                        $this->sendMessage($chatId, urlencode("فرمت ایمیل صحیح نمی باشد لطفا بصورت صحیح وارد نمایید"));
                    } else {
                        $user1 = get_user_by('login', $text);
                        if ($user1) {
                            update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-email');
                            $this->sendMessage($chatId, urlencode("ایمیل وارد شده در سیستم وجود دارد لطفا ایمیل دیگری وارد نمایید"));
                        } else {
                            $wpdb->update(
                                $wpdb->users,
                                ['user_login' => $text],
                                ['ID' => $user->ID]
                            );
                            $wpdb->update(
                                $wpdb->users,
                                ['user_nicename' => $text],
                                ['ID' => $user->ID]
                            );
                            update_user_meta($user->ID, "user_e_email", $text);
                            update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-country');
                            $this->sendMessage($chatId, urlencode("کشور را وارد نمایید"));
                        }
                    }

                    break;
                }
            case "menu-user-create-resume-country": {
                    update_user_meta($user->ID, "user_country", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-tel');
                    $this->request_phone($chatId);
                    break;
                }
            case "menu-user-create-resume-tel": {
                    update_user_meta($user->ID, "tel", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-about');
                    $this->sendMessage($chatId, urlencode("درباره خود بنویسید"));
                    break;
                }
            case "menu-user-create-resume-nerx": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-nerx');
                        $this->sendMessage($chatId, urlencode("لطفا نرخ ساعتی را بصورت عدد وارد نمایید"));
                    } else {
                        update_user_meta($user->ID, "user_nerx", $text);
                        update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-address');
                        $this->sendMessage($chatId, urlencode("نشانی خود بنویسید"));
                    }
                    break;
                }
            case "menu-user-create-resume-address": {
                    update_user_meta($user->ID, "user_address", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-about');
                    $this->sendMessage($chatId, urlencode("درباره خود بنویسید"));
                    break;
                }
            case "menu-user-create-resume-about": {
                    update_user_meta($user->ID, "user_desc", $text);
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-skills');
                    $this->sendMessage($chatId, urlencode("  مهارت های خود را با جدا کننده " . ' , ' . "وارد نمایید مانند:" . ' java,wordpress'));
                    break;
                }
            case "menu-user-create-resume-skills": {
                    $data = [];
                    $data["skills"] = $text;
                    update_user_meta($user->ID, "skills", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-edu-major');
                    $this->sendMessage($chatId, urlencode("رشته تحصیلی"));
                    break;
                }
            case "menu-user-create-resume-job-company": {
                    $db = json_decode(get_the_author_meta("user_exp", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["company_title"] = $text;
                    update_user_meta($user->ID, "user_exp", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-job-title');
                    $this->sendMessage($chatId, urlencode("عنوان شغلی که در آن شرکت مشغول بوده اید؟"));
                    break;
                }
            case "menu-user-create-resume-job-title": {
                    $db = json_decode(get_the_author_meta("user_exp", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["job_title"] = $text;
                    update_user_meta($user->ID, "user_exp", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-job-date-from');
                    $this->sendMessage($chatId, urlencode("از سال ؟"));
                    break;
                }
            case "menu-user-create-resume-job-date-from": {
                    $db = json_decode(get_the_author_meta("user_exp", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["start"] = $text;
                    update_user_meta($user->ID, "user_exp", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-job-date-to');
                    $this->sendMessage($chatId, urlencode("تا سال ؟"));
                    break;
                }
            case "menu-user-create-resume-job-date-to": {
                    $db = json_decode(get_the_author_meta("user_exp", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["end"] = $text;
                    update_user_meta($user->ID, "user_exp", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-job-desc');
                    $this->sendMessage($chatId, urlencode("توضیحاتی در باره کار خود در شرکت بیان کنید"));
                    break;
                }
            case "menu-user-create-resume-job-desc": {
                    $db = json_decode(get_the_author_meta("user_exp", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["job_desc"] = $text;
                    update_user_meta($user->ID, "user_exp", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-edu-uni');
                    // $this->sendMessage($chatId, urlencode("سابقه تحصیلی خود را ثبت کنید"));
                    $this->sendMessage($chatId, urlencode("نام دانشگاه فارغ التحصیلی"));
                    break;
                }

            case "menu-user-create-resume-edu-uni": {
                    $db = json_decode(get_the_author_meta("user_edu", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["uni_title"] = $text;
                    update_user_meta($user->ID, "user_edu", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-edu-major');
                    $this->sendMessage($chatId, urlencode("رشته تحصیلی ؟"));
                    break;
                }

            case "menu-user-create-resume-edu-major": {
                    $db = json_decode(get_the_author_meta("user_edu", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["major_title"] = $text;
                    update_user_meta($user->ID, "user_edu", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-finish');
                    $this->sendMessage($chatId, urlencode("رزومه شما کامل شد"));
                    $this->user_menu($user, $chatId);
                    break;
                }

            case "menu-user-create-resume-edu-date-from": {
                    $db = json_decode(get_the_author_meta("user_edu", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["starte"] = $text;
                    update_user_meta($user->ID, "user_edu", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-edu-date-to');
                    $this->sendMessage($chatId, urlencode("تا سال ؟"));
                    break;
                }

            case "menu-user-create-resume-edu-date-to": {
                    $db = json_decode(get_the_author_meta("user_edu", $user->ID), JSON_UNESCAPED_UNICODE);
                    $data = [];
                    $data[] = [];
                    $data[0] = [];
                    if (is_array($db) && count($db) > 0) {
                        $data = $db;
                    }
                    $data[0]["end"] = $text;
                    update_user_meta($user->ID, "user_edu", json_encode($data, JSON_UNESCAPED_UNICODE));
                    update_user_meta($user->ID, "bot_step", 'menu-user-create-resume-finish');
                    $this->sendMessage($chatId, urlencode("رزومه شما کامل شد"));
                    $this->user_menu($user, $chatId);
                    break;
                }
            case "company-profile-register-name": {
                    update_user_meta($user->ID, "company_name", $text);
                    update_user_meta($user->ID, "user_name", $text);
                    $wpdb->update(
                        $wpdb->users,
                        ['display_name' => $text],
                        ['ID' => $user->ID]
                    );
                    update_user_meta($user->ID, "bot_step", 'company-profile-register-email');
                    $this->sendMessage($chatId, urlencode("ایمیل شرکت را وارد نمایید"));
                    break;
                }
            case "company-profile-register-email": {
                    if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
                        update_user_meta($user->ID, "bot_step", 'company-profile-register-email');
                        $this->sendMessage($chatId, urlencode("فرمت ایمیل صحیح نمی باشد لطفا بصورت صحیح وارد نمایید"));
                    } else {
                        $user1 = get_user_by('login', $text);
                        if ($user1) {
                            update_user_meta($user->ID, "bot_step", 'company-profile-register-email');
                            $this->sendMessage($chatId, urlencode("ایمیل وارد شده در سیستم وجود دارد لطفا ایمیل دیگری وارد نمایید"));
                        } else {
                            $wpdb->update(
                                $wpdb->users,
                                ['user_login' => $text],
                                ['ID' => $user->ID]
                            );
                            $wpdb->update(
                                $wpdb->users,
                                ['user_nicename' => $text],
                                ['ID' => $user->ID]
                            );
                            update_user_meta($user->ID, "user_e_email", $text);
                            update_user_meta($user->ID, "bot_step", 'company-profile-register-pass');
                            $this->sendMessage($chatId, urlencode("برای ورود به پنل کاربری خود از طریق وبسایت کاکتوس رمز عبور دلخواه خود را وارد نمایید"));
                        }
                    }
                    break;
                }
            case "company-profile-register-pass": {
                    $uppercase = preg_match('@[A-Z]@', $text);
                    $lowercase = preg_match('@[a-z]@', $text);
                    $number    = preg_match('@[0-9]@', $text);
                    $specialChars = preg_match('@[^\w]@', $text);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($text) < 8) {
                        update_user_meta($user->ID, "bot_step", 'company-profile-register-pass');
                        $this->sendMessage($chatId, urlencode("رمز عبور وارد شده حداقل باید دارای یک حروف کوچک و بزرگ و حروف خاص مانند @  باشد و همچنین طول آن نباید کمتر از 8 کاراکتر باشد"));
                    } else {
                        update_user_meta($user->ID, "user_pass_1", $text);
                        update_user_meta($user->ID, "bot_step", 'company-profile-register-repass');
                        $this->sendMessage($chatId, urlencode("تکرار رمز عبور را وارد نمایید"));
                    }
                    break;
                }
            case "company-profile-register-repass": {
                    $pass = get_the_author_meta('user_pass_1', $user->ID);
                    if ($pass == $text) {
                        wp_set_password($text, $user->ID);
                        update_user_meta($user->ID, "bot_step", 'company-profile-register-tel');
                        $this->request_phone($chatId);
                    } else {
                        update_user_meta($user->ID, "bot_step", 'company-profile-register-pass');
                        $this->sendMessage($chatId, urlencode("تکرار رمز عبور اشتباه است لطفا رمز عبور را مجددا وارد نمایید"));
                    }

                    break;
                }
            case "company-profile-register-tel": {
                    update_user_meta($user->ID, "tel", $text);
                    update_user_meta($user->ID, "bot_step", 'company-profile-register-finish');
                    $this->sendMessage($chatId, urlencode("ثبت نام انجام شد"));
                    $pass = get_the_author_meta('user_pass_1', $user->ID);
                    $user_name = get_the_author_meta('user_e_email', $user->ID);

                    $text = "اطلاعات ورود به سایت عبارت است از";
                    $text .= PHP_EOL . "نام کاربری" . " : " . PHP_EOL . $user_name;
                    $text .= PHP_EOL . "رمز عبور" . " : " . PHP_EOL . $pass;
                    $this->sendMessage($chatId, urlencode($text));
                    $this->company_menu($user, $chatId);
                    break;
                }
            case "company-profile-email": {
                    if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
                        update_user_meta($user->ID, "bot_step", "company-profile-email");
                        $this->sendMessage($chatId, urlencode("فرمت ایمیل صحیح نمی باشد لطفا بصورت صحیح وارد نمایید"));
                    } else {
                        $user1 = get_user_by('login', $text);
                        if ($user1) {
                            update_user_meta($user->ID, "bot_step", 'company-profile-register-email');
                            $this->sendMessage($chatId, urlencode("ایمیل وارد شده در سیستم وجود دارد لطفا ایمیل دیگری وارد نمایید"));
                        } else {
                            $wpdb->update(
                                $wpdb->users,
                                ['user_login' => $text],
                                ['ID' => $user->ID]
                            );
                            $wpdb->update(
                                $wpdb->users,
                                ['user_nicename' => $text],
                                ['ID' => $user->ID]
                            );
                            update_user_meta($user->ID, "user_e_email", $text);
                            $this->sendMessage($chatId, "ایمیل ویرایش شد");
                            $this->company_menu($user, $chatId);
                        }
                    }
                    break;
                }
            case "company-profile-web": {
                    update_user_meta($user->ID, "web", $text);
                    $this->sendMessage($chatId, "وب سایت ویرایش شد");
                    $this->company_menu($user, $chatId);
                    break;
                }
            case "user-create-request-price": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'user-create-request-price');
                        $this->sendMessage($chatId, urlencode("لطفا مقدار پیشنهاد را بصورت عدد وارد نمایید"));
                    } else {
                        update_post_meta(get_the_author_meta("create_request_id", $user->ID), 'price', $text);
                        update_user_meta($user->ID, "bot_step", 'user-create-request-time');
                        $this->sendMessage($chatId, urlencode("زمان پیشنهادی شما چقدر است(روز)"));
                    }

                    break;
                }
            case "user-create-request-time": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'user-create-request-time');
                        $this->sendMessage($chatId, urlencode("لطفا زمان پیشنهاد را بصورت عدد وارد نمایید"));
                    } else {
                        update_post_meta(get_the_author_meta("create_request_id", $user->ID), 'price', $text);
                        update_user_meta($user->ID, "bot_step", 'user-create-request-desc');
                        $this->sendMessage($chatId, urlencode("توضیحات پیشنهادتان را قید نمایید"));
                    }

                    break;
                }
            case "user-create-request-desc": {

                    update_post_meta(get_the_author_meta("create_request_id", $user->ID), 'desc', $text);
                    update_user_meta($user->ID, "bot_step", 'user-create-request-desc');

                    $my_post = array(
                        'ID'            => get_the_author_meta("create_request_id", $user->ID),
                        'post_content'      => $text,
                        'post_status'  => 'publish'
                    );
                    wp_update_post($my_post);

                    $this->sendMessage($chatId, urlencode("پیشنهاد شما با موفقیت برای این  پروژه ارسال شد،کارفرما پس از بررسی با شما تماس خواهد گرفت."));
                    update_user_meta($user->ID, "create_request_id", 0);
                    $this->user_menu($user, $chatId);
                    break;
                }
            case "company-create-job-name-edit": {
                    $args_post = array(
                        'ID'           => get_the_author_meta("create_job_id", $user->ID),
                        'post_title'   => $text,
                        'meta_input'   => array(
                            'title' => $text,
                            'active' => 0,
                        )
                    );
                    $id = wp_update_post($args_post);

                    update_user_meta($user->ID, "create_job_id", $id);
                    update_user_meta($user->ID, "bot_step", 'company-create-job-time');
                    $this->sendMessage($chatId, 'چقدر زمان لازم است پروژه پیاده سازی شود؟(روز)');
                    break;
                }
            case "company-create-job-name": {
                    $args_post = array(
                        'post_title'   => $text,
                        'post_type'    => 'job',
                        'post_author'  => $user->ID,
                        'post_status'  => 'draft',
                        'meta_input'   => array(
                            'title' => $text,
                            'active' => 0,
                        )
                    );
                    $id = wp_insert_post($args_post);
                    if ($id > 0) {
                        update_user_meta($user->ID, "create_job_id", $id);
                        update_post_meta($id,  'request_id', '0');
                        update_post_meta($id,  'project_state', '0');
                        update_user_meta($user->ID, "bot_step", 'company-create-job-time');
                        $this->sendMessage($chatId, 'چقدر زمان لازم است پروژه پیاده سازی شود؟(روز)');
                    } else {
                        $this->sendMessage($chatId, 'خطا لطفا عنوان تکراری وارد  ننمایید');
                    }

                    break;
                }
            case "company-create-job-time": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'company-create-job-time');
                        $this->sendMessage($chatId, urlencode("لطفا زمان را بصورت عدد وارد نمایید"));
                    } else {
                        update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'time', $text);
                        update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'expire', 60);
                        update_user_meta($user->ID, "bot_step", 'company-create-job-min-price');
                        $this->sendMessage($chatId, urlencode("حداقل بودجه شما چقدر است؟(دلار)"));
                    }

                    break;
                }
            case "company-create-job-min-price": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'company-create-job-min-price');
                        $this->sendMessage($chatId, urlencode("لطفا حداقل بودجه را بصورت عدد وارد نمایید"));
                    } else {
                        update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'min_price', $text);
                        update_user_meta($user->ID, "bot_step", 'company-create-job-max-price');
                        $this->sendMessage($chatId, urlencode("حداکثر بودجه شما چقدر است؟(دلار)"));
                    }

                    break;
                }
            case "company-create-job-max-price": {
                    if (!is_numeric($text)) {
                        update_user_meta($user->ID, "bot_step", 'company-create-job-max-price');
                        $this->sendMessage($chatId, urlencode("لطفا حداکثر بودجه را بصورت عدد وارد نمایید"));
                    } else {
                        update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'max_price', $text);
                        update_user_meta($user->ID, "bot_step", 'company-create-job-tag');
                        $this->sendMessage($chatId, urlencode("تگ و مهارت های موردنیاز پروژه را  وارد نمایید با حرف , جدا کنید" . " " . "مثال" . " : " . "php,wordpress"));
                    }

                    break;
                }
            case "company-create-job-tag": {
                    update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'skills', $text);
                    update_user_meta($user->ID, "bot_step", 'company-create-job-desc');
                    $this->sendMessage($chatId, 'درباره پروژه خود بیشتر توضیح دهید');
                    break;
                }
            case "company-create-job-desc": {
                    $my_post = array(
                        'ID'            => get_the_author_meta("create_job_id", $user->ID),
                        'post_content'      => $text,
                        'post_status'  => 'publish'
                    );
                    wp_update_post($my_post);
                    update_post_meta(get_the_author_meta("create_job_id", $user->ID), 'desc', $text);
                    update_user_meta($user->ID, "bot_step", 'company-create-job-finish');
                    $this->sendMessage($chatId, 'پروژه پس از بررسی ادمین منتشر خواهد شد');
                    $this->company_menu($user, $chatId);
                    break;
                }
            default: {
                    //    $this->sendMessage($chatId, "خطا" . " : " . $step);
                };
        }

        //update_user_meta($user->ID, "bot_step", "input_text");
    }

    public function start_menu($item)
    {
        $chatId = $item['message']['chat']['id'];

        $this->run_start_menu($chatId);
    }

    public function run_start_menu($chatId)
    {

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'ثبت نام فریلنسر'],
                    ['text' => 'ثبت نام کارفرما']
                ],
                [
                    ['text' => 'ورود فریلنسر'],
                    ['text' => 'ورود کارفرما']
                ]
            ],

            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);


        $this->sendMessage($chatId, "یکی از گزینه های زیر را انتخاب نمایید", "&reply_markup=" . $encodedKeyboard);
    }

    public function login_user($chatid)
    {
        $user = get_user_by('login', $chatid);
        if ($user) {
            update_user_meta($user->ID, "user_type_login", "user");
            $user1 =  $this->get_login($chatid);
            $this->user_menu($user1, $chatid);
        } else {

            $this->sendMessage($chatid, urlencode('هنوز به عنوان فریلنسر ثبت نام نکرده اید'));
            $this->run_start_menu($chatid);
        }
    }

    public function login_company($chatid)
    {
        $user = get_user_by('login', $chatid);
        // echo 'step 1 :'.$user->ID.'<br>';
        if ($user) {
            $user1 =  $this->get_login($chatid);

            update_user_meta($user->ID, "user_type_login", "com");

            $this->company_menu($user1, $chatid);
        } else {

            $this->sendMessage($chatid, urlencode('هنوز به عنوان کارفرما ثبت نام نکرده اید'));
            $this->run_start_menu($chatid);
        }
    }

    public function user_menu($user, $chatId)
    {
        $step = get_the_author_meta('bot_step', $user->ID);
        $user1 =  $this->get_login($chatId);

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'مشاهده رزومه'],
                    ['text' => 'ساخت رزومه']
                ],
                [
                    ['text' => 'پروژه ها با مهارت من']
                ],
                [
                    ['text' => 'پروژه های در دست انجام']
                ],
                [
                    ['text' => 'پروژه های تکمیل یافته']
                ],
                [
                    ['text' => 'پیام ها']
                ],
                [
                    ['text' => 'بازگشت']
                ]
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);

        update_user_meta($user->ID, "bot_step", "menu");

        update_user_meta($user->ID, "back_menu", 'start');

        update_user_meta($user->ID, "current_menu", "ورود فریلنسر");

        $this->sendMessage($chatId, urlencode("منوی فریلنسر"), "&reply_markup=" . $encodedKeyboard);
    }

    public function company_menu($user, $chatId)
    {
        $step = get_the_author_meta('bot_step', $user->ID);

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'ویرایش پروفایل'],
                    ['text' => 'ایجاد پروژه'],
                    ['text' => 'پروژه های من']
                ],
                [
                    ['text' => 'پروژه های باز']
                ],
                [
                    ['text' => 'پروژه های در حال انجام']
                ],
                [
                    ['text' => 'پروژه های تکمیل شده']
                ],
                [
                    ['text' => 'پیام ها']
                ],
                [
                    ['text' => 'بازگشت']
                ]
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);

        update_user_meta($user->ID, "bot_step", "menu");

        update_user_meta($user->ID, "back_menu", 'start');

        update_user_meta($user->ID, "current_menu", "ورود کارفرما");

        $this->sendMessage($chatId, urlencode("منوی کارفرما"), "&reply_markup=" . $encodedKeyboard);
    }

    public function menu_message($user, $chatId)
    {
        $step = get_the_author_meta('bot_step', $user->ID);
        $user1 =  $this->get_login($chatId);

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'کل پیام ها']
                ],
                [
                    ['text' => 'پیام های خوانده شده']
                ],
                [
                    ['text' => 'پیام های خوانده نشده']
                ],
                [
                    ['text' => 'بازگشت']
                ]
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);

        update_user_meta($user->ID, "bot_step", "menu_message");

        update_user_meta($user->ID, "back_menu", 'ورود کارفرما');

        update_user_meta($user->ID, "current_menu", "پیام ها");

        $this->sendMessage($chatId, urlencode("منوی پیام ها"), "&reply_markup=" . $encodedKeyboard);
    }

    public function my_message($user, $chatId, $type_message = 0)
    {
        $user_id = $user->ID;


        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $search = array();

        $search["relation"] = "OR";
        $search[] =           array(
            'key' => 'owner_id',
            'value' => $user_id,
            'compare' => '='
        );

        $search[] =           array(
            'key' => 'sender_id',
            'value' => $user_id,
            'compare' => '='
        ); 

        $args = array(
            'post_type' => 'request',
            'post_status' => 'publish',
            'paged' => $paged,
            'posts_per_page' => 100,
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);


        $count = $the_query->post_count;

        $desc = "پیام ها :";
        $this->sendMessage($chatId, urlencode($desc));
        $index = 0;
        while ($the_query->have_posts()) :
            $the_query->the_post();

            $desc = '';
            update_post_meta(get_the_ID(), "new_message", 0);

            $job_id = get_post_meta(get_the_ID(), 'job_id', true);
            $new_message = get_post_meta(get_the_ID(), 'new_message', true);

            $new_message_desc = get_post_meta(get_the_ID(), 'new_message_desc', true);

            $new_message_desc = (strlen($new_message_desc) > 0) ? $new_message_desc : get_post_meta(get_the_ID(), 'desc', true);

            $is_new = 0;
            if ($new_message == 1 && get_post_meta(get_the_ID(), 'last_sender_message', true) != $user->ID) {
                $desc .= PHP_EOL . 'پیام جدید';
                $is_new = 1;
            }

            $desc .= PHP_EOL . get_the_title($job_id) . ' ';
            $desc .= PHP_EOL . get_the_author_meta('user_name') . ' ';
            $desc .= PHP_EOL . (strlen(get_the_author_meta('job_title')) > 0) ? get_the_author_meta('job_title') : get_the_author_meta('user_country');
            $desc .= PHP_EOL . $new_message_desc;
            $desc .= PHP_EOL;
            $desc .= ' ';
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'گفتگو و ارسال پیام', 'callback_data' => 'chat-user-message-' . get_the_ID()]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);

            if ($type_message == 1 && $is_new == 1) {
                continue;
            }

            if ($type_message == 2 && $is_new == 0) {
                continue;
            }
            $index++;
            $this->sendMessage($chatId, urlencode($desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;

        if ($index == 0) {
            $this->sendMessage($chatId, urlencode("هیچ پیامی وجود ندارد"));
            $this->menu_message($user, $chatId);
        }

        wp_reset_query();
    }
    public function chat_message($user, $chatId, $request_id)
    {
        update_user_meta($user->ID, "bot_step", 'chat');
        update_user_meta($user->ID, "chat_request_id", $request_id);
        update_post_meta($request_id, "new_message", 0);

        $chat = [];

        $str = get_post_meta($request_id, 'chat', true);
        if (strlen($str) > 0) {
            $chat = json_decode($str, true);
        }


        if (count($chat) == 0) {
            $message = get_post_meta($request_id, 'desc', true);
            if (strlen($message) > 0) {
                $chat[] = ["user_id" => get_post_meta($request_id, 'owner_id', true), "text" => $message, "date" => get_the_time('U', $request_id)];
            }
        }


        $desc = '';
        foreach ($chat as $item) {
            $desc .= PHP_EOL . get_the_author_meta('user_name', $item["user_id"]) . ' : ';
            $desc .= PHP_EOL . human_time_diff($item["date"], current_time('timestamp')) . ' ' . 'پیش' . ' ';
            $desc .= PHP_EOL .  $item["text"];
            $desc .= PHP_EOL .  ' --------------- ';
        }

        $desc .= PHP_EOL .  ' --------------- ';
        $desc .= PHP_EOL .  ' شما هم پیام خود را بگذارید ';

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'بازگشت']
                ]
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);

        update_user_meta($user->ID, "back_menu", 'پیام ها');

        update_user_meta($user->ID, "current_menu", "گفتگو و ارسال پیام");

        $this->sendMessage($chatId, urlencode($desc), "&reply_markup=" . $encodedKeyboard);
    }

    public function company_cat($user, $chatId)
    {
        $step = get_the_author_meta('bot_step', $user->ID);

        $cat_arr = [];

        $Kaktos_Category = new Kaktos_Category;
        $cats = $Kaktos_Category->get_company_cat_list();

        foreach ($cats as $item) {

            $cat = [];
            $cat[0] = ['text' => $item["title"], 'callback_data' => 'select-company-cat-' . $item["id"]];
            $cat_arr[] = $cat;
        }

        $keyboard = [
            'inline_keyboard' => $cat_arr
        ];
        $encodedKeyboard = json_encode($keyboard);

        update_user_meta($user->ID, "bot_step", "company_select_cat");

        $this->sendMessage($chatId, "دسته بندی را انتخاب نمایید", "&reply_markup=" . $encodedKeyboard);
    }

    public function company_selected_cat($cat_id, $chatId)
    {

        $user =  $this->get_login($chatId);
        update_user_meta($user->ID, "cat_id", $cat_id);
        $this->sendMessage($chatId, "اطلاعات ثبت شد");
    }

    public function company_job_delete($job_id, $chatId)
    {
        $user =  $this->get_login($chatId);
        wp_delete_post($job_id);
        $this->sendMessage($chatId, urlencode("پروژه مورد نظر حذف شد"));
    }
    public function company_request_status($job_id, $chatId, $status)
    {
        $user =  $this->get_login($chatId);
        update_post_meta($job_id, 'status', $status);
        $this->sendMessage($chatId, urlencode("وضعیت درخواست تغییر یافت"));
    }

    public function company_accept_request($request_id, $chatId, $status)
    {
        $user =  $this->get_login($chatId);

        $job_id = get_post_meta($request_id, 'job_id', true);

        update_post_meta($job_id, 'request_id', get_post_field('post_author', $request_id));
        update_post_meta($job_id, 'user_id', get_post_field('post_author', $job_id));
        update_post_meta($job_id, 'request_req_id', $request_id);
        update_post_meta($job_id, 'request_accept_time', current_time('timestamp'));
        update_post_meta($job_id, 'request_accept_date', date('Y-m-d H:i:s'));

        $this->sendMessage($chatId, urlencode("وضعیت پروژه به حالت در حال انجام تغییر یافت"));
        $this->company_menu($user, $chatId);
    }

    public function company_complete_project($job_id, $chatId, $status)
    {
        $user =  $this->get_login($chatId);

        update_post_meta($job_id, 'project_state', 1);
        update_post_meta($job_id, 'project_state_date', date('Y-m-d H:i:s'));
        $d = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
        update_post_meta($job_id, 'project_state_time', $d);

        $this->sendMessage($chatId, urlencode("وضعیت پروژه به حالت در حال انجام تغییر یافت"));
        $this->company_menu($user, $chatId);
    }

    public function company_profile($user, $chatId)
    {
        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'ویرایش نام شرکت']
                ],
                [
                    ['text' => 'ویرایش تلفن شرکت']
                ],
                [
                    ['text' => 'ویرایش درباره شرکت']
                ],
                [
                    ['text' => 'بازگشت']
                ]
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true
        ];
        $encodedKeyboard = json_encode($keyboard);
        $desc = "اطلاعات پروفایل :";
        $desc .= PHP_EOL . 'نام شرکت' . ' : ' . get_the_author_meta('company_name', $user->ID);
        $desc .= PHP_EOL . 'تلفن' . ' : ' . get_the_author_meta('tel', $user->ID);
        $desc .= PHP_EOL . 'درباره شرکت' . ' : ' . get_the_author_meta('desc', $user->ID);

        update_user_meta($user->ID, "back_menu", 'ورود کارفرما');

        update_user_meta($user->ID, "current_menu", "ویرایش پروفایل");

        $this->sendMessage($chatId, urlencode($desc), "&reply_markup=" . $encodedKeyboard);
    }

    public function company_create_job($user, $chatId)
    {
        update_user_meta($user->ID, "bot_step", 'company-create-job-name');

        $this->sendMessage($chatId, "عنوان پروژه خود را وارد نمائید");
    }

    public function company_my_jobs($user, $chatId)
    {

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'job',
            'author'  => $user->ID,
            'post_status' => 'publish'
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;
        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'حذف پروژه', 'callback_data' => 'company-job-remove-' . get_the_ID()],
                        ['text' => 'ویرایش پروژه', 'callback_data' => 'company-job-edit-' . get_the_ID()]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $desc = "";
            $desc .= PHP_EOL . "زمان پیاده سازی موردنیاز" . " : " . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز';
            $desc .= PHP_EOL . "حداقل بودجه برای پروژه" . " : " . get_post_meta(get_the_ID(), 'min_price', true) . ' ' . 'دلار';
            $desc .= PHP_EOL . "حداکثر بودجه برای پروژه" . " : " . get_post_meta(get_the_ID(), 'max_price', true) . ' ' . 'دلار';
            $desc .= PHP_EOL . "شرح پروژه" . " : " . get_post_meta(get_the_ID(), 'desc', true);

            $this->sendMessage($chatId, urlencode(get_the_title()  . ' ' . PHP_EOL . get_post_meta(get_the_ID(), 'skills', true) . $desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;
        wp_reset_query();
        $this->company_menu($user, $chatId);
    }

    public function user_profile($user, $chatId)
    {

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'نام' . ' : ' . get_the_author_meta('user_name', $user->ID), 'callback_data' => 'user-profile-name']
                ],
                [
                    ['text' => 'عنوان شغل' . ' : ' . get_the_author_meta('user_exp', $user->ID), 'callback_data' => 'user-profile-exp']
                ],
                [
                    ['text' => 'ایمیل' . ' : ' . get_the_author_meta('user_e_email', $user->ID), 'callback_data' => 'user-profile-email']
                ],
                [
                    ['text' => 'سال تولد' . ' : ' . get_the_author_meta('user_date_year', $user->ID), 'callback_data' => 'user-profile-date']
                ],
                [
                    ['text' => 'استان' . ' : ' . get_the_author_meta('user_state', $user->ID), 'callback_data' => 'user-profile-state']
                ],
                [
                    ['text' => 'شهر' . ' : ' . get_the_author_meta('user_city', $user->ID), 'callback_data' => 'user-profile-city']
                ],
                [
                    ['text' => 'تلفن' . ' : ' . get_the_author_meta('tel', $user->ID), 'callback_data' => 'user-profile-tel']
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);

        $this->sendMessage($chatId, urlencode("اطلاعات فردی"), "&reply_markup=" . $encodedKeyboard);
    }

    public function user_resume($user, $chatId)
    {
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'درباره من', 'callback_data' => 'user-resume-about'],
                    ['text' => 'مهارت ها و حرفه', 'callback_data' => 'user-resume-skills']
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);

        $this->sendMessage($chatId, urlencode("رزومه من"), "&reply_markup=" . $encodedKeyboard);
    }

    public function user_job_request($job_id, $chatId)
    {
        $user =  $this->get_login($chatId);

        $args_post = array(
            'post_title'   => get_the_author_meta('user_name', $user->ID) . ' ' . date('Y-m-d H:i:s'),
            'post_type'    => 'request',
            'post_author'  => $user->ID,
            'post_status'  => 'draft'
        );
        $id = wp_insert_post($args_post);

        update_post_meta($id,  "job_id", $job_id);
        update_post_meta($id,  "sender_id", $user->ID);
        update_post_meta($id,  "owner_id", get_post_field('post_author', $job_id));

        update_user_meta($user->ID, "create_request_id", $id);
        update_user_meta($user->ID, "bot_step", 'user-create-request-price');
        $this->sendMessage($chatId, urlencode("مقدار پیشنهاد خود را بیان کنید(دلار)"));
    }

    public function user_jobs($user, $chatId)
    {

        $data = json_decode(get_the_author_meta('skills', $user->ID));
        $skills = [];
        if (isset($data->skills)) {
            $skills = explode(',', $data->skills);
        }


        $search = array();
        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'project_state',
            'value' => 1,
            'compare' => '!='
        );

        $search1 = array();
        $search1["relation"] = "OR";
        foreach ($skills as $item) {
            $search[] =           array(
                'key' => 'skills',
                'value' => $item,
                'compare' => 'LIKE'
            );
        }

        $search[] = $search1;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'meta_key' => 'active',
            'meta_value' => '1',
            'posts_per_page' => 30,
            'paged' => $paged,
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;
        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'ارسال پیشنهاد', 'callback_data' => 'user-request-job-' . get_the_ID()]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $desc = "";
            $desc .= PHP_EOL . "زمان پیاده سازی موردنیاز" . " : " . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز';
            $desc .= PHP_EOL . "حداقل بودجه برای پروژه" . " : " . get_post_meta(get_the_ID(), 'min_price', true) . ' ' . 'دلار';
            $desc .= PHP_EOL . "حداکثر بودجه برای پروژه" . " : " . get_post_meta(get_the_ID(), 'max_price', true) . ' ' . 'دلار';
            $desc .= PHP_EOL . "شرح پروژه" . " : " . get_post_meta(get_the_ID(), 'desc', true);

            $this->sendMessage($chatId, urlencode(get_the_title()  . PHP_EOL . get_post_meta(get_the_ID(), 'skills', true) . $desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;
        wp_reset_query();
        $this->user_menu($user, $chatId);
    }


    public function user_requests($user, $chatId)
    {

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'request',
            'post_status' => 'publish',
            'author__in'  => [$user->ID],
            'posts_per_page' => 50,
            'paged' => $paged
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;
        $this->sendMessage($chatId, 'شما' . ' ' . $count . " "  . "درخواست همکاری دارید");
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $job_id = get_post_meta(get_the_ID(), 'job_id', true);

            $st = "وضعیت درخواست" . " : ";
            $status = get_post_meta(get_the_ID(), 'status', true);
            if ($status == 1) {
                $st = $st . 'بررسی شده';
            } else if ($status == 2) {
                $st = $st . 'تایید برای مصاحبه';
            } else if ($status == 3) {
                $st = $st . 'رد درخواست';
            } else if ($status == 4) {
                $st = $st . 'استخدام شده';
            } else {
                $st = $st . 'در انتظار وضعیت';
            }

            $this->sendMessage($chatId, urlencode(get_the_title($job_id) . ' / ' . get_the_title(get_post_meta($job_id, 'cat_id', true)) . ' ' . PHP_EOL . get_post_meta($job_id, 'tag', true) . PHP_EOL . $st));
        endwhile;
        wp_reset_query();
        $this->user_menu($user, $chatId);
    }

    public function user_project_1($user, $status = 0, $chatId)
    {

        $search = array();
        $search = array();

        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'request_id',
            'value' => $user->ID,
            'compare' => '='
        );
        $search[] =           array(
            'key' => 'project_state',
            'value' => 1,
            'compare' => '!='
        );


        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();

            $desc = "";
            $desc .= PHP_EOL . "نام پروژه" . " : " . get_the_title();
            $desc .= PHP_EOL . "کارفرما" . " : " . get_the_author_meta('company_name');
            $desc .= PHP_EOL . "پیشنهاد انتخاب شده" . " : " . get_post_meta(get_post_meta(get_the_ID(), 'request_req_id', true), 'price', true) . ' ' . 'دلار';


            $date = date_create();
            date_modify($date, "+" . get_post_meta(get_the_ID(), 'time', true) . " day");

            $d = mktime(date_format($date, "H"), date_format($date, "i"), date_format($date, "s"), date_format($date, "m"), date_format($date, "d"), date_format($date, "Y"));
            $cur = current_time('timestamp');
            if ($d > $cur) {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($cur, $d) . ' ' . 'دیگر';
            } else {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($d, $cur) . ' ' . 'گذشته';
            }

            $this->sendMessage($chatId, urlencode($desc));
        endwhile;
        wp_reset_query();
        $this->user_menu($user, $chatId);
    }

    public function user_project_2($user, $status = 0, $chatId)
    {

        $search = array();

        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'request_id',
            'value' => $user->ID,
            'compare' => '='
        );
        $search[] =           array(
            'key' => 'project_state',
            'value' => 1,
            'compare' => '='
        );


        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();

            $desc = "";
            $desc .= PHP_EOL . "نام پروژه" . " : " . get_the_title();
            $desc .= PHP_EOL . "کارفرما" . " : " . get_the_author_meta('company_name');
            $desc .= PHP_EOL . "پیشنهاد انتخاب شده" . " : " . get_post_meta(get_post_meta(get_the_ID(), 'request_req_id', true), 'price', true) . ' ' . 'دلار';


            $date = date_create();
            date_modify($date, "+" . get_post_meta(get_the_ID(), 'time', true) . " day");

            $d = get_post_meta(get_the_ID(), 'project_state_time', true);
            $cur = current_time('timestamp');
            if ($d > $cur) {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($cur, $d) . ' ' . 'دیگر';
            } else {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($d, $cur) . ' ' . 'گذشته';
            }

            $this->sendMessage($chatId, urlencode($desc));
        endwhile;
        wp_reset_query();
        $this->user_menu($user, $chatId);
    }

    public function company_project_0($user, $status = 0, $chatId)
    {
        global $wpdb;
        $search = array();

        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'request_id',
            'value' => 0,
            'compare' => '='
        );


        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'author'  => $user->ID,
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $avg = 0;
            $sql       = $wpdb->prepare("select (select pm1.meta_value from " . $wpdb->prefix . "postmeta pm1 where p.ID=pm1.post_id and pm1.meta_key='price') as price from " . $wpdb->prefix . "posts p left join " . $wpdb->prefix . "postmeta pm on p.ID=pm.post_id where p.post_type='request' and  p.post_status='publish' and pm.meta_key='job_id' and pm.meta_value='" . get_the_ID() . "'", array());
            // echo '<br>'.$sql;
            $result = $wpdb->get_results($sql, 'ARRAY_A');
            $count1 = count($result);

            if (count($result) > 0) {
                foreach ($result as $item) {
                    $avg += $item["price"];
                }
            }

            if ($count1 > 0) {
                $avg = round($avg / $count1);
            }

            $desc = "";
            $desc .= PHP_EOL . "تعداد پیشنهادات" . " : " . $count1;
            $desc .= PHP_EOL . "میانگین پیشنهادات" . " : " . $avg;

            $date = date_create();
            date_modify($date, "+" . get_post_meta(get_the_ID(), 'expire', true) . " day");

            $d = mktime(date_format($date, "H"), date_format($date, "i"), date_format($date, "s"), date_format($date, "m"), date_format($date, "d"), date_format($date, "Y"));
            $cur = current_time('timestamp');
            if ($d > $cur) {
                $desc .= PHP_EOL . "تاریخ پایان" . " : " . human_time_diff($cur, $d) . ' ' . 'دیگر';
            } else {
                $desc .= PHP_EOL . "تاریخ پایان" . " : " . human_time_diff($d, $cur) . ' ' . 'گذشته';
            }


            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'مشاهده پیشنهادات', 'callback_data' => 'project-requests-' . get_the_ID()]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);


            $this->sendMessage($chatId, urlencode(get_the_title()  . ' ' . PHP_EOL . get_post_meta(get_the_ID(), 'skills', true) . $desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;
        wp_reset_query();
        $this->company_menu($user, $chatId);
    }

    public function company_project_1($user, $status = 0, $chatId)
    {

        $search = array();

        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'request_id',
            'value' => 0,
            'compare' => '>'
        );
        $search[] =           array(
            'key' => 'project_state',
            'value' => 1,
            'compare' => '!='
        );


        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'author'  => $user->ID,
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();

            $desc = "";
            $desc .= PHP_EOL . "فریلنسر" . " : " . get_the_author_meta('user_name', get_post_meta(get_the_ID(), 'request_id', true));
            $desc .= PHP_EOL . "پیشنهاد انتخاب شده" . " : " . get_post_meta(get_post_meta(get_the_ID(), 'request_req_id', true), 'price', true) . ' ' . 'دلار';

            $date = date_create();
            date_modify($date, "+" . get_post_meta(get_the_ID(), 'time', true) . " day");

            $d = mktime(date_format($date, "H"), date_format($date, "i"), date_format($date, "s"), date_format($date, "m"), date_format($date, "d"), date_format($date, "Y"));
            $cur = current_time('timestamp');
            if ($d > $cur) {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($cur, $d) . ' ' . 'دیگر';
            } else {
                $desc .= PHP_EOL . "زمان تحویل" . " : " .  human_time_diff($d, $cur) . ' ' . 'گذشته';
            }

            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'اعلام اتمام پروژه', 'callback_data' => 'company-request-job-complete-' . get_the_ID()]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);

            $this->sendMessage($chatId, urlencode(get_the_title()  . ' ' . PHP_EOL . get_post_meta(get_the_ID(), 'skills', true) . $desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;
        wp_reset_query();
        $this->company_menu($user, $chatId);
    }

    public function company_project_2($user, $status = 0, $chatId)
    {

        $search = array();

        $search["relation"] = "AND";

        $search[] =           array(
            'key' => 'request_id',
            'value' => 0,
            'compare' => '>'
        );

        $search[] =           array(
            'key' => 'project_state',
            'value' => 1,
            'compare' => '='
        );


        $args = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'author'  => $user->ID,
            'meta_query' => $search
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, $count . " " . "پروژه پیدا شده است");
        while ($the_query->have_posts()) :
            $the_query->the_post();

            $desc = "";
            $desc .= PHP_EOL . "فریلنسر" . " : " . get_the_author_meta('user_name', get_post_meta(get_the_ID(), 'request_id', true));
            $desc .= PHP_EOL . "پیشنهاد انتخاب شده" . " : " . get_post_meta(get_post_meta(get_the_ID(), 'request_req_id', true), 'price', true) . ' ' . 'دلار';

            $d = get_post_meta(get_the_ID(), 'project_state_time', true);
            $cur = current_time('timestamp');
            if ($d > $cur) {
                $desc .= PHP_EOL . "زمان اتمام" . " : " .  human_time_diff($cur, $d) . ' ' . 'دیگر';
            } else {
                $desc .= PHP_EOL . "زمان اتمام" . " : " .  human_time_diff($d, $cur) . ' ' . 'گذشته';
            }

            $this->sendMessage($chatId, urlencode(get_the_title()  . ' ' . PHP_EOL . get_post_meta(get_the_ID(), 'skills', true) . $desc));
        endwhile;
        wp_reset_query();
        $this->company_menu($user, $chatId);
    }



    public function company_request_0($job_id, $chatId)
    {
        $user =  $this->get_login($chatId);
        echo $job_id;
        $args = array(
            'post_type' => 'request',
            'post_status' => 'publish',
            'meta_key' => 'job_id',
            'meta_value' => $job_id
        );
        $the_query = new WP_Query($args);
        $count = $the_query->post_count;

        $this->sendMessage($chatId, 'شما' . ' ' . $count . " "  . "پیشنهاد برای این پروژه دارید");


        while ($the_query->have_posts()) :
            $the_query->the_post();
            $job_id = get_post_meta(get_the_ID(), 'job_id', true);


            $desc = "";
            $desc .= PHP_EOL . "درخواست کننده" . " : " . get_the_author_meta('user_name') . ' ' . custom_get_the_date(get_the_ID());
            $desc .= PHP_EOL . "پیشنهاد" . " : " . get_post_meta(get_the_ID(), 'price', true) . ' ' . 'دلار';
            $desc .= PHP_EOL . "زمان تحویل" . " : " . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز';
            $desc .= PHP_EOL . "توضیحات" . " : " . get_post_meta(get_the_ID(), 'desc', true);


            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'استخدام و قبول درخواست', 'callback_data' => 'company-request-job-accept-' . get_the_ID()]
                    ],
                    [
                        ['text' => 'مشاهده رزومه', 'callback_data' => 'user-profile-view-' . get_the_author_meta('ID')]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);


            $this->sendMessage($chatId, urlencode(PHP_EOL  . $desc), "&reply_markup=" . $encodedKeyboard);
        endwhile;
        wp_reset_query();
        $this->company_menu($user, $chatId);
    }


    public function register_user($chat_id)
    {
        $user1 = get_user_by('login', $chat_id);
        if ($user1) {
        } else {
            $pass = rand(1000000, 9999999);
            $result = wp_create_user($chat_id, $pass);
            $user1 = get_user_by('id', $result);
        }
        update_user_meta($user1->ID, "user_type_login", "user");
        $user = get_user_by('id', get_the_author_meta('user_username', $user1->ID));
        if ($user) {
            $user_name = get_the_author_meta('user_name', $user->ID);
            if (strlen($user_name) == 0) {
                update_user_meta($user->ID, "bot_step", 'user-profile-register-name');
                $this->sendMessage($chat_id, urlencode("نام و نام خانوادگی را وارد نمایید"));
            } else {
                $this->sendMessage($chat_id, urlencode("شما قبلا ثبت نام کرده اید"));
                $this->run_start_menu($chat_id);
            }
            return;
        }
        $pass = rand(1000000, 9999999);
        $result = wp_create_user($chat_id . "_user", $pass);
        if (is_wp_error($result)) {
            $error = $result->get_error_message();
        } else {
            $user = get_user_by('id', $result);
            update_user_meta($user->ID, "user_pass", $pass);
            update_user_meta($user1->ID, "user_username", $user->ID);
            update_user_meta($user->ID, "user_type", "user");
            update_user_meta($user->ID, "bot_step", "start");
            update_user_meta($user->ID, "user_type_login", "user");

            update_user_meta($user->ID, "bot_step", 'user-profile-register-name');
            $this->sendMessage($chat_id, urlencode("نام و نام خانوادگی را وارد نمایید"));
        }
    }

    public function register_company($chat_id)
    {
        $user1 = get_user_by('login', $chat_id);
        if ($user1) {
        } else {
            $pass = rand(1000000, 9999999);
            $result = wp_create_user($chat_id, $pass);
            $user1 = get_user_by('id', $result);
        }
        update_user_meta($user1->ID, "user_type_login", "com");
        $user = get_user_by('id', get_the_author_meta('com_username', $user1->ID));
        if ($user) {
            $user_name = get_the_author_meta('company_name', $user->ID);
            if (strlen($user_name) == 0) {
                update_user_meta($user->ID, "bot_step", 'company-profile-register-name');
                $this->sendMessage($chat_id, urlencode("نام شرکت را وارد نمایید"));
            } else {
                $this->sendMessage($chat_id, urlencode("شما قبلا به عنوان کارفرما ثبت نام کرده اید"));
                $this->run_start_menu($chat_id);
            }
            return;
        }
        $pass = rand(1000000, 9999999);
        $result = wp_create_user($chat_id . "_com", $pass);
        if (is_wp_error($result)) {
            $error = $result->get_error_message();
        } else {
            $user = get_user_by('id', $result);
            update_user_meta($user->ID, "company_pass", $pass);
            update_user_meta($user1->ID, "com_username", $user->ID);
            update_user_meta($user->ID, "user_type", "company");
            update_user_meta($user->ID, "bot_step", "start");
            update_user_meta($user->ID, "bot_step", 'company-profile-register-name');
            update_user_meta($user->ID, "user_type_login", "com");
            $this->sendMessage($chat_id, urlencode("نام شرکت را وارد نمایید"));
        }
    }
}
