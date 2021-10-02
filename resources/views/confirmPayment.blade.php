<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8"> 
    <meta name="csrf-token">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  margin: 0;
}

body {
  background-color: rgb(213, 221, 222);
  color: #222;
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
}

.modal {
  position: relative;
  background-color: #fff;
  box-sizing: border-box;
  width: 90%;
  max-width: 460px;
  margin: 0 auto;
  margin-top: 100px;
  border-radius: 4px;
  padding: 105px 38px 20px 38px;
  text-align: center;
  box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.25);
}

h1 {
  font-size: 37px;
}

.points {
  color: #999;
  font-size: 18px;
}

hr {
  border: none;
  height: 1px;
  background-color: rgb(221, 221, 221);
  margin: 20px auto;
}

.progress {
  margin-top: 20px;
  margin-bottom: 27px;
  
 
}
.progress rect {
    fill:#8BC34A;
  }

#close-modal {
  position: absolute;
  top: 12px;
  right: 12px;
  width: 11px;
  height: 11px;
  stroke: #222;
  cursor: pointer;
}

#success-icon {
  position: absolute;
  width: 110px;
  height: 110px;
 
  left: 50%;
  margin-left: -55px;
  top: -15%;
  background-color: #8BC34A;
  border-radius: 50%;
  box-sizing: border-box;
  border: solid 5px white;
  box-shadow:1px 0px 5px 2px rgba(160, 153, 153, 0.47);
  
  
}
.btn-primary{
  background: #8bc34a;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 19px;
    margin-top: 20px;
}

#success-icon div {
    position: absolute;
    top: 34%;
    left: 30%;
    transform: rotate(-45deg);
    border-bottom: solid 4px white;
    border-left: solid 4px white;
    height: 15%;
    width: 33%;
  }

  @media only screen and (max-width: 768px) {
    .home-btn{
      display:none;
    }
  }
</style>
</head>
<body >        
        <div class="modal">
                <div id="success-icon">
                  <div></div>
                </div>
                <h1><strong>{{__("Success!")}}</strong></h1>
                <svg class="progress" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 4.5">
                  <rect height="4.5" width="100" rx="2" ry="2" />
                </svg>

                <p class="points">{{__("Your Payment successfully completed.")}}</p>
                
              @if(Auth::check())            
                <a href="{{url('/')}}"><button class="btn btn-primary home-btn" > {{__("back to home")}}</button></a>              
              @endif
            
        </div>
        
</body>

<script src="{{url('frontend/js/jquery.min.js')}}"></script>
<script src="{{url('frontend/js/custom.js')}}"></script>
</html>