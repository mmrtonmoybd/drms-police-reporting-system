<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>DRMS Public</title>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
       }

body{  /* background: #dfdfdf;*/
        /*background-image: linear-gradient(#122947,  #1f3079);*/
        background-image: linear-gradient(#7f9fce,#e6ebf1);
         padding: 0 8px;
       }
    .middle{
        max-width: 600px;
        width:100%;
        margin: 15px auto;
        background: rgb(255, 255, 255);
        padding: 30px;
        border-radius: 20px;
      
       }
    
 
    .header{
        text-align: center;
        margin-top: 40px;
    }
   .header p{
        text-align: center;
         display: block;
         margin-top: 20px;
         font-size: 25px;
        color: #1f3079;}
    .header img{
            height: 200px;
            width: 200px;
            text-align: center;
            margin-top: 40px;
        }

   .container{
         width: 100%;
         text-align: center;
         margin:50px auto; 
         display: flex;
         justify-content: center;
         transition: 6s;
         max-width: 450px;
         margin: 15px auto;
         padding: 30px;
        }
    
    .box a button{
        height: 40px;
        width: 200px; 
        background-color: rgb(14, 73, 161); 
        border-radius: 5px;
        color: rgb(255, 255, 255);
        margin: 10px;
        font-size: 15px ;
        border:none;
    }
   .box a button:hover{
        transform: scale(1.1);
        background-color: rgb(7, 55, 117);
        transition: 0.2s;
   }
   .note{
        font-size: 15px;
        color: blueviolet;
    
    }
.footer {
  font-family: arial;
  font-size: 13px;
  color: #f00;
  margin-top: 30px;
  text-align: center;
  background-color: #f3f3f3;
  height: 38px;
  padding: 7px;
}
       
   
    @media only screen and (max-width: 400px){
        .middle{
            max-width: 400px;
            width: 100%;
            margin: 10px auto;
            background: rgb(255 255 255);
            padding: 14px;
            border-radius: 20px;
      
       }
    
 
    .header{
        text-align: center;
        margin-top: 10PX;
    }
   .header p{
        text-align: center;
        font-size: 14px;
        color: #3d00ad;}
    .header img{
        height: 130px;
        width: 130px;
        text-align: center;
        margin-top: 17px;
        }
   .container{
         width: 100%;
         text-align: center;
         margin:20px auto; 
         display: flex;
         justify-content: center;
         transition: 6s;
         max-width: 400px;
         margin: 10px auto;
         padding: 20px;
        }
    
    .box a button{
        height: 40px;
        width: 100px;
        background-color: rgb(14, 73, 161);
        border-radius: 5px;
        color: rgb(255, 255, 255);
         margin: 6px;
        font-size: 15px;
        border: none;
        }
    }
</style> 


</style>
       
</head>
<body>

   
    <div class="middle"> 
        <div class="header">
                <p><strong>বরিশাল রেঞ্জ ডিআরএমএস সফটওয়্যারে<br> আপনাকে স্বাগতম<strong></p>
                <img src="https://drmsbslrange.com/logo-drms.jpg">
        </div>

            <div class="container">
                    
                <div class="box">
                    <a href="admin/login"><button>পুলিশ</button></a>
                
                </div>

                <div class="box">

                    <a href="seba"><button>সেবা প্রার্থী</button></a>
                </div>
            </div>
            <div class="note">
                <marquee>
                    <p> ডিআরএমএস সংক্রান্ত যে কোন সমস্যায় যোগাযোগ করুন ictbslrange@gmail.com এই ই-মেইলে</p>
                </marquee>
            </div>
            <div class="footer">
                <strong>Developed By: Engineer BD Network; </strong> 
            </div>
           
           
    </div>
   
    

</body>
</html>