<?php
header("Content-type: image/png");

 	class InvoiceBuilder{
		var $im;
		var $imageWidth;
		var $imageHeight;
		
		var $bgColor;
		var $textColor;
		var $lineColor;
		
		var $numOrder;
		var $orderNameArray = array();
		var $orderPriceArray = array();
		var $orderAmountArray = array();
		
		function InvoiceBuilder($width,$height){
			$this->imageWidth = $width;
			$this->imageHeight = $height;
			$this->im = @imagecreate($this->imageWidth,$this->imageHeight) or die("Cannot Initialize new GD image stream");
			$this->bgColor = imagecolorallocate($this->im, 255, 255, 255);
			$this->textColor = imagecolorallocate($this->im, 233, 14, 91);
			$this->lineColor = imagecolorallocate($this->im, 0, 0, 0);
			
			$this->numOrder = 0;

		}
		
 		function addString($str,$posX,$posY,$size){
			imagestring($this->im,$size,$posX,$posY,$str,$this->textColor);
		}
		
 		function addOrder($name,$price,$amount){
			$this->orderNameArray[$this->numOrder] = $name;
			$this->orderPriceArray[$this->numOrder] = $price;
			$this->orderAmountArray[$this->numOrder] = $amount;
			$this->numOrder++;
		}
		
 		function buildTable(){
			$totalPrice = 0;
		
			$tableBeginY = $this->imageHeight/3;
			imageline($this->im,5,$tableBeginY,$this->imageWidth-5,$tableBeginY,$this->lineColor);
			imagestring($this->im,4,6,$tableBeginY+4,"No.",$this->textColor);
			imagestring($this->im,4,100,$tableBeginY+4,"Description",$this->textColor);
			imagestring($this->im,4,273,$tableBeginY+4,"Each",$this->textColor);
			imagestring($this->im,4,322,$tableBeginY+4,"Qty.",$this->textColor);
			imagestring($this->im,4,370,$tableBeginY+4,"Price",$this->textColor);
			imageline($this->im,5,$tableBeginY+20,$this->imageWidth-5,$tableBeginY+20,$this->lineColor);
			imageline($this->im,5,$tableBeginY,5,$this->imageHeight-5,$this->lineColor);
			imageline($this->im,28,$tableBeginY,28,$this->imageHeight-5,$this->lineColor);
			imageline($this->im,260,$tableBeginY,260,$this->imageHeight-5,$this->lineColor);
			imageline($this->im,320,$tableBeginY,320,$this->imageHeight-5,$this->lineColor);
			imageline($this->im,352,$tableBeginY,352,$this->imageHeight-5,$this->lineColor);
			imageline($this->im,$this->imageWidth-5,$tableBeginY,$this->imageWidth-5,$this->imageHeight-5,$this->lineColor);
			
			for($i=0;$i<$this->numOrder;$i++){
				imagestring($this->im,4,8,$tableBeginY+24+(14*$i),str_pad(($i+1), 2," ", STR_PAD_LEFT),$this->textColor);
				imagestring($this->im,4,32,$tableBeginY+24+(14*$i),$this->orderNameArray[$i],$this->textColor);
				imagestring($this->im,4,267,$tableBeginY+24+(14*$i),str_pad($this->orderPriceArray[$i], 6," ", STR_PAD_LEFT),$this->textColor);
				imagestring($this->im,4,326,$tableBeginY+24+(14*$i),str_pad($this->orderAmountArray[$i], 3," ", STR_PAD_LEFT),$this->textColor);
				$price = $this->orderPriceArray[$i] * $this->orderAmountArray[$i];
				imagestring($this->im,4,360,$tableBeginY+24+(14*$i),str_pad($price, 7," ", STR_PAD_LEFT),$this->textColor);
				$totalPrice+=$price;
			}
			
			imageline($this->im,5,$this->imageHeight-5,$this->imageWidth-5,$this->imageHeight-5,$this->lineColor);
			imagestring($this->im,4,200,$this->imageHeight-22,"total",$this->textColor);
			imagestring($this->im,4,365,$this->imageHeight-22,str_pad($totalPrice,7," ",STR_PAD_LEFT),$this->textColor);
			imageline($this->im,5,$this->imageHeight-25,$this->imageWidth-5,$this->imageHeight-25,$this->lineColor);
			
		}
		
 		function buildImage(){
			$this->buildTable();
			imagepng($this->im);
			imagedestroy($this->im);
		} 
	
	};
	
	//$id= $_GET["id"];
	$invoice = new InvoiceBuilder(430,600);
	$invoice->addString("xxxxx",5,6,4);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,800);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->addOrder("aaaaa",100000,3);
	$invoice->addOrder("aaaaa",1000,3);
	$invoice->buildImage();
	
?>