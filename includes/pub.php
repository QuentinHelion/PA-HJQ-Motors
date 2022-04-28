<style>
  #rigth{
    right: 0;
    left: auto;
  }

  #left {
    left: 0;
    right: auto;
  }
  .col-1 > img{
    overflow: hidden !important;
    height: 55vh !important;
  }
  .col-1{
    overflow: hidden;
    position: fixed;
    width: 10vw !important;

  }
  div#pub.d-flex.justify-content-between{
    margin-top: 25vh;
    position: absolute;
    position: fixed;
    z-index: 10;
    width: 100% !important;
    /* position: absolute; */
  }
</style>

<div id="pub" class="d-flex justify-content-between ">
  <div class="col-1" id="left">
    <img src="uploads/pub1.png" alt="pub1">
  </div>
  <div class="col-1" id="rigth">
    <img src="uploads/pub2.png" alt="pub2">
  </div>
</div>
