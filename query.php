<?php

require_once('koneksi.php');
//instantiate database and product object

function start($text){
  $command1 = explode(' ', $text);   
  if($text == '/login'){
      $hasil ="🔊 Login Sebagai:\n\n ";
      $hasil .= "/aslab khusus untuk aslab\n\n";
      $hasil .= "/praktikan untuk masuk sebagai praktikan biasa tanpa login";
      $_SESSION['step']='level_user';
  }
  else{
    $hasil= '⛔️ *ERROR:* _Instruksi belum terisi sesuai perintah!_';
    $hasil .= "\n".'ingat /login ya! 😅';
  }        var_dump($text);
  return $hasil;
}

function level_user($text){
  if($text == '/aslab'){
      var_dump($text);
      $hasil = menu_aslab($text);
  }
  else if($text == '/praktikan'){
     var_dump($text);
     print_r($text);
     $hasil = menu_praktikan($text);
  }
  else if($text == '/login'){
     $hasil = start($text);
  }
  else{
     var_dump($text);
     $hasil = '⛔️ *ERROR:* _Instruksi  tidak ditemukan. Perintahkan bot sesuai instruksi!_';
     $hasil .= "\n".'ingat /aslab atau /praktikan';
  }
    return $hasil;
}



function menu_praktikan($text){
  $hasil = "Berikut menu yang tersedia untuk membantu anda.. ‼️\n\n";
  $hasil .= "📅 /jadlab `[kom]` `[angkatan]` `[hari]`  untuk lihat jadwal lab\n     ex: /jadlab B1 2018 Senin\n";        
  $hasil .= "\n\n 🤦‍♀️ /logout ";
  var_dump($text);
  print_r($_SESSION['step']);
  $_SESSION['step'] = 'menupraktikan';
  return $hasil;
}

function menupraktikan($text){
  $pecah = explode(' ', $text); 
  if($pecah[0] == '/jadlab'){

    if(str_word_count($text)<=4){
              if(isset($pecah[1])&&isset($pecah[2])&&isset($pecah[3])){
                $kom_jadwal = $pecah[1];
                $angkatan_jadwal = $pecah[2];
                $hari_jadwal = $pecah[3];
                $hasil = listJadwal($kom_jadwal, $angkatan_jadwal, $hari_jadwal);
                //var_dump($text);
              }
              else{
                $hasil = '⛔️ *ERROR:* _Instruksi belum terisi sesuai perintah!_';
                $hasil .= "\n".'ingat /jadlab `[kom]` `[angkatan]` `[hari]`'; 
              }
            }
            else{
              $hasil = '⛔️ *ERROR:* _Instruksi terisi berlebihan. Ikuti sesuai perintah!_';
              $hasil .= "\n".'ingat /jadlab `[kom]` `[angkatan]` `[hari]`'; 
            }     
     echo "pecah";
  }  else if($text == '/praktikan'){
     var_dump($text);
     print_r($text);
     $hasil = menu_praktikan($text);

  }
  else if($pecah[0] == '/logout'){
      $hasil = logout($text);  
      echo "logout";
   }
   else{
    $hasil = '⛔️ *ERROR:* _Instruksi belum terisi sesuai perintah!_\n';
    $hasil .= "/jadlab `[kom]` `[angkatan]` `[hari]`  untuk lihat jadwal lab! ex: `/jadlab B1 2018 Senin` " ;
    $_SESSION['chat_id'] = $chatid;
  }
  return $hasil;

}

function menu_aslab($text){  
  $hasil = "Ok! Sekarang tuliskan nim kamu!";
  $_SESSION['step'] = 'nim';
  var_dump($text);
  return $hasil;
}

function login($text){
	global $conn;
	$query = mysqli_query($conn,"SELECT * from aslab where nim = '$text'");
	$row=mysqli_fetch_array($query);
  $_SESSION['nama_aslab'] = $row['nama_aslab'];
  		if ($row['nim'] == $text)
  			{
            $hasil = "Ok, {$text} _Masukkan password anda!_";
            //$_SESSION['chat_id'] = $chatid;
            $_SESSION['step'] = 'password';
  				//$hasil ="masukkan password dengan cara /password password_kamu";
  			}
        else if('/login' == $text ){
          $hasil = start($text);
        }
        else if('/aslab' == $text ){
          $_SESSION['step']= 'level_user';
        }
        else{
          $hasil ="⛔️ *ERROR:* `nim` anda `tidak terdaftar` dalam Grup Aslab. \n_masukkan kembali nim anda_\n\n<< kembali ke menu login : /login";
        }
        var_dump($text);
  			return $hasil;
}

function menu($nama_aslab){
      $hasil = "Hai, Selamat datang asisten laboran `{$nama_aslab}`.";
      $hasil .= "\n\nBerikut _menu_ yang tersedia untuk *membantu anda* para aslab.. ‼️\n\n";
      $hasil .= "✏️ /tambah untuk memasukkan jadwal mengajar lab anda\n";
      $hasil .= "🔍 /jadlab `[kom]` `[angkatan]` `[hari]`  untuk lihat jadwal lab\n     ex: /jadlab B1 2018 Senin\n";
      $hasil .= "📅 /jadngajar untuk mengolah jadwal mengajar anda ";
      $hasil .= "\n\n 🤦‍♀️ /logout ";
      $_SESSION['step']='menuaslab';
      return $hasil;  
}

