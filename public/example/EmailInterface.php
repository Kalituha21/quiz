<?php


interface EmailInterface
{
    public function send(string $email, string $message);
}