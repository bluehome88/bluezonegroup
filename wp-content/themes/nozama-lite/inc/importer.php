<?php
// import products
if( isset($_GET['import_product']) ){
	echo "Run script<br>";
	$url = $_GET["import_product"];
	echo $url."<br>";

	// load page html
	$dom = new DOMDocument();
	$dom->loadHTMLFile($url);
	$finder = new DomXPath($dom);
	$classname="details";
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	$h2 = $dom->getElementsByTagName('h2');
	$product_name = $h2[0]->textContent;
	$innerHTML = ""; 
    $children  = $nodes[0]->childNodes;

    // get contents html
    foreach ($children as $child) 
    {
    	$className = "";
    	if ($child->nodeType == XML_ELEMENT_NODE)
    		$className = $child->getAttribute('class');

    	if( $className == "date" || $className == "comment-form" || $className == "goBack")
    		continue;

        $innerHTML .= $nodes[0]->ownerDocument->saveHTML($child);
        
        // adjust news url
        $innerHTML = str_replace('https://www.bluezonegroup.com.au/announcements', 'https://bluezonegroup.rbdev.com.au/announcements', $innerHTML);

        // adjust youtube url
        if( strpos($innerHTML, '//www.youtube') !== false)
        	$innerHTML = str_replace('src="//www.youtube', 'src="https://www.youtube', $innerHTML);

        // adjust image url
        $innerHTML = str_replace('src="/', 'src="https://www.bluezonegroup.com.au/', $innerHTML);

        // Fix PDF link issue
        if( strpos($innerHTML, '/Literature') !== false)
        	$innerHTML = str_replace('href="/Literature', 'href="https://www.bluezonegroup.com.au/Literature', $innerHTML);

        if( strpos($innerHTML, '/_literature') !== false)
        	$innerHTML = str_replace('href="/_literature', 'href="https://www.bluezonegroup.com.au/_literature', $innerHTML);
    }

	echo $product_name."<br>".$innerHTML;
	$posts = get_posts([
	    'title' => $product_name,
	    'post_type' => 'product'
	]);

	// store to DB
	if(!empty($posts))
		wp_update_post( array("ID"=>$posts[0]->ID, "post_content"=>$innerHTML));
	else{
		$my_post = array(
		  'post_title'    => $arrPosts[$i]['title'],
		  'post_content'  => $innerHTML,
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		);
		// Insert the post into the database
		wp_insert_post( $my_post );			
	}

	exit;
}

// scan issued products
if( isset($_GET['issued_product']) ){
	wp_reset_query();

	$posts = get_posts([
	    'post_type' => 'product',
	    'posts_per_page' => 500
	]);

	$arrRes = array();
	foreach( $posts as $product ){

		// check empty contents
		if( $product->post_content == "" ){
			$arrRes['empty_content'][] = "<a href='".get_permalink($product->ID)."'>".$product->post_title."</a><br>";
		}

		if( strpos($product->post_content, '/announcements/') !== false){
			$arrRes['has_news_link'][] = "<a href='".get_permalink($product->ID)."'>".$product->post_title."</a><br>";
		}
		if( strpos($product->post_content, '/Literature') !== false){
			$arrRes['has_pdf_link'][] = "<a href='".get_permalink($product->ID)."'>".$product->post_title."</a><br>";
			// $content = str_replace('href="/Literature', 'href="https://www.bluezonegroup.com.au/Literature', $product->post_content);
			// wp_update_post( array("ID"=>$product->ID, "post_content"=>$content));
		}
		if( strpos($product->post_content, 'Literature/pdf.png') !== false){
			$arrRes['has_pdf_link_with_icon'][] = "<a href='".get_permalink($product->ID)."'>".$product->post_title."</a><br>";
			// $content = str_replace('href="/_literature', 'href="https://www.bluezonegroup.com.au/_literature', $product->post_content);
			// wp_update_post( array("ID"=>$product->ID, "post_content"=>$content));
		}
		if( strpos($product->post_content, 'youtube') !== false){
			$arrRes['has_video_youtuve'][] = "<a href='".get_permalink($product->ID)."'>".$product->post_title."</a><br>";
			// wp_update_post( array("ID"=>$product->ID, "post_content"=>$content));
		}
	}

	echo "<pre>";
	print_r( $arrRes );

	exit;
}