function password($text){
  global $conn;
  $query = mysqli_query($conn,"SELECT * from aslab where nim = '$_SESSION[nim]' and password = '$text'");
  $row=mysqli_fetch_array($query);  
  $nama_aslab = $row['nama_aslab'];
  $id_aslab = $row['id_aslab'];
  $nim = $row['nim'];

  if ($row['password'] == $text)
  {
      $hasil = menu($nama_aslab);
      $_SESSION['step'] = 'menuaslab';
      $_SESSION['id_aslab'] = $id_aslab;
  }else if('/login' == $text ){
      $hasil = start($text);
  }else{        
    $hasil ="⛔️ *ERROR:* `password salah`. \n_masukkan kembali password_ anda.\n\nJika lupa tanyakan secara personal password pemberian dari grup pengurus aslab.\n\n << kembali ke menu login : /login";
  } return $hasil;      
}


function menuaslab($text){
  $pecah = explode(' ', $text); 
  
   if($text == '/tambah')
   {
     $hasil = tambah($text);
   }elseif($pecah[0]== '/jadlab'){
      
    if(str_word_count($text)<=4){
              if(isset($pecah[1])&&isset($pecah[2])&&isset($pecah[3])){
                $kom_jadwal = $pecah[1];
                $angkatan_jadwal = $pecah[2];
                $hari_jadwal = $pecah[3];
                $hasil = listJadwal($kom_jadwal, $angkatan_jadwal, $hari_jadwal);
                //var_dump($text);
              }
              else{
                $hasil = '⛔️ *ERROR:* _Instruksi belum terisi sesuai perintah!_';
                $hasil .= "\n".'ingat /jadlab `[kom]` `[angkatan]` `[hari]`'; 
              }
            }
            else{
              $hasil = '⛔️ *ERROR:* _Instruksi terisi berlebihan. Ikuti sesuai perintah!_';
              $hasil .= "\n".'ingat /jadlab `[kom] [angkatan] [hari]`'; 
            }
    
   }else if($text == '/jadngajar'){
      $hasil = listJadwalNgajar($text);
   }
   else if($text == '/hapus'){
     $hasil = "⛔️ *ERROR:* apa yang ingin anda hapus?. `kode jadwal tidak boleh kosong.`";
     return $hasil;
   }
   elseif(preg_match("/^\/hapus_(\d+)$/i", $text, $cocok)) {
          var_dump($cocok);
          $text = "/hapus $cocok[1]";
          var_dump($text);
          echo str_word_count($text) ;
          $pecah = explode(' ', $text, 2);
          if (isset($pecah[1])) {
             $pesanproses = $pecah[1];
             $hasil = hapus($_SESSION['id_aslab'], $pesanproses);
          } else {
            $hasil = '⛔️ *ERROR:* `Bot tidak mengerti`. Kode jadwal yang diberikan tidak sesuai instruksi .`';
          }
   }else if(preg_match("/^\/gantijadwal_(\d+)$/i", $text, $cocok)){
        $text = "/gantijadwal $cocok[1]";
        var_dump($text);
          $pecah = explode(' ', $text, 2);
          if (isset($pecah[1])) {
             $pesanproses = $pecah[1];
             $hasil = gantijadwal($_SESSION['id_aslab'], $pesanproses);
          } else {
            $hasil = '⛔️ *ERROR:* `kode jadwal tidak boleh kosong.`';
          }
      
   }
   elseif($text == '/logout'){
      $hasil = logout($text);  
   }
   else{
    $hasil = "⛔️ *ERROR:* _Instruksi belum terisi sesuai perintah!_ \n";
      $hasil .= "✏️ /tambah untuk memasukkan jadwal mengajar lab anda\n";
      $hasil .= "🔍 /jadlab `[kom] [angkatan] [hari]`  untuk lihat jadwal lab\n     ex: /jadlab B1 2018 Senin\n";
      $hasil .= "📅 /jadngajar untuk mengolah jadwal mengajar anda ";
      $hasil .= "\n\n 🤦‍♀️ /logout untuk keluar "; 
      $_SESSION['chat_id'] = $chatid;
  }
  return $hasil;
}




function listJadwal($kom_jadwal, $angkatan_jadwal, $hari_jadwal){
  global $conn;
  $hasil = "😢 Maaf ya, jadwal belum tersedia.\nSilahkan hubungi aslab anda.";
 
  $query = mysqli_query($conn,"SELECT nama_mk, jam, ruangan, nama_aslab from v_jadwal where kom = '$kom_jadwal' and angkatan = '$angkatan_jadwal' and hari = '$hari_jadwal'");

  $row=mysqli_fetch_array($query);
       $jml = mysqli_num_rows($query);  
       if($jml >0){
           $hasil = "✍🏽 *Ada $jml jadwal lab-mu pada hari $hari_jadwal: *\n";

          $no = 0 ;

          foreach ($query as $data){
             $no++;
          $hasil .= "\n$no.  📚 ". $data['nama_mk']."\n     🕐 ".$data['jam']." \n     🏢 Ruang ".$data['ruangan']."\n     👩🏻‍🏫 ".$data['nama_aslab']."\n";        
          }
 
        }    
  return $hasil;
}

