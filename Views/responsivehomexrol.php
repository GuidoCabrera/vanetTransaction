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
    #tableBoxResults{
        margin-bottom: 20px;
    }
}

@media(max-width:369px) and (min-width:280px){
    #containerHeader{
        height: auto;
        flex-direction: column;
    }
    #containerHeader #containerChange #icons{
        bottom: 5px;
        left: 25px;
    }
    #containerHeader #containerSearch .inputBox:nth-child(2){
        margin-bottom: 10px;
        margin-left: 0px;
    } 
    #containerFooter{
        padding: 5px 10px;
    }
    #tableBoxResults{
        margin-bottom: 50px;
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
    #containerHeader #containerChange #icons{
       float: left;
       margin-left: 15px;
       margin-bottom: 10px;
    }
    #containerHeader #containerSearch{
         margin-left: -10px;
    }
    #containerFooter{
        padding: 5px 10px;
        padding-top: 50px;
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