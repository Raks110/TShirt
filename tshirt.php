<html>
  <head>
    <title>T-Shirt Portal</title>
    <meta name="T-Shirt" content="JSC3D">
    <style>
      div{
        display: inline;
      }
      input,select{
        border:0;
        padding: 5 0 5 10;
        border-radius: 10px;
        width: 50%;
        height: 30px;
        margin: 15px 15px 15px 0px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
      }
      input:hover,select:hover{
        width:90%;
      }
      .button:hover{
        background: rgba(0, 0, 0, 0.5);
        color:white;
        transition: 0.4s;
      }
      .editions{
        position: absolute;
        left: 340px;
        top: 213.96px;
        width: 642px;
        height: 20px;
        border: 1px solid rgb(0,0,0);
        pointer-events: none;
        display: none;
      }
      .editons2{
        position: absolute;
        left: 343px;
        top: 216.96px;
        width: 638px;
        height: 16px;
        background-color: rgb(0,0,0);
        pointer-events: none;
        display: none;
        background-position: initial initial;
        background-repeat: initial initial;
      }
      .editions3{
        position: absolute;
        left: 340px;
        top: 197.96px;
        width: 642px;
        height: 14px;
        font-weight: bold;
        font-style: normal;
        font-variant: normal;
        font-size: 14px;
        line-height: normal;
        font-family: 'Courier New';
        color: rgb(0,0,0);
        pointer-events: none;
        display: none;
      }
      body{
        background: #466368;
        background: -webkit-linear-gradient(#FFF, #000);
        background: -moz-linear-gradient(#FFF, #000);
        background: linear-gradient(#FFF, #000);
      }
    </style>
  </head>
  <body style="margin: 0px">
    <div style="width: 50%;
                margin: 0 20 0 0;
                position: relative;
                font-size: 9pt;
                color: #777;">
      <canvas id="cv" width="600px" height="700px"></canvas>
    </div>
    <script type="text/javascript" src="jsc3d.js"></script>
    <script type="text/javascript" src="jsc3d.touch.js"></script>
    <script type="text/javascript" src="jsc3d.webgl.js"></script>
    <script type="text/javascript">
      var canvas = document.getElementById('cv');
      var viewer = new JSC3D.Viewer(canvas);
      viewer.setParameter('SceneUrl','shirt.obj');
      viewer.setParameter('InitRotationX',0);
      viewer.setParameter('InitRotationY',20);
      viewer.setParameter('InitRotationZ',0);
      viewer.setParameter('ModelColor','#000');
      viewer.setParameter('BackgroundColor1','#FFFFFF');
      viewer.setParameter('BackgroundColor2','#000000');
      viewer.setParameter('RenderMode','texturesmooth');
      viewer.setParameter('Renderer','webgl');
      viewer.init();
      viewer.update();
    </script>
    <div id="editions"></div>
    <div id="editions2"></div>
    <div class="container-right" style="float: right; display:inline; width:40%; align: left; margin-top:100px">
      <form>
        <h2>Sign up for Tech Tatva '18 Tees</h2>
        <p>
          Name <br><input type="text" name="name" placeholder="Enter your name here."><br>
          Reg no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Registration Number" name="reg"><br>
          Phone no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Phone number" name="phone"><br>
          Size<br>
          <div class="select-custom" style="display:inline; width:50%; position:relative; border-radius:20px">
          <select name="size">
              <option hidden selected>Set your size</option>
              <option>S</option>
              <option>M</option>
              <option>L</option>
              <option>XL</option>
              <option>XXL</option>
            </select>
          </div>
          <input class="button" type="submit" value="Sign Up" name="continue">
        </p>
      </form>
    </div>
  </body>
</html>
