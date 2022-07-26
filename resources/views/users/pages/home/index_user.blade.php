       @extends('users.master_user')
       
        @section('content')
        <style>
.bounce-in-right {
	-webkit-animation: bounce-in-right 1.1s both;
	        animation: bounce-in-right 1.1s both;
}
    /* ----------------------------------------------
 * Generated by Animista on 2022-8-10 0:44:27
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info. 
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation bounce-in-right
 * ----------------------------------------
 */
@-webkit-keyframes bounce-in-right {
  0% {
    -webkit-transform: translateX(600px);
            transform: translateX(600px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
    opacity: 0;
  }
  38% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
    opacity: 1;
  }
  55% {
    -webkit-transform: translateX(68px);
            transform: translateX(68px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  72% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
  81% {
    -webkit-transform: translateX(32px);
            transform: translateX(32px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  90% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
  95% {
    -webkit-transform: translateX(8px);
            transform: translateX(8px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
}
@keyframes bounce-in-right {
  0% {
    -webkit-transform: translateX(600px);
            transform: translateX(600px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
    opacity: 0;
  }
  38% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
    opacity: 1;
  }
  55% {
    -webkit-transform: translateX(68px);
            transform: translateX(68px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  72% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
  81% {
    -webkit-transform: translateX(32px);
            transform: translateX(32px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  90% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
  95% {
    -webkit-transform: translateX(8px);
            transform: translateX(8px);
    -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
  }
}


        </style>
            <div class="row d-flex align-items-center" style="min-height: calc(100vh - 100px)">
                <div class="col-12">
                    <div class="row  d-flex align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div id="carouselExampleInterval " class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded shadow-lg">
                                    <div class="carousel-item active" data-bs-interval="1500">
                                    <img src="{{asset('assets/images/IMG_4493.JPG')}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="1500">
                                    <img src="{{asset('assets/images/IMG_4466.JPG')}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="1500">
                                    <img src="{{asset('assets/images/IMG_4558.JPG')}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="1500">
                                    <img src="{{asset('assets/images/IMG_4566.JPG')}}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                </div>     
                            </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row mb-3">
                                <h1 class="text-center bounce-in-right">Penyewaan Studio <br>
                                Perum Produksi Film Negara
                                </h1>
                            </div>
                            <div class="row mb-3">
                                {{-- <p>
                                    Menyediakan studio yang luas <br>
                                    untuk kebutuhan syuting anda
                                </p> --}}
                                <h6 class="text-center typewrite" data-period="2000" data-type='[ "Menyediakan studio yang luas untuk kebutuhan syuting anda", "Menyediakan studio dengan berbagai macam fasilitas", "Pesan sekarang." ]'>
                                    <span class="wrap">&nbsp;</span>
                                </h6>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="text-center col-6">
                                    <a href="{{route('user.studio')}}" class="btn btn-danger shadow">Lihat Studio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        setTimeout(function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                console.log(toRotate)
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #000}";
            document.body.appendChild(css);
        }, 3000)
    };
    
            </script>
        @endsection