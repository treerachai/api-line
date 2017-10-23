<?php
/*
copyright @ medantechno.com
2017

*/

require_once('./line_class.php');

$channelAccessToken = 'MTn2latTZ4NmBnuah67007iRDPdliDVKkpxR1yb5IGpzTARdjzAqSnLmhkvew0EqfNs3wDSQuTc8j/DUfKCoPFpV3ECtur1KUxyiRd1jZjeS9JA7yJXlkuK6l6/WkCJEKDybBDiRMdFbYxtFlRYOmQdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = 'adbb3952c8bc75b90664aa5ededbbbec';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

//var_dump($client->parseEvents());



//$_SESSION['userId']=$client->parseEvents()[0]['source']['userId'];

/*
{
  "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
  "type": "message",
  "timestamp": 1462629479859,
  "source": {
    "type": "user",
    "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
  },
  "message": {
    "id": "325708",
    "type": "text",
    "text": "Hello, world"
  }
}
*/


$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];


$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = $message['text'];



//pesan bergambar
if($message['type']=='text')
{
	if($pesan_datang=='1')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo '.$profil->displayName.', Anda memilih menu 1,'
									)
							)
						);
				
	}
	else
	if($pesan_datang=='2')
	{
		$get_sub = array();
		$aa =   array(
						'type' => 'image',									
						'originalContentUrl' => 'https://medantechno.com/line/images/bolt/1000.jpg',
						'previewImageUrl' => 'https://medantechno.com/line/images/bolt/240.jpg'	
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Halo '.$profil->displayName.', Anda memilih menu 2, harusnya gambar muncul.'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
		/*
		$alt = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Anda memilih menu 2, harusnya gambar muncul.'
									)
							)
						);
		*/
		//$client->replyMessage($alt);
	}
	else
	if($pesan_datang=='3')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Fungsi PHP base64_encode medantechno.com :'. base64_encode("medantechno.com")
									)
							)
						);
				
	}
	else
	if($pesan_datang=='4')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Jam Server Saya : '. date('Y-m-d H:i:s')
									)
							)
						);
				
	}
	else
	if($pesan_datang=='6')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'location',					
										'title' => 'Lokasi Saya.. Klik Detail',					
										'address' => 'Medan',					
										'latitude' => '3.521892',					
										'longitude' => '98.623596' 
									)
							)
						);
				
	}
	else
	if($pesan_datang=='7')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Testing PUSH pesan ke anda'
									)
							)
						);
						
		$push = array(
							'to' => $userId,									
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Pesan ini dari medantechno.com'
									)
							)
						);
						
		
		$client->pushMessage($push);
				
	}
	
	else
	if ($pesan_datang== '8')
	{
	
        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'template',
										'altText' => 'Deskripsi template',
										'template' => array(
											'type' => 'buttons',
											'thumbnailImageUrl' => 'https://raw.githubusercontent.com/farzain/api-line/master/zFz.png',
											'title' => 'Youtube Farzain',
											'text' => 'Klik tombol dibawahini',
											'actions' => array(
								array(
										'type' => 'uri',
										'label' => 'Farzain - zFz',
										'uri' => 'https://youtube.com/c/zfz48',
									),
								array(
										'type' => 'message',
										'label' => 'yes',
										'text' => 'yes',
									)										
                        )
                  )
             )					
			 
        )
    );
	}


	else{

		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo.. Selamat datang di medantechno.com .        Untuk testing menu pilih 1,2,3,4,5 ... atau stiker'
									)
							)
						);
						
	}

}	else if($message['type']=='sticker')
{	
	$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Terimakasih stikernya... '										
									
									)
							)
						);
						
}
 
$result =  json_encode($balas);
//$result = ob_get_clean();

file_put_contents('./balasan.json',$result);


$client->replyMessage($balas);

