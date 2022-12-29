<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Complain Form</title>

    <style>
       *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
       }
       body{
       /* background: #dfdfdf;
       /* background-image: linear-gradient(#122947,  #1f3079);*/
        padding: 0 8px;
        background-image: linear-gradient(#7f9fce,#e6ebf1);
       }
       .wrapper{
        max-width: 600px;
        width: 100%;
        margin: 15px auto;
        background: #fff;
        padding: 30px;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.125);
        border-radius: 20px;
    
       }
       .title {
        width: 100%;
        padding: 3px;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        align-content: stretch;
        justify-content: space-between;
    }
        .title p{
        font-size: 23px;
        display: inline;
        padding: 5px 6px;
        text-align: center;
        color: #1f3079;
        margin: 9px 1px;
        }

        .text_bar{
        font-size: 14px;
        margin: 24px auto;
        border-bottom: 2px solid #140064;
        padding: 4px;
        color: #007eff;
        text-align: justify;
    }
    .text_bar p span{
        color: red;
    }
    /* justify-content: center;
        }
       /*.wrapper .title{
        font-size:23px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #1f3079;
        text-align: center;

       }*/

       .wrapper .form{
        width: 100%;

       }
       .wrapper .form .input_field{
        margin-bottom: 8px;
        align-items: center;

       }
       @media only screen and (min-width: 400px){

        .wrapper .form .input_field{
        margin-bottom: 8px;
        display: flex;
        align-items: center;
       }
    }
       
       .wrapper .form .input_field label{
        width: 200px;
        color:#3b3b3b;
        margin-right: 5px;
        font-size: 14px;

       }

       .wrapper .form .input_field .input,
       .wrapper .form .input_field .textarea{
        width: 100%;
        outline: none;
        border: 1px solid #d5dbd9;
        font-size: 15px;
        padding: 7px 10px;
        border-radius: 3px;
        transition: all 0.3s ease;
       }
       .wrapper .form .input_field .textarea{
       resize: none; 
       height: 130px ;
       }
       .wrapper .form .input_field .input:hover,
       .wrapper .form .input_field .textarea:hover,
       .wrapper .form .input_field .custom_select select:hover{
       background: #e9ebf7;
       transition: 0.5s;

       }

      .wrapper .form .input_field .custom_select{
        position: relative;
        width: 100%;
        height: 37px;
       }

       .wrapper .form .input_field .custom_select select{
        -webkit-appearance: none;
        appearance: none;
        border: 1px solid #d5dbd9;
        width: 100%;
        height: 100%;
        padding: 8px 10px;
        border-radius: 3px;
        outline: none;
        color:#152569;
        font-size: 13PX;
       }
       .wrapper .form .input_field .Custom_select::before{
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        border: 8px solid;
       /* border-color: red transparent transparent transparent;*/
        pointer-events: none;
       }

       .wrapper .form .input_field .input:focus,
       .wrapper .form .input_field .textarea:focus,
       .wrapper .form .input_field select:focus{
        border: 1px solid   #45569e;
       }
       .wrapper .form .input_field .btn{
        width: 100%;
        padding: 8px 10px;
        font-size: 15px;
        color: white;
        background:  #142053;
        cursor: pointer;
        border-radius: 4px;
        border: none;
        margin-top: 10px;
        
       }
       .wrapper .form .input_field .btn:hover{
        background: #397891;
        transition: 0.2s;
       }
 .footer {
  font-family: arial;
  font-size: 15px;
  color: #f00;
  margin-top: 30px;
  text-align: center;
  background-color: #f3f3f3;
  height: 38px;
  padding: 7px;
}
       @media only screen and (max-width: 400px) {
        .wrapper{
        max-width: 350px;
        width: 100%;
        margin: 8px auto;
        background: #fff;
        padding: 20px;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.125);
        border-radius: 20px;}
        .title p{
        font-size: 17px;
        font-weight: 700;
        color: #1f3079;
        text-align: center;

       }
       
    
       .wrapper .form .input_field label{
        width: 200px;
        color:#3b3b3b;
        margin-right: 5px;
        font-size: 12px;}

        .wrapper .form .input_field .custom_select select{
        -webkit-appearance: none;
        appearance: none;
        border: 1px solid #d5dbd9;
        width: 100%;
        height: 100%;
        padding: 8px 10px;
        border-radius: 3px;
        outline: none;
        color:#152569;
        font-size: 10PX;
       }

       .text_bar{
        font-size: 12px;
        margin: 24px auto;
        border-bottom: 2px solid #140064;
        color: #007eff;
        padding: 4px;
        text-align: justify;
    }
}
   </style>
