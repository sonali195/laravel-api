<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectname = ucwords(config('app.name'));
        EmailTemplate::firstOrCreate([
            'id' => 1,
        ], [
            'title' => "Reset Password",
            'subject' => "Reset Password",
            'body' => "<p>Hello {user_name},</p>
            <p>You have received this email because we received a password reset request for your account. Please click on the link below to reset your password.</p>
            <p><a href='{password_reset_link}'>Click Here</a></p>
            <p>This password reset link will expire in {expiry_time} minutes.</p>
            <p>If you did not request a password reset, please get in touch with us at info@example.com and we will investigate further.</p> <p>Warm Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 2,
        ], [
            'title' => "Reset password (User)",
            'subject' => "Reset Password",
            'body' => "<p>Hello {user_name},</p><p>We received a request to reset the password for your " . $projectname . " account. To proceed with the password reset, please use the following verification code:</p><p><strong>Verification Code:</strong> {code}</p><p>If you have any questions or concerns, please contact our support team at info@example.co.uk.</p><p>Thank you for choosing " . $projectname . ". We value your security and are here to help.</p><p>Warm Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 3,
        ], [
            'title' => "Welcome mail",
            'subject' => "Welcome to " . $projectname . "!",
            'body' => "<p>Hi {user_name}!</p><p>Welcome to " . $projectname . "! Thanks so much for joining us.</p><p>Have any questions? Just shoot us an email at info@example.co.uk! We are always here to help.</p><p>Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 4,
        ], [
            'title' => "Account Activate (User)",
            'subject' => "Account Activated",
            'body' => "<p>Hello {user_name},</p><p>Your account has been activated, Now you can login</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 5,
        ], [
            'title' => "Account Suspended (User)",
            'subject' => "Account Suspended",
            'body' => "<p>Hello {user_name},</p><p>Your account have been suspended by " . $projectname . " Team. For more information, please contact us at info@example.co.uk</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 6,
        ], [
            'title' => "Contact Enquiry",
            'subject' => "Enquiry",
            'body' => "<p>Hello!</p><p>New&nbsp;Enquiry</p><p>Name: {name}<br />Email: {email}<br />Message: {message}</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 7,
        ], [
            'title' => "User account created by admin (User)",
            'subject' => "Your Account is created on " . $projectname . "",
            'body' => "<p>Hello!</p><p>Welcome to " . $projectname . "! We are excited to inform you that your account has been created in our system.</p><p><a href=\"{activation_link}\"><strong>Click here</strong></a>&nbsp;to set up your account password.</p><p>If you have any questions or concerns, please contact our support team at info@example.co.uk.</p><p>Thank you for choosing " . $projectname . ". We appreciate your trust, and we're excited to have you as part of our community.</p><p>Best regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 8,
        ], [
            'title' => "1111Contact Enquiry",
            'subject' => "Enquiry",
            'body' => "<p>Hello!</p><p>New&nbsp;Enquiry</p><p>Name: {name}<br />Email: {email}<br />Message: {message}</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);
    }
}