function listJadwalNgajar($text){
  global $conn;
  $query = mysqli_query($conn,"SELECT * from aslab where nim='$_SESSION[nim]' and password = '$_SESSION[password]'");

  $row=mysqli_fetch_array($query);  
  $id_aslab = $row['id_aslab'];
  $_SESSION['id_aslab'] = $id_aslab;  

  $query1 = mysqli_query($conn, "SELECT nama_mk, jam, ruangan, id_jadwal, kom, angkatan, hari from v_jadwal where id_aslab = '$id_aslab'");
  $row1=mysqli_fetch_array($query1);
  $id_jadwal = $row1['id_jadwal'];  
  $jml = mysqli_num_rows($query1);  
       if($jml >0){
           $hasil = "✍🏽 *Ada $jml jadwal lab yang telah anda buat: *\n";

          $no = 0 ;

          foreach ($query1 as $data){
              $no++;
              $hasil .= "\n$no.  📚 ". $data['nama_mk']."\n     🕐 ".$data['jam']." \n     🏢 Ruang ".$data['ruangan']."\n     📆 ".$data['hari']."\n     📍 Kom ".$data['kom']."\n     👤 angkatan ".$data['angkatan']."\n";
              $hasil .= "\n📛 Hapus? /hapus\_$data[id_jadwal]\n";
              $hasil .= "\n📛 Ganti Jadwal mengajar (Jam, Hari Ruang Mengajar)? /gantijadwal\_$data[id_jadwal]\n";
              //$hasil .= hapus($text,$id_jadwal);    
          } 

        }else {
          $hasil = "😢 Anda belum menambahkan jadwal lab";
        } 
        return $hasil;   

}

function hapus($id_aslab, $id_jadwal){
    global $conn;
    $hasil = "⛔️ *ERROR :* Bot tidak mengerti instruksi anda salah! Jangan lupa `sertakan kode jadwal nya` contoh: hapus_`55`";
    if( $id_jadwal != ''){
      $query = mysqli_query($conn, "DELETE FROM jadwal where id_aslab='$id_aslab' and id_jadwal='$id_jadwal' ");
      $hasil = '💁🏼  Jadwal yang dipilih telah dihapus..';
    } return $hasil;
}

function gantijadwal($id_aslab, $id_jadwal){
  global $conn;
   $_SESSION['jadwalganti'] = $id_jadwal;
   $query = mysqli_query($conn, "SELECT * FROM v_jadwal where id_jadwal ='$id_jadwal'");
    $row = mysqli_fetch_array($query);

   $hasil = "Anda sebelumnya tidak bisa mengajar lab `{$row['nama_mk']} {$row['kom']} {$row['angkatan']}` pada hari `{$row['hari']}`.\n Masukkan hari anda bisa mengajar: \n";
  $hasil .= "Berikut daftar hari anda bisa mengajar :\n";

  $query1 = mysqli_query($conn,"SELECT DISTINCT hari from waktu ");
  $no = 0;
  foreach($query1 as $data){
    $no++;
    $hasil .= "{$no}. {$data['hari']}\n " ;
  } 
    $_SESSION['step']='gantihari'; 

   return $hasil;
}

function gantihari($text){
 global $conn;

  //jadwal sebelumnya
  $query1 = mysqli_query($conn, "SELECT * FROM v_jadwal where id_jadwal ='$_SESSION[jadwalganti]'");
    $row1 = mysqli_fetch_array($query1);
    $id_waktu = $row1['id_waktu'];
    $hari = $row1['hari'];

  //mau diganti ke hariganti
    $hariganti = $_SESSION['hariganti'];
 
  var_dump($_SESSION['jadwalganti']);
  var_dump($query1);
  //print_r($query1);
  var_dump($row1);
  //print_r($row1);

  // $query2 = mysqli_query($conn, "SELECT id_waktu FROM v_jadwal where id_jadwal!='$_SESSION[jadwalganti]'");
  // $row2 = mysqli_fetch_array($query1);
  // $id_waktufull = $row2['id_waktu'];

  if($text == $hari){
  $query = mysqli_query($conn,"SELECT DISTINCT jam, hari from waktu where  hari='$text' and jam!='$row1[jam]'");
  }
  else{
     $query = mysqli_query($conn,"SELECT DISTINCT jam, hari from waktu where  hari='$text' and id_waktu!='$id_waktu'"); 
  }  
  var_dump($query);
  $row= mysqli_fetch_array($query);
  $jam = $row['jam'];
  //print_r($row);
  var_dump($row);
      
  if($row['hari'] = $text && (mysqli_num_rows($query)>0))
  {
     $hasil = "Anda sebelumnya tidak bisa mengajar pada `{$row1['hari']} {$row1['jam']}`. Masukkan jam anda bisa mengajar `{$row1['nama_mk']} `pada` {$hariganti}`! Contoh: `$jam`\n\nBerikut daftar jam lab available anda :\n";
          if(mysqli_num_rows($query)>0){
            $no = 0;  
              foreach ($query as $data) {
                # code...
                $no++;
                $hasil .= "\n{$no}. {$data['jam']}\n";
              }
            $_SESSION['step'] = 'gantiwaktu';
          }
  }else{
     $hasil ="⛔️ *ERROR:* `Masukkan hari ganti ` mengajar ` yang tersedia sesuai format instruksi`";
  }
   return $hasil;
}