// Post Import from html file ( Latet News )
if( isset($_GET['import_news']) ){
	echo "Run script<br>";

	$dom = new DOMDocument();
	$arrPosts = array();

	if( !empty($_GET['url']) ){
		$title = $date = $link = "";
		$link = $_GET['url'];

		$dom->loadHTMLFile($link);
		$documentElement = $dom->documentElement; 
		$title = $dom->getElementsByTagName('h1');
		$title = $title[0]->textContent;

		$finder = new DomXPath($dom);
		$classname = "date";
		$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
		$children  = $nodes[0]->childNodes;
		$date = $children[0]->textContent;

		$arrPosts[] = array( "title"=>$title, "link"=> $link, "date" => $date );
	}
	else{
		$dom->loadHTMLFile(get_theme_file_path('/news.html'));
		$documentElement = $dom->documentElement; 
		$h2s = $dom->getElementsByTagName('h2');
		foreach( $h2s as $h2 ) {
			$title = $date = $link = "";

		    $child_elements = $h2->getElementsByTagName('span');
			$link = $h2->getElementsByTagName('a');
			$title = $link[0]->textContent;
			$link = $link[0]->getAttribute('href');
			$date = $child_elements[0]->textContent;
			$arrPosts[] = array( "title"=>$title, "link"=> $link, "date" => $date );
		}
	}

	$base_url = "https://www.bluezonegroup.com.au";
	for( $i = count( $arrPosts )-1; $i >= 0; $i--){

		$html_link = $base_url.$arrPosts[$i]['link'];
		$dom->loadHTMLFile($html_link);
		$finder = new DomXPath($dom);
		$classname="announcement-details";
		$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

		$innerHTML = ""; 
	    $children  = $nodes[0]->childNodes;

	    foreach ($children as $child) 
	    {
	    	$className = "";
	    	if ($child->nodeType == XML_ELEMENT_NODE)
	    		$className = $child->getAttribute('class');

	    	if( $className == "date" || $className == "comment-form" || $className == "goBack")
	    		continue;

	        $innerHTML .= $nodes[0]->ownerDocument->saveHTML($child);
	    }

		$posts = get_posts([
		    'title' => htmlspecialchars($arrPosts[$i]['title']),
		]);

		/* ---- store to DB ---- */
        $post_id = null;
		if(!empty($posts) && !isset($_GET['url']) ){
			$post_id = $posts[0]->ID;
			// wp_update_post( array("ID"=>$post_id, "post_content"=>$innerHTML, 'post_status'   => 'publish'));
			// echo ++$index.":Updated <a href='".get_permalink($post_id)."'>".$arrPosts[$i]['title']."</a><br><br>";
		}
		else
		{
			$my_post = array(
			  'post_title'    => $arrPosts[$i]['title'],
			  'post_content'  => $innerHTML,
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_category' => array( 1 ),
			  'post_date'	  => date( 'Y-m-d H:i:s', strtotime($arrPosts[$i]['date']))
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $my_post );			
			echo ++$index.":New Post <a href='".get_permalink($post_id)."'>".$arrPosts[$i]['title']."</a><br><br>";
		}
	}
	exit;
}

