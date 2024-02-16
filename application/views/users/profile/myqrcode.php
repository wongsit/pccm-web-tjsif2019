<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">QR-CODE - <?php echo $user->firstname.' '.$user->lastname; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-4">
      <h3 class="text-info">My QR-code</h3>
      <?php
      $params['data'] = $user->id;
      $params['level'] = 'H';
      $params['size'] = 10;
      $qrcode_img = FCPATH.'assets/images/qrcode/'.$user->id.'.png';
      $params['savename'] = $qrcode_img;
      $this->ciqrcode->generate($params);
      //echo '<img src="'.$qrcode_img.'" />';
      ?>
      <img src="<?php echo base_url(); ?>assets/images/qrcode/<?php echo $user->id.'.png'; ?>" class="img-responsive d-block w-100" alt="Cinque Terre">
      <h5 class="text-info">ID: <?php echo $user->id; ?></h5>
    </div>

    </div>
    <hr class="featurette-divider">
    <div class="col-sm-4">
    <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
    </button>
    </div>

  </div>