function gantiwaktu($text){
  global $conn;

  //jadwal sebelumnya
  $query1 = mysqli_query($conn, "SELECT * FROM v_jadwal where id_jadwal ='$_SESSION[jadwalganti]'");
    $row1 = mysqli_fetch_array($query1);

  //jadwal ganti
  $hariganti = $_SESSION['hariganti'];
  $jamganti = $_SESSION['waktuganti'];
    
   // $query3 = mysqli_query($conn, "SELECT DISTINCT ruangan, nama_aslab, kom, angkatan, nama_mk from v_jadwal where jam='$text' and hari= '$hariganti'" ); 
   // $row3 = mysqli_fetch_array($query3);
   // print_r($row3);
   // var_dump($row3);

  $query2= mysqli_query($conn,"SELECT * from v_jadwal where hari='$hariganti' and jam='$text' ");
  
  $row2 = mysqli_fetch_array($query2);


foreach($query2 as $dt){
    $id = $dt['id_waktu'];
    $jam = $dt['jam'];
    $noruangan = $dt['ruangan'];
    $all[$id][$jam] = $noruangan;
 }

 //deklarasi stack adalah array
 $stack = array();

 //mengambil semua keys dari all
 $keys = array_keys($all);

 for($i = 0 ; $i<count($all) ; $i++){
  foreach ($all[$keys[$i]] as $key => $value) {
     echo array_push($stack, $value);
  }
 }

 //var_dump( array_push($stack, $value));
 // $noruangans = join(',',$stack);

 $query3 = mysqli_query($conn , "SELECT * from waktu where hari='$hariganti'  and jam='$text' and ruangan NOT IN ('" . implode( "','" , $stack) . "') ");
  $row3 = mysqli_fetch_array($query3);
  $noruang = $row3['ruangan'];
  var_dump($noruang); 
  var_dump($row3);
  var_dump($stack);
 

  $query = mysqli_query($conn,"SELECT DISTINCT hari, jam, ruangan from waktu where jam='$text' and hari = '$hariganti' " );
  $row=mysqli_fetch_array($query);
  print_r($row);
   $ruangan = $row['ruangan'];
   print_r($ruangan);

      if ($row['jam'] == $text && (mysqli_num_rows($query3)>0))
        {
            $hasil = "Anda tidak bisa mengajar pada `{$row1['hari']} {$row1['jam']} {$row1['ruangan']}`. Masukkan `ruangan anda mengajar {$row1['nama_mk']}` pada `{$hariganti} {$jamganti}`  !\n\n Berikut data ruangan yang tersedia pada waktu anda bisa mengajar :";
            if(mysqli_num_rows($query)>0){
               $no= 0;
              foreach ($query3 as $data) {
                # code...
                $no++;
                $hasil .= "\n $no. {$data['ruangan']}\n";
              }
            }
            //$_SESSION['chat_id'] = $chatid;
            $_SESSION['step'] = 'gantiruangan';
        
        }else{
          $hasil ="⛔️ *ERROR:* `Masukkan Jam mengajar yang tersedia`";
        }
        return $hasil;

 
}

function gantiruangan($text){
  global $conn ;

  //jadwal sebelumnya
  $query1 = mysqli_query($conn, "SELECT * FROM v_jadwal where id_jadwal ='$_SESSION[jadwalganti]'");
    $row1 = mysqli_fetch_array($query1);
    $nama_aslab = $row1['nama_aslab'];
    $_SESSION['nama_aslab'] = $nama_aslab;
  //jadwal ganti
  $hariganti = $_SESSION['hariganti'];
  $jamganti  = $_SESSION['waktuganti'];
  $ruanganganti = $_SESSION['ruanganganti'];

  $query3 = mysqli_query($conn, "SELECT ruangan, nama_aslab, nama_mk, kom from v_jadwal where hari='$hariganti' and jam='$jamganti' and ruangan = '$text'");
   $row3 = mysqli_fetch_array($query3);
   print_r($row3);

  $query = mysqli_query($conn,"SELECT DISTINCT hari, jam, ruangan from waktu where  jam='$jamganti' and hari = '$hariganti' and ruangan='$text' " );

  $row=mysqli_fetch_array($query);
  print_r($row);
   $ruangan = $row['ruangan'];

        if($ruangan == $text && (!(mysqli_num_rows($query3)>0)))
        {
            $hasil = "Berikut detail jadwal yang anda pilih :\n-----------------------------------------\n\n🔉 `Saya dengan sadar Menetapkan` :\n\nNama : `{$nama_aslab} `\nNim :`{$_SESSION['nim']}`\nMatakuliah: `{$row1['nama_mk']}` \nSemester: `{$row1['semester']}`\nKom : `{$row1['kom']}`\n\nJadwal matakuliah sebelumnya :\nHari : {$row1['hari']}\nJam : {$row1['jam']}\nRuangan : {$row1['ruangan']}\n\n `Mengubah jadwal mengajar saya` dengan detail `sebagai berikut:` \nHari: `{$_SESSION['hariganti']}`\nJam: `{$_SESSION['waktuganti']}` \nRuangan : `{$_SESSION['ruanganganti']}` \n\n*Apakah sudah sesuai pilihan anda?* `(ya/tidak)`";
            //$_SESSION['chat_id'] = $chatid;
            $_SESSION['step'] = 'update';
        }else{
          if((mysqli_num_rows($query3))>0){
            $hasil ="⛔️ *ERROR:* Ruangan `{$ruanganganti} ini sudah dijadwalkan oleh {$row3['nama_aslab']} - {$row3['nama_mk']} {$row3['kom']}` . Pilih ruangan lain yang tersedia";
          }
          else{

          $hasil ="⛔️ *ERROR:* `Masukkan ruangan mengajar anda` anda sesuai insteruksi";
          }
        }
        return $hasil;
}

