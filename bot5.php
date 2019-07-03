<?php
require_once('query.php');
// session diperlukan untuk simpan step
session_start();

$TOKEN      = "714742325:AAG0nlo00eCw6CkVSaau-ubWtdXQ6pYDlIA";
$usernamebot= "@LabTI_bot";
define('myVERSI', '0.1');
define('lastUPDATE', 'Juni 2019');


// aktifkan ini jika lagi debugging
$debug = true;
 
if (strlen($TOKEN)<20) 
    die("Token mohon diisi dengan benar!\n");

// fungsi untuk mengirim/meminta/memerintahkan sesuatu ke bot 
function request_url($method){
    global $TOKEN;
    
	return "https://api.telegram.org/bot" . $TOKEN . "/". $method;
}
 
// fungsi untuk meminta pesan 
// Meminta Pesan, polling: getUpdates
function get_updates($offset){
    $url = request_url("getUpdates")."?offset=".$offset;
        $resp = file_get_contents($url);
        $result = json_decode($resp, true);
        if ($result["ok"]==1)
            return $result["result"];
        return array();
}

// fungsi untuk membalas pesan, 
function send_reply($chatid, $msgid, $text){
    global $debug;
    $data = array(
        'chat_id' => $chatid,
        'text'  => $text,
        'parse_mode' => 'Markdown'
    //'reply_to_message_id' => $msgid   // <---- biar ada reply nya balasannya, opsional, bisa dihapus baris ini
    );
    //Memproses pesan response dari server lokal agar bisa di kirim ke bot
    // mengubah   
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            // 'ignore_errors' => true,
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options); 
    $result = file_get_contents(request_url('sendMessage'), false, $context);

    if ($debug) 
        print_r($result);
}


// Setelag kita menerima pesan dari fungsi get_updates kitan akan membuat fungsi create response
//Fungsi Create Response merupakan fungsi untuk mengolah pesan yang diambil dari bot dan Menyiapkan balasan pesan untuk dikirimkan dari server local ke  Bot. 

