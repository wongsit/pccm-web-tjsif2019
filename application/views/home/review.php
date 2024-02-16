<section id="review" class="review">
  <div class="container">
      <!-- <h1>Reviews</h1>
      <p>Thank you very much for coming all the way to join us. TJ-SIF 2016 ended successfully with 800 visitors. We share some of the precious memories and will never forget them until we meet again!</p>
      <h3><p class="text-warning"><i class="fa fa-play fa-fw" aria-hidden="true"></i>&nbsp;Videos</p></h3> -->
      <div id="review-ov-1">
          <h4>TJ-SIF2019 Official Video</h4>
          <div class="embed-responsive embed-responsive-16by9">
              <iframe src="https://www.youtube.com/embed/CURY4hpUcRc?controls=0&amp;start=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
      </div>
    <div id="video1">
        <h4>Introduce all schools</h4>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/AZAdHUwar30" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <div id="video2">
        <h4>Introduce Twelve Princess Chulabhorn Science High Schools</h4>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/6lPn_5JvynA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <div id="video3">
        <h4>All The Activities TJ-SIF 2019</h4>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/YGqUubDJp48" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

      <div id="tjsif2019-live">
          <h4>TJ-SIF2019 Live</h4>
              <a href="http://gg.gg/tjsif2019-live" target="_blank">
              <img src="<?php echo base_url(); ?>assets/images/home/Live.jpg" class="d-block w-100" alt="Live">
              </a>
      </div>

      <div id="review-sawasdee">
          <h3><p class="text-warning"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i>&nbsp;Daily Newspapers</p></h3>
          <div class="table-responsive">
              <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                        <td>PCSHS News 19th December 2019 (.pdf)</td>
                        <td><?php echo $this->Users_model->fetch_file_download('TJ-SIF2019_191219-news.pdf'); //update time ์?></td>
                        <td><a href="<?php echo base_url(); ?>welcome/download/TJ-SIF2019_191219-news.pdf" target="_blank" class="btn btn-lg btn-warning pull-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                    </tr>
                      <tr>
                          <td>PCSHS News 20th December 2019 (.pdf)</td>
                          <td><?php echo $this->Users_model->fetch_file_download('TJ-SIF2019_191220-news.pdf'); //update time ์?></td>
                          <td><a href="<?php echo base_url(); ?>welcome/download/TJ-SIF2019_191220-news.pdf" target="_blank" class="btn btn-lg btn-danger pull-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                      </tr>
                      <tr>
                          <td>PCSHS News 21st December 2019(.pdf)</td>
                          <td><?php echo $this->Users_model->fetch_file_download('TJ-SIF2019_191221-news.pdf'); //update time ์?></td>
                          <td><a href="<?php echo base_url(); ?>welcome/download/TJ-SIF2019_191221-news.pdf" target="_blank" class="btn btn-lg btn-info pull-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                      </tr>
                      <tr>
                          <td>PCSHS News 22nd December 2019(.pdf)</td>
                          <td><?php echo $this->Users_model->fetch_file_download('TJ-SIF2019_191222-news.pdf'); //update time ์?></td>
                          <td><a href="<?php echo base_url(); ?>welcome/download/TJ-SIF2019_191222-news.pdf" target="_blank" class="btn btn-lg btn-primary pull-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
    </div><!-- /.container -->
</section><!-- /about-->
