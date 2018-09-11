<html>
  <head>
    <title>TT' 18 | Tshirt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="T-Shirt" content="JSC3D">
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
    <div class="container-right" style="float: right; display:inline; width:40%; align: left; margin-top:80px">
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
        <a class="fb" href="https://www.facebook.com/MITtechtatva/">Facebook</a><br>
        <a class="insta" href="https://www.instagram.com/mittechtatva/">Instagram</a>
      </form>
    </div>
  </body>
</html>
