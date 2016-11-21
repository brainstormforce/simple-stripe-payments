<?php
  require_once('config.php');

  $token  = $_POST['stripeToken'];
  $amount = $_POST['amount'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'card'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'usd'
  ));

  echo '<h1>Successfully charged $5!</h1>';
?>