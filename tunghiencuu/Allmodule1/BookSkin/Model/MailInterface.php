<?php

namespace Convert\BookSkin\Model;

interface MailInterface
{
    /**
     * Send email from book skin form
     *
     * @param string $replyTo Reply-to email address
     * @param array $variables Email template variables
     * @return void
     */
    public function send($replyTo, array $variables);
}
