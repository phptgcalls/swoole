<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Crypto;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Helper;

final class Rsa {
	private const RSAKEYS = [
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAwVACPi9w23mF3tBkdZz+zwrzKOaaQdr01vAbU4E1pvkfj4sqDsm6'.
													'lyDONS789sVoD/xCS9Y0hkkC3gtL1tSfTlgCMOOul9lcixlEKzwKENj1Yz/s7daS'.
													'an9tqw3bfUV/nqgbhGX81v/+7RFAEd+RwFnK7a+XYl9sluzHRyVVaTTveB2GazTw'.
													'Efzk2DWgkBluml8OREmvfraX3bkHZJTKX4EQSjBbbdJ2ZXIsRrYOXfaA+xayEGB+'.
													'8hdlLmAjbCVfaigxX0CDqWeR1yFL9kwd9P0NsZRPsmoqVwMbMu7mStFai6aIhc3n'.
													'Slv8kg9qv1m6XHVQY3PnEw+QQtqSIXklHwIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													# '-----BEGIN RSA PUBLIC KEY-----'.
													# 'MIIBCgKCAQEAyMEdY1aR+sCR3ZSJrtztKTKqigvO/vBfqACJLZtS7QMgCGXJ6XIR'.
													# 'yy7mx66W0/sOFa7/1mAZtEoIokDP3ShoqF4fVNb6XeqgQfaUHd8wJpDWHcR2OFwv'.
													# 'plUUI1PLTktZ9uW2WE23b+ixNwJjJGwBDJPQEQFBE+vfmH0JP503wr5INS1poWg/'.
													# 'j25sIWeYPHYeOrFp/eXaqhISP6G+q2IeTaWTXpwZj4LzXq5YOpk4bYEQ6mvRq7D1'.
													# 'aHWfYmlEGepfaYR8Q0YqvvhYtMte3ITnuSJs171+GDqpdKcSwHnd6FudwGO4pcCO'.
													# 'j4WcDuXc2CTHgH8gFTNhp/Y8/SpDOhvn9QIDAQAB'.
													# '-----END RSA PUBLIC KEY-----',
													# '-----BEGIN RSA PUBLIC KEY-----'.
													# 'MIIBCgKCAQEA6LszBcC1LGzyr992NzE0ieY+BSaOW622Aa9Bd4ZHLl+TuFQ4lo4g'.
													# '5nKaMBwK/BIb9xUfg0Q29/2mgIR6Zr9krM7HjuIcCzFvDtr+L0GQjae9H0pRB2OO'.
													# '62cECs5HKhT5DZ98K33vmWiLowc621dQuwKWSQKjWf50XYFw42h21P2KXUGyp2y/'.
													# '+aEyZ+uVgLLQbRA1dEjSDZ2iGRy12Mk5gpYc397aYp438fsJoHIgJ2lgMv5h7WY9'.
													# 't6N/byY9Nw9p21Og3AoXSL2q/2IJ1WRUhebgAdGVMlV1fkuOQoEzR7EdpqtQD9Cs'.
													# '5+bfo3Nhmcyvk5ftB0WkJ9z6bNZ7yxrP8wIDAQAB'.
													# '-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAruw2yP/BCcsJliRoW5eBVBVle9dtjJw+OYED160Wybum9SXtBBLX'.
													'riwt4rROd9csv0t0OHCaTmRqBcQ0J8fxhN6/cpR1GWgOZRUAiQxoMnlt0R93LCX/'.
													'j1dnVa/gVbCjdSxpbrfY2g2L4frzjJvdl84Kd9ORYjDEAyFnEA7dD556OptgLQQ2'.
													'e2iVNq8NZLYTzLp5YpOdO1doK+ttrltggTCy5SrKeLoCPPbOgGsdxJxyz5KKcZnS'.
													'Lj16yE5HvJQn0CNpRdENvRUXe6tBP78O39oJ8BTHp9oIjd6XWXAsp2CvK45Ol8wF'.
													'XGF710w9lwCGNbmNxNYhtIkdqfsEcwR5JwIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAvfLHfYH2r9R70w8prHblWt/nDkh+XkgpflqQVcnAfSuTtO05lNPs'.
													'pQmL8Y2XjVT4t8cT6xAkdgfmmvnvRPOOKPi0OfJXoRVylFzAQG/j83u5K3kRLbae'.
													'7fLccVhKZhY46lvsueI1hQdLgNV9n1cQ3TDS2pQOCtovG4eDl9wacrXOJTG2990V'.
													'jgnIKNA0UMoP+KF03qzryqIt3oTvZq03DyWdGK+AZjgBLaDKSnC6qD2cFY81UryR'.
													'WOab8zKkWAnhw2kFpcqhI0jdV5QaSCExvnsjVaX0Y1N0870931/5Jb9ICe4nweZ9'.
													'kSDF/gip3kWLG0o8XQpChDfyvsqB9OLV/wIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAs/ditzm+mPND6xkhzwFIz6J/968CtkcSE/7Z2qAJiXbmZ3UDJPGr'.
													'zqTDHkO30R8VeRM/Kz2f4nR05GIFiITl4bEjvpy7xqRDspJcCFIOcyXm8abVDhF+'.
													'th6knSU0yLtNKuQVP6voMrnt9MV1X92LGZQLgdHZbPQz0Z5qIpaKhdyA8DEvWWvS'.
													'Uwwc+yi1/gGaybwlzZwqXYoPOhwMebzKUk0xW14htcJrRrq+PXXQbRzTMynseCoP'.
													'Ioke0dtCodbA3qQxQovE16q9zz4Otv2k4j63cz53J+mhkVWAeWxVGI0lltJmWtEY'.
													'K6er8VqqWot3nqmWMXogrgRLggv/NbbooQIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAvmpxVY7ld/8DAjz6F6q05shjg8/4p6047bn6/m8yPy1RBsvIyvuD'.
													'uGnP/RzPEhzXQ9UJ5Ynmh2XJZgHoE9xbnfxL5BXHplJhMtADXKM9bWB11PU1Eioc'.
													'3+AXBB8QiNFBn2XI5UkO5hPhbb9mJpjA9Uhw8EdfqJP8QetVsI/xrCEbwEXe0xvi'.
													'fRLJbY08/Gp66KpQvy7g8w7VB8wlgePexW3pT13Ap6vuC+mQuJPyiHvSxjEKHgqe'.
													'Pji9NP3tJUFQjcECqcm0yV7/2d0t/pbCm+ZH1sadZspQCEPPrtbkQBlvHb4OLiIW'.
													'PGHKSMeRFvp3IWcmdJqXahxLCUS1Eh6MAQIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAxq7aeLAqJR20tkQQMfRn+ocfrtMlJsQ2Uksfs7Xcoo77jAid0bRt'.
													'ksiVmT2HEIJUlRxfABoPBV8wY9zRTUMaMA654pUX41mhyVN+XoerGxFvrs9dF1Ru'.
													'vCHbI02dM2ppPvyytvvMoefRoL5BTcpAihFgm5xCaakgsJ/tH5oVl74CdhQw8J5L'.
													'xI/K++KJBUyZ26Uba1632cOiq05JBUW0Z2vWIOk4BLysk7+U9z+SxynKiZR3/xdi'.
													'XvFKk01R3BHV+GUKM2RYazpS/P8v7eyKhAbKxOdRcFpHLlVwfjyM1VlDQrEZxsMp'.
													'NTLYXb6Sce1Uov0YtNx5wEowlREH1WOTlwIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAsQZnSWVZNfClk29RcDTJQ76n8zZaiTGuUsi8sUhW8AS4PSbPKDm+'.
													'DyJgdHDWdIF3HBzl7DHeFrILuqTs0vfS7Pa2NW8nUBwiaYQmPtwEa4n7bTmBVGsB'.
													'1700/tz8wQWOLUlL2nMv+BPlDhxq4kmJCyJfgrIrHlX8sGPcPA4Y6Rwo0MSqYn3s'.
													'g1Pu5gOKlaT9HKmE6wn5Sut6IiBjWozrRQ6n5h2RXNtO7O2qCDqjgB2vBxhV7B+z'.
													'hRbLbCmW0tYMDsvPpX5M8fsO05svN+lKtCAuz1leFns8piZpptpSCFn7bWxiA9/f'.
													'x5x17D7pfah3Sy2pA+NDXyzSlGcKdaUmwQIDAQAB'.
													'-----END RSA PUBLIC KEY-----',
													'-----BEGIN RSA PUBLIC KEY-----'.
													'MIIBCgKCAQEAwqjFW0pi4reKGbkc9pK83Eunwj/k0G8ZTioMMPbZmW99GivMibwa'.
													'xDM9RDWabEMyUtGoQC2ZcDeLWRK3W8jMP6dnEKAlvLkDLfC4fXYHzFO5KHEqF06i'.
													'qAqBdmI1iBGdQv/OQCBcbXIWCGDY2AsiqLhlGQfPOI7/vvKc188rTriocgUtoTUc'.
													'/n/sIUzkgwTqRyvWYynWARWzQg0I9olLBBC2q5RQJJlnYXZwyTL3y9tdb7zOHkks'.
													'WV9IMQmZmyZh/N7sMbGWQpt4NMchGpPGeJ2e5gHBjDnlIf2p1yZOYeUYrdbwcS0t'.
													'UiggS4UeE8TzIuXFQxw7fzEIlmhIaq3FnwIDAQAB'.
													'-----END RSA PUBLIC KEY-----'
												];
	static public function find(int $fingerprintnumber,string $data) : string | null {
		foreach(self::RSAKEYS as $rsa):
			list($fingerprint,$modulus,$exponent) = self::loadRsa($rsa);
			if($fingerprint === $fingerprintnumber):
				return self::encrypt($data,$modulus,$exponent);
			endif;
		endforeach;
		return null;
	}
	static private function encrypt(string $data,string $modulus,string $exponent) : string {
		$writer = new Binary();
		$writer->write(sha1($data,true));
		$writer->write($data);
		$length = strlen($data);
		if($length < 0xeb):
			$padding = random_bytes(0xeb - $length);
			$writer->write($padding);
		endif;
		$bytes = $writer->read();
		$number = gmp_import($bytes);
		$pow = gmp_powm($number,$exponent,$modulus);
		$string = Helper::getByteArray(strval($pow));
		return str_pad($string,0x100,chr(0),STR_PAD_LEFT);
	}
	static private function loadRsa(string $publickey) : array {
		$rsa = \phpseclib3\Crypt\RSA::load($publickey);
		$reflection = new \ReflectionClass($rsa);
		$modulus = $reflection->getProperty('modulus')->getValue($rsa);
		$exponent = $reflection->getProperty('exponent')->getValue($rsa);
		$fingerprint = new Binary();
		$fingerprint->tgwriteBytes(Helper::getByteArray($modulus));
		$fingerprint->tgwriteBytes(Helper::getByteArray($exponent));
		$fingerprint->write(substr(sha1($fingerprint->read(),true),-8));
		return array($fingerprint->readLong(),strval($modulus),strval($exponent));
	}
}

?>