<?php


     require "Grabber.php";
     require "MainGrabber.php";
     require "AmazonGrabber.php";
     require "MediaworldGrabber.php";
     require "EpriceGrabber.php";
     require "UnieuroGrabber.php";
     require "unieuro.php";
   //$url = "https://www.amazon.it/s?k=portatile&i=computers&__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1U8CTQF3CAEVW&sprefix=por%2Cappliances%2C196&ref=nb_sb_ss_ts-a-p_1_3";
  // $url = "https://www.amazon.it/s?k=portatili&page=2&qid=1606937714&ref=sr_pg_1";
  //ok $url = "https://www.amazon.it/s?i=computers&rh=n%3A425916031%2Cn%3A425917031%2Cn%3A460158031&page=3&qid=1606858784&ref=sr_pg_3";
   // $url = "https://www.amazon.it/s?k=lavatrici&__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&ref=nb_sb_noss_2";
     //$url = "https://www.amazon.it/s?k=tablet&page=3&__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&qid=1607039085&ref=sr_pg_3";
   // $url = "https://www.amazon.it/s?k=orologi&__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&ref=nb_sb_noss_2";
  // $url = "https://www.amazon.it/s?k=cellulari&i=electronics&__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&ref=nb_sb_noss_1";
   //  $url = "https://shop-live.mediaworld.it:443/wcs/resources/store/20000/productview/bySearchTermWithCategories/*?categoryId=241128&pageNumber=4&pageSize=24&orderBy=5&facet=mfName_ntk_cs%3A%22hp%22&facet=mfName_ntk_cs%3A%22acer%22&facet=mfName_ntk_cs%3A%22asus%22&facet=mfName_ntk_cs%3A%22lenovo%22&facet=mfName_ntk_cs%3A%22samsung%22&facet=mfName_ntk_cs%3A%22microsoft%22&facet=mfName_ntk_cs%3A%22dell%22&facet=mfName_ntk_cs%3A%22msi%22";
                      // $url = "https://www.unieuro.it/online/Computer-e-Tablet/Computer-Portatili?p=2&dFR[categories.lvl2][0]=C12&dFR[categoryNames_it.lvl3][0]=Notebook&dFR[manufacturerName][0]=Acer&dFR[manufacturerName][1]=DELL&dFR[manufacturerName][2]=ASUS&dFR[manufacturerName][3]=Huawei";
  //  $url = "https://www.amazon.it/s?i=computers&bbn=460188031&rh=n%3A425916031%2Cn%3A425917031%2Cn%3A460188031%2Cp_89%3AApple%7CHUAWEI%7CLenovo%7CSAMSUNG%7CTECLAST%7CYOTOPT%7Cvankyo&dc&fst=as%3Aoff&qid=1607460636&rnid=1688663031&ref=sr_nr_p_89_7";
  //  $url = "https://www.eprice.it/pr/pc-convertibili?manufacturer=HP%2CLENOVO%2CMICROSOFT%2CTOSHIBA%2CACER%2CDELL%2CFUJITSU";
   //$url = "https://www.mediaworld.it/catalogo/computer-e-smart-home/computer/notebook-convertibili-2-in-1/f/marca-microsoft/marca-hp/marca-lenovo/marca-mediacom?pageNumber=2" ;
//$url = "https://www.mediaworld.it/catalogo/computer-e-smart-home/computer/notebook/f/marca-hp/marca-acer/marca-lenovo/marca-asus/marca-microsoft/marca-samsung/marca-dell/marca-msi";
   // $cat = "notebook";
//$url = "https://www.mediaworld.it/api/v1/wcs/resources/store/20000/productview/bySearchTermWithCategories/*?categoryId=241178&pageNumber=1&pageSize=24&orderBy=5&facet=";
//var_dump($url);die();
  //   $url = "https://www.unieuro.it/online/Computer-e-Tablet/Computer-Portatili?p=2&dFR[categories.lvl2][0]=C12&dFR[categoryNames_it.lvl3][0]=Notebook&dFR[manufacturerName][0]=Acer&dFR[manufacturerName][1]=DELL&dFR[manufacturerName][2]=ASUS&dFR[manufacturerName][3]=Huawei";
//$url = "https://www.unieuro.it/online/Telefonia-e-Smartphone/Smartphone-e-Cellulari/?dFR[categories.lvl2][0]=C21";
  $url = "uni.html";
   // $url = "https://www.unieuro.it/online/Telefonia-e-Smartphone/Smartphone-e-Cellulari/iPhone";
// $cat = "tablet";
   $cat = "smartphone";
   //$cat = "lavatrici";
   //$prodotti = new DriverEp($url,$cat);
  // $prodotti = new DriverAmz($url, $cat);
  // $prodotti = new AmazonGrabber($url,$cat);
   // $prodotti = new MediaworldGrabber($url,$cat);
      $prodotti = new UnieuroGrabber($url,$cat);
  //  $prodotti = new unieuro($url,$cat);
   //   $prodotti = new EpriceGrabber($url,$cat);
  //  $prodotti = new ripristino($url, $cat);
  $a=$prodotti->getContent();
  //$b= $prodotti->getProduct();
  // $c=$prodotti->getPropr();
  // $d= $prodotti->getId();
 // $f = $prodotti->getBrand("cosa pensa 173/... aPpLe, di oppo");

//var_dump($c);die();

   $prod = $prodotti->getProducts();
   var_dump($prod);


