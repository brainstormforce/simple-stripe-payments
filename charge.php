<?php
  require_once('config.php');

  $token  = $_POST['stripeToken'];
  $amount = $_POST['amount'];

  $customer = \Stripe\Customer::create(array(
      'email' => 'anilj@bsf.io',
      'card'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'usd'
  ));

  echo '<h1>Successfully charged $5!</h1>';
?>