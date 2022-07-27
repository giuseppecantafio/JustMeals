<template>
  <div class="jumbo-size d-flex justify-content-center container-fluid">
    <!-- <div class="row">
      <div class="col-lg-6 col-sm-12 jumbo-container d-flex justify-content-center align-items-center">
        <img src="storage/uploads/kisspng-logo-computer-icons-scalable-vector-graphics-clip-filemcdonaldampapossshadow-svg-wikipedia-5c775acd244151.2332977515513259011485.jpg" class="logo shadow" id="lolgo" alt="...">
      </div>
      <div class="col-lg-6 col-sm-12 jumbo-container d-flex justify-content-center align-items-center">
        <h1 class="jumbo-title">Consegna di cibo a domicilio</h1>
      </div> 
    </div>-->
    <div class="img-container animate__animated animate__bounceInDown animate__slow animate__delay-0.5s"> 
      <img src="/images/Justmeals-ai-white-su-blue.png"  id="jumbo-img" alt="" class="jumbo-immagine">
    </div>
    
  </div>
</template>

<script>

export default {
  name: "JumbotronComponent"
}
</script>

<style>

.jumbo-size{
  height: 300px;
}
.jumbo-container{
  width: 600px;
  
}
.jumbo-title{
  font-size: 60px;
  color: #3DB0B6;
  text-shadow: 2px 2px 5px black;
  text-align: center;
}

/* #lolgo{
   width: 200px;
  position: relative;
}
.logo:hover{

  animation-name:;
  animation-duration: 2s;
}
@keyframes example {
  
} */
#jumbo-img {
  display: inline-block;
  margin: 0 0.5rem;

  animation: bounce; /* referring directly to the animation's @keyframe declaration */
  animation-duration: 2.5s; /* don't forget to set a duration! */
}
.img-container{
  padding-top: 3%;
}
</style>