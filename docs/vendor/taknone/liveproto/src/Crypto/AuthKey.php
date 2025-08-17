<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Crypto;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Helper;

final class AuthKey {
	public string $key;
	public int $auxHash;
	public int $id;

	public function __construct(string $gab,public readonly int $expires_at){
		$this->key = Helper::getByteArray($gab);
		$reader = new Binary();
		$reader->write(sha1($this->key,true));
		$this->auxHash = $reader->readLong();
		$reader->read(4);
		$this->id = $reader->readLong();
	}
	public function calcNewNonceHash(string $newNonce,int $nonceNumber) : string {
		$writer = new Binary();
		$writer->write($newNonce);
		$writer->writeByte($nonceNumber);
		$writer->writeLong($this->auxHash);
		$newNonceHash = substr(sha1($writer->read(),true),4);
		$writer->write($newNonceHash);
		return $writer->readLargeInt(128);
		// return strval(gmp_import($newNonceHash,16));
	}
}

?>