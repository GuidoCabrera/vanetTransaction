<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
  if($_SESSION["usuario"]["rol"]==1){ 
?>
<style>
  @media(max-width:599px) and (min-width:530px){
    #containerHeader{
        height: auto;
    }
    #containerHeader #containerSearch .inputBox{
        display: block;
        width: 300px;
        float: left;
    }
    #containerHeader #containerSearch .inputBox:nth-child(2){
        margin-bottom: 10px;
    }
    #containerHeader #containerSearch .inputBox:nth-child(2){
        margin-left: 0px;
    } 
    #tableBox td {
        font-size: 16px;  
    }
    #tableBox th {
        font-size: 18px;
    }
    #containerFooter form #inputGroup .inputBox input{
        padding-left: 10px;
    }
    #containerHeader #containerChange #icons{
        margin-top: 110px;
    }
   }
   @media(max-width:529px) and (min-width:370px){
    #containerHeader{
        height: auto;
    }
    #containerHeader #containerSearch .inputBox{
        display: block;
        width: 200px;
        float: left;
    }
    #containerHeader #containerSearch .inputBox:nth-child(2){
        margin-bottom: 10px;
        margin-left: 0px;
    }
    #tableBox td, #tableBoxResults td {
        font-size: 16px;  
    }
    #tableBox th , #tableBoxResults th {
        font-size: 18px;
        font-weight: 300;
    }
    #containerFooter form #inputGroup .inputBox input{
        width: 95%;
        padding-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox input::placeholder{
        font-size: 0;
    }
    #containerHeader #containerChange #icons{
        margin-top: 110px;
        margin-right: 20px;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) select{
        float: left;
        height: 35px;
        width: 80%;
     }
     #containerFooter form #inputGroup .inputBox:nth-child(5) select{
        height: 35px;   
     }
     #containerFooter form #inputGroup .inputBox:nth-child(3) input{
        margin: 0;
     }
    #btnBox{
        left: 83%;
    }
     #containerFooter form #inputGroup .inputBox:nth-child(3) p{
        float: left;
        margin-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) p{
        float: left;
        margin-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(5) p{
        text-align: center;
    }
    #tableBox{
        overflow-x: auto;
    }
    #tableBoxResults{
        margin-bottom: 20px;
    }
    #tableBoxResults table{
    width: 100%;
    height: 30px;
    background: #fff;
    border: none;
    overflow-x: auto;
}
}

