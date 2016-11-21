<?php
require_once('stripe-bsf/init.php');

$stripe = array(
  secret_key      => ('sk_test_u9qXsOKITj7oB5P6xuh2smJo'),
  publishable_key => ('pk_test_1V0y2RCkZmzF1fdtvg9Vc3dv')
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>