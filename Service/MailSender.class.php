
<?php
class MailSender
{
    private const DEFAULT_SUBJECT = "Haarlem Festival Invoice";
    private const DEFAULT_SENDER = "From: info@haarlemFestiv.com";
    private const DEFAULT_MESSAGE = "Thank you purchasing our tickects";

    private string $subject;
    private string $headers;
    private string $message;
    private string $recipient;


    public function __construct(string $recipient, string $subject=self::DEFAULT_SUBJECT, string $message=self::DEFAULT_MESSAGE, string $headers=self::DEFAULT_SENDER)
    {
        $this->subject = $subject;
        $this->headers = $headers;
        $this->recipient =$recipient;
        $this->message = $message;
    }

    public function sendEmail() 
    {
        mail($recipient, $subject, $message, $headers);
    }
}
?> 