function upselesai(){

  global $conn;

  //jadwal sebelumnya
  $query1 = mysqli_query($conn, "SELECT * FROM v_jadwal where id_jadwal ='$_SESSION[jadwalganti]'");
    $row1 = mysqli_fetch_array($query1);
    $nama_aslab = $row1['nama_aslab'];
    $nim = $_SESSION['nim'];

  $hariganti = $_SESSION['hariganti'];
  $jamganti = $_SESSION['waktuganti'];
  $ruanganganti = $_SESSION['ruanganganti'];

  $query3 = mysqli_query($conn, "SELECT ruangan from v_jadwal where jam='$jamganti' and hari = '$hariganti' and ruangan='$ruanganganti'" ); 
   $row3 = mysqli_fetch_array($query3);
   print_r($row3);

  $query = mysqli_query($conn,"SELECT id_waktu,hari, jam, ruangan from waktu where  jam='$_SESSION[waktuganti]' and hari = '$_SESSION[hariganti]' and ruangan = '$ruanganganti'" );

  $row=mysqli_fetch_array($query);
  $id_waktu = $row['id_waktu'];
  print_r($row);

  if( (!(mysqli_num_rows($query3)>0)) && (mysqli_num_rows($query)>0) ){

  $query = mysqli_query($conn, "UPDATE jadwal SET id_waktu = '$id_waktu' where id_jadwal = '$_SESSION[jadwalganti]'") ; 

  if(mysqli_query($conn, $query)) {

      $hasil = "⛔️ *ERROR:* Maaf Jadwal '{$hariganti} {$jamganti} {$ruanganganti}'  yang Anda tambahkan telah dipilih terlebih dahulu oleh `{$nama_aslab}` -  Silahkan tetapkan jadwal lain atau diskusikan dengan `{$nama_aslab}` secara personal ";     
    }else{
           $hasil = "✅ Jadwal `berhasil diubah`\n";
           $hasil .= menu($nama_aslab);
    }
  }else{
    if((mysqli_num_rows($query3)>0)){
         $hasil = "⛔️ *ERROR:* Maaf Jadwal '{$hariganti} {$jamganti} {$ruanganganti}'  yang Anda tambahkan telah dipilih terlebih dahulu oleh `{$nama_aslab}` -  Silahkan tetapkan jadwal lain atau diskusikan dengan `{$nama_aslab}` secara personal ";     
    }else if(!(mysqli_num_rows($query)>0)){
        $hasil = "⛔️ *ERROR:* Maaf Jadwal '{$hariganti} {$jamganti} {$ruanganganti}'  yang Anda tambahkan tidak tersedia";
    } else{
      $hasil = "⛔️ *ERROR:*";
    }
    }

    // var_dump(!(mysqli_num_rows($query_waktuksg)>0));
    // var_dump(!(mysqli_num_rows($query_udhlist)>0)) ;
    // var_dump(!(mysqli_num_rows($query_klshvjwl)>0));      
        return $hasil;

}

function logout($text){

  $hasil = "Hai 💁 `$namauser` .. Selamat datang di `Sistem Informasi Jadwal Laboratorium FASILKOM-TI` Universitas Sumatera Utara! \n\n";
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
  return $hasil;
}

function tambah($text){
  global $conn;
  
  $query = mysqli_query($conn,"SELECT * from aslab where nim='$_SESSION[nim]' and password = '$_SESSION[password]'");

  $row=mysqli_fetch_array($query);  
  $nama_aslab = $row['nama_aslab'];

  $hasil = "Hai, {$nama_aslab}.\n`Masukkan semester matakuliah` yang akan anda `ajar`(1-8) !\n";

  if (mysqli_num_rows($query)>0){               
      $_SESSION['step'] = 'term';
  }
  return $hasil;
}

function term($text){
  global $conn;
  $query = mysqli_query($conn,"SELECT id_mk, nama_mk, semester from matakuliah where semester = '$text'");
  $row=mysqli_fetch_array($query);
  $semester = $row['semester'];     
  
  if ($row['semester'] == $text)
  {
      $hasil = "Masukkan `id mata kuliah` yang ada pada `semester {$row[semester]}` yang akan  `anda  ajar`! Contoh:2!";
  
       if(mysqli_num_rows($query)>0){
          $no = 0 ;
          foreach ($query as $data){
             $no++;
             $hasil .= "\n".$no.". ".$data['nama_mk']."  (`id` = ".$data['id_mk'].")\n";
          } 
        }    
          $_SESSION['step'] = 'matakuliah';
  }
  else if($text == '/jadngajar'){
    $hasil = listJadwalNgajar($text);
  }
  else{
     $hasil ="⛔️ *ERROR:* `semester` matakuliah lab yang `tersedia 1-8`";
  }
  return $hasil;
}

function matakuliah($text){
  global $conn;
  $query = mysqli_query($conn,"SELECT * from matakuliah where id_mk = '$text' and semester='$_SESSION[semester]'");
  $row=mysqli_fetch_array($query);
  $nama_mk = $row['nama_mk'];
  
  if ($row['id_mk'] == $text)
  {
    $hasil = "Masukkan `hari` anda akan `mengajar {$nama_mk}` (Senin - Jumat)!\nContoh: Senin (kapital no spasi - case sensitive)\n";
    
    $_SESSION['step'] = 'hari';
  }else {
    $hasil ="⛔️ *ERROR:* `Masukkan id matkul yang tersedia` untuk lab";
  }
  return $hasil;
}

