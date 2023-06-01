<!DOCTYPE html>
<html lang="en" id="home" style="padding: 0; margin: 0;">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <style>

      h5{
        text-align: center !important; 
        color: #fff; 
        padding: 20px 20px; 
        margin: 0; 
        font-size: 25px;
        font-family: Helvetica, sans-serif;
      }
  
      .data{
        margin-top: 50px;

      }
      
        .name{
          margin-bottom: 10px;
          text-align: center;
          font-weight: bold;
          color: #636363;
          font-size: 30px;
          font-family: Helvetica, sans-serif;

        }

        .profesion{
          margin-bottom: 10px;
          text-align: center;
          font-weight: bold;
          font-size: 30px;
          font-family: Helvetica, sans-serif;
          margin-bottom: 40px;
          color: #636363;

        }

        footer{
          position:absolute;
          width:100%;
          height:60px;
          bottom: 0;
        }

        p{
          text-align: center !important; 
          color: #fff; 
          padding: 20px 20px; 
          margin: 0; 
          font-size: 12px;
          font-family: Helvetica, sans-serif;
        }

        .qrcode {
          text-align: center;
        }
        

        
    </style>
  </head>

  <body style="margin: 0; padding: 0;">
    

    <nav style="background-color: #0c0435;">
      <h5>EVENT {{ strtoupper($EventUser->event->name) }}</h5>
    </nav>
     
    <section class="data">
      
        <div class="name">
          {{ $EventUser->user->name }}
        </div>
       
        <div class="profesion">
          {{ $EventUser->user->position }}
        </div>
    </section>

    <div class="qrcode">
       <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($EventUser->code)) !!} ">
    </div>

    <footer style="background-color: #0c0435;">
            
      <p>Copyright © 2021 evnt.my.id. All rights reversed</p>

    </footer>
  
  </body>
</html>
