<?php
if(isset($_POST["link"]))
{		
   $main_url=$_POST["link"];
   @$str = file_get_contents($main_url);


   // This Code Block is used to extract title
   if(strlen($str)>0)
   {
     $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
     preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
   }
  

   // This Code block is used to extract description 
   $b =$main_url;
   @$url = parse_url( $b ) ;
   @$tags = get_meta_tags( $main_url );

   // This Code Block is used to extract og:image which facebook extracts from webpage it is also considered 
   // the default image of the webpage
   $d = new DomDocument();
   @$d->loadHTML($str);
   $xp = new domxpath($d);
   foreach ($xp->query("//meta[@property='og:image']") as $el)
   {
     $l2=parse_url($el->getAttribute("content"));
     if($l2['scheme'])
     {
	   $img[]=$el->getAttribute("content");
	  // print_r($img2);
     }
     else
     {
	
     }
   }
}   
?>
   <a href="<?php echo $main_url;?>" style="text-decoration: none;"  target="_blank">
   
   <?php
      if(!empty($img)) {
         echo "<img  style='max-height:100%; max-width:100%;' src='".$img[0]."'><br>";
	  }  
       echo "<br><H2 id='title' >".$title[1]."</H2>";
	 
       echo "<p id='desc'>".$tags['description']."</p>";
   ?>
   </a>
   