function hari($text){
  global $conn;
  $query = mysqli_query($conn,"SELECT DISTINCT jam, hari from waktu where hari = '$text'");
  $row= mysqli_fetch_array($query);
  $hari = $row['hari'];
  $jam = $row['jam'];
      
  if ($row['hari'] == $text)
  {
     $hasil = "Masukkan jam mengajar anda pada {$hari}! Contoh: `14.40-16.20`\n\nBerikut daftar jam lab yang dibolehkan untuk aslab:\n";
          if(mysqli_num_rows($query)>0){
            $no = 0;  
              foreach ($query as $data) {
                # code...
                $no++;
                $hasil .= "\n{$no}. {$data['jam']}\n";
              }
            $_SESSION['step'] = 'waktu';
          }
  }else{
     $hasil ="⛔️ *ERROR:* `Masukkan hari` mengajar `sesuai format instruksi`";
  }
   return $hasil;
}

function waktu($text){
  global $conn;


  $query = mysqli_query($conn,"SELECT DISTINCT jam from waktu where hari='$_SESSION[hari]' and jam='$text'");

  // $query1 = mysqli_query($conn, "SELECT ruangan from v_jadwal where hari= '$_SESSION[hari]' and jam='$_SESSION[waktu]'");
  // $row1 = mysqli_fetch_array($query1);

  // $noruang = $row1['ruangan'];

  // // var_dump($noruang);
  // // print_r($query1);
  // var_dump($query1);


  // $query2= mysqli_query($conn,"SELECT jam, ruangan from waktu where hari='$_SESSION[hari]'  and jam='$text' and ruangan NOT IN ('" . implode( "', '" , $row1) . "') ");

  $query2= mysqli_query($conn,"SELECT * from v_jadwal where hari='$_SESSION[hari]'  and jam='$text' ");
  
  $row2 = mysqli_fetch_array($query2);


foreach($query2 as $dt){
    $id = $dt['id_waktu'];
    $jam = $dt['jam'];
    $noruangan = $dt['ruangan'];
    $all[$id][$jam] = $noruangan;
 }

 //deklarasi stack adalah array
 $stack = array();

 //mengambil semua keys dari all
 $keys = array_keys($all);

 for($i = 0 ; $i<count($all) ; $i++){
  foreach ($all[$keys[$i]] as $key => $value) {
     echo array_push($stack, $value);
  }
 }

 var_dump( array_push($stack, $value));
 // $noruangans = join(',',$stack);

//munculkan ruangan yang kosong jadwalnya
 $query3 = mysqli_query($conn , "SELECT * from waktu where hari='$_SESSION[hari]'  and jam='$text' and ruangan NOT IN ('" . implode( "','" , $stack) . "') ");
  $row3 = mysqli_fetch_array($query3);
   // print_r($keys);
   //   print_r($all);
   // print_r($stack);
   // print_r($noruangans);
    var_dump($keys);
     var_dump($all);
   var_dump($stack);
   var_dump($noruangans);
   
  // print_r($query2);
  // var_dump($query2);
  // print_r($query3);
  // var_dump($row3);

  $row=mysqli_fetch_array($query);
 //  $ruangan = $row2['ruangan'];
      if ($row['jam'] == $text && (mysqli_num_rows($query3)>0))
        {
            $hasil = "`Masukkan nama ruangan` mana anda akan `mengajar`!\n\nBerikut daftar ruangan yang tersedia untuk mengajar :\n";
            if((mysqli_num_rows($query3))>0){
               $no= 0;
              foreach ($query3 as $data) {
                # code...
                $no++;
                $hasil .= "\n $no. {$data['ruangan']}\n";
              }
            }
            //$_SESSION['chat_id'] = $chatid;
            $_SESSION['step'] = 'ruangan';
        
        }else{
          $hasil ="⛔️ *ERROR:* `Masukkan Jam mengajar yang tersedia`";
        }
        return $hasil;
}

function ruangan($text){
  global $conn ;
  // $query =  mysqli_query($conn, "SELECT * from waktu where ruangan='$text' AND jam = '$_SESSION[waktu]' AND hari ='$_SESSION[hari]'");  
  

    $query2= mysqli_query($conn,"SELECT * from v_jadwal where hari='$_SESSION[hari]' and jam='$_SESSION[waktu]' ");
  
  $row2 = mysqli_fetch_array($query2);


foreach($query2 as $dt){
    $id = $dt['id_waktu'];
    $jam = $dt['jam'];
    $noruangan = $dt['ruangan'];
    $all[$id][$jam] = $noruangan;
 }

 //deklarasi stack adalah array
 $stack = array();

 //mengambil semua keys dari all
 $keys = array_keys($all);

 for($i = 0 ; $i<count($all) ; $i++){
  foreach ($all[$keys[$i]] as $key => $value) {
     echo array_push($stack, $value);
  }
 }

 //var_dump( array_push($stack, $value));
 // $noruangans = join(',',$stack);

 $query3 = mysqli_query($conn , "SELECT * from waktu where hari='$_SESSION[hari]'  and jam='$_SESSION[waktu]' and ruangan NOT IN ('" . implode( "','" , $stack) . "') ");
  $row3 = mysqli_fetch_array($query3);
  $noruang = $row3['ruangan'];
  var_dump($noruang); 
  var_dump($row3);
  var_dump($stack);
  //next
  $query5 = mysqli_query($conn , "SELECT * FROM matakuliah where id_mk='$_SESSION[id_matkul]'");

  $datenow = getdate();
  $yearnow = $datenow['year'];
  if ($_SESSION['semester']==1 or $_SESSION['semester']==3 or $_SESSION['semester']==5 or $_SESSION['semester']==7) {
    # code...
    $angkatanmatkul = ($yearnow - ($_SESSION['semester']/2)) - 0.5;
  }if($_SESSION['semester']==2 or $_SESSION['semester']==4 or $_SESSION['semester']==6 or $_SESSION['semester']==8) {
    # code...
    $angkatanmatkul = $yearnow - ($_SESSION['semester']/2);
  }
  // $row = mysqli_fetch_array($query);
  $row5 = mysqli_fetch_array($query5);
  if($noruang == $text){

    $hasil = "Anda mengajar angkatan `{$angkatanmatkul}` matkul `{$row5['nama_mk']}`. `Masukkan kom kelas` yang anda `ajar`! `Contoh: B1`\n\n";

      //$_SESSION['chat_id'] = $chatid;
      $_SESSION['step'] = 'kom';
          
  }
  else{
    $hasil = "⛔️ *ERROR:* `Masukkan ruangan mengajar` yang ada `sesuai format tersedia`";
  }
  return $hasil;

}

