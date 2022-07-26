<template>
  <div class="jumbo-size d-flex justify-content-center container-fluid">
    <div class="row">
      <div class="col-lg-6 col-sm-12 jumbo-container d-flex justify-content-center align-items-center">
        <img src="storage/uploads/kisspng-logo-computer-icons-scalable-vector-graphics-clip-filemcdonaldampapossshadow-svg-wikipedia-5c775acd244151.2332977515513259011485.jpg" class="logo shadow" id="lolgo" alt="...">
      </div>
      <div class="col-lg-6 col-sm-12 jumbo-container d-flex justify-content-center align-items-center">
        <h1 class="jumbo-title">Consegna di cibo a domicilio</h1>
      </div>
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
  height: 400px;
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

#lolgo{
   width: 200px;
  position: relative;
}
.logo:hover{
 
  animation-name: example;
  animation-duration: 2s;
}
@keyframes example {
  0%   {left:0px; top:0px;}
  50%  { left:0px; top:-50px;}
  100% {left:0px; top:0px;}
}
</style>