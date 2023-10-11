<?php include("navbar.php"); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald:wght@700&family=Rouge+Script&display=swap');

body{
  background-color: #f5f5f5;
}

p{
  color: grey;
  text-align: center;
  max-height: 50px;
}

button{
  width: 35px;
  height: 35px;
  border: 1px solid #4CAF50;
  border-radius: 50%;
  font-size: 1.5rem;
}

.pagination {
  display: flex;
  justify-content: center;
  }

  .pagination-container{
    display: flex;
    justify-content: center;
    margin-top: 2rem;
  }
  
  .pagination a {
    color: black;
    float: left;
    padding: 8px ;
    text-decoration: none;
  }
  
  .pagination a:hover{
    cursor: pointer;
  }
  
  
  .active {
    text-align: center;
    color: #4CAF50 !important;
    font-size: 1.5rem;
  }
  
  /* .pagination a:hover:not(.active) {background-color: #ddd;} */

  .image-container{
    overflow: hidden;
    color: #fff;
    /* height: 40%; */
    height: 300px;
    width: 17%;
    padding: 5px;
    background-color: white;
    align-items: center;
    border: 10px solid white;
    border-radius: 20px;
    box-shadow: 0 3px 60px rgba(57,73,76,0.35);
    transition:.5s ease all;
    margin: 0.25rem;
  }

  .image-container:hover{
    transform: scale(1.01);
    
    cursor: pointer;
  }


  .pagination-heading{
    text-align: center;
    font-size: 3rem;
    color: grey;
    font-family: 'Rouge Script', cursive;
  }

  .d-none{
    display: none;
  }

  .images{
    height: 80%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  img{
    border: 5px;
    border-radius: 10px;
    width:100%;
    height: 80%;
    object-fit: cover;
    display: block;
    background-size: cover;
    background-repeat: no-repeat;
  }


  /* Error Page */
 
/*======================
    404 page
=======================*/


.page_404{ 
  padding:40px 0;
  background:#fff;
  font-family: 'Arvo', serif;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  top: 0;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
    background-repeat: no-repeat;
 }
 
 
 .four_zero_four_bg h1{
 font-size:80px;
 }
 
  .four_zero_four_bg h3{
			 font-size:80px;
			 }
			 
.link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
.contant_box_404{ 
  margin-top:-50px;
}

.text-center {
  text-align: center;
}


/* **********************************Loading********************* */
.loader {
  --duration: 3s;
  --primary: rgba(39, 94, 254, 1);
  --primary-light: #2f71ff;
  --primary-rgba: rgba(39, 94, 254, 0);
  width: 200px;
  height: 320px;
  position: relative;
  transform-style: preserve-3d;
}

@media (max-width: 480px) {
  .loader {
    zoom: 0.44;
  }
}

.loader:before, .loader:after {
  --r: 20.5deg;
  content: "";
  width: 320px;
  height: 140px;
  position: absolute;
  right: 32%;
  bottom: -11px;
/* change the back groung color on switching from light to dark mood */
  background: #e8e8e8;
  transform: translateZ(200px) rotate(var(--r));
  -webkit-animation: mask var(--duration) linear forwards infinite;
  animation: mask var(--duration) linear forwards infinite;
}

.loader:after {
  --r: -20.5deg;
  right: auto;
  left: 32%;
}

.loader .ground {
  position: absolute;
  left: -50px;
  bottom: -120px;
  transform-style: preserve-3d;
  transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
}

.loader .ground div {
  transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
  width: 200px;
  height: 200px;
  background: var(--primary);
  background: linear-gradient(45deg, var(--primary) 0%, var(--primary) 50%, var(--primary-light) 50%, var(--primary-light) 100%);
  transform-style: preserve-3d;
  -webkit-animation: ground var(--duration) linear forwards infinite;
  animation: ground var(--duration) linear forwards infinite;
}

.loader .ground div:before, .loader .ground div:after {
  --rx: 90deg;
  --ry: 0deg;
  --x: 44px;
  --y: 162px;
  --z: -50px;
  content: "";
  width: 156px;
  height: 300px;
  opacity: 0;
  background: linear-gradient(var(--primary), var(--primary-rgba));
  position: absolute;
  transform: rotateX(var(--rx)) rotateY(var(--ry)) translate(var(--x), var(--y)) translateZ(var(--z));
  -webkit-animation: ground-shine var(--duration) linear forwards infinite;
  animation: ground-shine var(--duration) linear forwards infinite;
}

.loader .ground div:after {
  --rx: 90deg;
  --ry: 90deg;
  --x: 0;
  --y: 177px;
  --z: 150px;
}

.loader .box {
  --x: 0;
  --y: 0;
  position: absolute;
  -webkit-animation: var(--duration) linear forwards infinite;
  animation: var(--duration) linear forwards infinite;
  transform: translate(var(--x), var(--y));
}

.loader .box div {
  background-color: var(--primary);
  width: 48px;
  height: 48px;
  position: relative;
  transform-style: preserve-3d;
  -webkit-animation: var(--duration) ease forwards infinite;
  animation: var(--duration) ease forwards infinite;
  transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
}

.loader .box div:before, .loader .box div:after {
  --rx: 90deg;
  --ry: 0deg;
  --z: 24px;
  --y: -24px;
  --x: 0;
  content: "";
  position: absolute;
  background-color: inherit;
  width: inherit;
  height: inherit;
  transform: rotateX(var(--rx)) rotateY(var(--ry)) translate(var(--x), var(--y)) translateZ(var(--z));
  filter: brightness(var(--b, 1.2));
}

.loader .box div:after {
  --rx: 0deg;
  --ry: 90deg;
  --x: 24px;
  --y: 0;
  --b: 1.4;
}

.loader .box.box0 {
  --x: -220px;
  --y: -120px;
  left: 58px;
  top: 108px;
}

.loader .box.box1 {
  --x: -260px;
  --y: 120px;
  left: 25px;
  top: 120px;
}

.loader .box.box2 {
  --x: 120px;
  --y: -190px;
  left: 58px;
  top: 64px;
}

.loader .box.box3 {
  --x: 280px;
  --y: -40px;
  left: 91px;
  top: 120px;
}

.loader .box.box4 {
  --x: 60px;
  --y: 200px;
  left: 58px;
  top: 132px;
}

.loader .box.box5 {
  --x: -220px;
  --y: -120px;
  left: 25px;
  top: 76px;
}

.loader .box.box6 {
  --x: -260px;
  --y: 120px;
  left: 91px;
  top: 76px;
}

.loader .box.box7 {
  --x: -240px;
  --y: 200px;
  left: 58px;
  top: 87px;
}

.loader .box0 {
  -webkit-animation-name: box-move0;
  animation-name: box-move0;
}

.loader .box0 div {
  -webkit-animation-name: box-scale0;
  animation-name: box-scale0;
}

.loader .box1 {
  -webkit-animation-name: box-move1;
  animation-name: box-move1;
}

.loader .box1 div {
  -webkit-animation-name: box-scale1;
  animation-name: box-scale1;
}

.loader .box2 {
  -webkit-animation-name: box-move2;
  animation-name: box-move2;
}

.loader .box2 div {
  -webkit-animation-name: box-scale2;
  animation-name: box-scale2;
}

.loader .box3 {
  -webkit-animation-name: box-move3;
  animation-name: box-move3;
}

.loader .box3 div {
  -webkit-animation-name: box-scale3;
  animation-name: box-scale3;
}

.loader .box4 {
  -webkit-animation-name: box-move4;
  animation-name: box-move4;
}

.loader .box4 div {
  -webkit-animation-name: box-scale4;
  animation-name: box-scale4;
}

.loader .box5 {
  -webkit-animation-name: box-move5;
  animation-name: box-move5;
}

.loader .box5 div {
  -webkit-animation-name: box-scale5;
  animation-name: box-scale5;
}

.loader .box6 {
  -webkit-animation-name: box-move6;
  animation-name: box-move6;
}

.loader .box6 div {
  -webkit-animation-name: box-scale6;
  animation-name: box-scale6;
}

.loader .box7 {
  -webkit-animation-name: box-move7;
  animation-name: box-move7;
}

.loader .box7 div {
  -webkit-animation-name: box-scale7;
  animation-name: box-scale7;
}

@-webkit-keyframes box-move0 {
  12% {
    transform: translate(var(--x), var(--y));
  }

  25%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move0 {
  12% {
    transform: translate(var(--x), var(--y));
  }

  25%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale0 {
  6% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  14%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale0 {
  6% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  14%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move1 {
  16% {
    transform: translate(var(--x), var(--y));
  }

  29%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move1 {
  16% {
    transform: translate(var(--x), var(--y));
  }

  29%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale1 {
  10% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  18%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale1 {
  10% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  18%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move2 {
  20% {
    transform: translate(var(--x), var(--y));
  }

  33%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move2 {
  20% {
    transform: translate(var(--x), var(--y));
  }

  33%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale2 {
  14% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  22%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale2 {
  14% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  22%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move3 {
  24% {
    transform: translate(var(--x), var(--y));
  }

  37%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move3 {
  24% {
    transform: translate(var(--x), var(--y));
  }

  37%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale3 {
  18% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  26%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale3 {
  18% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  26%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move4 {
  28% {
    transform: translate(var(--x), var(--y));
  }

  41%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move4 {
  28% {
    transform: translate(var(--x), var(--y));
  }

  41%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale4 {
  22% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  30%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale4 {
  22% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  30%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move5 {
  32% {
    transform: translate(var(--x), var(--y));
  }

  45%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move5 {
  32% {
    transform: translate(var(--x), var(--y));
  }

  45%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale5 {
  26% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  34%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale5 {
  26% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  34%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move6 {
  36% {
    transform: translate(var(--x), var(--y));
  }

  49%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move6 {
  36% {
    transform: translate(var(--x), var(--y));
  }

  49%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale6 {
  30% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  38%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale6 {
  30% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  38%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes box-move7 {
  40% {
    transform: translate(var(--x), var(--y));
  }

  53%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@keyframes box-move7 {
  40% {
    transform: translate(var(--x), var(--y));
  }

  53%, 52% {
    transform: translate(0, 0);
  }

  80% {
    transform: translate(0, -32px);
  }

  90%, 100% {
    transform: translate(0, 188px);
  }
}

@-webkit-keyframes box-scale7 {
  34% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  42%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@keyframes box-scale7 {
  34% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(0);
  }

  42%, 100% {
    transform: rotateY(-47deg) rotateX(-15deg) rotateZ(15deg) scale(1);
  }
}

@-webkit-keyframes ground {
  0%, 65% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
  }

  75%, 90% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(1);
  }

  100% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
  }
}

@keyframes ground {
  0%, 65% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
  }

  75%, 90% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(1);
  }

  100% {
    transform: rotateX(90deg) rotateY(0deg) translate(-48px, -120px) translateZ(100px) scale(0);
  }
}

@-webkit-keyframes ground-shine {
  0%, 70% {
    opacity: 0;
  }

  75%, 87% {
    opacity: 0.2;
  }

  100% {
    opacity: 0;
  }
}

@keyframes ground-shine {
  0%, 70% {
    opacity: 0;
  }

  75%, 87% {
    opacity: 0.2;
  }

  100% {
    opacity: 0;
  }
}

@-webkit-keyframes mask {
  0%, 65% {
    opacity: 0;
  }

  66%, 100% {
    opacity: 1;
  }
}

@keyframes mask {
  0%, 65% {
    opacity: 0;
  }

  66%, 100% {
    opacity: 1;
  }
}
.loader{
  position: absolute;
 top: 50%;
left: 50%;
 margin: -25px 0 0 -25px; /* Apply negative top and left margins to truly center the element */
}

</style>
<section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Special Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Sale Item</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Popular Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Sale Item</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $120.00 - $280.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Special Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Popular Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="images">
    
  </section>
        <div class="pagination-container">
            <button id="prevBtn">&laquo;</button>
            <div class="pagination" id="pagination"></div>
            <button id="nextBtn">&raquo;</button>
        </div>

        <script>

let paginationDiv = document.querySelectorAll('.number');
var images = document.querySelectorAll(".image-container");
var imageContainer = document.querySelector(".images");
var image = document.querySelectorAll(".image");
let prevBtn = document.getElementById('prevBtn');
let nextBtn = document.getElementById('nextBtn');
const paginationElement = document.getElementById('pagination');
var currentPage = 1; 
var perPageLimit =10;
var limit = 200;
const totalPages = Math.ceil(limit/perPageLimit); 
const numPagesToShow = 3; 

var currentIndex ;

// *Fetching API Data*
var auth ="t5rQbk5GjYAgjGz3WVWWzVWDeWLYUg47Hey3BE3uAV0"
let fetchData  = async(currentPage)=>{
    try{
        // *Loading*
        imageContainer.innerHTML = 
        `<div class="loader">
        <div class="box box0">
          <div></div>
        </div>
        <div class="box box1">
          <div></div>
        </div>
        <div class="box box2">
          <div></div>
        </div>
        <div class="box box3">
          <div></div>
        </div>
        <div class="box box4">
          <div></div>
        </div>
        <div class="box box5">
          <div></div>
        </div>
        <div class="box box6">
          <div></div>
        </div>
        <div class="box box7">
          <div></div>
        </div>
        <div class="ground">
          <div></div>
        </div>
      </div>`;

        let response = await fetch(`https://api.unsplash.com/photos/?client_id=${auth}&page=${currentPage}&per_page=${perPageLimit}&Total=${limit}`, { 
        method: "GET",
        });
        var data = await response.json();

        // *Removing Loading*
        imageContainer.innerHTML = '';



    // *********************Creating Element and appending to Html****************

    const imageList = [];
        for (let i = 0; i < perPageLimit; i++) {
            imageList.push(`<div id="${i+1}" class="image-container">
                                <img src="${data[i].urls.small}" loading="lazy" class="image"></img>
                                <p>${data[i].alt_description}</p>
                            </div>`);
        }
        imageContainer.innerHTML = imageList.join(' ');


}
 catch(error){
    console.log(error);
    // *Error Page*
    const errorList = [
        `<section class="page_404">`,
       ` <div class="container">`,
            `<div class="row">`	,
           ` <div class="col-sm-12 ">`,
            `<div class="col-sm-10 col-sm-offset-1  text-center">`,
            `<div class="four_zero_four_bg">`,
                `<h1 class="text-center ">Something Went Wrong</h1>`,
            
            
           ` </div>`,
            
           ` <div class="contant_box_404">`,
           ` <h3 class="h2">`,
           ` Look like you're lost`,
            `</h3>`,
            
            `<p>the page you are looking for not avaible!</p>`,
  
       ` </div>`,
           ` </div>`,
           ` </div>`,
           ` </div>`,
       ` </div>`,
    `</section>`,
    ]
    
    console.error()
    document.body.innerHTML = errorList.join(' ');
}

}


function generatePagination() {
        // *Calculate start and end page numbers to display
        let startPage = Math.max(currentPage - Math.floor(numPagesToShow / 2), 1);
        let endPage = startPage + numPagesToShow - 1;

        // *Adjust if the end page is greater than the total number of pages*
        if (endPage > totalPages) {
            endPage = totalPages;
            startPage = Math.max(endPage - numPagesToShow + 1, 1);
        }



        // *Generate the pagination links*
        paginationElement.innerHTML = '';

        for (let i = startPage; i <= endPage; i++) {
            const link = document.createElement('a');
            link.innerText = i;
            link.dataset.page = i;
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = parseInt(link.getAttribute('data-page'));
                generatePagination();
            });
          
          
            console.log(link);
            paginationElement.appendChild(link);
        }

        // *Giving the styling to active Page Or Link*
        let anch = paginationElement.querySelectorAll('a');
              console.log(anch);
              anch.forEach((el)=>{
                if(el.innerText == currentPage){
                  console.log("true");
                //   el.style.color = 'green';
                el.classList.add('active');
                }
              })


        // *Add click event listeners to the pagination links*
        const links = paginationElement.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                //e.preventDefault();
                console.log("data property" ,link.getAttribute('data-page'));
                let paginataionLimit = 10;
                
                link.style.color = 'green';
                link.classList.add("active")
                console.log("color is :-",link.style.color);
                currentIndex = currentPage;
                let startIndex = ((currentIndex-1)*paginataionLimit);
                let lastIndex = currentIndex*paginataionLimit-1;
                console.log("activeLink",link)
                currentPage = parseInt(link.getAttribute('data-page'));
                generatePagination();

                fetchData(currentPage);
            });
        });
}

        

// *Handling prev abd Next Button*
// console.log(prevBtn)
prevBtn.disabled = currentPage == 1;
nextBtn.disabled = currentPage == totalPages;
prevBtn.addEventListener('click', ()=>{
    if( currentPage > 1 ) {
        currentPage-=1;
        generatePagination();
        fetchData(currentPage);
    }})
nextBtn.addEventListener("click",()=> {
    if( currentPage <totalPages && currentPage>0) {
        currentPage+=1;
        generatePagination();
        fetchData(currentPage);
    }})

window.addEventListener('click',()=>{
    prevBtn.disabled = currentPage == 1;
    nextBtn.disabled = currentPage == totalPages;
    // console.log(currentIndex,currentPage);
})

generatePagination();
fetchData(currentPage);


        </script>

<?php include_once("footer.php"); ?>