// Check issued news
// Important: only run once for updating
if( isset($_GET['issued_news']) ){
	wp_reset_query();

	$posts = get_posts([
	    'post_type' => 'post',
	    'posts_per_page' => 500,
	    'cat' => 1
	]);

	$arrRes = array();
	
	$old_domain = "www.bluezonegroup.com.au";
	$new_domain = "bluezonegroup.rbdev.com.au";
	
	foreach( $posts as $post ){

		$content = $post->post_content;

		// check empty contents
		if( $content == "" ){
			$arrRes['Empty Contents'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
		}

		// Fix news link
		if( strpos($content, $old_domain.'/announcements') !== false){
			$arrRes['Has News Links'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace($old_domain.'/announcements', $new_domain.'/announcements', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}

		// Fix Old redirect
		if( strpos($content, 'http://www.uvs.com.au/') !== false){
			$arrRes['Has Old link'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace('http://www.uvs.com.au', "https://".$new_domain, $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}		
		
		// Service page link issue
		if( strpos($content, $old_domain.'/services/') !== false ){ 
			$arrRes['Has Service Link'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace($old_domain.'/services', $new_domain.'/services', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}

		// PDF link issue
		if( strpos($content, 'href="/Literature') !== false || strpos($content, $new_domain.'/Literature') !== false){
			$arrRes['Has PDF issue'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace('href="/Literature', 'href="https://'.$old_domain.'/Literature', $content);
			$content = str_replace($new_domain.'/Literature', $old_domain.'/Literature', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
		if( strpos($content, 'href="/_literature') !== false || strpos($content, $new_domain.'/_literature') !== false){
			$arrRes['Has PDF _literature'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace('href="/_literature', 'href="https://'.$old_domain.'/_literature', $content);
			$content = str_replace($new_domain.'/_literature', $old_domain.'/_literature', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
		
		// Youtube IFrame issue
		if( strpos($content, '//www.youtube') !== false){
			$arrRes['Youtube Issue'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace('src="//www.youtube', 'src="https://www.youtube', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
		
		// Fix Image issue
		if( strpos($content, 'src="/') !== false){
			$arrRes['Image Base Link'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace('src="/', 'src="https://'.$old_domain.'/', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
		
		// TODO: fix products url on news
		// issue: find a way to separate category and product links from old one
		/*
		// fix product link
		if( strpos($content, $old_domain.'/product-catalogue/') !== false || strpos($content, $old_domain.'/rental-equipment/') !== false ){
			$arrRes['Product Links'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace($old_domain.'/product-catalogue/', $new_domain.'/product-catalogue/', $content);
			$content = str_replace($old_domain.'/rental-equipment/', $new_domain.'/rental-equipment/', $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
		*/
		
		// Has Old Domain Link for page
		$pattern = "/contact-us";
		if( strpos($content, $old_domain.$pattern ) !== false  ){
			$arrRes['Has Old link'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
			$content = str_replace($old_domain.$pattern, $new_domain.$pattern, $content);
			// wp_update_post( array("ID"=>$post->ID, "post_content"=>$content));
		}
	}

	echo "<pre>";
	// print_r( $arrRes );

	foreach( $arrRes as $key => $arrType )
	{
		echo "--------------------------------$key---------------------------------<br><br>";
		foreach( $arrType as $post ){
			echo ++$index."            ".$post."<br>";
		}
	}

	exit;
}

// Post Import Page Contents
if( isset($_GET['import_page']) ){
	$link = $_GET['url'];
	echo "Start Importing Page from $link<br>";

	$dom = new DOMDocument();
	$dom->loadHTMLFile($link);
	$documentElement = $dom->documentElement; 
	$finder = new DomXPath($dom);

	// get page title
	$classname = "pageTitle";
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	$children  = $nodes[0]->childNodes;
	$page_title = $children[0]->textContent;

	// get contents
	$classname="main";
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

	$content = ""; 
    $children  = $nodes[0]->childNodes;

    foreach ($children as $child) 
    {
    	$className = "";
    	if ($child->nodeType == XML_ELEMENT_NODE)
    		$className = $child->getAttribute('class');

    	if( $className == "pageTitle" || $className == "breadcrumb")
    		continue;

        $content .= $nodes[0]->ownerDocument->saveHTML($child);
    }

    // process contents issues
	$old_domain = "www.bluezonegroup.com.au";
	$new_domain = "bluezonegroup.rbdev.com.au";

	// Fix news link
	if( strpos($content, $old_domain.'/announcements') !== false){
		$content = str_replace($old_domain.'/announcements', $new_domain.'/announcements', $content);
	}

	// Fix Old redirect
	if( strpos($content, 'http://www.uvs.com.au/') !== false){
		$content = str_replace('http://www.uvs.com.au', "https://".$new_domain, $content);
	}		
	
	// Service page link issue
	if( strpos($content, $old_domain.'/services/') !== false ){ 
		$content = str_replace($old_domain.'/services', $new_domain.'/services', $content);
	}

	// PDF link issue
	if( strpos($content, 'href="/Literature') !== false || strpos($content, $new_domain.'/Literature') !== false){
		$content = str_replace('href="/Literature', 'href="https://'.$old_domain.'/Literature', $content);
		$content = str_replace($new_domain.'/Literature', $old_domain.'/Literature', $content);
	}
	if( strpos($content, 'href="/_literature') !== false || strpos($content, $new_domain.'/_literature') !== false){
		$content = str_replace('href="/_literature', 'href="https://'.$old_domain.'/_literature', $content);
		$content = str_replace($new_domain.'/_literature', $old_domain.'/_literature', $content);
	}
	
	// Youtube IFrame issue
	if( strpos($content, '//www.youtube') !== false){
		$content = str_replace('src="//www.youtube', 'src="https://www.youtube', $content);
	}
	
	// Fix Image issue
	if( strpos($content, 'src="/') !== false){
		$content = str_replace('src="/', 'src="https://'.$old_domain.'/', $content);
	}
	if( strpos($content, 'src="https://'.$new_domain."/") !== false){
		$content = str_replace('src="https://'.$new_domain."/", 'src="https://'.$old_domain."/", $content);
	}

	// Fix contact mail issue
	if( strpos($content, 'href="hrm@bzg.com.au') !== false){
		$content = str_replace('href="hrm@bzg.com.au', 'href="mailto:hrm@bzg.com.au', $content);
	}
	
	// Fix by Pattern
	$arrPatterns = array(
		"/contact-us",
		"/equipment-return-information",
		"/rental-equipment",
		"/product-catalogue"	
	);
	foreach( $arrPatterns as $pattern ){
		if( strpos($content, $old_domain.$pattern ) !== false  ){
			$content = str_replace($old_domain.$pattern, $new_domain.$pattern, $content);
		}
	}

    // Process DB
    $posts = get_posts([
	    'title' => $page_title,
	    'post_type' => 'page'
	]);

	$post_id = null;
	if(!empty($posts)){
		$post_id = $posts[0]->ID;

		echo "Existing Page: <a href='".get_permalink($post_id)."' target='_blank'>".$page_title."</a><br>".$content;
		wp_update_post( array("ID"=>$post_id, "post_content"=>$content, 'post_status'   => 'publish')); 
	}else{
		$my_post = array(
		  'post_title'    => $page_title,
		  'post_content'  => $content,
		  'post_status'   => 'publish',
		  'post_author'   => 1
		);

		// Insert the post into the database
		// $post_id = wp_insert_post( $my_post );
		echo "New Page: $page_title<br>".$content;
	}

	exit;
}

if( isset($_GET['issued_page']) ){
	wp_reset_query();

	$posts = get_posts([
	    'post_type' => 'page',
	    'posts_per_page' => 500
	]);

	$arrRes = array();
	
	$old_domain = "www.bluezonegroup.com.au";
	$new_domain = "bluezonegroup.rbdev.com.au";
	
	foreach( $posts as $post ){

		$content = $post->post_content;

		// check empty contents
		if( $content == "" ){
			$arrRes['Empty Contents'][] = "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a><br>";
		}
	}
	
	echo "<pre>";
	// print_r( $arrRes );

	foreach( $arrRes as $key => $arrType )
	{
		echo "--------------------------------$key---------------------------------<br><br>";
		foreach( $arrType as $post ){
			echo ++$index."            ".$post."<br>";
		}
	}

	exit;
}