function kom($text){
  global $conn;
  $queryw = mysqli_query($conn, "SELECT id_waktu from waktu where jam='$_SESSION[waktu]' and hari='$_SESSION[hari]' and ruangan ='$_SESSION[ruangan]'");
    $rowk = mysqli_fetch_array($queryw);
    $id_waktu = $rowk['id_waktu'];
    var_dump($id_waktu);

  $datenow = getdate();
  $yearnow = $datenow['year'];
  if($_SESSION['semester']==1 or $_SESSION['semester']==3 or $_SESSION['semester']==5 or $_SESSION['semester']==7) {
    # code...
    $angkatanmatkul = ($yearnow - ($_SESSION['semester']/2)) - 0.5;
  }if($_SESSION['semester']==2 or $_SESSION['semester']==4 or $_SESSION['semester']==6 or $_SESSION['semester']==8) {
    # code...
    $angkatanmatkul = $yearnow - ($_SESSION['semester']/2);
  }
  $query = mysqli_query($conn,"SELECT * from kelas where kom = '$text' and angkatan = '$angkatanmatkul'");
  $query1 = mysqli_query($conn,"SELECT * from aslab where nim = '$_SESSION[nim]'");
  $query2 = mysqli_query($conn,"SELECT * from matakuliah where id_mk = '$_SESSION[id_matkul]'");
    
  $row=mysqli_fetch_array($query);
  $row1=mysqli_fetch_array($query1);
  $row2=mysqli_fetch_array($query2);

      if ($row['kom'] == $text)
        {
            $hasil = "Berikut detail jadwal yang anda pilih :\n-----------------------------------------\n\n🔉 `Saya dengan sadar menyatakan` :\n\nNama : `{$row1['nama_aslab']}`\nNim :`{$row1['nim']}`\n\n `Menetapkan jadwal mengajar saya` dengan detail `sebagai berikut :` \nMatakuliah: `{$row2['nama_mk']}`\nSemester: `{$row2['semester']}`\nHari: `{$_SESSION['hari']}`\nWaktu: `{$_SESSION['waktu']}`\nKOM: `{$_SESSION['kom']}` \nRuangan : `{$_SESSION['ruangan']}` \n\n*Apakah sudah sesuai pilihan anda?* `(ya/tidak)`";
            //$_SESSION['chat_id'] = $chatid;
            $_SESSION['step'] = 'verifikasi';
        }else{
          $hasil ="⛔️ *ERROR:* `Masukkan kom mengajar` anda";
        }
        return $hasil;
}