</head>

<body>
    <div class="wrapper">  
            <div class="title">
                <img src="https://www.drmsbslrange.com/police-logo.png" style="height: 70px;">
           
                <p><strong>অভিযোগ/তথ্য প্রদান ফরম</strong></p>
                
                <img src="https://www.drmsbslrange.com/b-range.png" style="height: 70px; float:right; ">
            </div>
            <div class="text_bar">
           
                
                   <p><span style="color:red;" ><b>Note:</b>  সার্ভিস টি এখনো চালু হয়নি।  অতি শীঘ্রই চালু করা হবে। </span></p>
                <!-----------
                                      <p><span><b>Note:</b></span> আপনার অভিযোগ, মতামত অথবা তথ্য পুলিশ কে জানাতে নিচর ফরম টি পূরণ করে সাবমিট করুন। এরপর আপনার মোবাইলে একটি OTP যাবে। OTP টি দিয়ে কনফর্ম করুন। প্রয়োজনে পুলিশ আপনার তাথে যোগাযোগ করবেন।  তথ্য দিয়ে পুলিশ কে সহায়তা করুন।</p>
                -------------->
                
                
            </div>


           
         <div class="form">
            <div class="input_field">
                <label> অভিযোগ/তথ্য প্রদানঃ</label>
                <div class="custom_select">
                    <select>
                        <option value="">Select</option>
                        <option value="অভিযোগ">অভিযোগ</option>
                        <option value="তথ্য প্রদান">তথ্য প্রদান</option>
                     </select>
            </div>
            </div>
                                        
            <div class="input_field">
                <label> জেলাঃ</label>
                    <div class="custom_select">
                        <select>
                            <option value="">Select</option>
                            <option value="বরিশাল">বরিশাল</option>
                            <option value="পটুয়াখালী">পটুয়াখালী</option>
                            <option value="ভোলা">ভোলা</option>
                            <option value="বরগুনা">বরগুনা</option>
                            <option value="পিরোজপুর">পিরোজপুর</option>
                            <option value="ঝালকাঠী">ঝালকাঠী</option>
                        </select>
                </div>
            </div>
            
            <div class="input_field">
                <label> থানাঃ</label>
                <div class="custom_select">
                    <select>
                        <option value="">Select</option>
                        <option value="বাবুগঞ্জ">বাবুগঞ্জ</option>
                        <option value="বাকেরগঞ্জ">বাকেরগঞ্জ</option>
                    </select>
            </div>
            </div>

            <div class="input_field">
                <label> গ্রামঃ</label>
                <input type="text" class="input">
            </div>

            <div class="input_field">
                <label> গ্রাম, ইউনিয়নঃ</label>
                <input type="text" class="input">
            </div>
            <div class="input_field">
                <label> নামঃ</label>
                <input type="text" class="input">
            </div>

            <div class="input_field">
                <label> লিঙ্গঃ</label>
                    <div class="custom_select">
                        <select>
                            <option value="">Select</option>
                            <option value="পুরুষ">পুরুষ</option>
                            <option value="নারী">নারী</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                </div>
            </div>

            <div class="input_field">
                <label> মোবাইল নম্বরঃ</label>
                <input type="text" class="input">
            </div>

            <div class="input_field">
                <label> অভিযোগের বিস্তারিতঃ</label>
                <textarea class="textarea"></textarea>
            </div>

            <div class="input_field">
                <input type="submit" value="Submit" class="btn">
            </div>
         </div>
        
         <div class="footer">
            <strong>Developed By: Engineer BD Network; Designed by: MD Nayem Hossain  </strong> 
        </div>


    </div>
    
</body>
</html>