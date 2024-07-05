<?php

namespace DC_Optimize;

use DC_Optimize\WP_Session_Tokens;

class UserTracking
{
    private static $instance;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function __construct()
    {
        add_action('wp_ajax_trigger_monthly_report', [$this, 'trigger_report_callback']);
        register_activation_hook(__FILE__, [$this, 'dc_activate']);
        register_deactivation_hook(__FILE__, [$this, 'dc_deactivate']);
        add_action('dc_midnight_logout_event', [$this, 'perform_midnight_logout']);
        
        if (!wp_next_scheduled('dc_midnight_logout_event')) {
            wp_schedule_event(strtotime('today midnight'), 'daily', 'midnight_logout_event');
        };
    }

    // Function to perform the logout
    public function perform_midnight_logout() {
        // Get all non-admin users
        $users = get_users(['role__not_in' => ['administrator']]);

        // Log out each user
        foreach ($users as $user) {
            $user_id = $user->ID;
            // Clear user sessions by updating user's session tokens.
            delete_user_meta($user_id, 'session_tokens');
        }
    }

    // Activation hook
    public function dc_activate() {
        // Schedule event on activation
        if (!wp_next_scheduled('dc_midnight_logout_event')) {
            wp_schedule_event(time(), 'daily', 'dc_midnight_logout_event');
        }
    }

    // Deactivation hook
    public function dc_deactivate() {
        // Unschedule event on deactivation
        wp_clear_scheduled_hook('dc_midnight_logout_event');
    }

    function trigger_report_callback() {
        $days = $_POST['days'];
        $domain = $_POST['email_domain'];
    
        $res = $this->create_report($days, $domain);

        wp_send_json_success(['message' => 'Report generated successfully', 'data' => $res]);
    }

    public function create_report($days, $domain){

        $login_results = $this->get_logins($days);
        $output = [];
        
        if(!empty($login_results)){
            $contexts = $this->get_login_details($login_results, $domain);

            if(!empty($contexts)){
                $merged_array = [];

                foreach ($login_results as $login) {
                    foreach ($contexts as $context) {
                        if ($login->id == $context->history_id) {
                            // Merge properties from both arrays
                            $merged_item = (object)array_merge((array)$login, (array)$context);
                            $merged_array[] = $merged_item;
                        };
                    };
                };

                foreach ($merged_array as $ma) {
                    $dateTime = new \DateTime($ma->date);
                    $date = $dateTime->format('Y-m-d');
                    $email = $ma->value;
                    $output[] = [$email, $date];
                };
            };

            $to = get_option('admin_email');
            $subject = "User Report for: {$domain} in the last {$days} days";
            $hasData = false;

            if (!empty($output)) {
                $hasData = true;
                $message .= "<h4>User Report for: <strong>{$domain}</strong> in the last <strong>{$days}</strong> days with user's email/login dates:</h4><br>";
            
                foreach ($output as $entry) {
                    $message .= "<p><strong>Email: </strong> $entry[0] | <strong>Date:</strong> $entry[1]</p>";
                };

                $headers = array('Content-Type: text/html; charset=UTF-8');

                // Send the email
                wp_mail($to, $subject, $message, $headers);

            } else {
                $message .= "<p>No data available to report.</p>";
            }

            return (['message' => $message, 'hasData' => $hasData]);
        };
    }

    private function get_logins($days) {
        global $wpdb;
        $days_ago = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        // get all logins within the last 30 days
        $query = $wpdb->prepare(
            "SELECT `id`, `date`
            FROM {$wpdb->prefix}simple_history
            WHERE message = %s
            AND `date` >= %s",
            'Logged in',
            $days_ago
        );

        $login_results = $wpdb->get_results($query);

        if (!empty($login_results)) {
            return $login_results;
        } else {
            // No matching "Logged in" messages found in the last 30 days.
            return [];
        };
    }

    private function get_login_details($login_results, $domain){
        global $wpdb;
        $placeholders = implode(', ', array_fill(0, count($login_results), '%d'));
        $email_domain_placeholder = '%' . esc_sql($domain) . '%';

        foreach ($login_results as $result) {
            $merged_array[] = $result->id;
        };

        // get all contexts with matching email domain and history ids
        $query = $wpdb->prepare(
            "SELECT history_id, `key`, `value`
            FROM {$wpdb->prefix}simple_history_contexts
            WHERE history_id IN ($placeholders)
            AND `key` = '_user_email'
            AND `value` LIKE %s",
            array_merge($merged_array, array($email_domain_placeholder))
        );

        $contexts = $wpdb->get_results($query);

        if (!empty($contexts)) {
            return $contexts;
        } else {
            // No matching contexts found for login IDs.
            return [];
        };
    }

    // private function get_users_name($email){
    //     $user = get_user_by('email', $email);

    //     if ($user) {
    //         $user_id = $user->ID;

    //         $first_name = get_user_meta($user_id, 'first_name', true);
    //         $last_name = get_user_meta($user_id, 'last_name', true);

    //         return $first_name . " " . $last_name;
    //     } else {
    //         return "Name not found";
    //     };
    // }

}