function selesai(){
  global $conn;

  //waktu (id, jam, hari, ruangan)
  $queryw = mysqli_query($conn, "SELECT id_waktu from waktu where jam='$_SESSION[waktu]' and hari='$_SESSION[hari]' and ruangan ='$_SESSION[ruangan]'");
    $rowk = mysqli_fetch_array($queryw);
    $id_waktu = $rowk['id_waktu'];
    var_dump($id_waktu);

  //aslab (id, nim, nama, pass)
  $query1 = mysqli_query($conn, "SELECT * FROM aslab where nim='$_SESSION[nim]'");
    $row1 = mysqli_fetch_array($query1);
    $nama_aslab = $row1['nama_aslab'];
    $id_aslab= $row1['id_aslab'];
    var_dump($id_aslab);


  //id_kelas dari angkatan matkul semester dan kom
    $datenow = getdate();
    $yearnow = $datenow['year'];
    if ($_SESSION['semester']==1 or $_SESSION['semester']==3 or $_SESSION['semester']==5 or $_SESSION['semester']==7) {
    # code...
    $angkatanmatkul = ($yearnow - ($_SESSION['semester']/2)) - 0.5;
    }if($_SESSION['semester']==2 or $_SESSION['semester']==4 or $_SESSION['semester']==6 or $_SESSION['semester']==8) {
      # code...
      $angkatanmatkul = $yearnow - ($_SESSION['semester']/2);
    }
    $query2 = mysqli_query($conn,"SELECT * from kelas where kom='$_SESSION[kom]' and angkatan = '$angkatanmatkul'"); 
    $row2= mysqli_fetch_array($query2);
    $id_kelas = $row2['id_kelas'];
    var_dump($id_kelas);

  //id mk 
    $id_mk = $_SESSION['id_matkul'];
    $query4 = mysqli_query($conn, "SELECT * FROM matakuliah where id_mk= '$id_mk'");
    $row4 = mysqli_fetch_array($query4);
    var_dump($id_mk);

  //hari, jam , ruang udh diambil
  $query_waktuksg = mysqli_query($conn, "SELECT * FROM v_jadwal where hari='$_SESSION[hari]' and jam = '$_SESSION[waktu]'  and ruangan = '$_SESSION[ruangan]'");

  //kita udh isi jadwalnya matkul itu, kom itu, 
  $query_udhlist = mysqli_query($conn, "SELECT * FROM v_jadwal where id_aslab = '$id_aslab' and id_mk= '$id_mk' and id_kelas = '$id_kelas'");

  //kelas itu udh punya jadwal punya aslab lain 
  $query_klshvjwl = mysqli_query($conn, "SELECT * FROM v_jadwal where hari='$_SESSION[hari]' and jam = '$_SESSION[waktu]'  and id_kelas = '$id_kelas' ");
  $row_klshvjwl = mysqli_fetch_array($query_klshvjwl);

  $query_aslab_slah_ambil = mysqli_query($conn, "SELECT *FROM v_jadwal where id_kelas='$id_kelas' and id_aslab!='$id_aslab' and id_mk='$id_mk' ");
  $row_aslab_slah_ambil = mysqli_fetch_array($query_aslab_slah_ambil);
  $aslab_salah_ambil =  $row_aslab_slah_ambil['nama_aslab'];


  $row_waktuksg = mysqli_fetch_array($query_waktuksg);
  if((!(mysqli_num_rows($query_waktuksg)>0)) && (!(mysqli_num_rows($query_udhlist)>0)) && (!(mysqli_num_rows($query_klshvjwl)>0)) && (!(mysqli_num_rows($query_aslab_slah_ambil)>0))){
    $query3= "INSERT into jadwal (id_jadwal, id_aslab, id_mk, id_kelas, id_waktu) values('', '$id_aslab','$id_mk', '$id_kelas', '$id_waktu')";
    var_dump($query3);
    print_r($query_waktuksg);
    print_r($query_udhlist);
    print_r($query_klshvjwl);

     if(!mysqli_query($conn, $query3)) {
       // $hasil = "Error: " . $query3 . "<br>" . mysqli_error($conn);
      //$_SESSION['chat_id'] = $chatid;
      $_SESSION['step'] = 'nim';
    
      $hasil = "⛔️ *ERROR:* Maaf Jadwal yang Anda tambahkan telah dipilih terlebih dahulu oleh `{$row['nama_aslab']}`. Silahkan tetapkan jadwal lain atau diskusikan dengan `{$row['nama_aslab']}` secara personal ";     
    }else{
           $hasil = "✅ Jadwal `berhasil ditambah`\n";
           $hasil .= menu($nama_aslab);
    }
    // var_dump(!(mysqli_num_rows($query_waktuksg)>0));
    // var_dump(!(mysqli_num_rows($query_udhlist)>0)) ;
    // var_dump(!(mysqli_num_rows($query_klshvjwl)>0));
    print_r(!(mysqli_num_rows($query_waktuksg)>0));
    print_r(!(mysqli_num_rows($query_udhlist)>0));
    print_r(!(mysqli_num_rows($query_klshvjwl)>0));      
      
        return $hasil;

  }
  else{

    var_dump(!(mysqli_num_rows($query_waktuksg)>0)) ;
    var_dump(!(mysqli_num_rows($query_udhlist)>0)) ;
    var_dump(!(mysqli_num_rows($query_klshvjwl)>0));
    print_r((mysqli_num_rows($query_waktuksg)>0));
    print_r((mysqli_num_rows($query_udhlist)>0));
    print_r((mysqli_num_rows($query_klshvjwl)>0));      
    
    if((mysqli_num_rows($query_aslab_slah_ambil)>0)){
      $hasil = " ⛔️ *ERROR:* Jadwal lab `{$row4['nama_mk']}` kom `{$row2['kom']} {$row2['angkatan']}` sudah ada di list jadwal oleh  {$aslab_salah_ambil}.";
    }

    else if((mysqli_num_rows($query_udhlist)>0)){
     $hasil = "⛔️ *ERROR:* Jadwal lab `{$row4['nama_mk']}` kom `{$row2['kom']} {$row2['angkatan']}` sudah ada di list jadwal.\n Lihat list dengan ketik :  `/jadngajar` "; 

    }
    else if((mysqli_num_rows($query_klshvjwl)>0))
    {
      $hasil = "⛔️ *ERROR:* Kom `{$row2['kom']} {$row2['angkatan']}` yang ingin anda ajar pada hari `{$_SESSION['hari']}` jam `{$_SESSION['waktu']}` *sudah punya jadwal lab* : \n\n";
      foreach($query_klshvjwl as $data){
        $hasil .= " _{$data['nama_mk']}_  `{$data['nama_aslab']}` \n";
      } $hasil .= "\n Silahkan diskusi sendiri secara personal dengan aslab bersangkutan.";     
    }
    else if((mysqli_num_rows($query_waktuksg)>0)){
    $hasil = "⛔️ *ERROR:* Jadwal lab pada hari `{$_SESSION['hari']}`, jam `{$_SESSION['waktu']}` , ruangan `{$_SESSION['ruangan']}` yang ingin Anda tambahkan telah dipilih terlebih dahulu oleh `{$row_waktuksg['nama_aslab']}`.\n Silahkan tetapkan jadwal lain atau diskusikan dengan `{$row_waktuksg['nama_aslab']}` secara personal ";
    }

    else{
      $hasil = "⛔️ *ERROR:* ";
    }

      $_SESSION['step'] = 'menuaslab';
      return $hasil;
    }

   
    //mysqli_close($conn);
}
