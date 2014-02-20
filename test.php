<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><style type="text/css">
 
div { font: 12px Arial; }
 
span.bold { font-weight: bold; }
 
#div1,#div3 {
   height: 80px;
   position: relative;
   border: 1px dashed #669966;
   background-color: #ccffcc;
   padding-left: 5px;
}
 
#div2 {
   opacity: 0.8;
   position: absolute;
   width: 150px;
   height: 200px;
   top: 20px;
   left: 170px;
   border: 1px dashed #990000;
   background-color: #ffdddd;
   text-align: center;
}
 
#div4 {
   opacity: 0.8;
   z-index: 2;
   position: absolute;
   width: 200px;
   height: 70px;
   top: 65px;
   left: 50px;
   border: 1px dashed #000099;
   background-color: #ddddff;
   text-align: left;
   padding-left: 10px;
}
 
 
</style></head>
 
<body>
 
<br />
 
<div id="div1">
<br /><span class="bold">DIV #1</span>
<br />position: relative;
   <div id="div2">
   <br /><span class="bold">DIV #2</span>
   <br />position: absolute;
   <br />z-index: 1;
   </div>
</div>
 
<br />
 
<div id="div3">
<br /><span class="bold">DIV #3</span>
<br />position: relative;
   <div id="div4">
   <br /><span class="bold">DIV #4</span>
   <br />position: absolute;
   <br />z-index: 2;
   </div>
</div>
 
</body></html>