//Di fungsi ini kita akan mengambil pesan masuk tadi dalam paramater fungsinya. 
function create_response($text, $message)
{
    global $usernamebot;
    
    // inisiasi variable hasil yang mana merupakan hasil olahan pesan
    $hasil = '';  
        
    $chatid = $message["chat"]["id"]; // variable penampung id chat
    

    // variable penampung username nya user
    isset($message["from"]["username"])
        ? $chatuser = $message["from"]["username"]
        : $chatuser = '';
    

    // variable penampung nama user

    isset($message["from"]["last_name"]) 
        ? $namakedua = $message["from"]["last_name"] 
        : $namakedua = '';        

    $namauser = $message["from"]["first_name"]. ' ' .$namakedua;

    $pecah = explode(' ', $text); 
	
    // identifikasi perintah (yakni kata pertama, atau array pertamanya)
    switch ($pecah[0]) {
        
        case '/start':
            if(str_word_count($text)<=1){
                $_SESSION['namauser']=$namauser;

                $hasil = "Hai 💁 `{$_SESSION['namauser']}` .. Selamat datang di `Sistem Informasi Jadwal Laboratorium FASILKOM-TI` Universitas Sumatera Utara! \n\n";
                $hasil .= '💁🏼 Aku adalah *bot SisLabTI* ver.`'.myVERSI."`\n";
                $hasil .= "🎓 yang dibuat oleh :\n";
                $hasil .= "          _Indana Fariza Hidayat 161402082_\n";
                $hasil .= "          _Gistya Fakhrani 161402094_\n";
                $hasil .= "          _Rina Ayu Wulan Sari 161402097_\n ";
                $hasil .= "          _Sinta Anjelina 161402100_\n";
                $hasil .= "          _Dea Amanda 161402118_\n⌛️".lastUPDATE."\n\n";
                $hasil .= "‼️ Notes ‼️ \n `Bot hanya mengerti bahasa instruksi yang disediakan` 🔻 \n `Jika` instruksi sudah sesuai namun `bot sedang lambat & tidak merespons`. `Ketikkan instruksi ulang` 🔻\n\n";

                $hasil .= "Silahkan _login_ terlebih dahulu. ketik: /login\n";
                $_SESSION['step']= "/login";
            } else {
                $hasil= '⛔️ *ERROR:* _Tidak ada instruksi tersebut . Panggil bot sesuai instruksi!_';
                $hasil .= "\n".'ingat /start ya ! 😅';                   
            }
            break;

        // balasan default jika pesan tidak di definisikan
        default:
			//if(isset($_SESSION['chatid'])){
				if(isset($_SESSION['step'])){
					switch($_SESSION['step']){
                        case '/login':
                            var_dump($text);
                            $hasil = start($text);
                            break;
                        case 'level_user':
                            $hasil = level_user($text);
                            // return $hasil;
                            break;
                        case 'menupraktikan':
                            $hasil = menupraktikan($text);
                            $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'menuaslab':
                            $hasil = menuaslab($text);
                            $_SESSION['chat_id'] = $chatid;
                            break;
                         case 'nim':
                            //tampung dulu nimnya ke SESSION
                            var_dump($text);
                            $_SESSION['nim'] = $text;
                            var_dump($_SESSION['nim']);
                            $hasil = login($text);
                            $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'password':
                            var_dump($text);
                            $_SESSION['password'] = $text;     
                            $hasil = password($text);
                            $_SESSION['chat_id'] = $chatid;    
                            break;
                        case 'term':    
                            $_SESSION['semester'] = $text;
                            $hasil = term($text);
                            $_SESSION['chat_id']=$chatid;
                            break;
                        case 'matakuliah':
                            $_SESSION['id_matkul']= $text;
                            $hasil = matakuliah($text);
                            $_SESSION['chat_id']=$chatid;
                            break;
                        case 'hari':
                            $_SESSION['hari'] = $text;
                            $hasil = hari($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'waktu':
                            $_SESSION['waktu'] = $text;
                            $hasil = waktu($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'ruangan':
                            $_SESSION['ruangan'] = $text;
                            $hasil = ruangan($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'kom':
                            $_SESSION['kom'] = $text;
                            $hasil = kom($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;

                        case 'menu': 
                            $hasil = menu($_SESSION['nama_aslab']);
                            break;

                        case 'gantihari':
                            $_SESSION['hariganti'] = $text;
                            $hasil = gantihari($text);
                            $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'gantiwaktu':
                            $_SESSION['waktuganti'] = $text;
                            $hasil = gantiwaktu($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'gantiruangan':
                            $_SESSION['ruanganganti'] = $text;
                            $hasil = gantiruangan($text);
                             $_SESSION['chat_id'] = $chatid;
                            break;
                        case 'update':
                            $text = strtolower($text);
                            $_SESSION['chat_id'] = $chatid;
                            if($text == 'ya'){
                            $hasil .=upselesai();
                            return $hasil;
                            }
                            elseif ($text== 'tidak') {
                                # code...
                                var_dump($_SESSION['nama_aslab']);
                                $hasil = "🅾️ Anda tidak jadi mengubah jadwal.\n\n";
                                $_SESSION['step']='menuaslab';
                                $hasil .= menu($_SESSION['nama_aslab']);
                                
                            }
                            else {
                                $hasil = "Masukkan sesuai perintah (ya/tidak)\n";
                                $_SESSION['step'] ='update';
                                break;    
                            }
                            break;

                        case 'upselesai':
                            $hasil .= upselesai();
                            break;


                    
						case 'verifikasi':
                            $text = strtolower($text);
                            $_SESSION['chat_id'] = $chatid;
							if($text == 'ya'){
                            $hasil .=selesai();
                            return $hasil;
							}
                            elseif ($text== 'tidak') {
                                # code...
                                $hasil = "Silahkan ulangi dengan perintah /tambah";
                                $_SESSION['step']='menuaslab';
                            }
                            else {
                                $hasil = "Masukkan sesuai perintah (ya/tidak)\n";
                                $_SESSION['step'] ='verifikasi';
                                break;    
							}
							
							break;
						case 'selesai':
							// simpan ke database
                            $hasil=selesai();
							//return $hasil;
							//session_destroy();
							break;
						
					}
					
					
				} else {
				    $hasil = "😥 Instruksi tidak tersedia jika `anda belum memanggil Bot`.\n Panggil bot dengan `/start` ya! 😅";
				}
			//}
            break;
			
    }
	
	print_r($_SESSION);

    return $hasil;
}
 
// jebakan token, klo ga diisi akan mati

// fungsi pesan yang sekaligus mengupdate offset 
// biar tidak berulang-ulang pesan yang di dapat 
function process_message($message)
{
    $updateid = $message["update_id"];
    $message_data = $message["message"];
    if (isset($message_data["text"])) {
    $chatid = $message_data["chat"]["id"];
        $message_id = $message_data["message_id"];
        $text = $message_data["text"];
        $response = create_response($text, $message_data);
        if (!empty($response))
          send_reply($chatid, $message_id, $response);
    }
    return $updateid;
}
  
// hanya untuk metode poll
// fungsi untuk meminta pesan 
function process_one()
{
    global $debug;
    $update_id  = 0;
    echo "-";
 
    if (file_exists("last_update_id")) 
        $update_id = (int)file_get_contents("last_update_id");
 
    $updates = get_updates($update_id);

    // jika debug=0 atau debug=false, pesan ini tidak akan dimunculkan
    if ((!empty($updates)) and ($debug) )  {
        echo "\r\n===== isi diterima \r\n";
        print_r($updates);
    }
 
    foreach ($updates as $message)
    {
        echo '+';
        $update_id = process_message($message);
	}
    
	// @TODO nanti ganti agar update_id disimpan ke database
    // update file id, biar pesan yang diterima tidak berulang
    file_put_contents("last_update_id", $update_id + 1);
}

// proses berulang-ulang
// sampai di break secara paksa
// tekan CTRL+C jika ingin berhenti 
while (true) {
    process_one();
    sleep(1);
}


?>