<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes salt1 bytes salt2 int g bytes p
 * @return PasswordKdfAlgo
 */

final class PasswordKdfAlgoSHA256SHA256PBKDF2HMACSHA512iter100000SHA256ModPow extends Instance {
	public function request(string $salt1,string $salt2,int $g,string $p) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3a912d4a);
		$writer->tgwriteBytes($salt1);
		$writer->tgwriteBytes($salt2);
		$writer->writeInt($g);
		$writer->tgwriteBytes($p);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['salt1'] = $reader->tgreadBytes();
		$result['salt2'] = $reader->tgreadBytes();
		$result['g'] = $reader->readInt();
		$result['p'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>