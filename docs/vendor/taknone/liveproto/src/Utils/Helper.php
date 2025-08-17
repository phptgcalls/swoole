<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Utils;

abstract class Helper {
	static public function generateRandomLong() : int {
		return intval(gmp_import(random_bytes(0x8)));
	}
	static public function getByteArray(object | string | int $integer) : string {
		if(is_object($integer)):
			return gmp_export(strval($integer));
		elseif(is_string($integer) || is_int($integer)):
			return gmp_export(gmp_init($integer,0xa)); // base‑10 //
		endif;
		/*
		Why two different export ? because... gmp_export('010') !== gmp_export(gmp_init('010',0xa));
		elseif(is_int($integer)):
			$hex = dechex($integer);
			$dec = (strlen($hex) % 0x2 == 0x0) ? $hex : strval(0x0).$hex;
			return pack('C*',...array_map('hexdec',str_split($dec,0x2)));
		endif;
		*/
	}
	/* V2 : https://core.telegram.org/mtproto/description#defining-aes-key-and-initialization-vector */
	static public function keyCalculate(string $authKey,string $msgKey,bool $client) : array {
		$x = $client ? 0x0 : 0x8;
		$a = hash('sha256',$msgKey.substr($authKey,$x,0x24),true);
		$b = hash('sha256',substr($authKey,0x28 + $x,0x24).$msgKey,true);
		$key = substr($a,0x0,0x8).substr($b,0x8,0x10).substr($a,0x18,0x8);
		$iv = substr($b,0x0,0x8).substr($a,0x8,0x10).substr($b,0x18,0x8);
		return [$key,$iv];
	}
	/* V1 : https://core.telegram.org/mtproto/description_v1#defining-aes-key-and-initialization-vector */
	static public function aesCalculate(string $authKey,string $msgKey,bool $client) : array {
		$x = $client ? 0x0 : 0x8;
		$a = sha1($msgKey.substr($authKey,$x,0x20),true);
		$b = sha1(substr($authKey,$x + 0x20,0x10).$msgKey.substr($authKey,$x + 0x30,0x10),true);
		$c = sha1(substr($authKey,$x + 0x40,0x20).$msgKey,true);
		$d = sha1($msgKey.substr($authKey,$x + 0x60,0x20),true);
		$key = substr($a,0x0,0x8).substr($b,0x8,0xc).substr($c,0x4,0xc);
		$iv = substr($a,0x8,0xc).substr($b,0x0,0x8).substr($c,0x10,0x4).substr($d,0x0,0x8);
		return [$key,$iv];
	}
	static public function generateKeyNonces(string $serverNonce,string $newNonce) : array {
		$hash1 = sha1($newNonce.$serverNonce,true);
		$hash2 = sha1($serverNonce.$newNonce,true);
		$hash3 = sha1($newNonce.$newNonce,true);
		$key = $hash1.substr($hash2,0x0,0xc);
		$iv = substr($hash2,0xc,0x8).$hash3.substr($newNonce,0x0,0x4);
		return [$key,$iv];
	}
	static public function checkG(int | string | \GMP $g,int | string | \GMP $p,bool $a_or_b = false) : void {
		/*
		Apart from the conditions on the Diffie-Hellman prime dh_prime and generator g, both sides are to check that g, g_a and g_b are greater than 1 and less than dh_prime - 1. We recommend checking that g_a and g_b are between 2^{2048-64} and dh_prime - 2^{2048-64} as well
		g > 1 , g_a > 1 , g_b > 1
		g < dh_prime ( p ) - 1 , g_a < dh_prime ( p ) - 1 , g_b < dh_prime ( p ) - 1
		*/
		if(gmp_cmp($g,1) < 1 || gmp_cmp($g,gmp_sub($p,1)) > 0):
			throw new \Exception('g a / g b is invalid !');
		endif;
		/*
		We recommend checking that g_a and g_b are between 2^{2048-64} and dh_prime - 2^{2048-64} as well
		2^{2048-64} < g_a < dh_prime ( p ) - 2^{2048-64}
		*/
		if($a_or_b === true):
			$maximum = gmp_init('1751908409537131537220509645351687597690304110853111572994449976845956819751541616602568796259317428464425605223064365804210081422215355425149431390635151955247955156636234741221447435733643262808668929902091770092492911737768377135426590363166295684370498604708288556044687341394398676292971255828404734517580702346564613427770683056761383955397564338690628093211465848244049196353703022640400205739093118270803778352768276670202698397214556629204420309965547056893233608758387329699097930255380715679250799950923553703740673620901978370802540218870279314810722790539899334271514365444369275682816');
			if(gmp_cmp($maximum,$g) > 0 || gmp_cmp($g,gmp_sub($p,$maximum)) > 0):
				throw new \Exception('g a / g b is invalid !');
			endif;
		endif;
	}
}

?>