@media(max-width:369px) and (min-width:280px){
    #containerHeader{
        height: auto;
        flex-direction: column;
    }
    #containerHeader #containerChange{
        width: 100%;
    }
    #containerHeader #containerSearch .inputBox{
        display: block;
        width: 200px;
        float: left;
    }
    #containerHeader #containerSearch .inputBox:nth-child(2){
        margin-bottom: 10px;
        margin-left: 0px;
    } 
    #containerHeader #containerChange #icons{
        bottom: 5px;
        left: 25px;
    }
    #tableBox td, #tableBoxResults td {
        font-size: 15px;  
    }
    #tableBox th , #tableBoxResults th {
        font-size: 17px;
        font-weight: 300;
    }
    #containerFooter{
        padding: 5px 10px;
    }
    #containerFooter form #inputGroup .inputBox input{
        width: 95%;
        margin: 0 auto;
        box-sizing: border-box;
        padding-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox input::placeholder{
        font-size: 0;
    }
    #containerFooter form #inputGroup .inputBox{
       width: 100%;
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       text-align: center;
    }

    #containerFooter form #inputGroup .inputBox:nth-child(1) p,#containerFooter form #inputGroup .inputBox:nth-child(2) p,#containerFooter form #inputGroup .inputBox:nth-child(3) p,#containerFooter form #inputGroup .inputBox:nth-child(4) p{
        margin: 15px 0;
     }
    #containerFooter form #inputGroup .inputBox:nth-child(2) p, #containerFooter form #inputGroup .inputBox:nth-child(4) p{
        text-align: center;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(2) input, #containerFooter form #inputGroup .inputBox:nth-child(4) input,#containerFooter form #inputGroup .inputBox:nth-child(3) input{
        margin: 0;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) select, #containerFooter form #inputGroup .inputBox:nth-child(5) select{
      width: 90%;
      margin: 0 auto;
    }
    #containerFooter form #inputGroup .inputBox #selectPayment{
        width: 90%;
     }
    #btnBox{
        width: 50px;
        height: 40px;
        left: 75%;
        margin: 15px 0;
    }
    #tableBoxResults{
        margin-bottom: 50px;
    }
    #tableBoxResults table{
    width: 100%;
    height: 30px;
    background: #fff;
    border: none;
    overflow-x: auto;
}
    #tableBox{
        overflow-x: auto;
    }
}
</style>
<?php } 
else if($_SESSION["usuario"]["rol"]==2){
?>
<style>
  @media(max-width:599px) and (min-width:530px){
     #containerFooter form #inputGroup .inputBox input{
        padding-left: 15px;
    } 
  }
  @media(max-width:529px) and (min-width:370px){
    #containerHeader #containerChange #icons{
        margin-right: 20px;
    }
    #containerHeader #containerSearch{
      padding: 0;
    }
    #containerHeader #containerSearch .inputBox{
      margin-left: 15px;
    }
    #tableBox td, #tableBoxResults td {
        font-size: 16px;  
    }
    #tableBox th , #tableBoxResults th {
        font-size: 18px;
        font-weight: 300;
    }
    #containerFooter form #inputGroup .inputBox input{
        width: 95%;
        padding-left: 15px;
    }
    #containerFooter form #inputGroup .inputBox input::placeholder{
        font-size: 0;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) select{
        float: left;
        height: 35px;
        width: 80%;
     }
     #containerFooter form #inputGroup .inputBox:nth-child(5) select{
        height: 35px;   
     }
     #containerFooter form #inputGroup .inputBox:nth-child(3) input{
        margin: 0;
     }
    #btnBox{
        left: 83%;
    }
     #containerFooter form #inputGroup .inputBox:nth-child(3) p{
        float: left;
        margin-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) p{
        float: left;
        margin-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(5) p{
        text-align: center;
    }
    #tableBoxResults table{
    width: 100%;
    height: 30px;
    background: #fff;
    border: none;
    overflow-x: auto;
}
    #tableBox{
        overflow-x: auto;
    }
  }
  @media(max-width:400px) and (min-width:370px){
    #containerFooter{
        padding-top: 40px;
    }
  }
    @media(max-width:369px) and (min-width:280px){
      #containerHeader{
        height: auto;
        flex-direction: column;
        padding: 0;
    }
    #containerHeader #containerChange{
       width: 100%;
    }
    #containerHeader #containerChange #icons{
       float: left;
       margin-left: 15px;
       margin-bottom: 10px;
    }
    #containerHeader #containerSearch{
         margin-left: -10px;
    }
    #containerHeader #containerSearch .inputBox{
        display: block;
        width: 200px;
        float: left;
    }
    #tableBox td, #tableBoxResults td {
        font-size: 15px;  
    }
    #tableBox th , #tableBoxResults th {
        font-size: 17px;
        font-weight: 300;
    }
    #containerFooter{
        padding: 5px 10px;
        padding-top: 50px;
    }
    #containerFooter form #inputGroup .inputBox input{
        width: 95%;
        margin: 0 auto;
        box-sizing: border-box;
        padding-left: 10px;
    }
    #containerFooter form #inputGroup .inputBox input::placeholder{
        font-size: 0;
    }
    #containerFooter form #inputGroup .inputBox{
       width: 100%;
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       text-align: center;
    }

    #containerFooter form #inputGroup .inputBox:nth-child(1) p,#containerFooter form #inputGroup .inputBox:nth-child(2) p,#containerFooter form #inputGroup .inputBox:nth-child(3) p,#containerFooter form #inputGroup .inputBox:nth-child(4) p{
        margin: 15px 0;
     }
    #containerFooter form #inputGroup .inputBox:nth-child(2) p, #containerFooter form #inputGroup .inputBox:nth-child(4) p{
        text-align: center;
    }
    #containerFooter form #inputGroup .inputBox:nth-child(2) input, #containerFooter form #inputGroup .inputBox:nth-child(4) input,#containerFooter form #inputGroup .inputBox:nth-child(3) input{
        margin: 0;
        /* padding: 0; */
    }
    #containerFooter form #inputGroup .inputBox:nth-child(1) select, #containerFooter form #inputGroup .inputBox:nth-child(5) select{
      width: 90%;
      margin: 0 auto;
      /* padding: 0; */
    }
    #containerFooter form #inputGroup .inputBox #selectPayment{
        width: 90%;
     }
    #btnBox{
        width: 50px;
        height: 40px;
        left: 75%;
        margin: 15px 0;
    }
    #tableBoxResults table{
    width: 100%;
    height: 30px;
    background: #fff;
    border: none;
    overflow-x: auto;
    }
    #tableBox{
        overflow-x: auto;
    }
  }
</style>
<?php } 

else{ 
    header("location:".constant("URL")."ErrorP");
}
    ?>
</body>
</html>